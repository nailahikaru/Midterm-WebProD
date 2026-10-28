<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Presence;
use App\Models\Schedule;
use App\Models\User;

class PresenceController extends Controller
{
    // Daftar semua jadwal (pilih jadwal untuk diabsen)
    public function listSchedules()
    {
        $schedules = Schedule::orderBy('eventDate', 'desc')->get();

        return view('presence.list', compact('schedules'));
    }

    // Rekap absensi satu jadwal
    public function index($id)
    {
        $schedule = Schedule::findOrFail($id);
        $users = User::orderBy('name')->get();

        // Hasil: [user_id => status]
        $presences = Presence::where('sch_id', $schedule->id)
            ->pluck('status', 'user_id');

        return view('presence.index', compact('schedule', 'users', 'presences'));
    }

    // Simpan / perbarui absensi semua anggota untuk satu jadwal
    public function store(Request $request)
    {
        $request->validate([
            'sch_id'   => 'required|exists:schedules,id',
            'status'   => 'required|array',
            'status.*' => 'in:present,leave,alfa',
        ]);

        foreach ($request->status as $userId => $status) {
            Presence::updateOrCreate(
                ['sch_id' => $request->sch_id, 'user_id' => $userId],
                ['status' => $status]
            );
        }

        return redirect()
            ->route('presence.index', $request->sch_id)
            ->with('success', 'Attendance saved successfully!');
    }
}