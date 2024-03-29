<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PollController;
use App\Http\Controllers\AttachmentController;
use App\Http\Controllers\VoteController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProviderController;

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

    
    Route::get('/auth/{provider}/redirect', [ProviderController::class, 'redirect']);
        
    Route::get('/auth/{provider}/callback', [ProviderController::class, 'callback']);

    Route::middleware(['auth', 'is_admin'])->group(function () {

        Route::get('/', [DashboardController::class, 'showStatistics'])->name('dashboard');
        
        Route::get('/users', [UserController::class, 'show'])->name('users.get');
        Route::post('/users', [UserController::class, 'create'])->name('users.post');
        Route::delete('/users', [UserController::class, 'delete'])->name('users.delete');
        Route::delete('/users-selected', [UserController::class, 'deleteSelected'])->name('users.deleteSelected');

        Route::get('/polls', [PollController::class, 'show'])->name('polls.get');
        Route::post('/polls', [PollController::class, 'create'])->name('polls.post');
        Route::delete('/polls-selected', [PollController::class, 'deleteSelected'])->name('polls.deleteSelected');

        Route::get('/options/{options}', [AttachmentController::class, 'showById'])->name('options.getId');
    });

    Route::prefix('/app')->group(function () {
        Route::view('/login', 'app.login')->name('login');
        Route::post('/login',[AuthController::class, 'authenticate'])->name('login');
        
        Route::view('/register', 'app.register')->name('register');
        Route::post('/register',[AuthController::class, 'register'])->name('register');

        Route::get('/forgot-password', function () { return view('app.forgot-password');})->middleware('guest')->name('password.request');
        Route::post('/forgot-password', [AuthController::class, 'verifyEmail'])->middleware('guest')->name('password.email');
        Route::get('/reset-password/{token}', function (string $token) {return view('app.reset-password', ['token' => $token]);})->middleware('guest')->name('password.reset');        
        Route::post('/reset-password', [AuthController::class, 'resetPassword'])->middleware('guest')->name('password.update');

        Route::get('/logout',[AuthController::class, 'logout'])->name('logout');

        Route::middleware(['auth', 'track_visits'])->group(function () {
            Route::get('/home', [PollController::class, 'show'])->name('home');
            Route::get('/my-polls/myPolls', [PollController::class, 'showByUser'])->name('my.polls');
            Route::get('/my-polls/sharedPolls', [PollController::class, 'sharedPolls'])->name('shared.polls');
            Route::get('/my-polls/{currentRoute}', [PollController::class, 'togglePolls'])->name('toggle.polls');
            Route::delete('/polls', [PollController::class, 'delete'])->name('polls.delete');

            Route::get('/users/{user}', [UserController::class, 'showByid'])->name('users.getId');
            Route::put('/users/{user}/edit', [UserController::class, 'update'])->name('users.update');

            Route::get('/polls/{poll}', [PollController::class, 'showById'])->name('polls.getId');
            Route::get('/polls/{poll}/vote', [PollController::class, 'showById'])->name('vote');
            Route::post('/myPolls', [PollController::class, 'create'])->name('userPolls');
            Route::put('/polls/{poll}/edit', [PollController::class, 'update'])->name('polls.update');
            Route::post('/polls/{poll}/addUser', [PollController::class, 'addSelectedUsers'])->name('polls.addSelectedUsers');

            Route::delete('/polls/{poll}/deleteUsers', [PollController::class, 'deleteSelectedUsers'])->name('polls.deleteSelectedUsers');
            Route::post('/polls/{poll}/addOption', [PollController::class, 'addSelectedOptions'])->name('polls.addOption');
            Route::delete('/polls/{poll}/deleteOption', [PollController::class, 'deleteSelectedOptions'])->name('polls.deleteOption');

            Route::put('/notifications/{notification}/seen', [NotificationController::class, 'seen'])->name('notifications.seen');

            Route::post('/attachments/{poll}', [AttachmentController::class, 'create'])->name('attachments');
            Route::delete('/attachments', [AttachmentController::class, 'delete'])->name('attachments.delete');

            Route::post('/votes', [VoteController::class, 'create'])->name('votes');
            Route::get('/votes/{option}', [VoteController::class, 'showById'])->name('votes.getByOptionId');

            Route::get('/search-polls', [PollController::class, 'searchPolls'])->name('search.polls');

        });
    });