<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Admin\Market\CategoryController;
use App\Http\Controllers\Api\Admin\Market\BrandController;
use App\Http\Controllers\Api\Admin\Market\CommentController;
use App\Http\Controllers\Api\Admin\Market\DeliveryController;
use App\Http\Controllers\Api\Admin\Market\DiscountController;
use App\Http\Controllers\Api\Admin\Market\OrderController;
use App\Http\Controllers\Api\Admin\Market\PaymentController;
use App\Http\Controllers\Api\Admin\Market\ProductController;
use App\Http\Controllers\Api\Admin\Market\GalleryController;
use App\Http\Controllers\Api\Admin\Market\ProductColorController;
use App\Http\Controllers\Api\Admin\Market\GuaranteeController;
use App\Http\Controllers\Api\Admin\Market\PropertyController;
use App\Http\Controllers\Api\Admin\Market\PropertyValueController;
use App\Http\Controllers\Api\Admin\Market\StoreController;
use App\Http\Controllers\Api\Admin\User\AdminUserController;
use App\Http\Controllers\Api\Admin\User\CustomerController;
use App\Http\Controllers\Api\Admin\Ticket\TicketCategoryController;
use App\Http\Controllers\Api\Admin\Ticket\TicketPriorityController;
use App\Http\Controllers\Api\Admin\Ticket\TicketAdminController;
use App\Http\Controllers\Api\Admin\Ticket\TicketController;
use App\Http\Controllers\Api\Admin\Setting\SettingController;
use App\Http\Controllers\Api\Admin\User\RoleController;
use App\Http\Controllers\Api\admin\user\PermissionController;
use App\Http\Controllers\Api\Admin\Market\MarketController;


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


//admin
Route::group(['prefix' => 'admin'], function (){

    Route::group(['prefix' => 'market'], function () {

        //category
        Route::apiResource('category',CategoryController::class);

        //market
        Route::apiResource('market',MarketController::class);

        //brand
        Route::apiResource('brand',BrandController::class);

        //comment
        Route::apiResource('comment',CommentController::class);

        //delivery
        Route::apiResource('delivery',DeliveryController::class);

        //discount
        Route::apiResource('discount',DiscountController::class);

        //order
        Route::apiResource('order',OrderController::class);

        //admin-payment
        Route::apiResource('payment',PaymentController::class);


        //product
        Route::apiResource('product',ProductController::class);

        //gallery
        Route::apiResource('gallery',GalleryController::class);

        //color
        Route::apiResource('color',ProductColorController::class);

        //guarantee
        Route::apiResource('guarantee',GuaranteeController::class);

        //property & property-value
        Route::apiResource('property',PropertyController::class);
        Route::apiResource('property-value',PropertyValueController::class);


        //store
        Route::apiResource('store',StoreController::class);

    });

    //user
    Route::group(['prefix' => 'user'], function (){

        //admin-user
        Route::apiResource('admin-user',AdminUserController::class);

        //customer
        Route::apiResource('customer',CustomerController::class);

        //role
        Route::apiResource('role',RoleController::class);

        //permission
        Route::apiResource('permission',PermissionController::class);

    });

    //ticket
    Route::group(['prefix' => 'ticket'], function (){

        //category
        Route::apiResource('ticketCategory',TicketCategoryController::class);

        //priority
        Route::apiResource('ticketPriority', TicketPriorityController::class);

        //admin
        Route::apiResource('ticketAdmin', TicketAdminController::class);

        //ticket
        Route::apiResource('ticket', TicketController::class);

    });

    Route::apiResource('setting',SettingController::class);

});



