<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ComponentTestController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\ParkingController;
use App\Http\Controllers\User\ReservationController;

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

Route::get('/', function () {
    return view('user.welcome');
});

Route::resource('parking', ParkingController::class)
->middleware(['auth:users', 'verified']);

Route::get('reservation/future', [ReservationController::class, 'future'])->name('reservation.future')
->middleware(['auth:users', 'verified']);

Route::get('reservation/select-menu', [ReservationController::class, 'selectmenu'])->name('reservation.select-menu')
->middleware(['auth:users', 'verified']);
Route::get('reservation/select-calendar', [ReservationController::class, 'selectcalendar'])->name('reservation.select-calendar')
->middleware(['auth:users', 'verified']);

Route::resource('reservation', ReservationController::class)
->middleware(['auth:users', 'verified']);

// Breezeで自動追加 '/dashboard'
Route::get('/dashboard', function () {
    return view('user.dashboard');
})->middleware(['auth:users', 'verified'])->name('dashboard');

Route::middleware('auth:users')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/component-test1', [ComponentTestController::class, 'showComponent1']);
Route::get('/component-test2', [ComponentTestController::class, 'showComponent2']);

require __DIR__.'/auth.php'; // Breezeで自動追加
