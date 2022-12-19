<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GovernorateController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\AppSettingController;
use App\Http\Controllers\Admin\DonationRequestController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\MainController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

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

// Route::get('/', function () {
//     return view('home');
// });
Auth::routes();
Route::get('/client', [LoginController::class, 'showClientLoginForm'])->name('client.login-view');
Route::post('/client', [LoginController::class, 'clientLogin'])->name('client.login');

Route::get('/client/register', [RegisterController::class, 'showClientRegisterForm'])->name('client.register-view');
Route::post('/client/register', [RegisterController::class, 'createClient'])->name('client.register');


// Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::controller(App\Http\Controllers\Auth\ClientController::class)->group(function () {
    Route::post('/client/logout', 'logout')->name('client.logout');
    Route::get('/client/send-email', 'showEmail')->name('client.send-email');
    Route::post('/client/verify-email', 'VerifyEmail')->name('client.verifyemail');

    Route::get('/client/reset-password', 'resetPassword')->name('resetpasswordclient.request');
    Route::get('/client/show-forget-password/{token}/{email}', 'showForgetPassword')->name('client.showforgetPassword');
    Route::post('/client/update-password', 'updatePassword')->name('client.updatePassword');
});
Route::controller(FrontendController::class)->group(function () {
    Route::group(['middleware' => 'auth:clients'], function () {
        Route::post('contact-form', 'contactForm');
        Route::post('toggle-favouite', 'toggleFavouite');
        Route::post('create-donation', 'createDonation')->name('create-donation');
    });
    Route::get('contact', 'contact');
    Route::get('who-are-us', 'whoAreUs');
    Route::get('requests', 'requests');
    Route::get('create-account', 'createAccount');
    Route::get('/', 'index')->name('/');
    Route::get('/show-donation-request', 'showDonationRequest');
    Route::get('/donation-detail/{id}', 'donationDetail');
    Route::post('get-governorate-cities', 'getGovernorateCities');
});
Route::controller(MainController::class)->group(function () {
    // Route::get('/','settings');
});

Route::controller(App\Http\Controllers\Frontend\PostController::class)->group(function () {
    Route::get('post/{id}', 'post');
});




Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.', 'middleware' => 'isAdmin'], function () {

    Route::get('admin', [DashboardController::class, 'index']);
    route::middleware('autoCheckPermission')->group(function () {
        Route::resource('governorate', GovernorateController::class);
        Route::resource('cities', CityController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('posts', PostController::class);
        Route::resource('clients', ClientController::class);
        Route::post('toggle-active', [ClientController::class, 'toggleActive'])->name('client.toggleActive');
        Route::resource('contacts', ContactController::class);
        Route::resource('settings', AppSettingController::class);
        Route::resource('donnations', DonationRequestController::class);
        Route::resource('roles', RolesController::class);
        Route::resource('users', UsersController::class);
    });
    Route::get('change-password', [DashboardController::class, 'changePassword']);
    Route::put('update-password', [DashboardController::class, 'updatePassword']);
});
