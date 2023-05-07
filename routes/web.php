<?php

use App\Http\Controllers\Calendar\CalendarController;
use App\Http\Controllers\Resources\ResourcesController;
use App\Http\Controllers\Submissions\SubmissionsController;
use App\Http\Controllers\Users\UsersController;
use App\Http\Controllers\ProfileController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::prefix('/resources')->group(function () {
    Route::get('', [ResourcesController::class, 'index'])->name('resources-view');
});

Route::prefix('/calendar')->group(function () {
    Route::get('', [CalendarController::class, 'index'])->name('calendar-view');
});

Route::prefix('/submissions')->group(function () {
    Route::get('', [SubmissionsController::class, 'index'])->name('submissions-view');
    Route::post('/submissions', [SubmissionsController::class, 'create'])->name('create-submission');
    Route::put('/submissions/{id}', [SubmissionsController::class, 'update'])->name('update-submission');
    Route::delete('/submissions/{id}', [SubmissionsController::class, 'delete'])->name('delete-submission');
});

Route::prefix('/users')->group(function () {
    Route::get('', [UsersController::class, 'index'])->name('users-view');
});
