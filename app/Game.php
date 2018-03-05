<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Game extends Model
{
    protected $guarded = ['created_at', 'updated_at', 'id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function gameloc()
    {
        return $this->hasOne(GameLocation::class, 'id', 'location_id');
    }

    public function gametype()
    {
        return $this->hasOne(GameType::class, 'id', 'type');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    /* Returns whether or not a game has any payments */
    public function hasPayments()
    {
        return !DB::table('payments')->where('game_id', $this->id)->get()->isEmpty();
    }
}