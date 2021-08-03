<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Card\CardController;
use App\Http\Controllers\Frontend\FrontendController;
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
Route::get('/admin',[AdminController::class,'getAdmin'])->name('admin');
//View card
Route::get('/view-card',[CardController::class,'GetCardToIndex'])->name('viewcard');
//View card
Route::get('/all-users',[AdminController::class,'getAllUsers'])->name('allusers');

// Page user
//Profile
Route::get('/profile',[UserController::class,'getProfile'])->name('profile');
//Order history
Route::get('/order-history',[UserController::class,'getOrderHistory'])->name('orderhistory');


//Home
Route::get('/',[FrontendController::class,'getIndex'])->name('index');
//Sign Up
Route::get('/sign-up',[FrontendController::class,'signUp'])->name('signup');
//Sign In
Route::get('/sign-in',[FrontendController::class,'signIn'])->name('signin');
//Buy card
Route::get('/card',[FrontendController::class,'getCardToView'])->name('card');
//card
Route::get('/create-card',[CardController::class,'AddCard'])->name('create-card');
Route::post('/create-card/save',[CardController::class,'SaveCard'])->name('card_save');

//Test
Route::get('/test', function(){
    return view('test');
});
