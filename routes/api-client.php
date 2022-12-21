<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MainController;
use App\Http\Controllers\Api\Client\AuthController;
use App\Http\Controllers\Api\OrderController;

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

Route::prefix('/client')->group(function(){
    Route::post('/register',[AuthController::class,'register']);
    Route::post('/login',[AuthController::class,'login']);
    Route::post('/reset-password',[AuthController::class,'resetPassword']);
    Route::post('/new-password',[AuthController::class,'sendNewPassword']);
    Route::post('/register-device-token',[AuthController::class,'registerDeviceToken']);
    Route::post('/remove-device-token',[AuthController::class,'removeDeviceToken']);


    Route::middleware('auth:sanctum')->group( function() {
        //clients routes
        Route::post('/logout',[AuthController::class,'logout']);
       
        Route::get('/profile',[AuthController::class,'profile']);
        Route::post('/update-profile',[AuthController::class,'updateProfile']);

        Route::post('/new-order',[OrderController::class,'newOrder']);
        Route::post('/receive-order',[OrderController::class,'receiveOrder']);
        Route::post('/return-order',[OrderController::class,'returnOrder']);
        Route::post('/submit-review',[OrderController::class,'orderReview']);

        Route::get('/orders',[OrderController::class,'clientOrders']);
        Route::get('/current-orders',[OrderController::class,'clientCurrentOrders']);
        Route::get('/previous-orders',[OrderController::class,'clientPreviousOrders']);

        Route::post('/read-notification',[OrderController::class,'readNotification']);
        Route::get('/notifications',[OrderController::class,'clientNotifications']);



    });

});


