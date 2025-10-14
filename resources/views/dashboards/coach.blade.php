@php
  $coach = auth()->user()->coach;
  $upcoming = $coach
    ? \App\Models\Event::where('coach_id',$coach->id)
        ->where(function($q){
            $q->where('status','scheduled')->orWhere('status','postponed');
        })
        ->orderBy('starts_at')
        ->take(6)->get()
    : collect();
@endphp

<x-app-layout>
  <div class="p-6">
    <h1 class="text-2xl font-bold text-primary">Coach Dashboard</h1>
    <p class="mt-2">Create events and view player availability.</p>

    <div class="mt-4 flex gap-3">
      <a href="{{ route('coach.events.index') }}" class="px-4 py-2 rounded bg-primary text-white hover:bg-accent2">Manage My Events</a>
      <a href="{{ route('coach.events.create') }}" class="px-4 py-2 rounded bg-gray-900 text-white hover:bg-gray-700">+ New Event</a>
      <a href="{{ route('coach.profile.edit') }}" class="px-4 py-2 rounded ring-1 ring-primary text-primary hover:bg-secondary">Edit Coach Profile</a>
    </div>

    <h2 class="mt-8 text-xl font-semibold text-primary">Upcoming Events</h2>
    <div class="mt-4 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
      @forelse($upcoming as $event)
        <div class="rounded-lg bg-white shadow border">
          @if($event->cover_image)
            <img src="{{ asset('storage/'.$event->cover_image) }}" alt="Cover" class="w-full h-40 object-cover rounded-t-lg">
          @endif
          <div class="p-4">
            <div class="flex items-start justify-between gap-2">
              <h3 class="text-lg font-semibold text-primary">{{ $event->title }}</h3>
              <span class="text-xs rounded px-2 py-1 ring-1 ring-primary/30">
                {{ ($event->status==='postponed' ? $event->postponed_to : $event->starts_at)?->format('M d, Y H:i') }}
              </span>
            </div>
            <div class="mt-1 text-sm text-gray-600">{{ $event->sport_type }} • {{ $event->location }}</div>
            <div class="mt-2 text-xs">
              <span class="rounded px-2 py-1
                @class([
                  'bg-green-100 text-green-700' => $event->status==='scheduled',
                  'bg-yellow-100 text-yellow-700' => $event->status==='postponed',
                ])
              ">{{ ucfirst($event->status) }}</span>
            </div>
            <div class="mt-4 flex flex-wrap gap-2">
              <a href="{{ route('coach.events.show',$event) }}" class="px-3 py-1 rounded bg-accent2 text-white hover:bg-accent1 text-sm">View</a>
              <a href="{{ route('coach.events.edit',$event) }}" class="px-3 py-1 rounded ring-1 ring-primary text-primary hover:bg-secondary text-sm">Edit</a>
              <form method="POST" action="{{ route('coach.events.destroy',$event) }}"
                    onsubmit="return confirm('Delete this event?')" class="inline">
                @csrf @method('DELETE')
                <button class="px-3 py-1 rounded bg-red-600 text-white hover:bg-red-700 text-sm">Delete</button>
              </form>
            </div>
          </div>
        </div>
      @empty
        <p class="text-gray-600">No upcoming events yet.</p>
      @endforelse
    </div>
  </div>
</x-app-layout>
