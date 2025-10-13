<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fan extends Model
{
    use HasFactory;

    protected $fillable = ['user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // many-to-many: fans can attend many events
    public function events()
    {
        return $this->belongsToMany(Event::class, 'event_fans')
                    ->withPivot('status')
                    ->withTimestamps();
    }
}
