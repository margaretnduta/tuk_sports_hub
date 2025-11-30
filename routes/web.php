<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;

// Coach controllers
use App\Http\Controllers\Coach\EventController as CoachEventController;
use App\Http\Controllers\Coach\EventUpdateController;
use App\Http\Controllers\Coach\ProfileController as CoachProfileController;

// Player controllers
use App\Http\Controllers\Player\PlayerDashboardController;

// Models
use App\Models\Event;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Public landing with upcoming events
Route::get('/', function () {
    $events = Event::whereIn('status', ['scheduled', 'postponed'])
        ->orderBy('starts_at')
        ->take(6)
        ->get();

    return view('welcome', compact('events'));
});

// Authenticated dashboard (role-based via controller)
Route::middleware('auth')->get('/dashboard', DashboardController::class)->name('dashboard');

// Generic user profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin (placeholder, can expand later)
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/coaches', function () {
        return 'Admin: manage coaches';
    })->name('admin.coaches.index');
});

/*
|--------------------------------------------------------------------------
| Coach routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:coach'])
    ->prefix('coach')
    ->name('coach.')
    ->group(function () {

        Route::resource('events', CoachEventController::class)->names('events');

        Route::patch('events/{event}/postpone', [CoachEventController::class, 'postpone'])
            ->name('events.postpone');

        Route::post('events/{event}/updates', [EventUpdateController::class, 'store'])
            ->name('events.updates.store');

        Route::delete('events/{event}/updates/{update}', [EventUpdateController::class, 'destroy'])
            ->name('events.updates.destroy');

        Route::get('profile', [CoachProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('profile', [CoachProfileController::class, 'update'])->name('profile.update');
    });

/*
|--------------------------------------------------------------------------
| Player routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:player'])
    ->prefix('player')
    ->name('player.')
    ->group(function () {
        Route::post('events/{event}/availability', [PlayerDashboardController::class, 'updateAvailability'])
            ->name('events.availability');

        Route::get('profile', [PlayerDashboardController::class, 'profile'])
            ->name('profile');

        Route::post('profile', [PlayerDashboardController::class, 'updateProfile'])
            ->name('profile.update');
    });

/*
|--------------------------------------------------------------------------
| Fan routes (placeholder for now)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:fan'])->group(function () {
    Route::get('/fan/galleries', function () {
        return 'Fan: galleries';
    })->name('fan.galleries.index');
});

// Auth scaffolding (Breeze)
require __DIR__ . '/auth.php';
