<nav x-data="{ open: false }" class="border-b border-gray-200 bg-primary text-white">
    <!-- Primary Navigation Menu -->
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 justify-between">
            <!-- Left -->
            <div class="flex">
                <!-- Logo -->
                <div class="flex shrink-0 items-center">
                    <a href="{{ url('/') }}" class="text-xl font-bold hover:text-accent1">
                        TUK Sports Hub
                    </a>
                </div>

                <!-- Nav Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center border-b-2 border-transparent px-1 pt-1 text-sm font-medium hover:text-accent1">
                        Dashboard
                    </a>
                    @auth
                        @if(auth()->user()->role === 'coach')
                            <a href="{{ route('coach.events.index') }}" class="inline-flex items-center border-b-2 border-transparent px-1 pt-1 text-sm font-medium hover:text-accent1">
                                My Events
                            </a>
                        @endif
                    @endauth
                </div>
            </div>

            <!-- Right -->
            <div class="hidden sm:ms-6 sm:flex sm:items-center">
                @auth
                    <span class="text-sm me-4">{{ auth()->user()->name }}</span>
                @endauth
                <!-- Settings Dropdown -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center rounded-md bg-accent2 px-3 py-2 text-sm font-medium text-white hover:bg-accent1 focus:outline-none">
                            Menu
                            <svg class="ms-2 h-4 w-4" viewBox="0 0 20 20" fill="currentColor"><path d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.25a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z"/></svg>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <!-- Profile -->
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Logout -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center rounded-md p-2 hover:bg-accent1 focus:outline-none">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"/>
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-primary">
        <div class="space-y-1 pb-3 pt-2">
            <x-responsive-nav-link :href="route('dashboard')" class="text-white hover:text-accent1">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            @auth
                @if(auth()->user()->role === 'coach')
                    <x-responsive-nav-link :href="route('coach.events.index')" class="text-white hover:text-accent1">
                        {{ __('My Events') }}
                    </x-responsive-nav-link>
                @endif
            @endauth
        </div>
    </div>
</nav>
