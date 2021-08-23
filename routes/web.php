<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BillController;
use App\Http\Controllers\Card\CardController;
use App\Http\Controllers\Card\SubCardTypeController;
use App\Http\Controllers\Discount\DiscountController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\LoginController;
use App\Http\Controllers\Frontend\SettingController;
use App\Http\Controllers\Partners\PartnersController;
use App\Http\Controllers\Recharge\RechargeCodeController;
use App\Http\Controllers\ShowBill\ShowBillController;
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
    //stores card
    Route::get('/view-card-stores/{name}/price/{price}',[CardController::class,'GetCardStoreToIndex'])->name('view.cards.stores');
    Route::get('/edit-card-store/{id}',[CardController::class,'EditCardStore'])->name('card.store.edit');
    Route::post('/update-card-store/{id}',[CardController::class,'UpdateCardStore'])->name('card.store.update');
    Route::get('/destroy-card-store',[CardController::class,'deleteCardCode'])->name('destroy.card.store');
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
    Route::get('/users-card-bills/{id}',[AdminController::class,'showCardBill'])->name('users.card_bills');
    Route::get('/users-recharge-bills/{id}',[AdminController::class,'showRechargeBill'])->name('users.recharge_bills');
    //card bill
    Route::get('/card-bill',[BillController::class,'cardBill'])->name('cardbill');
    Route::post('/card-bill/exportCardBill',[BillController::class,'exportCardBill'])->name('cardbill.export');
    Route::get('/card-bill-status',[BillController::class,'updateStatus'])->name('cardbill.update.status');
    Route::post('/card-bill-status-all',[BillController::class,'updateStatusAll'])->name('cardbill.update.status.all');
    //recharge bill
    Route::get('/recharge-bill',[BillController::class,'rechargeBill'])->name('rechargebill');
    Route::post('/recharge-bill/exportRechargeBill',[BillController::class,'exportRechargeBill'])->name('rechargebill.export');
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
    Route::post('/update-banner-index/{id}',[SettingController::class,'updateBannerIndex'])->name('updatebannerindex');
    Route::post('/update-background/{id}',[SettingController::class,'updateBackground'])->name('updatebackground');
    Route::post('/update-banner-card/{id}',[SettingController::class,'updateBannerCard'])->name('updatebannercard');
    Route::post('/update-contact/{id}',[SettingController::class,'updateContact'])->name('updatecontact');
    Route::post('/update-serve/{id}',[SettingController::class,'updateServe'])->name('updateserve');
    Route::post('/update-step/{id}',[SettingController::class,'updateStep'])->name('update.step');
    Route::post('/update-to-do/{id}',[SettingController::class,'updateToDo'])->name('update.todo');
    Route::get('/delete-icon/{id}',[SettingController::class,'deleteIcon'])->name('delete.icon');
    Route::get('/delete-icon-serve/{id}',[SettingController::class,'deleteIconServe'])->name('delete.icon.serve');
    Route::get('/delete-icon-todo/{id}',[SettingController::class,'deleteIconToDo'])->name('delete.icon.todo');
    //Discount
    Route::get('/discount',[DiscountController::class,'viewDiscount'])->name('discount');
    Route::post('/discount-create',[DiscountController::class,'createDiscount'])->name('discount.create');
    Route::get('/discount-destroy',[DiscountController::class,'destroy'])->name('discount.destroy');
    Route::get('/discount-destroy-all',[DiscountController::class,'deleteAll'])->name('discount.destroy.all');
    //Recharge code
    Route::get('/recharge-code',[RechargeCodeController::class,'viewRechargeCode'])->name('rechargecode');
    Route::post('/recharge-create',[RechargeCodeController::class,'createRechargeCode'])->name('rechargecode.create');
    Route::get('/recharge-destroy',[RechargeCodeController::class,'destroy'])->name('rechargecode.destroy');
    Route::get('/recharge-destroy-all',[RechargeCodeController::class,'deleteAll'])->name('rechargecode.destroy.all');
    //View sub card
    Route::get('/brand',[SubCardTypeController::class,'index'])->name('brand');
    Route::get('/brand-create',[SubCardTypeController::class,'create'])->name('brand.create');
    Route::post('/brand-save',[SubCardTypeController::class,'store'])->name('brand.store');
    Route::get('/brand-edit/{id}',[SubCardTypeController::class,'edit'])->name('brand.edit');
    Route::post('/brand-update/{id}',[SubCardTypeController::class,'update'])->name('brand.update');
    Route::get('/brand-destroy',[SubCardTypeController::class,'destroy'])->name('brand.destroy');
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
    Route::post('/recharge-code',[UserController::class,'rechargeMoneyCode'])->name('recharge.code');
});
 //Show bill
 Route::get('/show-card-bill/{id}',[ShowBillController::class,'showCardBill'])->name('show.card_bill');
 Route::get('/show-recharge-bill/{id}',[ShowBillController::class,'showRechargeBill'])->name('show.recharge_bill');

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
// Route::get('/test', function(){
//     return view('show_bill.show_card_bill');
// });
