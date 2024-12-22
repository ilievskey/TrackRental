<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Api\CarController;
use Illuminate\Support\Facades\Route;

Route::get('/', [IndexController::class, 'index'])->name('index');
Route::get('/cars/{id}', [CarController::class, 'show'])->name('cars.show')->middleware('check.reservation');
Route::get('/cars/{id}/reserve', [ReservationController::class, 'create'])->name('reserve')->middleware('auth', 'check.reservation');
Route::post('/cars/{id}/reserve', [ReservationController::class, 'store'])->name('reserve.store')->middleware('auth', 'check.reservation');

Route::get('/admin-dashboard', [AdminController::class, 'index'])->name('admin.dashboard')->middleware('auth', 'check.admin');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/logout', function () {
    return redirect('/');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
