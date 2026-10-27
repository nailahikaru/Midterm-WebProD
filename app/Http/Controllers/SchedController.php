<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule; // Pakai Model Schedule
use App\Models\User; // Panggil model User untuk data absensi
use Illuminate\Support\Facades\Auth;

class SchedController extends Controller
{
    public function index()
    {
        // Urutkan berdasarkan eventDate (sesuai nama kolom di database kamu)
        $schedules = Schedule::orderBy('eventDate', 'desc')->get();
        
        // Ambil semua data user untuk ditampilkan di modal absensi
        $users = User::all(); 

        // Kirim $schedules dan $users ke view
        return view('schedule', compact('schedules', 'users'));
    }

    public function store(Request $request)
    {
        // Validasi input disesuaikan dengan name="" di form HTML
        $request->validate([
            'eventName'     => 'required|string|max:255',
            'eventDate'     => 'required|date',
            'eventTime'     => 'required',
            'eventLocation' => 'required|string|max:255',
            'eventDesc'     => 'nullable|string',
        ]);

        // Simpan ke database
        Schedule::create([
            'user_id'       => Auth::id(),
            'eventName'     => $request->eventName,
            'eventDate'     => $request->eventDate,
            'eventTime'     => $request->eventTime,
            'eventLocation' => $request->eventLocation,
            'eventDesc'     => $request->eventDesc,
        ]);

        return redirect()->route('schedule.index')->with('success', 'Schedule added successfully!');
    }

    public function destroy($id)
    {
        $schedule = Schedule::findOrFail($id);
        $schedule->delete();

        return redirect()->route('schedule.index')->with('success', 'Schedule deleted successfully!');
    }
}