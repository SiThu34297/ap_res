<?php

use App\Http\Controllers\DishController;
use App\Http\Controllers\OrderController;
use App\Models\Dish;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', [OrderController::class,'index'])->name('order.form');
Route::get('/search', [OrderController::class,'index'])->name('order.search');
Route::post('/', [OrderController::class,'submit'])->name('order.submit');

Auth::routes([
  'register' => false, // Registration Routes...
  'reset' => false, // Password Reset Routes...
  'verify' => false, // Email Verification Routes...
  'confirm' => false, // password confirm Routes...
]);

Route::get('/order', [DishController::class, 'order'])->name('order');
Route::resource('/dish', DishController::class );

// admin order approve reject ready
Route::get('/order/{order}/approve',[DishController::class,'approve'])->name('order.approve');
Route::get('/order/{order}/cancel',[DishController::class,'cancel'])->name('order.cancel');
Route::get('/order/{order}/ready',[DishController::class,'ready'])->name('order.ready');

Route::get('/order/{order}/serve',[OrderController::class,'serve'])->name('order.serve');
Route::get('/order/{order}/delete',[OrderController::class,'delete'])->name('order.delete');