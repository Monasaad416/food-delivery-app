<?php

namespace App\Http\Controllers\Api;

use App\Models\Item;
use App\Models\Order;
use App\Models\Client;
use App\Models\Review;
use App\Models\Setting;
use App\Traits\FcmTrait;
use App\Models\Restaurant;
use App\Models\Notification;
use App\Models\PaidCommission;
use Illuminate\Http\Request;
use App\Traits\ApiResponseTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    use ApiResponseTrait ,FcmTrait;

    public function newOrder(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'address' =>'required|string',
            'phone' =>'required|string',
            'restaurant_id' => 'required|exists:restaurants,id',
            'payment_method_id'=> 'required|exists:payment_methods,id',
            'notes'=> 'nullable|string',
            'items.*.item_id' => 'required|exists:items,id',
            'items.*.qty' => 'required|numeric',
            'items.*.add_special' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                $validator->errors()
            ],422);
        }

        $client = $request->user();
        $restaurant = Restaurant::find($request->restaurant_id);
        if($restaurant->availability == false ){
            return $this->apiResponse(0 ,'عذرا المطعم مغلق في الوقت الحالي');
        }

        $order = $client->orders()->create([
            'name' => $request->name,
            'address' =>$request->address,
            'phone' =>$request->phone,
            'restaurant_id' =>$request->restaurant_id,
            'payment_method_id'=> $request->payment_method_id,
            'delivery_fees'=> $request->delivery_fees,
            'notes'=> isset($request->notes) ? $request->notes : '',
        ]);

        $cost = 0;
        foreach($request->items as $addedItem){
            $item = Item::find($addedItem['item_id']);
            $pivotRow = [
                $addedItem['item_id'] => [
                    'qty' => $addedItem['qty'],
                    'item_price' => $item->price,
                    'total_price' => $addedItem['qty'] * $item->price,
                    'add_special' => isset($addedItem['add_special']) ? $addedItem['add_special'] : '',
                    'preparation_time' => $item->preparation_time,
                ]
            ];

            $order->items()->attach($pivotRow);

            $cost += ($item->price * $addedItem['qty']);

        }
            if($cost > $restaurant->min_order_charge){
                $costWithDelivery = $cost + $restaurant->delivery_fees;
                $orderCommission = (Setting::first()->app_commission) * $costWithDelivery /100;
                $netCost = $costWithDelivery - $orderCommission;

                $order->update([
                    'order_price' => $cost,
                    'total_price' => $costWithDelivery,
                    'commission_fees' => $orderCommission,
                ]);

                //create notification to restaurant
                $notification = $restaurant->notifications()->create([
                    'title'=> 'طلب جديد',
                    'body'=> $request->user()->name .'لديك طلب جديد من العميل ',
                    'notifiable_id'=>$restaurant->id,
                    'order_id' => $order->id
                ]);

                //get registered devices tokens for restaurant
                $tokens = $restaurant->notificationTokens->where('token','!=','')->pluck('token')->toArray();

                //prepare required data for fcm
                $title = $notification->title;
                $body = $notification->body;
                $data = [
                    'order' => $order->fresh()->load('items'),
                ];

                //send notification to restaurant devices using fcm
                $this->notifyByFirebase($title,$body,$tokens,$data);
                return $this->apiResponse('200','notification sent successfully',['data' =>$data]);

            } else {
                $order->items()->delete();
                $order->delete();
                return $this->apiResponse(0 ,  ' عذرا اقل تكلفة للطلب هي ' . $restaurant->min_order_charge . 'جنية');
            }

    }

    //restaurant accept order
    public function acceptOrder(Request $request)
    {
        $restaurant = $request->user();
        $order = Order::find($request->order_id);

            $order->status = 2 ;
            $order->save();

            ///notification is_read
            $notification = Notification::where('order_id',$order->id)->where('restaurant_id',$restaurant->id)->first();
            $notification->update([
                'is_read' => 1,

            ]);



            //create notification to restaurant
            $client = Client::where('id',$order->client_id)->first();
            $notification = $client->notifications()->create([
                'title'=> 'حالة الطلب',
                'body'=>   $restaurant->name.'تم قبول طلبك من',
                'client_id'=>$client->id,
                'order_id'=>$order->id,
            ]);

            //get registered devices tokens for restaurant
            $tokens = $client->notificationTokens->where('token','!=','')->pluck('token')->toArray();

            //prepare required data for fcm
            $title = $notification->title;
            $body = $notification->body;
            $data = [
                'order' => $order->with('items'),
            ];

            //send notification to restaurant devices using fcm
            $this->notifyByFirebase($title,$body,$tokens,$data);



        return $this->apiResponse('200','Restaurant accept your order',[
            'order' => $order,
        ]);
    }


    //restaurant reject order
    public function rejectOrder(Request $request)
    {
        $restaurant = $request->user();
        $order = Order::find($request->order_id);

            $order->status = 3 ;
            $order->save();

            $notification = Notification::where('order_id',$order->id)->first();
            $notification->update([
                'is_read' => 1,
            ]);



            //create notification to restaurant
            $client = Client::where('id',$order->client_id)->first();
            $notification = $client->notifications()->create([
                'title'=> 'حالة الطلب',
                'body'=>   $restaurant->name.'تم رفض طلبك من',
                'client_id'=>$client->id,
                'order_id'=>$order->id,
            ]);

            //get registered devices tokens for restaurant
            $tokens = $client->notificationTokens->where('token','!=','')->pluck('token')->toArray();

            //prepare required data for fcm
            $title = $notification->title;
            $body = $notification->body;
            $data = [
                'order' => $order->with('items'),
            ];

            //send notification to restaurant devices using fcm
            $this->notifyByFirebase($title,$body,$tokens,$data);



        return $this->apiResponse('200','Restaurant reject your order',[
            'order' => $order,
        ]);
    }


    //client receive order
    public function receiveOrder(Request $request)
    {
        $client = $request->user();
        $order = Order::find($request->order_id);
        $order->status = 4 ;
        $order->save();

        $notification = Notification::where('order_id',$order->id)->first();
        $notification->update([
            'is_read' => 1,

        ]);

        //create notification to restaurant
        $restaurant = Restaurant::where('id',$order->restaurant_id)->first();
        $notification = $client->notifications()->create([
            'title'=> 'حالة الطلب',
            'body'=>   $client->name.'تم تسليم الطلب للعميل',
            'restaurant_id'=> $restaurant->id,
            'order_id'=>$order->id,
        ]);

        //get registered devices tokens for restaurant
        $tokens = $restaurant->notificationTokens->where('token','!=','')->pluck('token')->toArray();

        //prepare required data for fcm
        $title = $notification->title;
        $body = $notification->body;
        $data = [
            'order' => $order->with('items'),
        ];

        //send notification to restaurant devices using fcm
        $this->notifyByFirebase($title,$body,$tokens,$data);



        return $this->apiResponse('200','Client recieved the order order',[
            'order' => $order,
        ]);
    }

     //client return order
    public function returnOrder(Request $request)
    {
        $client = $request->user();
        $order = Order::find($request->order_id);
        $order->status = 5 ;
        $order->save();

        ///notification is_read
        $notification = Notification::where('order_id',$order->id)->first();
        $notification->update([
            'is_read' => 1,

        ]);

        //create notification to restaurant
        $restaurant = Restaurant::where('id',$order->restaurant_id)->first();
        $notification = $client->notifications()->create([
            'title'=> 'حالة الطلب',
            'body'=>   $client->name.'تم رفض استلام الطلب وتم إعادته من قبل العميل',
            'restaurant_id'=> $restaurant->id,
            'order_id'=>$order->id,
        ]);

        //get registered devices tokens for restaurant
        $tokens = $restaurant->notificationTokens->where('token','!=','')->pluck('token')->toArray();

        //prepare required data for fcm
        $title = $notification->title;
        $body = $notification->body;
        $data = [
            'order' => $order->with('items'),
        ];

        //send notification to restaurant devices using fcm
        $this->notifyByFirebase($title,$body,$tokens,$data);
            return $this->apiResponse('200','Restaurant reject order',[
                'order' => $order,
            ]);
    }


    public function orderReview(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'restaurant_id' => 'required|exists:restaurants,id',
            'comment'=> 'required|string',
            'rating'=> 'required|numeric|in:1,2,3,4,5',
        ]);

        if ($validator->fails()) {
            return response()->json([
                $validator->errors()
            ],422);
        }

        $client = $request->user();
        $review = Review::create([
            'client_id' => $client->id,
            'restaurant_id' => $request->restaurant_id,
            'comment' => $request->comment,
            'rating' => $request->rating,
        ]);

        return $this->apiResponse('200','Review submitted successfully',[
            'review' => $review,
        ]);
    }


    public function restaurantOrders(Request $request)
    {
        $restaurant = $request->user();
        $orders = Order::where('restaurant_id',$restaurant->id)->get();

        return $this->apiResponse('200','Dispaly restaurant orders',[
            'orders' => $orders,
        ]);
    }


    public function clientOrders(Request $request)
    {
        $client = $request->user();
        $orders = Order::where('client_id',$client->id)->get();

        return $this->apiResponse('200','Dispaly client orders',[
            'orders' => $orders,
        ]);
    }

    public function clientPreviousOrders(Request $request)
    {
        $client = $request->user();
        $deliverdOrders = Order::where('client_id',$client->id)->where('status',4)->get();

        return $this->apiResponse('200','Dispaly previews client orders orders',[
            'deliverdOrders' => $deliverdOrders,
        ]);
    }

    public function clientCurrentOrders(Request $request)
    {
        $client = $request->user();
        $currentOrders = Order::where('status',1)->orWhere('status',2)->get();

        return $this->apiResponse('200','Dispaly current client orders',[
            'currentOrders' => $currentOrders,
        ]);
    }


    public function restaurantPendingOrders(Request $request)
    {
        $restaurant = $request->user();

        $pendingOrders = Order::where('status',1)->where('restaurant_id',$restaurant->id)->get();

        return $this->apiResponse('200','Dispaly pending orders of restaurant',[
            'pendingOrders' => $pendingOrders,
        ]);
    }

    public function restaurantAcceptedOrders(Request $request)
    {
        $restaurant = $request->user();

        $acceptedOrders = Order::where('status',2)->where('restaurant_id',$restaurant->id)->get();

        return $this->apiResponse('200','Dispaly accepted orders from restaurant',[
            'acceptedOrders' => $acceptedOrders,
        ]);
    }


    public function restaurantRejectededOrders(Request $request)
    {
        $restaurant = $request->user();
        $rejectedOrders = Order::where('restaurant_id',$restaurant->id)->where('status',3)->get();

        return $this->apiResponse('200','Dispaly rejected orders from restaurant',[
            'rejectedOrders' => $rejectedOrders,
        ]);
    }



    public function readNotification(Request $request)
    {
        $notification = Notification::where('id',$request->notification_id)->where('notifiable_id',$request->user()->id)->first();
        $notification->update([
            'is_read' => 1,
        ]);

        return $this->apiResponse('200','Notification stats',[
            'is_read' => $notification->is_read,
        ]);
    }


    public function clientNotifications(Request $request)
    {
        $client = $request->user();
        $notifications = $client->notifications()->paginate(10);
        return $this->apiResponse('200','Get notifications successfully',[
            'notifications' => $notifications,
        ]);
    }

    public function restaurantNotifications(Request $request)
    {
        $restaurant = $request->user();
        $notifications = $restaurant->notifications()->paginate(10);
        return $this->apiResponse('200','Get notifications successfully',[
            'notifications' => $notifications,
        ]);
    }


    public function commissions(Request $request)
    {

        $totalOrders = Order::where('restaurant_id',$request->user()->id)->sum('total_price');
        $totalCommessions = ($totalOrders * 10 )/ 100;

        $totalPayments = PaidCommission::where('restaurant_id',$request->user()->id)->sum('paid');
        $remainning= $totalCommessions - $totalPayments;

        return $this->apiResponse('200','Get commissions successfully',
        [
            'totalOrders' => $totalOrders,
            'totalCommessions' =>$totalCommessions,
             'totalPayments' => $totalPayments,
             'remainning' => $remainning,
        ]);
    }
}
