<?php

use App\Http\Controllers\Events\EventsController;
use App\Http\Controllers\Resources\ResourcesController;
use App\Http\Controllers\Submissions\AuditionSubmissionsController;
use App\Http\Controllers\Users\UsersController;
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
    return view('home');
});

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

Route::prefix('/submissions')->group(function () {
    Route::get('', [AuditionSubmissionsController::class, 'index'])->name('submissions-view');
    Route::post('/submissions', [AuditionSubmissionsController::class, 'create'])->name('create-submission');
    Route::put('/submissions/{id}', [AuditionSubmissionsController::class, 'update'])->name('update-submission');
    Route::delete('/submissions/{id}', [AuditionSubmissionsController::class, 'delete'])->name('delete-submission');
});

Route::prefix('/users')->group(function () {
    Route::get('', [UsersController::class, 'index'])->name('users-view');
});
