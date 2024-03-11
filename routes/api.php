<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\MidtransCallbackController;
use App\Http\Controllers\API\TransactionController;
use Illuminate\Support\Facades\Route;

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


// Public API
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/schedules', [TransactionController::class, 'schedule']);

// Midtrans Callback
Route::post('/callback', [MidtransCallbackController::class, 'callback']);

// Auth API
Route::middleware('auth:sanctum')->group(function () {

    // Auth
    Route::post('/logout', [AuthController::class, 'logout']);

    // Transaction
    Route::post('/transactions/create', [TransactionController::class, 'create']);
});
