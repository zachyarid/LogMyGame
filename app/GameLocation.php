<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class GameLocation extends Model
{
    use LogsActivity;

    protected $fillable = ['location', 'user_id'];
    protected static $logAttributes = ['*'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeDefault($query)
    {
        return $query->orWhere(['is_default' => 1]);
    }

    public function scopeOwn($query)
    {
        return $query->orWhere(['user_id' => \Auth::id()]);
    }
}
