<nav x-data="{ open: false }" class="border-b border-gray-200 bg-primary text-white">
  <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="flex h-16 items-center justify-between">

      {{-- Left: Logo + Brand --}}
      <div class="flex items-center">
        <a href="{{ url('/') }}" class="flex items-center gap-2">
          {{-- Logo image, put your file at public/images/tuk-logo.png --}}
          <img src="{{ asset('images/tuk-logo.png') }}" alt="TUK logo" class="h-8 w-8 rounded-full object-cover">
          <span class="text-lg font-bold tracking-wide">TUK Sports Hub</span>
        </a>
      </div>

      {{-- Right: Account icon + Menu dropdown (desktop) --}}
      <div class="hidden sm:flex items-center gap-4">

        {{-- Account icon goes to account info --}}
        <a href="{{ route('profile.edit') }}" class="inline-flex items-center justify-center rounded-full border border-white/30 p-2 hover:bg-white/10">
          <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                  d="M12 12a4 4 0 100-8 4 4 0 000 8z" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                  d="M4 20a8 8 0 0116 0" />
          </svg>
        </a>

        {{-- Plain Menu dropdown, not a big button --}}
        <x-dropdown align="right" width="48">
          <x-slot name="trigger">
            <button class="inline-flex items-center text-sm font-medium hover:text-accent1 focus:outline-none">
              <span>Menu</span>
              <svg class="ms-1 h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                      d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.25a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z"
                      clip-rule="evenodd" />
              </svg>
            </button>
          </x-slot>

          <x-slot name="content">
            {{-- Common links --}}
            <x-dropdown-link :href="route('dashboard')">
              Dashboard
            </x-dropdown-link>

            @auth
              @if(auth()->user()->role === 'coach')
                <x-dropdown-link :href="route('coach.events.index')">
                  My Events
                </x-dropdown-link>
                <x-dropdown-link :href="route('coach.events.create')">
                  Create Event
                </x-dropdown-link>
                <x-dropdown-link :href="route('coach.profile.edit')">
                  Coach Profile
                </x-dropdown-link>
              @endif
            @endauth

            <x-dropdown-link :href="route('profile.edit')">
              Account Settings
            </x-dropdown-link>

            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <x-dropdown-link :href="route('logout')"
                               onclick="event.preventDefault(); this.closest('form').submit();">
                Log Out
              </x-dropdown-link>
            </form>
          </x-slot>
        </x-dropdown>
      </div>

      {{-- Mobile hamburger --}}
      <div class="flex sm:hidden">
        <button @click="open = ! open"
                class="inline-flex items-center justify-center rounded-md p-2 hover:bg-accent1 focus:outline-none">
          <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
            <path :class="{ 'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                  stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M4 6h16M4 12h16M4 18h16" />
            <path :class="{ 'hidden': ! open, 'inline-flex': open }" class="hidden"
                  stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>
    </div>
  </div>

  {{-- Mobile dropdown --}}
  <div :class="{ 'block': open, 'hidden': ! open }" class="hidden sm:hidden bg-primary text-white">
    <div class="space-y-1 pb-3 pt-2 border-t border-white/10">
      <x-responsive-nav-link :href="route('dashboard')" class="text-white hover:text-accent1">
        Dashboard
      </x-responsive-nav-link>

      @auth
        @if(auth()->user()->role === 'coach')
          <x-responsive-nav-link :href="route('coach.events.index')" class="text-white hover:text-accent1">
            My Events
          </x-responsive-nav-link>
          <x-responsive-nav-link :href="route('coach.events.create')" class="text-white hover:text-accent1">
            Create Event
          </x-responsive-nav-link>
          <x-responsive-nav-link :href="route('coach.profile.edit')" class="text-white hover:text-accent1">
            Coach Profile
          </x-responsive-nav-link>
        @endif
      @endauth

      <x-responsive-nav-link :href="route('profile.edit')" class="text-white hover:text-accent1">
        Account Settings
      </x-responsive-nav-link>

      <form method="POST" action="{{ route('logout') }}" class="border-t border-white/10 mt-2 pt-2">
        @csrf
        <x-responsive-nav-link :href="route('logout')"
                               onclick="event.preventDefault(); this.closest('form').submit();"
                               class="text-white hover:text-accent1">
          Log Out
        </x-responsive-nav-link>
      </form>
    </div>
  </div>
</nav>
