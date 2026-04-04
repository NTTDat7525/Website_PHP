<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\BookingController;

// xác thực người dùng
Route::prefix('auth')->group(function (){
    Route::post('/signup', [AuthController::class, 'signup']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout']);
});
//============ PUBLIC ROUTES =============

// trang chủ, tìm kiếm
Route::get('/tables', [TableController::class, 'index']);
Route::get('/tables/search', [TableController::class, 'search']);
Route::get('/tables/{id}', [TableController::class, 'show']);

// danh sách món ăn
Route::get('/foods', [FoodController::class, 'index']);
Route::get('/foods/{id}', [FoodController::class, 'show']);


// ============= CUSTOMER ROUTES=============

Route::middleware('user')->group(function () {
    // quản lý tài khoản
    Route::get('/user/profile', [UserController::class, 'getProfile']);
    Route::put('/user/profile', [UserController::class, 'updateProfile']);
    Route::put('/user/change-password', [UserController::class, 'changePassword']);

    // đặt bàn
    Route::post('/bookings', [BookingController::class, 'store']);
    Route::get('/bookings/{userId}', [BookingController::class, 'getUserBookings']);
    Route::put('/bookings/{id}/cancel', [BookingController::class, 'cancel']);

    // đơn hàng
    Route::post('/orders', [OrderController::class, 'store']);
    Route::get('/orders/{userId}', [OrderController::class, 'getUserOrders']);
    Route::put('/orders/{id}/cancel', [OrderController::class, 'cancel']);
});


// ============= ADMIN ROUTES =============

Route::middleware('admin')->prefix('admin')->group(function () {
    // xem doanh thu
    Route::get('/revenue', [OrderController::class, 'revenue']);

    // quản lý người dùng
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/users/{id}', [UserController::class, 'show']);
    Route::delete('/users/{id}', [UserController::class, 'destroy']);

    // quản lý bàn
    Route::post('/tables', [TableController::class, 'store']);
    Route::put('/tables/{id}', [TableController::class, 'update']);
    Route::delete('/tables/{id}', [TableController::class, 'destroy']);

    // quản lý đơn
    Route::get('/orders', [OrderController::class, 'index']);
    Route::get('/orders/{id}', [OrderController::class, 'show']);
    Route::put('/orders/{id}', [OrderController::class, 'update']);
    Route::delete('/orders/{id}', [OrderController::class, 'destroy']);
});
