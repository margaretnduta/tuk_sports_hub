<x-app-layout>
  <div class="p-6 space-y-6">
    <div class="flex items-start justify-between">
      <div>
        <h1 class="text-2xl font-bold text-primary">{{ $event->title }}</h1>
        <div class="mt-1 text-sm text-gray-700">
          {{ $event->sport_type }} • {{ $event->starts_at->format('M d, Y H:i') }}
          @if($event->ends_at) — {{ $event->ends_at->format('M d, Y H:i') }} @endif
          • {{ $event->location }}
        </div>
      </div>
      <div class="flex gap-2">
        <a href="{{ route('coach.events.edit',$event) }}" class="px-3 py-2 rounded bg-accent2 text-white hover:bg-accent1">Edit</a>
        <a href="{{ route('coach.events.index') }}" class="px-3 py-2 rounded ring-1 ring-primary text-primary hover:bg-secondary">Back</a>
      </div>
    </div>

    @if($event->cover_image)
      <img src="{{ asset('storage/'.$event->cover_image) }}" alt="Cover image" class="rounded-lg max-w-2xl">
    @endif

    @if($event->description)
      <div class="rounded-lg bg-white p-4 shadow">
        <h2 class="text-lg font-semibold text-primary">Description</h2>
        <p class="mt-2 text-gray-800">{{ $event->description }}</p>
      </div>
    @endif

    <div class="grid gap-6 md:grid-cols-2">
      <!-- Players -->
      <div class="rounded-lg bg-white p-4 shadow">
        <div class="flex items-center justify-between">
          <h2 class="text-lg font-semibold text-primary">Players</h2>
          <div class="text-xs">
            <span class="mr-2">✅ {{ $counts['players']['confirmed'] }}</span>
            <span class="mr-2">⏳ {{ $counts['players']['pending'] }}</span>
            <span>❌ {{ $counts['players']['declined'] }}</span>
          </div>
        </div>
        <div class="mt-3 divide-y">
          @forelse($event->players as $p)
            <div class="py-2 text-sm flex items-center justify-between">
              <div>
                <div class="font-medium">{{ $p->user->name ?? 'Player #'.$p->id }}</div>
                <div class="text-gray-500">{{ $p->sport ?? '—' }}</div>
              </div>
              <span class="rounded px-2 py-1 text-xs
                @class([
                  'bg-green-100 text-green-700' => $p->pivot->status==='confirmed',
                  'bg-yellow-100 text-yellow-700' => $p->pivot->status==='pending',
                  'bg-red-100 text-red-700' => $p->pivot->status==='declined',
                ])
              ">{{ ucfirst($p->pivot->status) }}</span>
            </div>
          @empty
            <p class="text-sm text-gray-500">No players yet.</p>
          @endforelse
        </div>
      </div>

      <!-- Fans -->
      <div class="rounded-lg bg-white p-4 shadow">
        <div class="flex items-center justify-between">
          <h2 class="text-lg font-semibold text-primary">Fans</h2>
          <div class="text-xs">
            <span class="mr-2">🎟️ {{ $counts['fans']['going'] }}</span>
            <span class="mr-2">⭐ {{ $counts['fans']['interested'] }}</span>
            <span>🚫 {{ $counts['fans']['not_going'] }}</span>
          </div>
        </div>
        <div class="mt-3 divide-y">
          @forelse($event->fans as $f)
            <div class="py-2 text-sm flex items-center justify-between">
              <div class="font-medium">{{ $f->user->name ?? 'Fan #'.$f->id }}</div>
              <span class="rounded px-2 py-1 text-xs
                @class([
                  'bg-green-100 text-green-700' => $f->pivot->status==='going',
                  'bg-blue-100 text-blue-700' => $f->pivot->status==='interested',
                  'bg-red-100 text-red-700' => $f->pivot->status==='not_going',
                ])
              ">{{ ucfirst($f->pivot->status) }}</span>
            </div>
          @empty
            <p class="text-sm text-gray-500">No fans yet.</p>
          @endforelse
        </div>
      </div>
    </div>

    <!-- Event Updates (we add in step 24) -->
    <div class="rounded-lg bg-white p-4 shadow">
      <h2 class="text-lg font-semibold text-primary">Event Updates</h2>
      <p class="text-sm text-gray-500">Coming next step: post updates & photos here.</p>
    </div>
  </div>
</x-app-layout>

@php
  $updates = \App\Models\EventUpdate::where('event_id',$event->id)->latest()->get();
@endphp

<form method="POST" action="{{ route('coach.events.updates.store',$event) }}" enctype="multipart/form-data" class="mt-3 space-y-3">
  @csrf
  <textarea name="body" rows="3" class="w-full rounded border-gray-300" placeholder="Write an update..."></textarea>
  <input type="file" name="image" accept="image/*" class="block w-full rounded border-gray-300">
  <button class="px-4 py-2 rounded bg-primary text-white hover:bg-accent2">Post Update</button>
</form>

<div class="mt-6 space-y-4">
  @forelse($updates as $u)
    <div class="rounded border p-3">
      <div class="text-xs text-gray-500">{{ $u->created_at->diffForHumans() }}</div>
      @if($u->body)
        <p class="mt-1">{{ $u->body }}</p>
      @endif
      @if($u->image_path)
        <img src="{{ asset('storage/'.$u->image_path) }}" alt="Update" class="mt-2 max-w-md rounded">
      @endif
      <form method="POST" action="{{ route('coach.events.updates.destroy', [$event, $u]) }}" class="mt-2" onsubmit="return confirm('Delete this update?')">
        @csrf @method('DELETE')
        <button class="text-red-600 text-sm">Delete</button>
      </form>
    </div>
  @empty
    <p class="text-sm text-gray-500">No updates yet.</p>
  @endforelse
</div>
