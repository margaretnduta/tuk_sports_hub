<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TUK Sports Hub</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="antialiased bg-secondary/30">
    <div class="min-h-screen">
        <header class="bg-primary text-white">
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8 flex items-center justify-between">
                <h1 class="text-2xl font-bold">TUK Sports Hub</h1>
                <div class="space-x-3">
                    @auth
                        <a href="{{ route('dashboard') }}" class="rounded bg-accent2 px-4 py-2 hover:bg-accent1">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="rounded bg-accent2 px-4 py-2 hover:bg-accent1">Login</a>
                        <a href="{{ route('register') }}" class="rounded bg-white px-4 py-2 text-primary hover:bg-secondary">Register</a>
                    @endauth
                </div>
            </div>
        </header>

        <main class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
            <div class="grid gap-8 md:grid-cols-2">
                <div>
                    <h2 class="text-3xl font-extrabold text-primary">Play. Coach. Cheer.</h2>
                    <p class="mt-4 text-gray-700">
                        A central hub for TUK sports — events, team updates, galleries, and reviews. Join as a Player or Fan.
                    </p>
                    <div class="mt-6 flex gap-3">
                        <a href="{{ route('register') }}" class="rounded bg-accent2 px-5 py-3 font-semibold text-white hover:bg-accent1">
                            Join Now
                        </a>
                        <a href="{{ route('login') }}" class="rounded bg-white px-5 py-3 font-semibold text-primary ring-1 ring-primary hover:bg-secondary">
                            I already have an account
                        </a>
                    </div>
                </div>

                <div class="rounded-2xl bg-white p-6 shadow">
                    <h3 class="text-xl font-semibold text-primary">Upcoming Features</h3>
                    <ul class="mt-4 list-disc pl-6 text-gray-700">
                        <li>Coach-created events with RSVP & player availability</li>
                        <li>Fan galleries and reactions</li>
                        <li>Blogs and reviews for past events</li>
                    </ul>
                    <div class="mt-6">
                        <a href="{{ route('login') }}" class="text-accent2 hover:underline">Sign in to view your dashboard →</a>
                    </div>
                </div>
            </div>
        </main>

        <footer class="mt-12 border-t border-secondary/50 py-6 text-center text-sm text-gray-600">
            © {{ date('Y') }} TUK Sports Hub
        </footer>
    </div>
</body>
</html>
