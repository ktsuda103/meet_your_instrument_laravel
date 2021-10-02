<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('mypage');
Route::get('/mypage', [HomeController::class, 'mypage'])->name('mypage');
Route::get('/add_item', [HomeController::class, 'add_item'])->name('add_item');
Route::post('/store', [HomeController::class, 'store'])->name('store');
Route::post('/delete', [HomeController::class, 'delete'])->name('delete');
Route::post('/delete_mypage_item', [HomeController::class, 'delete_mypage_item'])->name('delete_mypage_item');
Route::get('/edit/{id}', [HomeController::class, 'edit'])->name('edit');
Route::post('/update', [HomeController::class, 'update'])->name('update');
Route::post('/update_status', [HomeController::class, 'update_status'])->name('update_status');
Route::get('/item_list', [HomeController::class, 'item_list'])->name('item_list');
Route::get('/item_detail/{id}', [HomeController::class, 'item_detail'])->name('item_detail');
Route::get('/user/{id}', [HomeController::class, 'user'])->name('user');
Route::post('/store_cart', [HomeController::class, 'store_cart'])->name('store_cart');
Route::get('/cart', [HomeController::class, 'cart'])->name('cart');
Route::post('/delete_cart', [HomeController::class, 'delete_cart'])->name('delete_cart');
Route::post('/update_cart', [HomeController::class, 'update_cart'])->name('update_cart');
Route::post('/buy', [HomeController::class, 'buy'])->name('buy');
Route::post('/search', [HomeController::class, 'search'])->name('search');
Route::get('/message/{id}', [HomeController::class, 'message'])->name('message');
Route::post('/send_message', [HomeController::class, 'send_message'])->name('send_message');
Route::get('/history/{id}', [HomeController::class, 'history'])->name('history');
Route::post('/store_favorite', [HomeController::class, 'store_favorite'])->name('store_favorite');
Route::get('/favorite/{id}', [HomeController::class, 'favorite'])->name('favorite');
Route::post('/delete_favorite', [HomeController::class, 'delete_favorite'])->name('delete_favorite');
Route::post('/store_friend', [HomeController::class, 'store_friend'])->name('store_friend');
Route::get('/friend/{id}', [HomeController::class, 'friend'])->name('friend');
Route::post('/delete_friend', [HomeController::class, 'delete_friend'])->name('delete_friend');
