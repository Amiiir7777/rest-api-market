<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\Customer\HomeController;
use App\Http\Controllers\Api\Customer\SalesProcess\CartController;
use App\Http\Controllers\Api\Customer\SalesProcess\ProfileCompletionController;
use App\Http\Controllers\Api\Customer\SalesProcess\AddressController;
use App\Http\Controllers\Api\Customer\SalesProcess\PaymentController as CustomerPaymentController;
use App\Http\Controllers\Api\Customer\Market\ProductController;
use App\Http\Controllers\Api\Customer\Profile\AddressController as ProfileAddressController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//customer-home
Route::apiResource('/home',HomeController::class)->only('index');

//cart
Route::apiResource('cart',CartController::class);

//profile completion
Route::apiResource('profile-completion',ProfileCompletionController::class);

Route::middleware('profile.completion')->group(function (){
    //address
    Route::apiResource('address',AddressController::class);
    //payment
    Route::apiResource('customer-payment',CustomerPaymentController::class);
    //market
    Route::apiResource('market',ProductController::class);
    //profile
    Route::apiResource('profile',ProfileAddressController::class);
});
