<x-app-layout>
  <div class="p-6 max-w-xl mx-auto space-y-6">
    <div>
      <h1 class="text-2xl font-bold text-primary">Player Profile</h1>
      <p class="text-sm text-gray-600">
        Update your sport and general availability status.
      </p>
    </div>

    @if(session('success'))
      <div class="rounded bg-green-100 p-3 text-sm text-green-700">
        {{ session('success') }}
      </div>
    @endif

    <form method="POST" action="{{ route('player.profile.update') }}" class="space-y-4">
      @csrf

      <div>
        <x-input-label for="sport" value="Primary sport" />
        <x-text-input id="sport"
                      name="sport"
                      class="block mt-1 w-full"
                      type="text"
                      :value="old('sport', $player->sport)"
                      placeholder="Football, Basketball, Volleyball..." />
        <x-input-error :messages="$errors->get('sport')" class="mt-2" />
      </div>

      <div>
        <x-input-label for="availability_status" value="General availability" />
        <select id="availability_status"
                name="availability_status"
                class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
          @php
            $current = old('availability_status', $player->availability_status ?? 'available');
          @endphp
          <option value="available" {{ $current === 'available' ? 'selected' : '' }}>Available</option>
          <option value="injured" {{ $current === 'injured' ? 'selected' : '' }}>Injured</option>
          <option value="busy" {{ $current === 'busy' ? 'selected' : '' }}>Busy / limited</option>
          <option value="unknown" {{ $current === 'unknown' ? 'selected' : '' }}>Unknown</option>
        </select>
        <x-input-error :messages="$errors->get('availability_status')" class="mt-2" />
      </div>

      <div class="pt-2">
        <x-primary-button>Save changes</x-primary-button>
      </div>
    </form>
  </div>
</x-app-layout>
