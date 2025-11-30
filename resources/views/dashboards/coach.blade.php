<x-app-layout>
  <div class="p-6">
    <h1 class="text-2xl font-bold text-primary">Coach Dashboard</h1>
    <p class="mt-2 text-sm text-gray-700">
      Manage your events and keep track of what is coming up.
    </p>

    <div class="mt-4 flex gap-3">
      <a href="{{ route('coach.events.index') }}" class="px-4 py-2 rounded bg-primary text-white hover:bg-accent2">
        My Events
      </a>
      <a href="{{ route('coach.events.create') }}" class="px-4 py-2 rounded bg-gray-900 text-white hover:bg-gray-700">
        + New Event
      </a>
      <a href="{{ route('coach.profile.edit') }}" class="px-4 py-2 rounded ring-1 ring-primary text-primary hover:bg-secondary">
        Edit Coach Profile
      </a>
    </div>

    <h2 class="mt-8 text-xl font-semibold text-primary">Upcoming Events</h2>

    <div class="mt-4 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
      @forelse($upcoming as $event)
        <div class="rounded-lg bg-white shadow border">
          @if($event->cover_image)
            <img src="{{ asset('storage/'.$event->cover_image) }}" alt="Cover"
                 class="w-full h-40 object-cover rounded-t-lg">
          @endif
          <div class="p-4">
            <div class="flex items-start justify-between gap-2">
              <h3 class="text-lg font-semibold text-primary">{{ $event->title }}</h3>
              <span class="text-xs rounded px-2 py-1 ring-1 ring-primary/30">
                {{ ($event->status === 'postponed' ? $event->postponed_to : $event->starts_at)?->format('M d, Y H:i') }}
              </span>
            </div>
            <div class="mt-1 text-sm text-gray-600">
              {{ $event->sport_type }} • {{ $event->location }}
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
              <a href="{{ route('coach.events.show',$event) }}" class="px-3 py-1 rounded bg-accent2 text-white hover:bg-accent1 text-sm">
                View
              </a>
              <a href="{{ route('coach.events.edit',$event) }}" class="px-3 py-1 rounded ring-1 ring-primary text-primary hover:bg-secondary text-sm">
                Edit
              </a>
            </div>
          </div>
        </div>
      @empty
        <p class="text-gray-600">No upcoming events yet. Create one to see it here.</p>
      @endforelse
    </div>
  </div>
</x-app-layout>
