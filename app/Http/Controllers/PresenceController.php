<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PresenceController extends Controller
{
    // Tambahkan fungsi ini di dalam class PresenceController
    public function listSchedules()
    {
        // Ambil semua jadwal
        $schedules = \App\Models\Schedule::orderBy('eventDate', 'desc')->get();
        
        return view('presence.list', compact('schedules'));
    }
}
