<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Age extends Model
{
    use LogsActivity;

    protected $guarded = ['created_at', 'updated_at', 'id'];

    protected static $logAttributes = ['*'];

    public function game()
    {
        return $this->belongsTo(Game::class);
    }
}
