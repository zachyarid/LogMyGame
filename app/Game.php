<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $guarded = ['created_at', 'updated_at', 'id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}