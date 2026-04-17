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
    Route::get('/booking/{id}', [BookingController::class, 'create']) //done
        ->name('booking.create');

    // Route::post('/booking/{id}', [BookingController::class, 'store'])
    //     ->name('booking.store');

    //chuyển đến trang profile
    Route::get("/profile", [AuthController::class, 'profile']) //done
        ->name('profile');

    //mở popup cập nhật thông tin cá nhân
    Route::put("/profile/update", [AuthController::class, 'updateProfile']) //done
        ->name('profile.update');

    //chuyển đến trang lịch sử đặt bàn
    Route::get('/history', [BookingController::class, 'history']) //done
        ->name('history');

    // Xem chi tiết booking
    Route::get('/booking/{id}', [BookingController::class, 'show'])
        ->name('booking.detail');

    // Route::get('/search', function() {
    //     return view('customer.search');
    // })->name('search');
});

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () { //done
        return view('admin.dashboard');
    })->name('dashboard');
});
