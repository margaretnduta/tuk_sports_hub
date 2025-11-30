<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>TUK Sports Hub</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
  </head>
  <body class="antialiased bg-gray-100">
    <div class="min-h-screen flex flex-col">

      {{-- Top bar --}}
      <header class="bg-primary text-white">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 flex h-16 items-center justify-between">
          <div class="flex items-center gap-2">
            <img src="{{ asset('images/tuk-logo.png') }}" alt="TUK logo" class="h-8 w-8 rounded-full object-cover bg-white">
            <span class="text-lg font-bold tracking-wide">TUK Sports Hub</span>
          </div>

          <div class="flex items-center gap-3 text-sm">
            @auth
              <a href="{{ route('dashboard') }}" class="hover:text-accent1">Go to dashboard</a>
            @else
              <a href="{{ route('login') }}" class="hover:text-accent1">Log in</a>
              <a href="{{ route('register') }}"
                 class="rounded bg-accent2 px-3 py-1 text-white hover:bg-accent1">
                Get started
              </a>
            @endauth
          </div>
        </div>
      </header>

      <main class="flex-1">

        {{-- Hero --}}
        <section class="bg-gradient-to-br from-primary via-primary to-accent2 text-white">
          <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-12 lg:py-20 grid gap-10 lg:grid-cols-2 items-center">
            <div>
              <p class="text-xs uppercase tracking-[0.2em] text-accent1 mb-3">The Technical University of Kenya</p>
              <h1 class="text-3xl lg:text-4xl font-extrabold leading-tight">
                One digital home for all TUK sports.
              </h1>
              <p class="mt-4 text-sm lg:text-base text-white/90">
                View fixtures, confirm participation, follow your favourite teams and
                relive moments through match galleries, all in one place.
              </p>

              <div class="mt-6 flex flex-wrap gap-3">
                <a href="{{ route('register') }}"
                   class="rounded bg-accent2 px-5 py-2 text-sm font-semibold text-white hover:bg-accent1">
                  Sign up as player or fan
                </a>
                <a href="{{ route('login') }}"
                   class="rounded border border-white/60 px-5 py-2 text-sm font-semibold text-white hover:bg-white hover:text-primary">
                  Already registered, log in
                </a>
              </div>

              <div class="mt-6 flex flex-wrap gap-3 text-xs text-white/90">
                <span class="inline-flex items-center rounded-full bg-black/20 px-3 py-1">
                  Live fixtures and event updates
                </span>
                <span class="inline-flex items-center rounded-full bg-black/20 px-3 py-1">
                  Player availability and fan attendance
                </span>
                <span class="inline-flex items-center rounded-full bg-black/20 px-3 py-1">
                  Match galleries and reviews
                </span>
              </div>
            </div>

            <div class="relative">
              <div class="rounded-2xl bg-white/10 backdrop-blur shadow-xl p-4">
                <img src="{{ asset('images/sports-hero-card.jpg') }}" alt="Students playing sports"
                     class="w-full h-64 object-cover rounded-xl">
              </div>
              <div class="absolute -bottom-6 -right-4 bg-white text-primary rounded-xl shadow px-4 py-3 text-xs">
                <div class="font-semibold text-sm">Today on TUK Sports Hub</div>
                <div class="mt-1">
                  Fixtures, postponed matches and fresh photos in one place.
                </div>
              </div>
            </div>
          </div>
        </section>

        {{-- Upcoming events from coaches --}}
        <section class="py-10 bg-gray-100">
          <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between mb-4">
              <h2 class="text-xl font-semibold text-primary">Upcoming events</h2>
              <p class="text-xs text-gray-500">
                Events are created by verified TUK coaches.
              </p>
            </div>

            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
              @forelse($events as $event)
                <div class="rounded-lg bg-white shadow border">
                  @if($event->cover_image)
                    <img src="{{ asset('storage/'.$event->cover_image) }}"
                         alt="Event cover image"
                         class="w-full h-40 object-cover rounded-t-lg">
                  @endif

                  @php
                    $isPostponed = $event->status === 'postponed';
                    $displayDate = $isPostponed && $event->postponed_to
                        ? $event->postponed_to
                        : $event->starts_at;
                  @endphp

                  <div class="p-4">
                    <div class="flex items-start justify-between gap-2">
                      <div>
                        <h3 class="text-base font-semibold text-primary">
                          {{ $event->title }}
                        </h3>
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
                        $desc = strlen($event->description) > 100
                            ? substr($event->description, 0, 100).'...'
                            : $event->description;
                      @endphp
                      <p class="mt-2 text-xs text-gray-700">
                        {{ $desc }}
                      </p>
                    @endif
                  </div>
                </div>
              @empty
                <p class="text-gray-600 text-sm">
                  No upcoming events have been posted yet. Check back soon.
                </p>
              @endforelse
            </div>
          </div>
        </section>

        {{-- Info section --}}
        <section class="py-10 bg-gray-100 border-t border-gray-200">
          <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 grid gap-8 md:grid-cols-3">
            <div>
              <h3 class="text-sm font-semibold text-primary mb-2">For coaches</h3>
              <p class="text-sm text-gray-700">
                Create fixtures, update match details and see who is available. No more scattered lists in different chats.
              </p>
            </div>
            <div>
              <h3 class="text-sm font-semibold text-primary mb-2">For players</h3>
              <p class="text-sm text-gray-700">
                Confirm your participation, view your game schedule and stay updated on last minute changes.
              </p>
            </div>
            <div>
              <h3 class="text-sm font-semibold text-primary mb-2">For fans</h3>
              <p class="text-sm text-gray-700">
                Follow events, RSVP for games and enjoy photo galleries from past matches.
              </p>
            </div>
          </div>
        </section>
      </main>

      <footer class="py-4 text-center text-xs text-gray-500">
        © {{ date('Y') }} TUK Sports Hub. All rights reserved.
      </footer>
    </div>
  </body>
</html>
