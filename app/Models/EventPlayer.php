<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventPlayer extends Model
{
    use HasFactory;

    protected $table = 'event_players';

    protected $fillable = [
        'event_id',
        'player_id',
        'status',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function player()
    {
        return $this->belongsTo(Player::class);
    }
}
