<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiAuthController;
use App\Http\Controllers\ApiUsersController;
use App\Http\Controllers\ApiDepartmentController;


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
    
    Route::get('user', [ApiAuthController::class, 'user']);
    Route::post('logout', [ApiAuthController::class, 'logout']);
});

Route::post('login', [ApiAuthController::class, 'login']);