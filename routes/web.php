<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\MovieController;
use Illuminate\Support\Facades\Route;

Route
    ::middleware('minifier')->get('/', function () {
        return view('welcome');
    });

Route
    ::get('login-open-provider', function () {
        \Illuminate\Support\Facades\Auth::attempt();
        dd(\Illuminate\Support\Facades\Auth::user());
    });

Route
    ::get('/home', [HomeController::class, 'index'])
    ->name('home');

Route
    ::get('movies', [MovieController::class, 'list_movies'])
    ->name('list_movies');

Route
    ::get('movie/{id}', [MovieController::class, 'list_seats'])
    ->name('list_seats');

Route
    ::get('movie/{movie}/reserve/{seat}', [MovieController::class, 'reserve_seat'])
    ->name('reserve_seat');

Route
    ::get('stats', 'StatsController@stats')
    ->name('stats');
