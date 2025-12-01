<?php

namespace App\Http\Controllers;

use App\Models\Coach;
use App\Models\Event;
use App\Models\EventPlayer;
use App\Models\Player;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        $user = $request->user();

        if (!$user) {
            return redirect()->route('login');
        }

        // Coach dashboard
        if ($user->role === 'coach') {
            $coach = Coach::firstOrCreate(
                ['user_id' => $user->id],
                ['sport' => 'Football', 'bio' => null]
            );

            $upcoming = Event::where('coach_id', $coach->id)
                ->whereIn('status', ['scheduled', 'postponed'])
                ->orderBy('starts_at')
                ->take(6)
                ->get();

            return view('dashboards.coach', compact('upcoming'));
        }

        // Player dashboard
        if ($user->role === 'player') {
            $player = Player::firstOrCreate(
                ['user_id' => $user->id],
                ['sport' => 'Football', 'availability_status' => 'available']
            );

            // Player sees all upcoming events, not only their sport
            $events = Event::whereIn('status', ['scheduled', 'postponed'])
                ->orderBy('starts_at')
                ->take(20)
                ->get();

            $participations = $events->isEmpty()
                ? collect()
                : EventPlayer::where('player_id', $player->id)
                    ->whereIn('event_id', $events->pluck('id'))
                    ->get()
                    ->keyBy('event_id');

            return view('dashboards.player', [
                'player'         => $player,
                'events'         => $events,
                'participations' => $participations,
            ]);
        }

        // Fan dashboard
        if ($user->role === 'fan') {
            $events = Event::whereIn('status', ['scheduled', 'postponed'])
                ->orderBy('starts_at')
                ->take(20)
                ->get();

            $confirmedCounts = $events->isEmpty()
                ? collect()
                : EventPlayer::whereIn('event_id', $events->pluck('id'))
                    ->where('status', 'confirmed')
                    ->selectRaw('event_id, count(*) as confirmed_count')
                    ->groupBy('event_id')
                    ->pluck('confirmed_count', 'event_id');

            return view('dashboards.fan', [
                'events'          => $events,
                'confirmedCounts' => $confirmedCounts,
            ]);
        }

        // Default dashboard for other roles
        return view('dashboard');
    }
}
