<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('event_players')) {
            Schema::create('event_players', function (Blueprint $table) {
                $table->id();
                $table->foreignId('event_id')->constrained()->onDelete('cascade');
                $table->foreignId('player_id')->constrained()->onDelete('cascade');
                $table->string('status')->default('pending'); // pending / confirmed / declined
                $table->timestamps();
            });
        } else {
            Schema::table('event_players', function (Blueprint $table) {
                if (!Schema::hasColumn('event_players', 'event_id')) {
                    $table->foreignId('event_id')->constrained()->onDelete('cascade');
                }
                if (!Schema::hasColumn('event_players', 'player_id')) {
                    $table->foreignId('player_id')->constrained()->onDelete('cascade');
                }
                if (!Schema::hasColumn('event_players', 'status')) {
                    $table->string('status')->default('pending');
                }
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('event_players');
    }
};
