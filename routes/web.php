<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Card\CardController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\LoginController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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
//Admin
Route::group(['middleware' => 'user'], function () {
    Route::get('/admin',[AdminController::class,'getAdmin'])->name('admin');
    //View card
    Route::get('/view-card',[CardController::class,'GetCardToIndex'])->name('viewcard');
    //View card
    Route::get('/all-users',[AdminController::class,'getAllUsers'])->name('allusers');
    Route::get('/users/banned/{id}',[AdminController::class,'banned'])->name('users.banned');
    Route::get('/users/unbanned/{id}',[AdminController::class,'unbanned'])->name('users.unbanned');
});

Route::group(['middleware' => 'login'], function () {
    // Page user
    //Profile
    Route::get('/profile/{id}',[UserController::class,'getProfile'])->name('profile');
    Route::post('/profile/update/{id}',[UserController::class,'updateInfo'])->name('profile.update.info');
    Route::post('/profile/change/{id}',[UserController::class,'changePass'])->name('profile.change_pass');
    //Order history
    Route::get('/order-history',[UserController::class,'getOrderHistory'])->name('orderhistory');
});

//Login Facebook
Route::get('/social-login/redirect/{provider}', [LoginController::class,'redirectToProvider'])->name('social.login');
Route::get('/social-login/{provider}/callback', [LoginController::class,'handleProviderCallback'])->name('social.callback');
//Home
Route::get('/',[FrontendController::class,'getIndex'])->name('index');
//Contact
Route::get('/contact',[FrontendController::class,'contact'])->name('contact');
//Sign Up
Route::get('/sign-up',[FrontendController::class,'signUp'])->name('signup');
Route::post('/sign-up',[FrontendController::class,'postSignup'])->name('signup');
//Sign In
Route::get('/sign-in',[FrontendController::class,'signIn'])->name('signin');
Route::post('/sign-in',[FrontendController::class,'postSignIn'])->name('signin');
//Logout
Route::get('/logout',[FrontendController::class,'postLogout'])->name('logout');
//Buy card
Route::get('/card',[FrontendController::class,'getCardToView'])->name('card');
//card
Route::get('/create-card',[CardController::class,'AddCard'])->name('create-card');
Route::post('/create-card/save',[CardController::class,'SaveCard'])->name('card_save');
Route::get('/edit-card/{id}',[CardController::class,'EditCard'])->name('card_edit');
Route::get('/delete-price/{id}',[CardController::class,'deletePrice'])->name('card_price_delete');
Route::post('/edit-card/update/{id}',[CardController::class,'UpdateCard'])->name('card_update');
//Test
Route::get('/test', function(){
    return view('test');
});
