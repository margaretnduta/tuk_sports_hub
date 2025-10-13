<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coach extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'sport', 'bio'];

    // link back to the user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // one coach can create many events
    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
