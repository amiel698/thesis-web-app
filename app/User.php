<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    public $timestamps = false;

    protected $fillable = [
        'first_name', 'last_name', 'user_name', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
