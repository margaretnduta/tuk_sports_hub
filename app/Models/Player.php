<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'sport',
        'availability_status',
        'achievements',
        'avatar_url'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // many-to-many: players can join many events
    public function events()
    {
        return $this->belongsToMany(Event::class, 'event_players')
                    ->withPivot('status')
                    ->withTimestamps();
    }
}
