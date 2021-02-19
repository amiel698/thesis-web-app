<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Students extends Model
{
    protected $casts = [
         'easy_score' => 'array',
         'medium_score'=> 'array',
         'hard_score' => 'array'
    ];
}
