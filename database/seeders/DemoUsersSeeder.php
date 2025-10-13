<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Coach;
use App\Models\Player;
use App\Models\Fan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DemoUsersSeeder extends Seeder
{
    public function run(): void
    {
        // Admin (no profile table)
        $admin = User::updateOrCreate(
            ['email' => 'admin@tuk.test'],
            ['name' => 'Admin', 'password' => Hash::make('password'), 'role' => 'admin']
        );

        // Coach + profile
        $coachUser = User::updateOrCreate(
            ['email' => 'coach@tuk.test'],
            ['name' => 'Coach One', 'password' => Hash::make('password'), 'role' => 'coach']
        );
        Coach::updateOrCreate(
            ['user_id' => $coachUser->id],
            ['sport' => 'Football', 'bio' => 'Head coach, Football']
        );

        // Player + profile
        $playerUser = User::updateOrCreate(
            ['email' => 'player@tuk.test'],
            ['name' => 'Player One', 'password' => Hash::make('password'), 'role' => 'player']
        );
        Player::updateOrCreate(
            ['user_id' => $playerUser->id],
            ['sport' => 'Football', 'availability_status' => 'available']
        );

        // Fan + profile
        $fanUser = User::updateOrCreate(
            ['email' => 'fan@tuk.test'],
            ['name' => 'Fan One', 'password' => Hash::make('password'), 'role' => 'fan']
        );
        Fan::updateOrCreate(['user_id' => $fanUser->id], []);
    }
}
