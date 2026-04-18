<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\TableController;
use App\Models\Table;

Route::get('/', [AuthController::class, 'showLoginForm'])->name('auth.login'); //done

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('auth.login'); //done
Route::post('/login', [AuthController::class, 'login'])->name('auth.login.post'); //done

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('auth.register');
Route::post('/register', [AuthController::class, 'register'])->name('auth.register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::middleware('auth')->prefix('customer')->name('customer.')->group(function () {

    Route::get('/dashboard', function () { //done
        $tables = Table::all();
        return view('customer.dashboard', compact('tables'));
    })->name('dashboard');

    // Route::get('/tables', [TableController::class, 'index'])->name('tables.index');
    // Route::get('/tables/{table}', [TableController::class, 'show'])->name('tables.show');

    Route::get('/booking', [BookingController::class, 'index'])
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

    //mở popup cập nhật thông tin cá nhân
    Route::put("/profile/update", [AuthController::class, 'updateProfile']) //done
        ->name('profile.update');

    //chuyển đến trang lịch sử đặt bàn
    Route::get('/history', [BookingController::class, 'history']) //done
        ->name('history');
});

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () { //done
        return view('admin.dashboard');
    })->name('dashboard');

    Route::get('/bookings', [BookingController::class, 'adminIndex'])->name('bookings');
    Route::get('/tables', [TableController::class, 'adminIndex'])->name('tables');
    Route::get('/users', [AuthController::class, 'adminIndex'])->name('users');
    Route::get('/revenue', [BookingController::class, 'revenue'])->name('revenue');
    Route::get('/reports', [BookingController::class, 'reports'])->name('reports');

});
