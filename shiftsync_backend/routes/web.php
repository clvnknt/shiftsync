<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\InoutController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\TimesheetController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\AddressController;
use App\Http\Controllers\Admin\EmergencyContactController;
use App\Http\Controllers\Admin\ShiftScheduleController;
use App\Http\Controllers\Admin\EmployeeRecordController;
use App\Http\Controllers\Admin\EmployeeAssignedShiftController;
use App\Http\Controllers\Admin\EmployeeShiftRecordController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

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

// Email Verification Routes
Route::get('/email/verify', [EmailVerificationController::class, 'showVerificationNotice'])->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])->middleware(['auth', 'signed'])->name('verification.verify');
Route::post('/email/verification-notification', [EmailVerificationController::class, 'resendVerificationNotification'])->middleware(['auth', 'throttle:6,1'])->name('verification.send');

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

// Admin routes requiring admin authentication
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('/users', UserController::class, ['as' => 'admins']);
    Route::resource('/departments', DepartmentController::class, ['as' => 'admins']);
    Route::resource('/roles', RoleController::class, ['as' => 'admins']);
    Route::resource('/addresses', AddressController::class, ['as' => 'admins']);
    Route::resource('/emergency-contacts', EmergencyContactController::class, ['as' => 'admins']);
    Route::resource('/shift-schedules', ShiftScheduleController::class, ['as' => 'admins']);
    Route::resource('/employee-records', EmployeeRecordController::class, ['as' => 'admins']);
    Route::resource('/employee-assigned-shifts', EmployeeAssignedShiftController::class, ['as' => 'admins']);
    Route::resource('/employee-shift-records', EmployeeShiftRecordController::class, ['as' => 'admins']);
});
