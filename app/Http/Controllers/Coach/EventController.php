<?php

namespace App\Http\Controllers\Coach;

use App\Http\Controllers\Controller;
use App\Models\Coach;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    private function coachOrFail(): Coach
    {
        $user = auth()->user();
        abort_unless($user && $user->role === 'coach', 403);

        return Coach::firstOrCreate(
            ['user_id' => $user->id],
            ['sport' => 'Football', 'bio' => null]
        );
    }

    private function guardOwnership(Event $event): void
    {
        $coachId = optional(auth()->user()->coach)->id;
        abort_if(!$coachId || $event->coach_id !== $coachId, 403);
    }

    public function index()
    {
        $coach = $this->coachOrFail();

        $events = Event::where('coach_id', $coach->id)
            ->orderByDesc('starts_at')
            ->paginate(12);

        return view('coach.events.index', compact('events'));
    }

    public function create()
    {
        $this->coachOrFail();
        return view('coach.events.create');
    }

    public function store(Request $request)
    {
        $coach = $this->coachOrFail();

       $data = $request->validate([
    'title'       => ['required', 'string', 'max:255'],
    'sport_type'  => ['required', 'string', 'max:100'],
    'starts_at'   => ['required', 'date'],              // removed after:now
    'ends_at'     => ['nullable', 'date'],              // removed after_or_equal
    'location'    => ['required', 'string', 'max:255'],
    'description' => ['nullable', 'string'],
    'cover_image' => ['nullable', 'image', 'max:2048'],
]);

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('events', 'public');
        }

        $data['coach_id'] = $coach->id;
        $data['status']   = 'scheduled';

        Event::create($data);

        return redirect()->route('coach.events.index')->with('success', 'Event created.');
    }

    public function show(Event $event)
    {
        $this->guardOwnership($event);
        return view('coach.events.show', compact('event'));
    }

    public function edit(Event $event)
    {
        $this->guardOwnership($event);
        return view('coach.events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $this->guardOwnership($event);

      $data = $request->validate([
    'title'       => ['required', 'string', 'max:255'],
    'sport_type'  => ['required', 'string', 'max:100'],
    'starts_at'   => ['required', 'date'],
    'ends_at'     => ['nullable', 'date'],
    'location'    => ['required', 'string', 'max:255'],
    'description' => ['nullable', 'string'],
    'cover_image' => ['nullable', 'image', 'max:2048'],
]);

        if ($request->hasFile('cover_image')) {
            if ($event->cover_image && Storage::disk('public')->exists($event->cover_image)) {
                Storage::disk('public')->delete($event->cover_image);
            }
            $data['cover_image'] = $request->file('cover_image')->store('events', 'public');
        }

        $event->update($data);

        return redirect()->route('coach.events.index')->with('success', 'Event updated.');
    }

    public function destroy(Event $event)
    {
        $this->guardOwnership($event);

        if ($event->cover_image && Storage::disk('public')->exists($event->cover_image)) {
            Storage::disk('public')->delete($event->cover_image);
        }

        $event->delete();

        return redirect()->route('coach.events.index')->with('success', 'Event deleted.');
    }

    public function postpone(Request $request, Event $event)
    {
        $this->guardOwnership($event);

        if ($event->status !== 'scheduled') {
            return back()->with('error', 'Only scheduled events can be postponed.');
        }

        $data = $request->validate([
            'postponed_to'    => ['required', 'date', 'after:now'],
            'postpone_reason' => ['nullable', 'string', 'max:255'],
        ]);

        $event->update([
            'status'          => 'postponed',
            'postponed_to'    => $data['postponed_to'],
            'postpone_reason' => $data['postpone_reason'] ?? null,
        ]);

        return back()->with('success', 'Event postponed.');
    }
}
