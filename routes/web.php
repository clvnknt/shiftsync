<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InoutController;
use App\Http\Controllers\TimesheetController;
use App\Http\Controllers\ShiftController;

// Public routes accessible without authentication
Route::get('/', function () {
    return view('landing');
})->name('landing');

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected routes requiring authentication
Route::middleware('auth')->group(function () {
    // Dashboard Route
    Route::get('/dashboard', [DashboardController::class, 'showDashboard'])->name('dashboard');

    // In/Out Routes
    Route::get('/inout', [InoutController::class, 'showInout'])->name('inout');

    // Shift Routes
    Route::post('/shift/start', [ShiftController::class, 'startShift'])->name('startShift');
    Route::post('/shift/lunch/start', [ShiftController::class, 'startLunch'])->name('startLunch');
    Route::post('/shift/lunch/end', [ShiftController::class, 'endLunch'])->name('endLunch');
    Route::post('/shift/end', [ShiftController::class, 'endShift'])->name('endShift');

    // Timesheet Route
    Route::get('/timesheet', [TimesheetController::class, 'show'])->name('timesheet');
});
