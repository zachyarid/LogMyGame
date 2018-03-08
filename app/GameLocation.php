<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class GameLocation extends Model
{
    use LogsActivity;

    protected $fillable = ['location'];

    protected static $logAttributes = ['*'];
}
