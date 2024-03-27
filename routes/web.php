<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InoutController;
use App\Http\Controllers\TimesheetController;
use App\Http\Controllers\ShiftController;



Route::get('/', function () {return view('landing');});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/dashboard', [DashboardController::class, 'showDashboard'])->name('dashboard');

Route::get('/inout', [InoutController::class, 'show'])->name('inout');

Route::post('/shift/start', [ShiftController::class, 'startShift'])->name('startShift');
Route::post('/shift/lunch/start', [ShiftController::class, 'startLunch'])->name('startLunch');
Route::post('/shift/lunch/end', [ShiftController::class, 'endLunch'])->name('endLunch');
Route::post('/shift/end', [ShiftController::class, 'endShift'])->name('endShift');

Route::get('/timesheet', [TimesheetController::class, 'show'])->name('timesheet');
