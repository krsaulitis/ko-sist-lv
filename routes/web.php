<?php

use App\Http\Controllers\Calendar\CalendarController;
use App\Http\Controllers\Resources\ResourcesController;
use App\Http\Controllers\Submissions\SubmissionsController;
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
    Route::get('', [ResourcesController::class, 'index'])->name('resources-view');
    Route::get('/resources', [ResourcesController::class, 'createForm'])->name('list-resources');
    Route::post('/resources-create', [ResourcesController::class, 'fileUpload'])->name('fileUpload');
    Route::put('/resources/{id}', [ResourcesController::class, 'update'])->name('update-resource');
    Route::delete('/resources/{id}', [ResourcesController::class, 'delete'])->name('delete-resource');
});

Route::prefix('/calendar')->group(function () {
    Route::get('', [CalendarController::class, 'index'])->name('calendar-view');
    Route::get('/events', [CalendarController::class, 'list'])->name('list-events');
    Route::post('/events', [CalendarController::class, 'create'])->name('create-event');
    Route::put('/events/{id}', [CalendarController::class, 'update'])->name('update-event');
    Route::delete('/events/{id}', [CalendarController::class, 'delete'])->name('delete-event');
});

Route::prefix('/submissions')->group(function () {
    Route::get('', [SubmissionsController::class, 'index'])->name('submissions-view');
});

Route::prefix('/users')->group(function () {
    Route::get('', [UsersController::class, 'index'])->name('users-view');
});
