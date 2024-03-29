<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Admin\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Admin\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Admin\Auth\NewPasswordController;
use App\Http\Controllers\Admin\Auth\PasswordController;
use App\Http\Controllers\Admin\Auth\PasswordResetLinkController;
use App\Http\Controllers\Admin\Auth\RegisteredUserController;
use App\Http\Controllers\Admin\Auth\VerifyEmailController;
use App\Http\Controllers\Admin\MenusController;
use App\Http\Controllers\Admin\StylistController;
use App\Http\Controllers\Admin\ParkingController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\ReserveController;
use App\Http\Controllers\Admin\HolidayController;
use App\Http\Livewire\Calender;
use App\Models\Reserve;
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

// Route::get('/', function () {
//     return view('admin.welcome');
// });

Route::resource('stylist', StylistController::class)
->middleware(['auth:admin', 'verified'])->except(['show']); //except 不要なメソッド

Route::resource('menu', MenusController::class)
->middleware(['auth:admin', 'verified']);

Route::resource('parking', ParkingController::class)
->middleware(['auth:admin', 'verified'])->except(['create', 'store', 'show', 'edit', 'destroy']);

Route::resource('holiday', HolidayController::class)
->middleware(['auth:admin', 'verified']);

Route::resource('users', UsersController::class)
->middleware(['auth:admin', 'verified']);


Route::get('reserve/past', [ReserveController::class, 'past'])->name('reserve.past')
->middleware(['auth:admin', 'verified']);

Route::get('reserve/select-menu', [ReserveController::class, 'selectMenu'])->name('reserve.select-menu')
->middleware(['auth:admin', 'verified']);
Route::get('reserve/select-calendar', [ReserveController::class, 'selectCalendar'])->name('reserve.select-calendar')
->middleware(['auth:admin', 'verified']);

Route::resource('reserve', ReserveController::class)
->middleware(['auth:admin', 'verified']);

Route::get('reserve/{id}', [ReserveController::class, 'detail'])->name('reserve.detail')
->middleware(['auth:admin', 'verified']);


// Breezeで自動追加 '/dashboard'
Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth:admin', 'verified'])->name('dashboard');

Route::middleware('auth:admin')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware('guest')->group(function () {
    // Route::get('register', [RegisteredUserController::class, 'create'])
    //             ->name('register');

    // Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
                ->name('password.store');
});

Route::middleware('auth:admin')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
                ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');
});
