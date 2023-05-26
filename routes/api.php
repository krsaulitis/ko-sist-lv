<?php

use App\Http\Controllers\Auth\AuthApiController;
use App\Http\Controllers\Events\EventsApiController;
use App\Http\Controllers\Resources\ResourcesApiController;
use App\Http\Controllers\Submissions\AuditionSubmissionsApiController;
use App\Http\Controllers\Users\UsersApiController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('guest')->group(function () {
    Route::post('/login', [AuthApiController::class, 'login'])->name('api-auth-login');
    Route::post('/register', [AuditionSubmissionsApiController::class, 'create'])->name('api-auth-register');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthApiController::class, 'logout'])->name('api-auth-logout');

    Route::prefix('/resources')->group(function () {
        Route::post('/create', [ResourcesApiController::class, 'create'])->name('api-resources-create');
        Route::put('/{id}', [ResourcesApiController::class, 'update'])->name('api-resources-update');
        Route::delete('/{id}', [ResourcesApiController::class, 'delete'])->name('api-resources-delete');
    });

    Route::prefix('/events')->group(function () {
        Route::post('/create', [EventsApiController::class, 'create'])->name('api-events-create');
        Route::put('/{id}', [EventsApiController::class, 'update'])->name('api-events-update');
        Route::delete('/{id}', [EventsApiController::class, 'delete'])->name('api-events-delete');
    });

    Route::middleware([])->group(function () {
        Route::prefix('/submissions')->group(function () {
            Route::post('/{id}/approve', [AuditionSubmissionsApiController::class, 'approve'])->name('api-submissions-approve');
            Route::post('/{id}/reject', [AuditionSubmissionsApiController::class, 'reject'])->name('api-submissions-reject');
        });
        Route::prefix('/users')->group(function () {
            Route::delete('/{id}', [UsersApiController::class, 'delete'])->name('api-users-delete');
        });
    });
});
