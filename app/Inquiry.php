<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Inquiry extends Model
{
    use LogsActivity;

    protected $guarded = ['created_at', 'updated_at', 'id'];
    protected static $logAttributes = ['*'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
