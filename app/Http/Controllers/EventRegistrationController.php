<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class EventRegistrationController extends Controller
{
    public function store(Request $request, Event $event)
    {
        if (!$event->isRegistrationOpen()) {
            return back()->withInput()
                ->withErrors(['name' => 'Pendaftaran untuk event ini sudah ditutup.']);
        }

        if ($event->seatsLeft() < 1) {
            return back()->withInput()
                ->withErrors(['name' => 'Kuota event ini sudah penuh.']);
        }

        $data = $request->validate([
            'name' => 'required|string|max:100',
            'nrp' => [
                'required',
                'digits:10',
                Rule::unique('event_registrations', 'nrp')->where('event_id', $event->id),
            ],
            'division' => ['required', Rule::in($event->divisions->pluck('name')->all())],
            'reason' => 'required|string',
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'nrp.required' => 'NRP wajib diisi.',
            'nrp.digits' => 'NRP harus terdiri dari 10 digit angka.',
            'nrp.unique' => 'NRP ini sudah terdaftar di event ini.',
            'division.required' => 'Divisi wajib dipilih.',
            'division.in' => 'Divisi yang dipilih tidak valid.',
            'reason.required' => 'Alasan bergabung wajib diisi.',
        ]);

        $data['event_id'] = $event->id;
        $data['user_id'] = Auth::id();
        $data['status'] = 'menunggu';

        EventRegistration::create($data);

        return redirect()->route('events.show', $event)
            ->with('success', 'Pendaftaran berhasil dikirim.');
    }

    public function updateStatus(Request $request, EventRegistration $registration)
    {
        $data = $request->validate([
            'status' => ['required', Rule::in(['menunggu', 'diterima', 'ditolak'])],
        ]);

        $registration->update($data);

        return back()->with('success', 'Status pendaftaran diperbarui.');
    }
}