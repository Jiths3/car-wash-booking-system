<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SlotController;

Route::get('/hello', function () {
    return view('welcome');
});

Route::get('/admin/slots/create' , [SlotController::class, 'create']);
Route::post('/admin/slots', [SlotController::class, 'store']);