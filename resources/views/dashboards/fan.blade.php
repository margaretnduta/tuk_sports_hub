<x-app-layout>
  <div class="p-6 max-w-6xl mx-auto space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
      <div>
        <h1 class="text-2xl font-bold text-primary">Fan Dashboard</h1>
        <p class="text-sm text-gray-600">
          See upcoming fixtures and how many players have confirmed for each game.
        </p>
      </div>
    </div>

    <div>
      <h2 class="text-xl font-semibold text-primary mb-3">Upcoming events</h2>

      <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
        @forelse($events as $event)
          @php
            $isPostponed = $event->status === 'postponed';
            $displayDate = $isPostponed && $event->postponed_to
                ? $event->postponed_to
                : $event->starts_at;

            $confirmed = $confirmedCounts[$event->id] ?? 0;
          @endphp

          <div class="rounded-lg bg-white shadow border">
            @if($event->cover_image)
              <img src="{{ asset('storage/'.$event->cover_image) }}"
                   alt="Event cover"
                   class="w-full h-40 object-cover rounded-t-lg">
            @endif

            <div class="p-4">
              <div class="flex items-start justify-between gap-2">
                <div>
                  <h3 class="text-base font-semibold text-primary">{{ $event->title }}</h3>
                  <div class="mt-1 text-xs text-gray-600">
                    {{ $event->sport_type }} • {{ $event->location }}
                  </div>
                </div>

                <div class="text-right space-y-1">
                  @if($displayDate)
                    <span class="block text-[11px] rounded px-2 py-1 ring-1 ring-primary/30">
                      {{ $displayDate->format('M d, Y H:i') }}
                    </span>
                  @endif

                  <span class="inline-block text-[11px] rounded px-2 py-1
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

              <p class="mt-3 text-xs text-gray-700">
                <span class="font-semibold">{{ $confirmed }}</span> player(s) have confirmed for this game.
              </p>
            </div>
          </div>
        @empty
          <p class="text-sm text-gray-600">
            No upcoming events available yet. Check back soon.
          </p>
        @endforelse
      </div>
    </div>
  </div>
</x-app-layout>
