<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\WebController;

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

Route::get('/', [WebController::class, 'index'])->name('web.index');

Route::resource('stores', StoreController::class)->middleware(['auth', 'verified']);
Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('stores/{store}/favorite', [StoreController::class, 'favorite'])->name('stores.favorite');
Route::resource('stores', StoreController::class);

Route::post('reviews', [ReviewController::class, 'store'])->name('reviews.store');
