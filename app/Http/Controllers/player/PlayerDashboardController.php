<?php

namespace App\Http\Controllers\Player;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventPlayer;
use App\Models\Player;
use Illuminate\Http\Request;

class PlayerDashboardController extends Controller
{
    public function updateAvailability(Request $request, Event $event)
    {
        $user = $request->user();
        abort_unless($user && $user->role === 'player', 403);

        $player = Player::firstOrCreate(
            ['user_id' => $user->id],
            ['sport' => 'Football', 'availability_status' => 'available']
        );

        $data = $request->validate([
            'status' => ['required', 'in:confirmed,declined'],
        ]);

        EventPlayer::updateOrCreate(
            ['event_id' => $event->id, 'player_id' => $player->id],
            ['status'   => $data['status']]
        );

        return back()->with('success', 'Your availability has been updated.');
    }

    public function profile(Request $request)
    {
        $user = $request->user();
        abort_unless($user && $user->role === 'player', 403);

        $player = Player::firstOrCreate(
            ['user_id' => $user->id],
            ['sport' => 'Football', 'availability_status' => 'available']
        );

        return view('player.profile', compact('player'));
    }

    public function updateProfile(Request $request)
    {
        $user = $request->user();
        abort_unless($user && $user->role === 'player', 403);

        $player = Player::firstOrCreate(
            ['user_id' => $user->id],
            ['sport' => 'Football', 'availability_status' => 'available']
        );

        $data = $request->validate([
            'sport'               => ['nullable', 'string', 'max:100'],
            'availability_status' => ['required', 'in:available,injured,busy,unknown'],
        ]);

        $player->update($data);

        return redirect()->route('player.profile')->with('success', 'Profile updated.');
    }
}
