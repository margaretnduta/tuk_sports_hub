<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Coach\EventController; // coach namespace

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Public landing
Route::get('/', function () {
    return view('welcome');
});

// Authenticated dashboard (role-based view via controller)
Route::middleware(['auth'])->get('/dashboard', DashboardController::class)->name('dashboard');

// Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ADMIN (placeholder)
Route::middleware(['auth','role:admin'])->group(function () {
    Route::get('/admin/coaches', fn () => 'Admin: manage coaches')->name('admin.coaches.index');
});

// COACH — Event CRUD (EXPLICIT route names)
Route::middleware(['auth','role:coach'])->group(function () {
    Route::resource('coach/events', EventController::class)->names([
        'index'   => 'coach.events.index',
        'create'  => 'coach.events.create',
        'store'   => 'coach.events.store',
        'show'    => 'coach.events.show',
        'edit'    => 'coach.events.edit',
        'update'  => 'coach.events.update',
        'destroy' => 'coach.events.destroy',
    ]);
});
use App\Http\Controllers\Coach\EventUpdateController;

Route::post('coach/events/{event}/updates', [EventUpdateController::class, 'store'])->name('coach.events.updates.store');
Route::delete('coach/events/{event}/updates/{update}', [EventUpdateController::class, 'destroy'])->name('coach.events.updates.destroy');


use App\Http\Controllers\Coach\ProfileController as CoachProfileController;

Route::get('coach/profile', [CoachProfileController::class, 'edit'])->name('coach.profile.edit');
Route::patch('coach/profile', [CoachProfileController::class, 'update'])->name('coach.profile.update');





// PLAYER (placeholder)
Route::middleware(['auth','role:player'])->group(function () {
    Route::get('/player/events', fn () => 'Player: upcoming events')->name('player.events.index');
});

// FAN (placeholder)
Route::middleware(['auth','role:fan'])->group(function () {
    Route::get('/fan/galleries', fn () => 'Fan: galleries')->name('fan.galleries.index');
});

// Auth routes (login/register/etc.)
require __DIR__.'/auth.php';
