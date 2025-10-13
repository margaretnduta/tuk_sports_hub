<x-app-layout>
  <div class="p-6">
    <div class="flex items-center justify-between">
      <h1 class="text-2xl font-bold text-primary">My Events</h1>
      <a href="{{ route('coach.events.create') }}" class="px-4 py-2 bg-primary text-white rounded">New Event</a>
    </div>

    <div class="mt-6 space-y-4">
      @forelse($events as $event)
        <div class="p-4 border rounded">
          <div class="font-semibold">{{ $event->title }} — {{ $event->sport_type }}</div>
          <div class="text-sm">{{ $event->starts_at->format('M d, Y H:i') }} @ {{ $event->location }}</div>
          <div class="mt-2 flex gap-3">
            <a class="text-blue-600" href="{{ route('coach.events.edit',$event) }}">Edit</a>
            <a class="text-gray-700" href="{{ route('coach.events.show',$event) }}">View</a>
            <form method="POST" action="{{ route('coach.events.destroy',$event) }}" onsubmit="return confirm('Delete?')">
              @csrf @method('DELETE')
              <button class="text-red-600">Delete</button>
            </form>
          </div>
        </div>
      @empty
        <p>No events yet.</p>
      @endforelse
    </div>

    <div class="mt-6">{{ $events->links() }}</div>
  </div>
</x-app-layout>
