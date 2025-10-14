<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
  'coach_id','title','sport_type','starts_at','ends_at','location','description','cover_image',
  'status','postponed_to','postpone_reason'
];
protected $casts = [
  'starts_at' => 'datetime',
  'ends_at'   => 'datetime',
  'postponed_to' => 'datetime',
];

    // each event belongs to one coach
    public function coach()
    {
        return $this->belongsTo(Coach::class);
    }

    // players who joined this event
    public function players()
    {
        return $this->belongsToMany(Player::class, 'event_players')
                    ->withPivot('status')
                    ->withTimestamps();
    }

    // fans attending this event
    public function fans()
    {
        return $this->belongsToMany(Fan::class, 'event_fans')
                    ->withPivot('status')
                    ->withTimestamps();
    }
}
