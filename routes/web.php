<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\BankController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\RegionController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\RestaurantController;
use App\Http\Controllers\Admin\PaidCommissionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\OfferController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();


Route::prefix('/dashboard')->middleware(['auth','auto_check_permission'])->group( function () {
    Route::get('/',[HomeController::class,'index'])->name('home');
    Route::post('/logout',[LoginController::class,'logout'])->name('logout');
    //restaurants
    Route::get('/restaurants-list',[RestaurantController::class,'restaurantsList'])->name('restaurants.list');
    Route::post('/restaurant/delete',[RestaurantController::class,'delete'])->name('restaurant.delete');
    Route::get('/restaurant/orders/{restaurant_id}',[RestaurantController::class,'restaurantOrders'])->name('restaurant.orders');
    Route::get('/balance_sheet/{restaurant_id}',[RestaurantController::class,'balanceSheetDetails'])->name('commissions.balance_sheet');
    Route::post('/restaurant/availability',[RestaurantController::class,'changeAvailability'])->name('restaurant.change_availability');

    //offers
    Route::get('/offers',[OfferController::class,'index'])->name('offers.index');
    Route::get('/offers-list',[OfferController::class,'offersList'])->name('offers.list');
    Route::post('/offer/delete',[OfferController::class,'delete'])->name('offer.delete');

    //cities
    Route::get('/cities-list',[CityController::class,'citiesList'])->name('cities.list');
    Route::post('/delete-city',[CityController::class,'delete'])->name('city.delete');

    //regions
    Route::get('/regions-list',[RegionController::class,'regionsList'])->name('regions.list');
    Route::get('/regions-by-city/{city_id}',[RestaurantController::class,'getRegionsByCities']);
    Route::post('/delete-region',[RegionController::class,'delete'])->name('region.delete');

    //categories
    Route::get('/categories-list',[CategoryController::class,'categoriesList'])->name('categories.list');
    Route::post('/delete-category',[CategoryController::class,'delete'])->name('category.delete');

    //commissions
    Route::get('/commissions-list',[PaidCommissionController::class,'commissionsList'])->name('commissions.list');
    Route::post('/delete-commission',[PaidCommissionController::class,'delete'])->name('commission.delete');

    //banks
    Route::get('/banks-list',[BankController::class,'banksList'])->name('banks.list');
    Route::post('/delete-bank',[BankController::class,'delete'])->name('bank.delete');

    //users
    Route::get('/users-list',[UserController::class,'usersList'])->name('users.list');
    Route::post('/delete-user',[UserController::class,'delete'])->name('user.delete');

    //roles
    Route::get('/roles-list',[RoleController::class,'rolesList'])->name('roles.list');
    Route::post('/delete-role',[RoleController::class,'delete'])->name('role.delete');


    //settings
    Route::get('/settings/edit',[SettingController::class,'edit'])->name('settings.edit');
    Route::post('/settings/update',[SettingController::class,'update'])->name('settings.update');

    //messages
    Route::get('/messages',[MessageController::class,'index'])->name('messages.all');
    Route::get('/message/show/{id}',[MessageController::class,'show'])->name('message.show');
    Route::get('/messages-list',[MessageController::class,'messagesList'])->name('messages.list');
    Route::post('/message/delete}',[MessageController::class,'delete'])->name('message.delete');


    //clients
    Route::get('/clients',[ClientController::class,'index'])->name('clients.all');
    Route::get('/clients-list',[ClientController::class,'clientsList'])->name('clients.list');
    Route::get('/client/orders/{client_id}',[ClientController::class,'clientOrders'])->name('client.orders');
    Route::post('/client/delete',[ClientController::class,'delete'])->name('client.delete');
    Route::post('/client/status',[ClientController::class,'changeStatus'])->name('client.change_status');


    Route::get('/orders',[OrderController::class,'index'])->name('orders.index');
    Route::get('/orders-list',[OrderController::class,'ordersList'])->name('orders.list');
    Route::get('/order/delete',[OrderController::class,'delete'])->name('order.delete');
    Route::get('/order/show/{id}',[OrderController::class,'show'])->name('order.show');

    //profile
    Route::get('/profile', [ProfileController::class, 'profile'])->name('profile.edit');
    Route::post('/update-profile', [ProfileController::class, 'updateProfile'])->name('profile.update');

    Route::resources([
        'restaurants' => RestaurantController::class,
        'cities' => CityController::class,
        'regions' => RegionController::class,
        'categories' => CategoryController::class,
        'commissions' => PaidCommissionController::class,
        'banks' => BankController::class,
        'users' => UserController::class,
        'roles' => RoleController::class,
        ],
        ['except' => ['destroy']
    ]);


















    Route::get('/test',function(){
        return view('dashboard.pages.test');
    })->name('');

});

