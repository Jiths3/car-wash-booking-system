<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SlotController;
use App\Http\Controllers\BookingController;

Route::get('/hello', function () {
    return view('welcome');
});

Route::get('/admin/slots/create' , [SlotController::class, 'create']);
Route::post('/admin/slots', [SlotController::class, 'store']);


// Route::get('users/bookings/create', [BookingController::class, 'create']);

Route::post('/users/bookings', [BookingController::class, 'store']);
Route::get('/users/slot', [SlotController::class, 'index']);
