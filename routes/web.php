<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\LoginController;
use App\Http\Controllers\backend\CategoryController;
use App\Http\Controllers\backend\CouponController;
use App\Http\Controllers\backend\DashboardController;
use App\Http\Controllers\backend\OrderController;
use App\Http\Controllers\backend\PaymentController;
use App\Http\Controllers\backend\ProductController;
use App\Http\Controllers\forntend\auth\RegisterController;
use App\Http\Controllers\frontend\CartController;
use App\Http\Controllers\frontend\CategoryWiseController;
use App\Http\Controllers\frontend\CheackoutController;
use App\Http\Controllers\frontend\CustomerDashboardController;
use App\Http\Controllers\frontend\homeController;
use App\Http\Controllers\frontend\RechargeController;
use App\Http\Controllers\frontend\ResourceController;
use App\Http\Controllers\shopeController;
use App\Http\Requests\RechargeRequest;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/





Route::prefix('')->group(function(){

Route::get('/',[homeController::class,'home'])->name('home');
Route::get('/shop',[shopeController::class,'index'])->name('shope.page');

Route::get('/single product /{product_slug}',[homeController::class,'ProductDatiles'])->name('singleproduct');

Route::get('/shoping-cart',[CartController::class,'cartPage'])->name('cartPage');
Route::post('add-to-cart',[CartController::class,'addTocart'])->name('addTocart');
Route::get('remove-from-cart/{cart_id}',[CartController::class,'removeFromCart'])->name('removeCart');

Route::get('category-wise-list/{id}',[CategoryWiseController::class,'list'])->name('categoryWiselist');
//new add

// Route::get('/nav',[homeController::class,'nevDeatils'])->name('navList');


// authentication use in customer

Route::get('/register',[RegisterController::class,'RegisterPage'])->name('registerPage');
Route::post('/register',[RegisterController::class,'RegisterStore'])->name('registerStore');
Route::get('/login',[RegisterController::class,'loginPage'])->name('customerLogin.page');
Route::post('/login store',[RegisterController::class,'loginStore'])->name('customerLoginStore');
// Route::post('/register',[RegisterController::class,'RegisterStorePage'])->name('registerStore.page');

Route::prefix('customer/')->middleware(['auth','is_customer'])->group(function(){
    Route::get('dashboard',[CustomerDashboardController::class,'CustomarDasboard'])->name('customerDasboard.page');
    Route::get('/logout',[RegisterController::class,'logout'])->name('customer.logout');
    Route::get('/cheackout',[CheackoutController::class,'cheackoutPage'])->name('customerCheackout.page');
    Route::post('/placeorder',[CheackoutController::class,'placeOrder'])->name('customer.placeorder');
    // Route::post('/orderConfirm',[CheackoutController::class,'orderConfirm'])->name('order');
    //payment add
     Route::post('/payment',[CartController::class,'payment'])->name('ApplyPament');
     Route::get('/recharge',[RechargeController::class,'recharge'])->name('RechargePayment');
     //Route::get('/recharge_payment',[RechargeController::class,'RechagePayments'])->name('RequestPayment');
     Route::post('/rechargeSrore',[RechargeController::class,'RechargeStore'])->name('RechargeStore');
     Route::get('/findToken',[RechargeController::class,'FindToken'])->name('Findtoken');

});







});







 Route::prefix('admin/')->group(function(){
         Route::get('login',[LoginController::class,'loginPage'])->name('admin.loginPage');
         Route::post('login',[LoginController::class,'login'])->name('admin.login');
         Route::get('logout',[LoginController::class,'logout'])->name('admin.logout');

              Route::middleware(['auth','is_admin'])->group(function(){
                  Route::get('dashboard',[DashboardController::class,'dashboard'])->name('admin.dashboard');
               });

        Route::resource('categories',CategoryController::class);
        Route::resource('products',ProductController::class);
        Route::resource('coupons',CouponController::class);
        Route::resource('/payment',PaymentController::class);
        Route::get('/order_list',[OrderController::class,'index'])->name('orderList');



  });



