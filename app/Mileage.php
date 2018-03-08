<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Mileage extends Model
{
    use LogsActivity, SoftDeletes;

    protected $guarded = ['created_at', 'updated_at', 'id'];
    protected $table = 'mileage';
    protected static $logAttributes = ['*'];
    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function games()
    {
        return $this->hasMany(Game::class);
    }
}
