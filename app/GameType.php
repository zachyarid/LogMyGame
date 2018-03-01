<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GameType extends Model
{
    protected $fillable = ['name', 'location', 'assignor', 'hotel', 'travel', 'grade_premium'];
}
