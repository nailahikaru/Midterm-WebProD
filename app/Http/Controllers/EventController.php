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
            'divisions' => 'required|string',
        ];
    }

    private function parseDivisions($text)
    {
        $names = preg_split('/\r\n|\r|\n/', $text);
        $names = array_map('trim', $names);
        $names = array_filter($names, function ($name) {
            return $name !== '';
        });

        return array_values(array_unique($names));
    }

    private function divisionsAreValid(array $names)
    {
        if (count($names) < 1) {
            return false;
        }

        foreach ($names as $name) {
            if (mb_strlen($name) > 50) {
                return false;
            }
        }

        return true;
    }

    private function syncDivisions(Event $event, array $names)
    {
        $event->divisions()->delete();

        foreach ($names as $name) {
            $event->divisions()->create(['name' => $name]);
        }
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
        $data = $request->validate($this->rules(), [
            'divisions.required' => 'Isi minimal satu divisi.',
        ]);

        $names = $this->parseDivisions($data['divisions']);
        if (!$this->divisionsAreValid($names)) {
            return back()->withInput()->withErrors([
                'divisions' => 'Isi minimal satu divisi, maksimal 50 karakter per nama.',
            ]);
        }

        unset($data['divisions']);
        $data['user_id'] = Auth::id();

        $event = Event::create($data);
        $this->syncDivisions($event, $names);

        return redirect()->route('events.index')
            ->with('success', 'Event berhasil ditambahkan.');
    }

    public function show(Event $event)
    {
        $event->load('divisions');
        $registrations = $event->registrations()->latest()->get();

        return view('events.show', compact('event', 'registrations'));
    }

    public function edit(Event $event)
    {
        $event->load('divisions');
        return view('events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $data = $request->validate($this->rules(), [
            'divisions.required' => 'Isi minimal satu divisi.',
        ]);

        $names = $this->parseDivisions($data['divisions']);
        if (!$this->divisionsAreValid($names)) {
            return back()->withInput()->withErrors([
                'divisions' => 'Isi minimal satu divisi, maksimal 50 karakter per nama.',
            ]);
        }

        unset($data['divisions']);

        $event->update($data);
        $this->syncDivisions($event, $names);

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