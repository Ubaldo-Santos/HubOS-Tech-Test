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
Route::get('/hotels', [App\Http\Controllers\HotelController::class, 'index'])->name('hotels');
Route::get('/hotels/create', [App\Http\Controllers\HotelController::class, 'create'])->name('hotels.create');
Route::post('/hotels', [App\Http\Controllers\HotelController::class, 'store'])->name('hotels.store');
Route::get('/hotels/{hotel}', [App\Http\Controllers\HotelController::class, 'show'])->name('hotels.show');
Route::get('/hotels/{hotel}/edit', [App\Http\Controllers\HotelController::class, 'edit'])->name('hotels.edit');
Route::put('/hotels/{hotel}', [App\Http\Controllers\HotelController::class, 'update'])->name('hotels.update');
Route::delete('/hotels/{hotel}', [App\Http\Controllers\HotelController::class, 'destroy'])->name('hotels.destroy');

// rooms
Route::get('/rooms', [App\Http\Controllers\RoomController::class, 'index'])->name('rooms');
Route::get('/hotels/{hotel}/rooms/create', [App\Http\Controllers\RoomController::class, 'create'])->name('rooms.create');
Route::post('/hotels/{hotel}/rooms', [App\Http\Controllers\RoomController::class, 'store'])->name('rooms.store');
Route::get('/hotels/{hotel}/rooms', [App\Http\Controllers\RoomController::class, 'show'])->name('rooms.show');
Route::get('/hotels/{hotel}/rooms/{room}/edit', [App\Http\Controllers\RoomController::class, 'edit'])->name('rooms.edit');
Route::put('/hotels/{hotel}/rooms/{room}', [App\Http\Controllers\RoomController::class, 'update'])->name('rooms.update');
Route::delete('/hotels/{hotel}/rooms/{room}', [App\Http\Controllers\RoomController::class, 'destroy'])->name('rooms.destroy');
