<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;

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

    Route::middleware(['auth'])->group(function () {
        Route::get('/', [DashboardController::class, 'showStatistics'])->name('dashboard');
        Route::get('/logout',[AuthController::class, 'logout'])->name('logout');
        
        Route::get('/users', [UserController::class, 'show'])->name('users');
        Route::get('/users/{user}', [UserController::class, 'showByid'])->name('users.getId');
        Route::post('/users', [UserController::class, 'create'])->name('users');
        Route::put('/users/{user}/edit', [UserController::class, 'update'])->name('users.update');
        Route::delete('/users', [UserController::class, 'delete'])->name('users');

        Route::view('/roles', 'app.roles')->name('roles');
    });

    Route::prefix('/app')->group(function () {
        Route::view('/login', 'app.login')->name('login');
        Route::post('/login',[AuthController::class, 'authenticate'])->name('login');
        
        Route::view('/register', 'app.register')->name('register');
        Route::post('/register',[AuthController::class, 'register'])->name('register');
    });
