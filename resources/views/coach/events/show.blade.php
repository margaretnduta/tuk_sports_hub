<x-app-layout>
  <div class="p-6 max-w-4xl space-y-6">
    {{-- Header --}}
    <div class="flex items-start justify-between gap-4">
      <div>
        <h1 class="text-2xl font-bold text-primary">{{ $event->title }}</h1>
        <div class="mt-1 text-sm text-gray-700">
          {{ $event->sport_type }} • {{ $event->location }}
        </div>
        <div class="mt-1 text-sm text-gray-600">
          Starts: {{ $event->starts_at?->format('M d, Y H:i') }}
          @if($event->ends_at)
            • Ends: {{ $event->ends_at?->format('M d, Y H:i') }}
          @endif
        </div>

        <span class="mt-2 inline-block text-xs rounded px-2 py-1
          @class([
            'bg-green-100 text-green-700' => $event->status === 'scheduled',
            'bg-yellow-100 text-yellow-700' => $event->status === 'postponed',
            'bg-red-100 text-red-700' => $event->status === 'cancelled',
            'bg-gray-200 text-gray-700' => $event->status === 'completed',
          ])
        ">
          {{ ucfirst($event->status) }}
        </span>

        @if($event->status === 'postponed' && $event->postponed_to)
          <div class="mt-1 text-xs text-yellow-700">
            New date: {{ $event->postponed_to?->format('M d, Y H:i') }}
            @if($event->postpone_reason)
              • Reason: {{ $event->postpone_reason }}
            @endif
          </div>
        @endif
      </div>

      <div class="flex flex-col gap-2">
        <a href="{{ route('coach.events.edit', $event) }}"
           class="px-3 py-2 rounded bg-accent2 text-white hover:bg-accent1 text-sm text-center">
          Edit
        </a>
        <a href="{{ route('coach.events.index') }}"
           class="px-3 py-2 rounded border border-primary text-primary hover:bg-secondary text-sm text-center">
          Back to My Events
        </a>
      </div>
    </div>

    {{-- Cover image --}}
    @if($event->cover_image)
      <div>
        <img src="{{ asset('storage/'.$event->cover_image) }}"
             alt="Event cover image"
             class="w-full max-h-96 object-cover rounded-lg shadow">
      </div>
    @endif

    {{-- Full description --}}
    @if($event->description)
      <div class="rounded-lg bg-white p-4 shadow">
        <h2 class="text-lg font-semibold text-primary mb-2">Event details</h2>
        <p class="text-gray-800 leading-relaxed whitespace-pre-line">
          {{ $event->description }}
        </p>
      </div>
    @endif

    {{-- Postpone section --}}
    <div class="rounded-lg bg-white p-4 shadow">
      <h2 class="text-lg font-semibold text-primary mb-2">Postpone event</h2>

      @if(session('error'))
        <p class="mb-2 text-sm text-red-600">{{ session('error') }}</p>
      @endif

      <form method="POST" action="{{ route('coach.events.postpone', $event) }}"
            class="mt-2 flex flex-wrap items-end gap-3">
        @csrf
        @method('PATCH')

        <div>
          <label class="block text-xs text-gray-600">New date and time</label>
          <input type="datetime-local" name="postponed_to" required
                 class="rounded border-gray-300">
        </div>

        <div>
          <label class="block text-xs text-gray-600">Reason (optional)</label>
          <input type="text" name="postpone_reason"
                 class="rounded border-gray-300"
                 placeholder="Weather, venue change, exams...">
        </div>

        <button class="px-3 py-2 rounded bg-yellow-600 text-white hover:bg-yellow-700 text-sm">
          Postpone
        </button>
      </form>
    </div>

    {{-- Players and availability --}}
    <div class="rounded-lg bg-white p-4 shadow">
      <h2 class="text-lg font-semibold text-primary mb-2">Players and availability</h2>

      @if($participations->isEmpty())
        <p class="text-sm text-gray-600">
          No players have responded yet. As players confirm or decline, they will appear here.
        </p>
      @else
        <div class="overflow-x-auto">
          <table class="min-w-full text-sm border border-gray-200 rounded">
            <thead class="bg-gray-100">
              <tr>
                <th class="px-3 py-2 text-left font-semibold text-gray-700 border-b">Player name</th>
                <th class="px-3 py-2 text-left font-semibold text-gray-700 border-b">Sport</th>
                <th class="px-3 py-2 text-left font-semibold text-gray-700 border-b">Availability</th>
              </tr>
            </thead>
            <tbody>
              @foreach($participations as $p)
                @php
                  $player = $p->player;
                  $user   = $player?->user;
                  $status = $p->status;
                @endphp
                <tr class="border-b last:border-b-0">
                  <td class="px-3 py-2">
                    {{ $user?->name ?? 'Unknown player' }}
                  </td>
                  <td class="px-3 py-2">
                    {{ $player?->sport ?? '-' }}
                  </td>
                  <td class="px-3 py-2">
                    <span class="inline-flex rounded px-2 py-1 text-xs capitalize
                      @class([
                        'bg-gray-100 text-gray-700' => $status === 'pending',
                        'bg-green-100 text-green-700' => $status === 'confirmed',
                        'bg-red-100 text-red-700' => $status === 'declined',
                      ])
                    ">
                      {{ $status }}
                    </span>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      @endif
    </div>
  </div>
</x-app-layout>
