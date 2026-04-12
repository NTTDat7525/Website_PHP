<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Models\Table;

Route::get('/', [AuthController::class, 'showLoginForm'])->name('home');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ============= CUSTOMER WEB ROUTES =============
Route::prefix('customer')->middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        $tables = Table::paginate(9);
        return view('customer.dashboard', compact('tables'));
    })->name('customer.dashboard');

    Route::get('/booking/{id?}', function ($id = null) {
        $table = $id ? Table::findOrFail($id) : null;
        $tables = Table::all();
        return view('customer.booking', compact('table', 'tables'));
    })->name('customer.booking');

    Route::get('/bookings', function () {
        return view('customer.history');
    })->name('customer.bookings');

    Route::get('/search', function () {
        return view('customer.search');
    })->name('customer.search');

    Route::get('/profile', function () {
        return view('customer.profile');
    })->name('customer.profile');
});

// ============= ADMIN WEB ROUTES =============
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::get('/bookings', function () {
        return view('admin.bookings');
    })->name('admin.bookings');

    Route::get('/tables', function () {
        return view('admin.tables');
    })->name('admin.tables');

    Route::get('/users', function () {
        return view('admin.users');
    })->name('admin.users');

    Route::get('/revenue', function () {
        return view('admin.revenue');
    })->name('admin.revenue');

    Route::get('/reports', function () {
        return view('admin.reports');
    })->name('admin.reports');
});
