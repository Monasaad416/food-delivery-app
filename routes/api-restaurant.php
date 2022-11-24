<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MainController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\Restaurant\AuthController;
use App\Http\Controllers\Api\Restaurant\ItemController;
use App\Http\Controllers\Api\Restaurant\OfferController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/




Route::prefix('/restaurant')->group(function(){
    Route::post('/register',[AuthController::class,'register']);
    Route::post('/login',[AuthController::class,'login']);
    Route::post('/reset-password',[AuthController::class,'resetPassword']);
    Route::post('/new-password',[AuthController::class,'sendNewPassword']);

    Route::middleware('auth:sanctum')->group(function() {
        Route::post('/logout',[AuthController::class,'logout']);
        
        Route::get('/profile',[AuthController::class,'profile']);
        Route::post('/update-profile',[AuthController::class,'updateProfile']);

        Route::post('/create-item',[ItemController::class,'createItem']);
        Route::post('/edit-item/{restaurantId}/{ItemId}',[ItemController::class,'editItem']);
        Route::post('/delete-item/{restaurantId}/{ItemId}',[ItemController::class,'deleteItem']);

        Route::post('/create-offer',[OfferController::class,'createOffer']);
        Route::post('/edit-offer/{restaurantId}/{OfferId}',[OfferController::class,'editOffer']);
        Route::post('/delete-offer/{restaurantId}/{OfferId}',[OfferController::class,'deleteOffer']);

        Route::post('/accept-order',[OrderController::class,'acceptOrder']);
        Route::post('/reject-order',[OrderController::class,'rejectOrder']);

        Route::get('/categories',[MainController::class,'categories']);
        Route::get('/orders',[orderController::class,'restaurantOrders']);
        Route::get('/pending-orders',[orderController::class,'restaurantPendingOrders']);
        Route::get('/accepted-orders',[orderController::class,'restaurantAcceptedOrders']);
        Route::get('/rejected-orders',[orderController::class,'restaurantRejectededOrders']);

        Route::Post('/read-notification',[OrderController::class,'readNotification']);
        Route::get('/notifications',[OrderController::class,'restaurantNotifications']);

    });

});


