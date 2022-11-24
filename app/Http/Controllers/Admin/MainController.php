<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Client;
use App\Models\City;
use App\Models\Region;
use App\Models\Category;
use App\Models\Order;

class MainController extends Controller
{
    public function index()
    {
        $data['restaurants'] = Restaurant::all();
        $data['clients'] = Client::all();
        $data['cities'] = City::all();
        $data['regions'] = Region::all();
        $data['categories'] = Category::all();
        $data['orders'] = Order::all();
        return view('dashboard.pages.index')->with($data);
    }
}
