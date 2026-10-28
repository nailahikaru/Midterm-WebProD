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
use App\Http\Controllers\PresenceController;

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

// ===== Wajib login: Fitur C (tambah, ubah, hapus) + Jadwal, Kas, Presensi =====
// Catatan: grup ini HARUS di atas rute publik, supaya /events/create
// tidak dianggap sebagai /events/{event}.
Route::middleware('auth')->group(function () {
    // Pengumuman
    Route::resource('announcements', AnnouncementController::class)
        ->except(['index', 'show']);

    // Portofolio
    Route::resource('portfolios', PortfolioController::class)
        ->except(['index', 'show']);

    // Event kepanitiaan
    Route::resource('events', EventController::class)
        ->except(['index', 'show']);
    Route::post('events/{event}/register', [EventRegistrationController::class, 'store'])
        ->name('events.register');
    Route::patch('registrations/{registration}/status', [EventRegistrationController::class, 'updateStatus'])
        ->name('registrations.status');

    // Jadwal
    Route::get('/schedule', [SchedController::class, 'index'])->name('schedule.index');
    Route::post('/schedule', [SchedController::class, 'store'])->name('schedule.store');
    Route::delete('/schedule/{id}', [SchedController::class, 'destroy'])->name('schedule.destroy');

    // Kas
    Route::get('/cash', [CashController::class, 'index'])->name('cash.index');
    Route::post('/cash', [CashController::class, 'store'])->name('cash.store');
    Route::delete('/cash/{id}', [CashController::class, 'destroy'])->name('cash.destroy');

    // Presensi (rute /presence/list harus di atas /presence/{id})
    Route::get('/presence/list', [PresenceController::class, 'listSchedules'])->name('presence.list');
    Route::post('/presence', [PresenceController::class, 'store'])->name('presence.store');
    Route::get('/presence/{id}', [PresenceController::class, 'index'])->name('presence.index');
});

// ===== Bisa dilihat siapa saja =====
Route::get('announcements', [AnnouncementController::class, 'index'])->name('announcements.index');
Route::get('portfolios', [PortfolioController::class, 'index'])->name('portfolios.index');
Route::get('events', [EventController::class, 'index'])->name('events.index');
Route::get('events/{event}', [EventController::class, 'show'])->name('events.show');