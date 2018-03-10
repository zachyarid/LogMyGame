<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Support\Facades\DB;

class Game extends Model
{
    use LogsActivity, SoftDeletes;

    protected $guarded = ['created_at', 'updated_at', 'id'];
    protected static $logAttributes = ['*'];
    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeOwn($query)
    {
        return $query->where(['user_id' => \Auth::id()]);
    }

    public function gameloc()
    {
        return $this->hasOne(GameLocation::class, 'id', 'location_id');
    }

    public function gametype()
    {
        return $this->hasOne(GameType::class, 'id', 'type');
    }

    public function age()
    {
        return $this->hasOne(Age::class, 'id', 'age_id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function mileage()
    {
        return $this->belongsTo(Mileage::class);
    }

    /* Returns whether or not a game has any payments */
    public function hasPayments()
    {
        return !DB::table('payments')->where('game_id', $this->id)->get()->isEmpty();
    }
}