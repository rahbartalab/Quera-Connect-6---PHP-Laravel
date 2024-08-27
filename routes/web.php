<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StatsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route
    ::middleware('minifier')->get('/', function () {
        return view('welcome');
    });

// this is related to ex-5
Route
    ::get('login-open-provider', function () {
        \Illuminate\Support\Facades\Auth::attempt();
        dd(\Illuminate\Support\Facades\Auth::user());
    });

// ex-6 routes
Route
    ::get('/home', [HomeController::class, 'index'])
    ->name('home');

Route
    ::controller(MovieController::class)->group(function () {
        Route
            ::get('movies', 'list_movies')
            ->name('list_movies');

        Route
            ::get('movie/{movie}', 'list_seats')
            ->name('list_seats');

        Route
            ::get('movie/{movie}/reserve/{seat}', 'reserve_seat')
            ->name('reserve_seat')->middleware('auth');
    });

Route
    ::get('stats', [StatsController::class, 'index'])
    ->name('stats')->middleware('auth');


require __DIR__ . '/auth.php';
