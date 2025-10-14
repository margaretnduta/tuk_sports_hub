<x-app-layout>
  <div class="p-6">
    <div class="flex items-center justify-between">
      <h1 class="text-2xl font-bold text-primary">My Events</h1>
      <a href="{{ route('coach.events.create') }}" class="px-4 py-2 rounded bg-primary text-white hover:bg-accent2">+ New Event</a>
    </div>

    <div class="mt-6 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
      @forelse($events as $event)
        <div class="rounded-lg bg-white shadow border">
          @if($event->cover_image)
            <img src="{{ asset('storage/'.$event->cover_image) }}" alt="Cover" class="w-full h-40 object-cover rounded-t-lg">
          @endif
          <div class="p-4">
            <div class="flex items-start justify-between gap-2">
              <h2 class="text-lg font-semibold text-primary">{{ $event->title }}</h2>
              <span class="text-xs rounded px-2 py-1 ring-1 ring-primary/30">
                {{ $event->starts_at?->format('M d, Y H:i') }}
              </span>
            </div>
            <div class="mt-1 text-sm text-gray-600">{{ $event->sport_type }} • {{ $event->location }}</div>
            @if($event->description)
              <p class="mt-2 text-sm text-gray-700 line-clamp-2">{{ Str::limit($event->description, 120) }}</p>
            @endif

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
        <p class="text-gray-600">No events yet. Create your first one.</p>
      @endforelse
    </div>

    <div class="mt-6">{{ $events->links() }}</div>
  </div>
</x-app-layout>
