<?php

use App\Http\Controllers\CourtController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'ensureRole:admin'])->prefix('admin')->name('admin.')->group(function () {

    // User Management
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
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
});

require __DIR__ . '/auth.php';
