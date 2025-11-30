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

            $eventsQuery = Event::whereIn('status', ['scheduled', 'postponed']);

            if (!empty($player->sport)) {
                $eventsQuery->where('sport_type', $player->sport);
            }

            $events = $eventsQuery
                ->orderBy('starts_at')
                ->take(12)
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

        // Default dashboard for fan / admin etc.
        return view('dashboard');
    }
}
