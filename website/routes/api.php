<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// ============= PUBLIC ROUTES (No authentication required) =============

// Authentication Routes
Route::post('/auth/signup', [AuthController::class, 'signup']);
Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/logout', [AuthController::class, 'logout']);

// Browse Tables (Trang chủ, Tìm kiếm)
Route::get('/tables', [TableController::class, 'list']);
Route::get('/tables/search', [TableController::class, 'search']);
Route::get('/tables/{id}', [TableController::class, 'show']);


// ============= CUSTOMER ROUTES (User authentication required) =============

Route::middleware('user')->group(function () {
    // User Profile (Quản lý tài khoản - Cập nhật thông tin cá nhân)
    Route::get('/user/profile', [UserController::class, 'getProfile']);
    Route::put('/user/profile', [UserController::class, 'updateProfile']);
    Route::put('/user/change-password', [UserController::class, 'changePassword']);

    // Orders (Xem lịch sử & Đặt bàn)
    Route::post('/orders', [OrderController::class, 'create']);                    // Đặt bàn
    Route::get('/orders/{userId}', [OrderController::class, 'getUserOrders']);     // Xem lịch sử
    Route::put('/orders/{id}/cancel', [OrderController::class, 'cancel']);          // Hủy đơn
});


// ============= ADMIN ROUTES (Admin authentication required) =============

Route::middleware('admin')->group(function () {
    // Revenue Management (Xem doanh thu)
    Route::get('/admin/revenue', [AdminController::class, 'viewRevenue']);

    // User Management (Quản lý người dùng)
    Route::get('/admin/users', [AdminController::class, 'listUsers']);
    Route::get('/admin/users/{id}', [AdminController::class, 'showUser']);

    // Table Management (Quản lý bàn)
    Route::post('/admin/tables', [AdminController::class, 'addTable']);             // Thêm bàn
    Route::put('/admin/tables/{id}', [AdminController::class, 'updateTable']);      // Cập nhật bàn
    Route::delete('/admin/tables/{id}', [AdminController::class, 'deleteTable']);   // Xóa bàn

    // Order Management (Quản lý đơn)
    Route::get('/admin/orders', [AdminController::class, 'listOrders']);            // Danh sách đơn
    Route::get('/admin/orders/{id}', [AdminController::class, 'showOrder']);        // Chi tiết đơn
    Route::put('/admin/orders/{id}', [AdminController::class, 'updateOrderStatus']); // Cập nhật trạng thái đơn
});
