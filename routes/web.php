<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/profile-ukm', function () {
    return view('profile-ukm');
});

Route::get('/profile', function () {
    return view('profile');
});
