<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\RevenueController;
use App\Http\Controllers\ReportController;
use App\Models\Table;

Route::get('/', [AuthController::class, 'showLoginForm'])->name('auth.login'); //done

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('auth.login'); //done
Route::post('/login', [AuthController::class, 'login'])->name('auth.login.post'); //done

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('auth.register');
Route::post('/register', [AuthController::class, 'register'])->name('auth.register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback']);

Route::middleware('auth')->prefix('customer')->name('customer.')->group(function () {

    Route::get('/dashboard', function () { //done
        $tables = Table::all();
        return view('customer.dashboard', compact('tables'));
    })->name('dashboard');

    // Route::get('/tables', [TableController::class, 'index'])->name('tables.index');
    // Route::get('/tables/{table}', [TableController::class, 'show'])->name('tables.show');

    Route::get('/booking', [BookingController::class, 'index'])//done
        ->name('booking.index');

    //chuyển đến form đặt bàn
    Route::get('/booking/create/{id}', [BookingController::class, 'create']) //done
        ->name('booking.create');

    // Lưu booking và chuyển đến trang xác nhận
    Route::post('/booking/store/{id}', [BookingController::class, 'store'])
        ->name('booking.store');

    // Trang xác nhận thanh toán
    Route::get('/booking/confirm/{id}', [BookingController::class, 'confirm'])
        ->name('booking.confirm');

    // API xác nhận thanh toán
    Route::post('/booking/confirm-payment/{id}', [BookingController::class, 'confirmPayment'])
        ->name('booking.confirm-payment');

    // Xem chi tiết booking
    Route::get('/booking/detail/{id}', [BookingController::class, 'show'])
        ->name('booking.show');

    //chuyển đến trang profile
    Route::get("/profile", [AuthController::class, 'profile']) //done
        ->name('profile');

    //chuyển đến trang lịch sử đặt bàn
    Route::get('/history', [BookingController::class, 'history']) //done
        ->name('history');

    Route::get('/search', [BookingController::class, 'search']) //done
        ->name('search');
    
    Route::post('/booking/cancel/{id}', [BookingController::class, 'cancel'])
        ->name('booking.cancel');
});
Route::middleware('auth')->group(function () {
    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
    Route::put('/profile', [AuthController::class, 'updateProfile'])->name('profile.update');
});
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');//done

    Route::get('/bookings', [BookingController::class, 'adminIndex'])->name('bookings');//done
    Route::get('/tables', [TableController::class, 'adminIndex'])->name('tables');//done
    Route::get('/tables/create', [TableController::class, 'create'])->name('tables.create');
    Route::post('/tables/store', [TableController::class, 'store'])->name('tables.store');
    Route::get('/tables/{id}/edit', [TableController::class, 'edit'])->name('tables.edit');
    Route::put('/tables/{id}', [TableController::class, 'update'])->name('tables.update');
    Route::delete('/tables/{id}', [TableController::class, 'destroy'])->name('tables.destroy');

    Route::get('/revenue', [RevenueController::class, 'index'])->name('revenue');//done

    Route::get('/reports', [ReportController::class, 'index'])->name('reports');
    Route::get('/export', [ReportController::class, 'export'])->name('reports.export');

});
