<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Activitylog\Traits\HasActivity;

class User extends Authenticatable
{
    use HasActivity, Notifiable;

    protected static $logAttributes = ['*'];
    protected static $logOnlyDirty = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fname', 'lname', 'email', 'password', 'ussf_grade'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function games()
    {
        return $this->hasMany(Game::class)->orderByDesc('date');
    }

    public function limitGames()
    {
        return $this->hasMany(Game::class)->orderByDesc('date')->limit(10);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class)->orderByDesc('created_at');
    }

    public function mileage()
    {
        return $this->hasMany(Mileage::class)->orderByDesc('date_travel');
    }

    public function gamelocs()
    {
        return $this->hasMany(GameLocation::class);
    }

    public function gametypes()
    {
        return $this->hasMany(GameType::class);
    }
}
