<?php

namespace App\Http\Controllers\Admin;

use DataTables;
use Carbon\Carbon;
use App\Models\Order;
use App\Models\Region;
use App\Models\Category;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use App\Models\PaidCommission;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class RestaurantController extends Controller
{
    public function index()
    {
        return view('dashboard.pages.restaurants.index');
    }

    public function restaurantsList(Request $request)
    {
            $data = Restaurant::latest()->get();
            $user  = auth()->user();
            return DataTables::of($data)
                ->addIndexColumn()
                 ->addColumn('name', function($row){
                    return $row->name;
                })
                ->addColumn('email', function($row){
                    return $row->email;
                })
                ->addColumn('min_order_charge', function($row){
                    return $row->min_order_charge;
                })
                ->addColumn('delivery_fees', function($row){
                    return $row->delivery_fees;
                })
                ->addColumn('whats_app_url', function($row){
                    $url = '<a href="'.$row->whats_app_url.'" >رابط الواتس اب</a>';
                    return $url;
                })
                ->addColumn('phone', function($row){
                    return $row->phone;
                })
                ->addColumn('region_id', function($row){
                    return $row->region->name;
                })
                ->addColumn('image', function($row){
                    $imgUrl = asset('uploads/'.$row->image);
                    $img = '<img src="'. $imgUrl .'"   alt=" '.$row->id.' "/>';
                    return $img;
                })
                ->editColumn('change_restaurant_availability', function($row) use($user){
                    if($user->can('تغيير-حالة-المطعم')){
                        return ($row->availability == 1) ? '<a href="javascript:void(0)" id="change_restaurant_availability_btn" data-id = "'. $row->id .'" data-toggle="modal" data-target="#change_restaurant_availability_modal" title="مفعل الان"><i class="fas fa-toggle-on fa-2x text-success" ></i></a>' 
                            : '<a href="javascript:void(0)" id="change_restaurant_availability_btn" data-id = "'. $row->id .'" data-name = "'. $row->name .'" data-toggle="modal" data-target="#change_restaurant_availability_modal" title="غير مفعل الان"><i class="fas fa-toggle-off fa-2x text-danger"></i></a>';
                        }
                        return '<p class="text-muted">غير مسموح</p>';
                    })
                ->addColumn('show', function($row){
                    $show = '<a href="'. Route('restaurants.show',$row->id) .'"  class="btn btn-secondary btn-sm"><i class="far fa-eye"></i></a>';
                    return $show;
                })
                ->addColumn('delete', function($row) use($user){
                    if($user->can('حذف-المطعم')){
                        $delete ='<button type="button" class="btn btn-danger btn-sm" id="delete_btn" data-id = "'. $row->id .'" data-name = "'. $row->name .'" data-toggle="modal" data-target="#delete_restaurant_modal">
                                    <i class="typcn typcn-document-delete"></i>
                                </button>';      
                        return $delete;
                    }
                    return '<p class="text-muted">غير مسموح</p>';    
                })

                ->addColumn('balance_sheet', function($row) use($user){
                    if($user->can('كشف-حساب')){
                    $balanceSheet = '<a  href="'. Route('commissions.balance_sheet',$row->id) .'"  class="btn btn-info btn-sm"><i class="icon ion-md-paper"></i></a>';
                    return $balanceSheet;
                }
                return '<p class="text-muted">غير مسموح</p>';   
            })


                ->rawColumns(['whats_app_url','image','show','edit','delete','balance_sheet','change_restaurant_availability'])

                ->make(true);

    }

    public function create()
    {
        return view('dashboard.pages.restaurants.create');
    }

    public function getRegionsByCities($city_id)
    {
        $listOfRegions = Region::where('city_id',$city_id)->pluck('name','id');
        return response()->json($listOfRegions);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:restaurants',
            'password'=> 'required|string|min:5|max:25|confirmed',
            'region_id'=> 'required|exists:regions,id',
            'min_order_charge'=> 'required|numeric',
            'delivery_fees'=> 'required|numeric',
            'whats_app_url'=> 'required|url',
            'phone'=> 'required|string',
            'image'=> 'required|image',
            'categories_id' => 'array',
            'categories_id.*' => 'required|exists:categories,id'

        ]);


        $path = Storage::putFile('restaurants', $request->file('image'));

        $restaurant = Restaurant::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make(($request->password)),
            'region_id' => $request->region_id,
            'min_order_charge' => $request->min_order_charge,
            'delivery_fees' => $request->delivery_fees,
            'whats_app_url' => $request->whats_app_url,
            'phone' => $request->phone,
            'image' => $path,
        ]);

        $restaurant->categories()->attach($request->categories_id);


        $request->session()->flash("success");
        return redirect()->route('restaurants.index');
    }

    public function show($id)
    {
        $restaurant = Restaurant::findOrFail($id);
        $data['offers'] = $restaurant->offers()->where('to_date' ,'>', Carbon::now() )->latest()->take(4)->get();
        $data['items'] = $restaurant->items()->latest()->take(3)->get();
        $data['reviews'] = $restaurant->reviews;
        return view('dashboard.pages.restaurants.show',[ 'restaurant' => $restaurant ])->with($data);
    }


    public function edit($id)
    {
        $restaurant = Restaurant::find($id);
        return view('dashboard.pages.restaurants.edit',['restaurant'=>$restaurant]);
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'nullable|string|max:255',
            'email' => 'email',[Rule::unique('restaurants')->ignore($id)],
            'password'=> 'nullable|string|min:5|max:25|confirmed',
            'region_id'=> 'nullable|exists:regions,id',
            'min_order_charge'=> 'nullable|numeric',
            'delivery_fees'=> 'nullable|numeric',
            'whats_app_url'=> 'nullable|url',
            'phone'=> 'nullable|string',
            'image'=> 'nullable|image',
            'categories_id' => 'array',
            'categories_id.*' => 'nullable|exists:categories,id'

        ]);

        $restaurant = Restaurant::find($id);
        $path = $restaurant->image;

        $restaurant->update([
            'name' => $request->name,
            'email' => $request->email,
            'region_id' => $request->region_id,
            'min_order_charge' => $request->min_order_charge,
            'delivery_fees' => $request->delivery_fees,
            'whats_app_url' => $request->whats_app_url,
            'phone' => $request->phone,
        ]);


        if($request->has('password')){
            $newPassword = Hash::make($request->password);
            $restaurant->update(['password'=>$newPassword]);
        };

        if ($request->hasFile('image')) {
            Storage::delete($path);
            $path = Storage::putFile('restaurants', $request->file('image'));
            $restaurant->update(['image'=>$path]);
        }

        $restaurant->categories()->detach();
        $restaurant->categories()->attach($request->categories_id);


        $request->session()->flash("update");
        return redirect()->route('pages.restaurants.index');
    }

    public function delete(Request $request)
    {
        $restaurant = Restaurant::findOrFail($request->id);
        $restaurant->categories()->detach();
        $restaurant->delete();
        $request->session()->flash("delete");
        return redirect()->route('restaurants.index');
    }


    public function balanceSheet($restaurant_id)
    {
        return view('dashboard.pages.restaurants.balance_sheet');
    }

    public function restaurantOrders($restaurant_id)
    {

        $restaurant = restaurant::findOrFail($restaurant_id);
        $orders= $restaurant->orders;
        return view('dashboard.pages.restaurants.restaurant_orders',['restaurant' => $restaurant ,'orders' => $orders]);

    }



    public function balanceSheetDetails(Request $request,$restaurant_id)
    {
        $restaurant = Restaurant::findOrFail($restaurant_id);
        $totalOrders = Order::where('restaurant_id',$restaurant->id)->sum('total_price');
        $totalCommessions = ($totalOrders * 10 )/ 100;

        $totalPayments = PaidCommission::where('restaurant_id',$restaurant->id)->sum('paid');
        $remainning= $totalCommessions - $totalPayments;

     return view('dashboard.pages.restaurants.balance_sheet',[
        'restaurant'=>$restaurant,
        'totalOrders'=>$totalOrders,
        'totalCommessions'=>$totalCommessions,
        'totalPayments'=>$totalPayments,
        'remainning'=>$remainning,
     ]);

    }


    
    public function changeAvailability(Request $request)
    {
        $restaurant = Restaurant::where('id',$request->id)->first();
        // return dd($restaurant);
        if( $restaurant->availability == 1 ){
            $restaurant->update(['availability' => 0]);
        }else {
            $restaurant->update(['availability' => 1]);
        }
        $request->session()->flash("update");
        return redirect()->back();
    }
}
?>
