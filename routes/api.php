<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MainControllor;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AuthCycleController;
use App\Http\Controllers\Api\DonationController;
use App\Http\Controllers\Api\NotificationController;

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

Route::group(['prefix' => 'v1'], function () {
    //clients
    Route::controller(AuthController::class)->group(function(){
        Route::post('register','register');
        Route::post('login','login');
        Route::post('logout','logout');
        Route::post('forget-password','forgetPassword');
        Route::post('new-password','newPassword');
        
    });
    Route::controller(MainControllor::class)->group(function () {
        //govs
        Route::get('governorates','governorates');
        //cities
        Route::get('cities', 'cities');
        //category
        Route::get('categories','categories');
        //Blood Types
        Route::get('blood-types','BloodTypes');
        //app setting
        Route::get('app-setting','appSetting');
    });

    Route::group(['middleware' => 'auth:api'], function () {
        Route::controller(AuthCycleController::class)->group(function () {
            Route::get('logout','logout');
            //posts
            Route::get('posts', 'posts');
            Route::get('post/{post_id}', 'post');
            //contacts
            Route::post('contact-us', 'contactUs');
            //profile
            Route::get('profile', 'profile');
            Route::put('update-profile', 'updateProfile');
            //Favourites
            Route::post('add-to-favourite','addToFavourite');
            Route::get('show-favourotes','ShowFavourotes');
            //settings
            Route::get('client-setting','clientSetting');
            Route::post('edit-client-setting','editClientSetting');
        });
        route::controller(DonationController::class)->group(function(){
            Route::post('create-donation','createDonation');
            Route::post('show-donation-requests','showDonationRequests');
            Route::get('donation-request/{donationrequest_id}','donationRequest');
            
        });
        route::controller(NotificationController::class)->group(function(){
            Route::post('register-token','registerToken');
            Route::post('remove-token','removeToken');
            Route::get('notification-list','notificationList');
            Route::get('notification-count','notificationCount');
            Route::get('notification/{id}','notification');
        });
        
    });


















    
});
