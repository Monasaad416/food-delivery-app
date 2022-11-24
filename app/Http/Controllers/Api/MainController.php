<?php

namespace App\Http\Controllers\Api;

use App\Models\Bank;
use App\Models\City;
use App\Models\Item;
use App\Models\Offer;
use App\Models\Region;
use App\Models\Review;
use App\Models\Message;
use App\Models\Setting;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use App\Traits\ApiResponseTrait;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;

class MainController extends Controller
{
    use ApiResponseTrait;

    public function settings()
    {
        $settings = Setting::first();
        return $this->apiResponse('200','About app',[
            'settings' => $settings,
        ]);
    }
    public function cities()
    {
        $cities = City::all();
        return $this->apiResponse('200','Get all cities successfully',[
            'cities' => $cities,
        ]);
    }

    public function regions(Request $request)
    {
        $regions = Region::where(function($query) use($request){
            if($request->has('city_id')){
                $query->where('city_id',$request->city_id);
            }
        })->with('city')->get();

        return $this->apiResponse('200','Get regions successfully',[
            'regions' => $regions,
        ]);
    }

    public function banks()
    {
        $banks = Bank::all();
        return $this->apiResponse('200','Get all banks successfully',[
            'banks' => $banks,
        ]);
    }

    public function paymentMethods()
    {
        $paymentMethods = PaymentMethod::all();
        return $this->apiResponse('200','Get all payment methods successfully',[
            'paymentMethods' => $paymentMethods,
        ]);
    }

    public function restaurants(Request $request)
    {
        $restaurants = Restaurant::where(function($query) use($request){
                if($request->has('id')){
                    $query->where('id',$request->id);
                }
            })->where(function($query) use($request){
                if($request->has('city_id')){
                    $query->whereHas('region',function($query) use($request){
                        $query->where('city_id',$request->city_id);
                    });
                }
            })->get();

            return $this->apiResponse('200','Get restaurants successfully',[
            'restaurants' => $restaurants,

        ]);
    }
    public function offers(Request $request)
    {
        $offers = Offer::where(function($query) use($request){
                if($request->has('id')){
                    $query->where('id', $request->id);
                }
            })->get();

            return $this->apiResponse('200','Get offers successfully',[
            'offers' => $offers,

        ]);
    }


    public function categories(Request $request)
    {
        $categories = Category::all();

            return $this->apiResponse('200','Get categories successfully',[
            'categories' => $categories,

        ]);
    }

    public function getReviews()
    {
        $reviews = Review::paginate(15);
        return $this->apiResponse('200','Get reviews successfully',[
            'reviews' => $reviews,

        ]);
    }



    public function sendMessage(Request $request)
    {
        $types = Message::types();

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:restaurants',
            'phone'=> 'required|string',
            'content'=> 'required|string',
            'type'=> 'required|numeric|in:'.implode(',',$types),

        ]);
            if ($validator->fails()) {
                return response()->json([
                    $validator->errors()
                ],422);
            }
            $message = Message::create($request->all());





        return $this->apiResponse('200','Restaurant Added Successfully',[
            'message' => $message,
        ]);
    }


    public function items(Request $request)
    {
        $items = Item::where(function($query) use($request){
                if($request->has('id')){
                    $query->where('id',$request->id);
                }
            })->with('restaurant')->get();

            return $this->apiResponse('200','Get items successfully',[
            'items' => $items,

        ]);
    }





}
