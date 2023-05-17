<?php

use App\Http\Controllers\Calendar\CalendarController;
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
    return view('submissions/create');
});

Route::prefix('/resources')->group(function () {
    Route::get('', [ResourcesController::class, 'index'])->name('resources-view');
});

Route::prefix('/calendar')->group(function () {
    Route::get('', [CalendarController::class, 'index'])->name('calendar-view');
    Route::get('/events', [CalendarController::class, 'list'])->name('list-events');
    Route::post('/events', [CalendarController::class, 'create'])->name('create-event');
    Route::put('/events/{id}', [CalendarController::class, 'update'])->name('update-event');
    Route::delete('/events/{id}', [CalendarController::class, 'delete'])->name('delete-event');
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
