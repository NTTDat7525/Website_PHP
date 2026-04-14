<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\TableController;
use App\Models\Table;

Route::get('/', [AuthController::class, 'showLoginForm'])->name('auth.login');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('auth.login');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login.post');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('auth.register');
Route::post('/register', [AuthController::class, 'register'])->name('auth.register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::middleware('auth')->prefix('customer')->name('customer.')->group(function () {
    
    Route::get('/dashboard', function () {
        $tables = Table::all();
        return view('customer.dashboard', compact('tables'));
    })->name('dashboard');

    Route::get('/tables', [TableController::class, 'index'])->name('tables.index');
    Route::get('/tables/{table}', [TableController::class, 'show'])->name('tables.show');

    Route::get('/booking', [BookingController::class, 'index'])
        ->name('booking.index');

    Route::get('/booking/{id}', [BookingController::class, 'create'])
        ->name('booking.create');

    Route::post('/booking/{id}', [BookingController::class, 'store'])
        ->name('booking.store');

    Route::get("/profile", [AuthController::class, 'profile'])
        ->name('profile');

    Route::get('/history', function() {
        return view('customer.history');
    })->name('history');

    Route::get('/search', function() {
        return view('customer.search');
    })->name('search');

    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});