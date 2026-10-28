<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnnouncementController;

Route::get('/', function () {
    return view('home');
});

Route::get('/profile-ukm', function () {
    return view('profile-ukm');
});

Route::get('/profile', function () {
    return view('profile');
});

// ===== Fitur C: Pengumuman =====
Route::resource('announcements', AnnouncementController::class)->except(['show']);