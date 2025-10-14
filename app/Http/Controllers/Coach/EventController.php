<?php

namespace App\Http\Controllers\Coach;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Coach;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
{
    $coach = $this->ensureCoachProfile();   // auto-create if missing
    $events = Event::where('coach_id', $coach->id)
        ->orderByDesc('starts_at')
        ->paginate(12);

    return view('coach.events.index', compact('events'));
}



public function postpone(Request $request, Event $event)
{
    $this->authorizeCoach($event);

    $data = $request->validate([
        'postponed_to'   => ['required','date','after:now'],
        'postpone_reason'=> ['nullable','string','max:255'],
    ]);

    $event->update([
        'status'          => 'postponed',
        'postponed_to'    => $data['postponed_to'],
        'postpone_reason' => $data['postpone_reason'] ?? null,
    ]);

    return back()->with('success','Event postponed.');
}


    public function create()
    {
        $this->ensureCoachProfile();
        return view('coach.events.create');
    }

    public function store(Request $request)
    {
        $coach = $this->ensureCoachProfile();

        $data = $request->validate([
            'title'      => ['required','string','max:255'],
            'sport_type' => ['required','string','max:100'],
            'starts_at'  => ['required','date'],
            'ends_at'    => ['nullable','date','after_or_equal:starts_at'],
            'location'   => ['required','string','max:255'],
            'description'=> ['nullable','string'],
                'cover_image'=> ['nullable','image','max:2048'], // ✅ NEW

        ]);

if ($request->hasFile('cover_image')) {
    $data['cover_image'] = $request->file('cover_image')->store('events', 'public');
}

        $data['coach_id'] = $coach->id;

        Event::create($data);

        return redirect()
            ->route('coach.events.index')
            ->with('success', 'Event created.');
    }

    public function show(Event $event)
{
    $this->authorizeCoach($event);

    $event->load([
        'players' => fn($q) => $q->orderBy('players.id'),
        'fans'    => fn($q) => $q->orderBy('fans.id'),
    ]);

    // simple counts for badges
    $counts = [
        'players' => [
            'confirmed' => $event->players->where('pivot.status','confirmed')->count(),
            'pending'   => $event->players->where('pivot.status','pending')->count(),
            'declined'  => $event->players->where('pivot.status','declined')->count(),
        ],
        'fans' => [
            'going'      => $event->fans->where('pivot.status','going')->count(),
            'interested' => $event->fans->where('pivot.status','interested')->count(),
            'not_going'  => $event->fans->where('pivot.status','not_going')->count(),
        ],
    ];

    return view('coach.events.show', compact('event','counts'));
}


    public function edit(Event $event)
    {
        $this->authorizeCoach($event);
        return view('coach.events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $this->authorizeCoach($event);

        $data = $request->validate([
            'title'      => ['required','string','max:255'],
            'sport_type' => ['required','string','max:100'],
            'starts_at'  => ['required','date'],
            'ends_at'    => ['nullable','date','after_or_equal:starts_at'],
            'location'   => ['required','string','max:255'],
            'description'=> ['nullable','string'],
                'cover_image'=> ['nullable','image','max:2048'], // ✅ NEW

        ]);
if ($request->hasFile('cover_image')) {
    $data['cover_image'] = $request->file('cover_image')->store('events', 'public');
}
        $event->update($data);

        return redirect()
            ->route('coach.events.index')
            ->with('success', 'Event updated.');
    }

    public function destroy(Event $event)
    {
        $this->authorizeCoach($event);
        $event->delete();

        return redirect()
            ->route('coach.events.index')
            ->with('success', 'Event deleted.');
    }

    private function authorizeCoach(Event $event): void
    {
        $coachId = optional(auth()->user()->coach)->id;
        abort_if(!$coachId || $event->coach_id !== $coachId, 403, 'Unauthorized.');
    }

    /**
     * Ensure the logged-in coach has a profile row; create it if missing.
     */
    private function ensureCoachProfile(): Coach
    {
        $user = auth()->user();

        abort_unless($user && $user->role === 'coach', 403, 'Unauthorized.');

        // If profile exists, return it; else create minimal profile.
        return Coach::firstOrCreate(
            ['user_id' => $user->id],
            ['sport' => 'Football', 'bio' => null]
        );
    }
}
