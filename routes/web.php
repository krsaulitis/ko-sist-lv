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
    Route::get('/resources', [CResourcesController::class, 'list'])->name('list-resources');
    Route::post('/resources', [ResourcesController::class, 'create'])->name('create-resource');
    Route::put('/resources/{id}', [ResourcesController::class, 'update'])->name('update-resource');
    Route::delete('/resources/{id}', [ResourcesController::class, 'delete'])->name('delete-resource');
});

Route::prefix('/calendar')->group(function () {
    Route::get('', [CalendarController::class, 'index'])->name('calendar-view');
});

Route::prefix('/submissions')->group(function () {
    Route::get('', [SubmissionsController::class, 'index'])->name('submissions-view');
});

Route::prefix('/users')->group(function () {
    Route::get('', [UsersController::class, 'index'])->name('users-view');
});
