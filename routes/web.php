<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\TimesheetController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Landing Page Route
Route::get('/', function () {
    return view('landing');
});

// Dashboard Route
Route::get('/dashboard', [DashboardController::class, 'show'])->name('dashboard');

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Shift Control Routes
Route::post('/start-shift', [ShiftController::class, 'startShift'])->name('startShift');
Route::post('/end-shift', [ShiftController::class, 'endShift'])->name('endShift');
Route::post('/start-lunch', [ShiftController::class, 'startLunch'])->name('startLunch');
Route::post('/end-lunch', [ShiftController::class, 'endLunch'])->name('endLunch');

// Timesheet Routes
Route::get('/timesheet', [TimesheetController::class, 'index'])->name('timesheet');

Route::get('/filter-shift-records', [TimesheetController::class, 'filterShiftRecords']);


