<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiAuthController;
use App\Http\Controllers\ApiUsersController;
use App\Http\Controllers\ApiDepartmentController;
use App\Http\Controllers\ApiRoleController;
use App\Http\Controllers\ApiShiftScheduleController;
use App\Http\Controllers\ApiEmployeeRecordController;
use App\Http\Controllers\ApiEmployeeAssignedShiftController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->group(function () {
    Route::get('users', [ApiUsersController::class, 'index']);
    Route::post('users', [ApiUsersController::class, 'store']);
    Route::get('users/{id}', [ApiUsersController::class, 'show']);
    Route::put('users/{id}', [ApiUsersController::class, 'update']);
    Route::delete('users/{id}', [ApiUsersController::class, 'destroy']);

    Route::get('departments', [ApiDepartmentController::class, 'index']);
    Route::post('departments', [ApiDepartmentController::class, 'store']);
    Route::get('departments/{id}', [ApiDepartmentController::class, 'show']);
    Route::put('departments/{id}', [ApiDepartmentController::class, 'update']);
    Route::delete('departments/{id}', [ApiDepartmentController::class, 'destroy']);

    Route::get('roles', [ApiRoleController::class, 'index']);
    Route::post('roles', [ApiRoleController::class, 'store']);
    Route::get('roles/{id}', [ApiRoleController::class, 'show']);
    Route::put('roles/{id}', [ApiRoleController::class, 'update']);
    Route::delete('roles/{id}', [ApiRoleController::class, 'destroy']);

    Route::get('shift-schedules', [ApiShiftScheduleController::class, 'index']);
    Route::post('shift-schedules', [ApiShiftScheduleController::class, 'store']);
    Route::get('shift-schedules/{id}', [ApiShiftScheduleController::class, 'show']);
    Route::put('shift-schedules/{id}', [ApiShiftScheduleController::class, 'update']);
    Route::delete('shift-schedules/{id}', [ApiShiftScheduleController::class, 'destroy']);

    Route::get('employee-records', [ApiEmployeeRecordController::class, 'index']);
    Route::post('employee-records', [ApiEmployeeRecordController::class, 'store']);
    Route::get('employee-records/{id}', [ApiEmployeeRecordController::class, 'show']);
    Route::put('employee-records/{id}', [ApiEmployeeRecordController::class, 'update']);
    Route::delete('employee-records/{id}', [ApiEmployeeRecordController::class, 'destroy']);

    Route::apiResource('employee-assigned-shifts', ApiEmployeeAssignedShiftController::class);
    
    Route::get('user', [ApiAuthController::class, 'user']);
    Route::post('logout', [ApiAuthController::class, 'logout']);
});

Route::post('login', [ApiAuthController::class, 'login']);