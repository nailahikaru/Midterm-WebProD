<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventRegistrationController;

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

// ===== Fitur C: Portofolio =====
Route::resource('portfolios', PortfolioController::class)->except(['show']);

// ===== Fitur C: Event Kepanitiaan =====
Route::resource('events', EventController::class);
Route::post('events/{event}/register', [EventRegistrationController::class, 'store'])->name('events.register');
Route::patch('registrations/{registration}/status', [EventRegistrationController::class, 'updateStatus'])->name('registrations.status');