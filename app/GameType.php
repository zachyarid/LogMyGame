<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class GameType extends Model
{
    use LogsActivity;

    protected $fillable = ['name', 'location', 'assignor', 'hotel', 'travel', 'grade_premium'];

    protected static $logAttributes = ['*'];
}
