<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\TransactionController;
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

Route::get('/', [Controller::class, 'index'])->name('home');
Route::get('/home', [Controller::class, 'index']);

Route::get('/register', [ProfileController::class, 'indexRegister'])->name('register');
Route::post('/register', [ProfileController::class, 'register']);
Route::get('/login', [ProfileController::class, 'indexLogin'])->name('login');
Route::get('/logout', [ProfileController::class, 'logout'])->name('logout');
Route::post('/login', [ProfileController::class, 'login']);

Route::get('/food', [ItemController::class, 'indexProductsFood'])->name('productsFood');
Route::get('/beverage', [ItemController::class, 'indexProductsDrink'])->name('productsDrink');
Route::get('/dessert', [ItemController::class, 'indexProductsDessert'])->name('productsDessert');
Route::get('/products/{product:id}', [ItemController::class, 'indexProductDetail'])->name('productDetail');
Route::get('/manageItem', [ItemController::class, 'indexManageItem'])->middleware('checkrole:admin')->name('manageItem');
Route::delete('/deleteItem/{product:id}', [ItemController::class, 'deleteItem']);
Route::get('/addItem', [ItemController::class, 'indexAddItem'])->name('addItem')->middleware('checkrole:admin');
Route::post('/addItem', [ItemController::class, 'addItem']);
Route::get('/updateItem/{product:id}', [ItemController::class, 'indexUpdateItem'])->name('updateItem')->middleware('checkrole:admin');
Route::put('/updateItem/{product:id}', [ItemController::class, 'updateItem']);

Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/addcart', [CartController::class, 'addCart']);

Route::post('/deleteCartItem', [CartController::class, 'deleteCartItem']);
Route::get('/updateCartQuantity/{product:id}', [CartController::class, 'indexUpdateCart']);
Route::put('/updateCartItem', [CartController::class, 'updateCartQuantity']);


Route::get('/transactionHistory', [TransactionController::class, 'index'])->middleware('checkrole:customer')->name('transactionHistory');
Route::post('/checkout', [TransactionController::class, 'checkout']);
