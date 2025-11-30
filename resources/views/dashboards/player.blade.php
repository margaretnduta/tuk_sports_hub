<x-app-layout>
  <div class="p-6 max-w-6xl mx-auto space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
      <div>
        <h1 class="text-2xl font-bold text-primary">Player Dashboard</h1>
        <p class="text-sm text-gray-600">
          See upcoming fixtures for your sport and update your availability.
        </p>
      </div>
      <div class="flex items-center gap-3 text-sm">
        <div class="px-3 py-1 rounded-full bg-secondary text-primary border border-primary/20">
          Sport:
          <span class="font-semibold">
            {{ $player->sport ?: 'Not set' }}
          </span>
        </div>
        <div class="px-3 py-1 rounded-full bg-gray-100 border border-gray-300">
          Status:
          <span class="font-semibold capitalize">
            {{ $player->availability_status }}
          </span>
        </div>
        <a href="{{ route('player.profile') }}"
           class="text-sm text-primary hover:text-accent2 underline">
          Edit profile
        </a>
      </div>
    </div>

    <div>
      <h2 class="text-xl font-semibold text-primary mb-3">Upcoming events</h2>

      <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
        @forelse($events as $event)
          @php
            $participation = $participations->get($event->id);
            $status = $participation->status ?? 'pending';

            $isPostponed = $event->status === 'postponed';
            $displayDate = $isPostponed && $event->postponed_to
                ? $event->postponed_to
                : $event->starts_at;
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

              @if($event->description)
                @php
                  $desc = strlen($event->description) > 90
                      ? substr($event->description, 0, 90).'...'
                      : $event->description;
                @endphp
                <p class="mt-2 text-xs text-gray-700">{{ $desc }}</p>
              @endif

              <div class="mt-3 text-xs">
                <span class="font-semibold">Your availability:</span>
                <span class="capitalize
                  @class([
                    'text-gray-600' => $status === 'pending',
                    'text-green-700' => $status === 'confirmed',
                    'text-red-600' => $status === 'declined',
                  ])
                ">
                  {{ $status }}
                </span>
              </div>

              <div class="mt-3 flex flex-wrap gap-2">
                <form method="POST"
                      action="{{ route('player.events.availability', $event) }}">
                  @csrf
                  <input type="hidden" name="status" value="confirmed">
                  <button type="submit"
                          class="px-3 py-1 rounded text-xs
                          @if($status === 'confirmed')
                            bg-green-700 text-white
                          @else
                            bg-green-100 text-green-700 hover:bg-green-200
                          @endif">
                    Confirm
                  </button>
                </form>

                <form method="POST"
                      action="{{ route('player.events.availability', $event) }}">
                  @csrf
                  <input type="hidden" name="status" value="declined">
                  <button type="submit"
                          class="px-3 py-1 rounded text-xs
                          @if($status === 'declined')
                            bg-red-700 text-white
                          @else
                            bg-red-100 text-red-700 hover:bg-red-200
                          @endif">
                    Decline
                  </button>
                </form>
              </div>
            </div>
          </div>
        @empty
          <p class="text-sm text-gray-600">
            No upcoming events for your sport yet. Check back soon or update your sport in your profile.
          </p>
        @endforelse
      </div>
    </div>
  </div>
</x-app-layout>
