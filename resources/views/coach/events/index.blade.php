<x-app-layout>
  <div class="p-6">
    <div class="flex items-center justify-between">
      <h1 class="text-2xl font-bold text-primary">My Events</h1>
      <a href="{{ route('coach.events.create') }}" class="px-4 py-2 rounded bg-primary text-white hover:bg-accent2">
        + New Event
      </a>
    </div>

    <div class="mt-6 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
      @forelse($events as $event)
        <div class="rounded-lg bg-white shadow border">
          @if($event->cover_image)
            <img src="{{ asset('storage/'.$event->cover_image) }}" alt="Cover"
                 class="w-full h-40 object-cover rounded-t-lg">
          @endif

          @php
            $isPostponed = $event->status === 'postponed';
            $displayDate = $isPostponed && $event->postponed_to
                ? $event->postponed_to
                : $event->starts_at;
          @endphp

          <div class="p-4">
            <div class="flex items-start justify-between gap-2">
              <div>
                <h2 class="text-lg font-semibold text-primary">{{ $event->title }}</h2>
                <div class="mt-1 text-sm text-gray-600">
                  {{ $event->sport_type }} • {{ $event->location }}
                </div>
              </div>

              <div class="text-right space-y-1">
                @if($displayDate)
                  <span class="block text-xs rounded px-2 py-1 ring-1 ring-primary/30">
                    {{ $displayDate->format('M d, Y H:i') }}
                  </span>
                @endif

                <span class="inline-block text-xs rounded px-2 py-1
                  @class([
                    'bg-green-100 text-green-700' => $event->status === 'scheduled',
                    'bg-yellow-100 text-yellow-700' => $event->status === 'postponed',
                    'bg-red-100 text-red-700' => $event->status === 'cancelled',
                    'bg-gray-200 text-gray-700' => $event->status === 'completed',
                  ])
                ">
                  {{ ucfirst($event->status) }}
                </span>
              </div>
            </div>

            @if($event->description)
              @php
                $desc = strlen($event->description) > 120
                    ? substr($event->description, 0, 120).'...'
                    : $event->description;
              @endphp
              <p class="mt-2 text-sm text-gray-700">{{ $desc }}</p>
            @endif

            <div class="mt-4 flex flex-wrap gap-2">
              <a href="{{ route('coach.events.show',$event) }}"
                 class="px-3 py-1 rounded bg-accent2 text-white hover:bg-accent1 text-sm">
                View
              </a>
              <a href="{{ route('coach.events.edit',$event) }}"
                 class="px-3 py-1 rounded ring-1 ring-primary text-primary hover:bg-secondary text-sm">
                Edit
              </a>
              <form method="POST" action="{{ route('coach.events.destroy',$event) }}"
                    onsubmit="return confirm('Delete this event?')" class="inline">
                @csrf
                @method('DELETE')
                <button class="px-3 py-1 rounded bg-red-600 text-white hover:bg-red-700 text-sm">
                  Delete
                </button>
              </form>
            </div>
          </div>
        </div>
      @empty
        <p class="text-gray-600 mt-4">No events yet. Create your first one.</p>
      @endforelse
    </div>

    <div class="mt-6">
      {{ $events->links() }}
    </div>
  </div>
</x-app-layout>
