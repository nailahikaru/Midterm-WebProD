<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventRegistrationController;
use App\Http\Controllers\SchedController;
use App\Http\Controllers\CashController;

Route::get('/', function () {
    return view('home');
});

Route::get('/profile-ukm', function () {
    return view('profile-ukm');
});

Route::get('/profile', function () {
    return view('profile');
})->middleware('auth')->name('profile');

Route::put('/profile', [ProfileController::class, 'update'])
    ->middleware('auth')
    ->name('profile.update');

// ===== Rute dari branch 'autentikasi' =====
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// ===== Fitur C: Pengumuman =====
Route::resource('announcements', AnnouncementController::class)->except(['show']);

// ===== Fitur C: Portofolio =====
Route::resource('portfolios', PortfolioController::class)->except(['show']);

// ===== Fitur C: Event Kepanitiaan =====
Route::resource('events', EventController::class);
Route::post('events/{event}/register', [EventRegistrationController::class, 'store'])->name('events.register');
Route::patch('registrations/{registration}/status', [EventRegistrationController::class, 'updateStatus'])->name('registrations.status');

Route::get('/schedule', [SchedController::class, 'index'])->name('schedule.index');
Route::post('/schedule', [SchedController::class, 'store'])->name('schedule.store');
Route::delete('/schedule/{id}', [SchedController::class, 'destroy'])->name('schedule.destroy');
Route::get('/presence', [App\Http\Controllers\PresenceController::class, 'listSchedules'])->name('presence.index');
Route::get('/cash', [CashController::class, 'index'])->name('cash.index');
Route::post('/cash', [CashController::class, 'store'])->name('cash.store');
Route::delete('/cash/{id}', [CashController::class, 'destroy'])->name('cash.destroy');