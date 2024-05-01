<?php

use App\Http\Controllers\AccountController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InoutController;
use App\Http\Controllers\TimesheetController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ResetPasswordController;


// Public routes accessible without authentication
Route::get('/', function () {
    return view('landing');
})->name('landing');

Route::get('/landing', function () {
    return view('landing');
})->name('landing');


// Authentication Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Password Routes
Route::prefix('password')->group(function () {
    // Forgot Password Routes
    Route::get('/forgot', [ForgotPasswordController::class, 'showForgotPasswordForm'])->name('password.request');
    Route::post('/forgot', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

    // Reset Password Routes
    Route::get('/reset/{token}', [ResetPasswordController::class, 'showResetPasswordForm'])->name('password.reset');
    Route::post('/reset', [ResetPasswordController::class, 'resetPassword'])->name('password.update');
});

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
    Route::get('/timesheet', [TimesheetController::class, 'showTimesheet'])->name('timesheet');
    Route::post('/fetch-records', [TimesheetController::class, 'fetchRecords'])->name('fetch.records');


    Route::get('/my-account', [AccountController::class, 'showMyAccount'])->name('myAccount');
});
