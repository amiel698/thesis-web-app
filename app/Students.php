<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Students extends Model
{
    protected $timestamps = false;
    protected $fillable = [
        'first_name',
        'last_name',
        'student_id',
        'password'
    ];

    protected $hidden = [
        'password'
    ];

    // protected $casts = [
    //      'easy_score' => 'array',
    //      'medium_score'=> 'array',
    //      'hard_score' => 'array'
    // ];
}
