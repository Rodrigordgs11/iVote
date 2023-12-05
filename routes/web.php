<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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
        return view('app.dashboard');
    });

    Route::get('/users', [UserController::class, 'show'])->name('users');
    Route::post('/users', [UserController::class, 'create'])->name('users');

    Route::get('/roles', function () {
        return view('app.roles');
    });

    Route::prefix('/app')->group(function () {
        Route::get('/login', function () {
            return view('app.login');
        })->name('login');

        Route::get('/register', function () {
            return view('app.register');
        })->name('register');
    });  