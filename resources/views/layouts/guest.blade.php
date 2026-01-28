<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'TUK Sports Hub') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
  </head>
  <body class="font-sans antialiased bg-gray-100">
    <div class="min-h-screen flex">
      {{-- Left side hero --}}
      <div class="hidden lg:flex w-1/2 items-center justify-center bg-primary relative overflow-hidden">
        <div class="absolute inset-0 opacity-20"
             style="background-image: url('{{ asset('images/sports-bg.jpg') }}');
                    background-size: cover;
                    background-position: center;">
        </div>

        <div class="relative z-10 max-w-lg px-8">
          <div class="flex items-center gap-3 mb-6">
            <img src="{{ asset('images/tuk-logo.png') }}" alt="TUK logo" class="h-10 w-10 rounded-full object-cover bg-white">
            <div>
              <h1 class="text-2xl font-bold text-white tracking-wide">TUK Sports Hub</h1>
              <p class="text-sm text-accent1/90">Official sports platform for The Technical University of Kenya.</p>
            </div>
          </div>

          <h2 class="mt-6 text-3xl font-semibold text-white">
            Organise campus sports.  
            Connect coaches, players and fans.
          </h2>

          <p class="mt-4 text-sm text-white/90 leading-relaxed">
            Create fixtures, manage teams, track attendance and share highlights
            all in one place. From football to chess, every game gets a home.
          </p>

          <div class="mt-6 flex flex-wrap gap-3 text-sm text-white/90">
            <span class="inline-flex items-center rounded-full bg-black/20 px-3 py-1 backdrop-blur">
              ⚽ Football, 🏀 Basketball, 🏐 Volleyball
            </span>
            <span class="inline-flex items-center rounded-full bg-black/20 px-3 py-1 backdrop-blur">
              📸 Galleries and match updates
            </span>
          </div>
        </div>
      </div>

      {{-- Right side form --}}
      <div class="flex w-full lg:w-1/2 items-center justify-center px-6 py-10">
        <div class="w-full max-w-md">
          <div class="mb-6 flex items-center gap-3 lg:hidden">
            <img src="{{ asset('images/tuk-logo.png') }}" alt="TUK logo" class="h-10 w-10 rounded-full object-cover bg-white">
            <div>
              <h1 class="text-xl font-bold text-primary tracking-wide">TUK Sports Hub</h1>
              <p class="text-xs text-gray-500">Sign in to access your sports dashboard.</p>
            </div>
          </div>

          <div class="bg-white shadow rounded-lg px-6 py-8">
            {{ $slot }}
          </div>

          <p class="mt-4 text-xs text-gray-500 text-center">
            Built for sports at The Technical University of Kenya.
          </p>
        </div>

      </div>
    </div>
  </body>
</html>
