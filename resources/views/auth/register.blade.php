<x-guest-layout>
  <h2 class="text-2xl font-bold text-primary text-center mb-1">Join TUK Sports Hub</h2>
  <p class="text-sm text-gray-600 text-center mb-6">
    Create an account as a player or fan and follow campus sports in real time.
  </p>

  <form method="POST" action="{{ route('register') }}" class="space-y-4">
    @csrf

    <!-- Name -->
    <div>
      <x-input-label for="name" value="Full name" />
      <x-text-input id="name" class="block mt-1 w-full"
                    type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
      <x-input-error :messages="$errors->get('name')" class="mt-2" />
    </div>

    <!-- Email Address -->
    <div>
      <x-input-label for="email" value="TUK email (if any)" />
      <x-text-input id="email" class="block mt-1 w-full"
                    type="email" name="email" :value="old('email')" required autocomplete="username" />
      <x-input-error :messages="$errors->get('email')" class="mt-2" />
    </div>

    <!-- Role -->
    <div>
      <x-input-label for="role" value="Registering as" />
      <select id="role" name="role"
              class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-primary focus:ring-primary"
              required>
        <option value="" disabled {{ old('role') ? '' : 'selected' }}>Select role</option>
        <option value="player" {{ old('role') === 'player' ? 'selected' : '' }}>Player</option>
        <option value="fan" {{ old('role') === 'fan' ? 'selected' : '' }}>Fan</option>
      </select>
      <x-input-error :messages="$errors->get('role')" class="mt-2" />
      <p class="mt-1 text-xs text-gray-500">
        Coaches are added by the sports office. Use your player or fan account to follow events.
      </p>
    </div>

    <!-- Password -->
    <div>
      <x-input-label for="password" value="Password" />
      <x-text-input id="password" class="block mt-1 w-full"
                    type="password"
                    name="password"
                    required autocomplete="new-password" />
      <x-input-error :messages="$errors->get('password')" class="mt-2" />
    </div>

    <!-- Confirm Password -->
    <div>
      <x-input-label for="password_confirmation" value="Confirm password" />
      <x-text-input id="password_confirmation" class="block mt-1 w-full"
                    type="password"
                    name="password_confirmation" required autocomplete="new-password" />
      <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
    </div>

    <div class="mt-6">
      <x-primary-button class="w-full justify-center">
        Create account
      </x-primary-button>
    </div>

    <p class="mt-4 text-xs text-gray-600 text-center">
      Already have an account?
      <a href="{{ route('login') }}" class="text-primary font-medium hover:text-accent2">
        Log in
      </a>
    </p>
  </form>
</x-guest-layout>
