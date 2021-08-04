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
});

Route::group(['middleware' => 'login'], function () {
    // Page user
    //Profile
    Route::get('/profile/{id}',[UserController::class,'getProfile'])->name('profile');
    //Order history
    Route::get('/order-history',[UserController::class,'getOrderHistory'])->name('orderhistory');
});

//Login Facebook
Route::get('/social-login/redirect/{provider}', [LoginController::class,'redirectToProvider'])->name('social.login');
Route::get('/social-login/{provider}/callback', [LoginController::class,'handleProviderCallback'])->name('social.callback');
//Home
Route::get('/',[FrontendController::class,'getIndex'])->name('index');
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

//Test
Route::get('/test', function(){
    return view('test');
});
