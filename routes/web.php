<?php

use Illuminate\Support\Facades\Route;

Route::middleware('minifier')->get('/', function () {
    return view('welcome');
});

Route::get('login-open-provider', function () {
    \Illuminate\Support\Facades\Auth::attempt();
    dd(\Illuminate\Support\Facades\Auth::user());
});
