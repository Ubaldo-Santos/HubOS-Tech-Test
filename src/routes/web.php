<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// hotels
Route::get('/hotels', [App\Http\Controllers\hotels\HotelsController::class, 'index'])->name('hotels.index');
Route::post('/hotels', [App\Http\Controllers\hotels\HotelsController::class, 'store'])->name('hotels.store');
Route::get('/hotels/{hotel}', [App\Http\Controllers\hotels\HotelsController::class, 'show'])->name('hotels.show');
Route::post('/hotels/{hotel}', [App\Http\Controllers\hotels\HotelsController::class, 'update'])->name('hotels.update');
Route::delete('/hotels/{hotel}', [App\Http\Controllers\hotels\HotelsController::class, 'destroy'])->name('hotels.destroy');


// rooms
Route::post('/hotels/{hotel}/room', [App\Http\Controllers\rooms\RoomsController::class, 'store'])->name('rooms.store');
Route::get('/hotels/{hotel}/room/{room}', [App\Http\Controllers\rooms\RoomsController::class, 'show'])->name('rooms.show');
Route::post('/hotels/{hotel}/room/{room}', [App\Http\Controllers\rooms\RoomsController::class, 'update'])->name('rooms.update');
Route::delete('/hotels/{hotel}/room/{room}', [App\Http\Controllers\rooms\RoomsController::class, 'destroy'])->name('rooms.destroy');
