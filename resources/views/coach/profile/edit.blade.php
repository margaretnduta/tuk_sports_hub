<x-app-layout>
  <div class="p-6 max-w-2xl">
    <h1 class="text-2xl font-bold text-primary">Coach Profile</h1>
    <p class="mt-1 text-sm text-gray-600">Update your sport and bio.</p>

    @if(session('success'))
      <div class="mt-3 rounded bg-green-100 p-2 text-green-700 text-sm">
        {{ session('success') }}
      </div>
    @endif

    <form method="POST" action="{{ route('coach.profile.update') }}" class="mt-6 space-y-4">
      @csrf @method('PATCH')

      <x-input-label for="sport" value="Sport" />
      <x-text-input id="sport" name="sport" class="w-full" required value="{{ old('sport', $coach->sport) }}" />

      <x-input-label for="bio" value="Bio" />
      <textarea id="bio" name="bio" rows="5" class="w-full rounded border-gray-300">{{ old('bio', $coach->bio) }}</textarea>

      <x-primary-button class="mt-2 bg-primary hover:bg-accent2">Save</x-primary-button>
    </form>
  </div>
</x-app-layout>
