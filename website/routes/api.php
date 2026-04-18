<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/booking/confirm-payment', [BookingController::class, 'confirmPayment'])
        ->name('api.booking.confirm-payment');
});
