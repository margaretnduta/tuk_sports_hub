<?php

namespace App\Http\Controllers\Coach;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventUpdate;
use Illuminate\Http\Request;

class EventUpdateController extends Controller
{
    public function store(Request $request, Event $event)
    {
        // authorize coach owns event
        $coachId = optional(auth()->user()->coach)->id;
        abort_if(!$coachId || $event->coach_id !== $coachId, 403);

        $data = $request->validate([
            'body'       => ['nullable','string','max:2000'],
            'image'      => ['nullable','image','max:4096'],
        ]);

        $path = null;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('event-updates', 'public');
        }

        EventUpdate::create([
            'event_id'   => $event->id,
            'user_id'    => auth()->id(),
            'body'       => $data['body'] ?? null,
            'image_path' => $path,
        ]);

        return back()->with('success','Update posted.');
    }

    public function destroy(Event $event, EventUpdate $update)
    {
        $coachId = optional(auth()->user()->coach)->id;
        abort_if(!$coachId || $event->coach_id !== $coachId || $update->event_id !== $event->id, 403);

        $update->delete();
        return back()->with('success','Update removed.');
    }
}
