<?php

use App\Http\Controllers\SlotController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;




Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {

    // USER ROUTES
    Route::get('user/slot', [SlotController::class, 'index']);
    Route::post('users/bookings', [BookingController::class, 'store']);

    // ADMIN ROUTES (role protection later)
    Route::get('admin/slots/create', [SlotController::class, 'create']);
    Route::post('admin/slots', [SlotController::class, 'store']);

});

require __DIR__.'/auth.php';
