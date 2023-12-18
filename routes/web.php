<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PollController;
use App\Http\Controllers\AttachmentController;
use App\Http\Controllers\VoteController;

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

    Route::middleware(['auth', 'is_admin'])->group(function () {

        Route::get('/', [DashboardController::class, 'showStatistics'])->name('dashboard');
        
        Route::get('/users', [UserController::class, 'show'])->name('users');
        Route::post('/users', [UserController::class, 'create'])->name('users');
        Route::delete('/users', [UserController::class, 'delete'])->name('users');
        Route::delete('/users-selected', [UserController::class, 'deleteSelected'])->name('users.deleteSelected');

        Route::get('/polls', [PollController::class, 'show'])->name('polls');
        Route::post('/polls', [PollController::class, 'create'])->name('polls');
        Route::delete('/polls', [PollController::class, 'delete'])->name('polls');
        Route::delete('/polls-selected', [PollController::class, 'deleteSelected'])->name('polls.deleteSelected');

        Route::delete('/polls/{poll}/deleteUsers', [PollController::class, 'deleteSelectedUsers'])->name('polls.deleteSelectedUsers');
        Route::post('/polls/{poll}/addUser', [PollController::class, 'addSelectedUsers'])->name('polls.addSelectedUsers');
        
        Route::post('/polls/{poll}/addOption', [PollController::class, 'addSelectedOptions'])->name('polls.addOption');
        Route::delete('/polls/{poll}/deleteOption', [PollController::class, 'deleteSelectedOptions'])->name('polls.deleteOption');

        Route::get('/options/{options}', [AttachmentController::class, 'showById'])->name('options.getId');

        Route::get('/votes/{poll}', [VoteController::class, 'showById'])->name('votes.getByPollId');
    });

    Route::prefix('/app')->group(function () {
        Route::view('/login', 'app.login')->name('login');
        Route::post('/login',[AuthController::class, 'authenticate'])->name('login');
        
        Route::view('/register', 'app.register')->name('register');
        Route::post('/register',[AuthController::class, 'register'])->name('register');

        Route::get('/logout',[AuthController::class, 'logout'])->name('logout');

        Route::middleware(['auth', 'track_visits'])->group(function () {
            Route::get('/home', [PollController::class, 'show'])->name('home');
            Route::get('/my-polls/myPolls', [PollController::class, 'showByUser'])->name('my.polls');
            Route::get('/my-polls/sharedPolls', [PollController::class, 'sharedPolls'])->name('shared.polls');
            Route::get('/my-polls/{currentRoute}', [PollController::class, 'togglePolls'])->name('toggle.polls');


            Route::get('/users/{user}', [UserController::class, 'showByid'])->name('users.getId');
            Route::put('/users/{user}/edit', [UserController::class, 'update'])->name('users.update');

            Route::get('/polls/{poll}', [PollController::class, 'showById'])->name('polls.getId');
            Route::get('/polls/{poll}/vote', [PollController::class, 'showById'])->name('vote');
            Route::post('/myPolls', [PollController::class, 'create'])->name('userPolls');
            Route::put('/polls/{poll}/edit', [PollController::class, 'update'])->name('polls.update');


            Route::post('/attachments/{poll}', [AttachmentController::class, 'create'])->name('attachments');
            Route::delete('/attachments', [AttachmentController::class, 'delete'])->name('attachments.delete');

            Route::post('/votes', [VoteController::class, 'create'])->name('votes');

            Route::get('/search-polls', [PollController::class, 'searchPolls'])->name('search.polls');

        });
    });