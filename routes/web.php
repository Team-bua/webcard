<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BillController;
use App\Http\Controllers\Card\CardController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\LoginController;
use App\Http\Controllers\Frontend\SettingController;
use App\Http\Controllers\Partners\PartnersController;
use App\Http\Controllers\PaymentController;
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
    Route::post('/admin',[AdminController::class,'getAdmin'])->name('admin.search');
    //View card
    Route::get('/view-card',[CardController::class,'GetCardToIndex'])->name('viewcard');
    //card
    Route::get('/create-card',[CardController::class,'AddCard'])->name('create-card');
    Route::post('/create-card/save',[CardController::class,'SaveCard'])->name('card_save');
    Route::get('/edit-card/{id}',[CardController::class,'EditCard'])->name('card_edit');
    Route::get('/delete-price/{id}',[CardController::class,'deletePrice'])->name('card_price_delete');
    Route::post('/edit-card/update/{id}',[CardController::class,'UpdateCard'])->name('card_update');
    Route::get('/add-card-code',[CardController::class,'AddCardCode'])->name('add-card-code');
    Route::post('/add-card-code/save',[CardController::class,'StoreCardCode'])->name('card-code-save');
    Route::get('/destroy',[CardController::class,'delete'])->name('destroy');
    //View user
    Route::get('/all-users',[AdminController::class,'getAllUsers'])->name('allusers');
    Route::get('/users/banned/{id}',[AdminController::class,'banned'])->name('users.banned');
    Route::get('/users/unbanned/{id}',[AdminController::class,'unbanned'])->name('users.unbanned');
    Route::post('/users/update/{id}',[AdminController::class,'updatePoint'])->name('users.update');
    //card bill
    Route::get('/card-bill',[BillController::class,'cardBill'])->name('cardbill');
    //recharge bill
    Route::get('/recharge-bill',[BillController::class,'rechargeBill'])->name('rechargebill');
    //View bank
    Route::get('/bank-info',[AdminController::class,'getBankInfo'])->name('bankinfo');
    Route::post('/update-bank-info/{id}',[AdminController::class,'updateBankInfo'])->name('update.bankinfo');
    //View partners
    Route::get('/partners',[PartnersController::class,'index'])->name('partners');
    Route::get('/partners-create',[PartnersController::class,'create'])->name('partners.create');
    Route::post('/partners-save',[PartnersController::class,'store'])->name('partners.store');
    Route::get('/partners-edit/{id}',[PartnersController::class,'edit'])->name('partners.edit');
    Route::post('/partners-update/{id}',[PartnersController::class,'update'])->name('partners.update');
    Route::get('/partners-destroy',[PartnersController::class,'destroy'])->name('partners.destroy');
    //Setting index
    Route::get('/setting',[SettingController::class,'viewSetting'])->name('setting');
    Route::post('/update-logo/{id}',[SettingController::class,'updateLogo'])->name('updatelogo');
    Route::post('/update-banner-card/{id}',[SettingController::class,'updateBannerCard'])->name('updatebannercard');
    Route::post('/update-contact/{id}',[SettingController::class,'updateContact'])->name('updatecontact');
    Route::post('/update-serve/{id}',[SettingController::class,'updateServe'])->name('updateserve');
});

Route::group(['middleware' => 'login'], function () {
    // Page user
    //Profile
    Route::get('/profile/{id}',[UserController::class,'getProfile'])->name('profile');
    Route::post('/profile/update/{id}',[UserController::class,'updateInfo'])->name('profile.update.info');
    Route::post('/profile/change/{id}',[UserController::class,'changePass'])->name('profile.change_pass');
    //Order history
    Route::get('/order-history',[UserController::class,'getOrderHistory'])->name('orderhistory');
    //recharge
    Route::get('/recharge',[UserController::class,'recharge'])->name('recharge');
    Route::get('/recharge-history',[UserController::class,'getRechargeHistory'])->name('rechargehistory');
    //VN Pay
    Route::post('/payment/online',[UserController::class,'createPayment'])->name('payment.online');
    Route::get('/vnpay/return',[UserController::class,'vnpayReturn'])->name('vnpay.return');
});

//Login Facebook
Route::get('/social-login/redirect/{provider}', [LoginController::class,'redirectToProvider'])->name('social.login');
Route::get('/social-login/{provider}/callback', [LoginController::class,'handleProviderCallback'])->name('social.callback');
//Home
Route::get('/',[FrontendController::class,'getIndex'])->name('index');
//Contact
Route::get('/contact',[FrontendController::class,'contact'])->name('contact');
//About
Route::get('/about',[FrontendController::class,'about'])->name('about');
//Terms of use
Route::get('/terms-of-use',[FrontendController::class,'termOfUse'])->name('termOfUse');
//Privacy
Route::get('/privacy',[FrontendController::class,'privacy'])->name('privacy');
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
//buy card
Route::get('/buy-card',[CardController::class,'BuyCard'])->name('buy_card');
//transaction
Route::post('handler-bank-transfer',[FrontendController::class,'transtionInfo'])->name('transtion.info');
//Test
Route::get('/test', function(){
    return view('test');
});
