<x-guest-layout>
  <h2 class="text-2xl font-bold text-primary text-center mb-1">Welcome back</h2>
  <p class="text-sm text-gray-600 text-center mb-6">
    Sign in to manage your events, teams and match updates.
  </p>

  <!-- Session Status -->
  <x-auth-session-status class="mb-4" :status="session('status')" />

  <form method="POST" action="{{ route('login') }}" class="space-y-4">
    @csrf

    <!-- Email Address -->
    <div>
      <x-input-label for="email" value="Email" />
      <x-text-input id="email" class="block mt-1 w-full"
                    type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
      <x-input-error :messages="$errors->get('email')" class="mt-2" />
    </div>

    <!-- Password -->
    <div>
      <x-input-label for="password" value="Password" />
      <x-text-input id="password" class="block mt-1 w-full"
                    type="password"
                    name="password"
                    required autocomplete="current-password" />
      <x-input-error :messages="$errors->get('password')" class="mt-2" />
    </div>

    <!-- Remember Me -->
    <div class="flex items-center justify-between mt-2">
      <label for="remember_me" class="inline-flex items-center">
        <input id="remember_me" type="checkbox"
               class="rounded border-gray-300 text-primary shadow-sm focus:ring-primary"
               name="remember">
        <span class="ms-2 text-sm text-gray-600">Remember me</span>
      </label>

      @if (Route::has('password.request'))
        <a class="text-sm text-primary hover:text-accent2" href="{{ route('password.request') }}">
          Forgot password?
        </a>
      @endif
    </div>

    <div class="mt-6">
      <x-primary-button class="w-full justify-center">
        Log in
      </x-primary-button>
    </div>

    <p class="mt-4 text-xs text-gray-600 text-center">
      New to TUK Sports Hub?
      <a href="{{ route('register') }}" class="text-primary font-medium hover:text-accent2">
        Create an account
      </a>
    </p>
  </form>
</x-guest-layout>
