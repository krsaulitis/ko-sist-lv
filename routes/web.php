<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\LoginRegisterController;
use App\Http\Controllers\Events\EventsController;
use App\Http\Controllers\Resources\ResourcesController;
use App\Http\Controllers\Submissions\AuditionSubmissionsController;
use App\Http\Controllers\Users\UsersController;
use App\Models\User;
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

Route::middleware('guest')->group(function () {
    Route::get('/', [AuthController::class, 'login'])->name('base');
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::get('/thanks', [AuthController::class, 'thanks'])->name('thanks');
});

Route::controller(LoginRegisterController::class)->group(function () {
    Route::post('/authenticate', 'authenticate')->name('authenticate');
    Route::post('/logout', 'logout')->name('logout');
});

Route::middleware('auth')->group(function () {
    Route::get('logout');
    Route::redirect('/home', '/calendar')->name('home');

    Route::prefix('/resources')->group(function () {
        Route::get('', [ResourcesController::class, 'list'])->name('resources-list');
        Route::get('/create', [ResourcesController::class, 'create'])->name('resources-create');
        Route::get('/{id}', [ResourcesController::class, 'view'])->name('resources-view');
        Route::get('/{id}/edit', [ResourcesController::class, 'edit'])->name('resources-edit');
    });

    Route::prefix('/calendar')->group(function () {
        Route::get('', [EventsController::class, 'list'])->name('events-list');
        Route::get('/events/create', [EventsController::class, 'create'])->name('events-create');
        Route::get('/events/{id}', [EventsController::class, 'view'])->name('events-view');
        Route::get('/events/{id}/edit', [EventsController::class, 'edit'])->name('events-edit');
    });

    Route::middleware('role:' . User::ROLE_ADMIN)->group(function () {
        Route::prefix('/submissions')->group(function () {
            Route::get('', [AuditionSubmissionsController::class, 'list'])->name('submissions-list');
        });

        Route::prefix('/users')->group(function () {
            Route::get('', [UsersController::class, 'list'])->name('users-list');
            Route::get('/{id}', [UsersController::class, 'index'])->name('users-view');
        });
    });
});
