<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Client;
use App\Models\City;
use App\Models\Region;
use App\Models\Category;
use App\Models\Order;
use App\Models\PaidCommission;
use App\Models\Offer;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['restaurants'] = Restaurant::all();
        $data['clients'] = Client::all();
        $data['cities'] = City::all();
        $data['regions'] = Region::all();
        $data['categories'] = Category::all();
        $data['orders'] = Order::latest()->get();
        $data['commissions'] = PaidCommission::latest()->get();
        $data['offers'] = Offer::all();

        return view('dashboard.pages.index')->with($data);
    }
}
