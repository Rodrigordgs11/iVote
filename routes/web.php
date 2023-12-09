<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PollController;
use App\Http\Controllers\AttachmentController;

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

        Route::get('/polls', [PollController::class, 'show'])->name('polls');
        Route::get('/polls/{poll}', [PollController::class, 'showById'])->name('polls.getId');
        Route::post('/polls', [PollController::class, 'create'])->name('polls');
        Route::put('/polls/{poll}/edit', [PollController::class, 'update'])->name('polls.update');
        Route::delete('/polls', [PollController::class, 'delete'])->name('polls');

        Route::delete('/polls/{poll}/deleteUsers', [PollController::class, 'deleteSelectedUsers'])->name('polls.deleteSelected');
        Route::post('/polls/{poll}/addUser', [PollController::class, 'addSelectedUser'])->name('polls.addSelected');


        Route::post('/attachments/{poll}', [AttachmentController::class, 'create'])->name('attachments');
        
        Route::view('/roles', 'app.roles')->name('roles');
    });

    Route::prefix('/app')->group(function () {
        Route::view('/login', 'app.login')->name('login');
        Route::post('/login',[AuthController::class, 'authenticate'])->name('login');
        
        Route::view('/register', 'app.register')->name('register');
        Route::post('/register',[AuthController::class, 'register'])->name('register');
    });
