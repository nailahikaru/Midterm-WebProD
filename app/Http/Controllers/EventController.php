<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    private function rules()
    {
        return [
            'name' => 'required|string|max:150',
            'description' => 'nullable|string',
            'location' => 'nullable|string|max:150',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'registration_deadline' => 'required|date|before_or_equal:start_date',
            'quota' => 'required|integer|min:1',
        ];
    }

    public function index()
    {
        $events = Event::latest()->get();
        return view('events.index', compact('events'));
    }

    public function create()
    {
        return view('events.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate($this->rules());
        $data['user_id'] = Auth::id();

        Event::create($data);

        return redirect()->route('events.index')
            ->with('success', 'Event berhasil ditambahkan.');
    }

    public function show(Event $event)
    {
        $registrations = $event->registrations()->latest()->get();
        return view('events.show', compact('event', 'registrations'));
    }

    public function edit(Event $event)
    {
        return view('events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $data = $request->validate($this->rules());

        $event->update($data);

        return redirect()->route('events.show', $event)
            ->with('success', 'Event berhasil diperbarui.');
    }

    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('events.index')
            ->with('success', 'Event berhasil dihapus.');
    }
}