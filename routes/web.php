<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CourtController;
use App\Http\Controllers\Admin\TransactionController;

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

// Public Route
Route::get('/', [HomeController::class, 'index'])->name('welcome');
Route::get('/schedule/{court:slug}', [HomeController::class, 'schedule'])->name('schedule');

// Authenticated Route
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/dashboard', [TransactionController::class, 'dashboard'])->name('dashboard');
    Route::get('/transactions/{transaction:unique_code}', [HomeController::class, 'payment'])->name('payment');

    // Create an Order
    Route::post('/schedule/{court:slug}/create', [HomeController::class, 'order'])->name('order');
});

// Admin Route
Route::middleware(['auth', 'ensureRole:admin'])->prefix('admin')->name('admin.')->group(function () {

    // User Management
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/{user}', [UserController::class, 'show'])->name('show');
    });

    // Court Management
    Route::prefix('courts')->name('courts.')->group(function () {
        Route::get('/', [CourtController::class, 'index'])->name('index');
        Route::get('/create', [CourtController::class, 'create'])->name('create');
        Route::get('/{court:slug}', [CourtController::class, 'show'])->name('show');
        Route::get('/{court:slug}/edit', [CourtController::class, 'edit'])->name('edit');
        Route::put('/{court:slug}', [CourtController::class, 'update'])->name('update');
        Route::put('/{court:slug}/toggle-status', [CourtController::class, 'toggleStatus'])->name('toggle');
        Route::post('/', [CourtController::class, 'store'])->name('store');
    });

    // Transaction Management
    Route::prefix('transactions')->name('transactions.')->group(function () {
        Route::post('/', [TransactionController::class, 'create'])->name('create');
        Route::get('/{transaction:unique_code}', [TransactionController::class, 'show'])->name('show');
    });
});

require __DIR__ . '/auth.php';
