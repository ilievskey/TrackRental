<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Api\CarController;
use Illuminate\Support\Facades\Route;

//index
Route::get('/', [IndexController::class, 'index'])->name('index');
Route::get('/message', [IndexController::class, 'getMessage']);

Route::get('/cars/{id}', [CarController::class, 'show'])->name('cars.show')->middleware('check.reservation');
Route::get('/cars/{id}/reserve', [ReservationController::class, 'create'])->name('reserve')->middleware('auth', 'check.reservation');
Route::post('/cars/{id}/reserve', [ReservationController::class, 'store'])->name('reserve.store')->middleware('auth', 'check.reservation');

//admin main - reservations
Route::get('/admin-dashboard', [AdminController::class, 'index'])->name('admin-dashboard')->middleware('auth', 'check.admin');
Route::delete('/admin-dashboard/{id}', [AdminController::class, 'destroy'])->name('admin-dashboard.destroy')->middleware('auth', 'check.admin');

//admin cars
Route::get('/admin-cars', [AdminController::class, 'indexCar'])->name('admin-cars')->middleware('auth', 'check.admin');
Route::post('/admin-cars/', [AdminController::class, 'storeCar'])->name('admin-cars.storeCar')->middleware('auth', 'check.admin');
Route::delete('/admin-cars/{id}', [AdminController::class, 'destroyCar'])->name('admin-cars.destroyCar')->middleware('auth', 'check.admin');

Route::get('admin-cars/{id}', [AdminController::class, 'showCarForUpdate'])->name('admin-car.showCarForUpdate')->middleware('auth', 'check.admin');
Route::put('/admin-cars/{id}', [AdminController::class, 'updateCar'])->name('admin-cars.updateCar')->middleware('auth', 'check.admin');

//admin users
Route::get('/admin-users', [AdminController::class, 'indexUser'])->name('admin-users')->middleware('auth', 'check.admin');
Route::delete('/admin-users/{id}', [AdminController::class, 'destroyUser'])->name('admin-users.destroyUser')->middleware('auth', 'check.admin');

//admin message
Route::get('/admin-message', [AdminController::class, 'adminMessage'])->name('admin-message')->middleware('auth', 'check.admin');
Route::post('/admin-message', [AdminController::class, 'storeMessage'])->name('admin-message.store')->middleware('auth', 'check.admin');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'no.dashboard'])->name('dashboard');

Route::get('/logout', function () {
    return redirect('/');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
