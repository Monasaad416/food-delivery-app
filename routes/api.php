<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MainController;

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

Route::get('/cities',[MainController::class,'cities']);
Route::get('/regions',[MainController::class,'regions']);
Route::get('/banks',[MainController::class,'banks']);
Route::get('/payment-methods',[MainController::class,'paymentMethods']);
Route::get('/restaurants',[MainController::class,'restaurants']);
Route::post('/send-message',[MainController::class,'sendMessage']);
Route::get('/items',[MainController::class,'items']);
Route::get('/reviews',[MainController::class,'getReviews']);
Route::get('/offers',[MainController::class,'offers']);
Route::get('/settings',[MainController::class,'settings']);




