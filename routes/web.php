<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\LoginController;
use App\Http\Controllers\backend\CategoryController;
use App\Http\Controllers\backend\DashboardController;
use App\Http\Controllers\backend\ProductController;
use App\Http\Controllers\frontend\CartController;
use App\Http\Controllers\frontend\homeController;
use App\Http\Controllers\shopeController;
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


});







 Route::prefix('admin/')->group(function(){
         Route::get('login',[LoginController::class,'loginPage'])->name('admin.loginPage');
         Route::post('login',[LoginController::class,'login'])->name('admin.login');
         Route::get('logout',[LoginController::class,'logout'])->name('admin.logout');

              Route::middleware(['auth'])->group(function(){
                  Route::get('dashboard',[DashboardController::class,'dashboard'])->name('admin.dashboard');
               });

        Route::resource('categories',CategoryController::class);
        Route::resource('products',ProductController::class);



  });



