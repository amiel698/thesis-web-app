<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Students extends Model
{
    #use SoftDeletes;
    protected $connection = 'pgsql';
    protected $table = 'students';
    protected $guarded = [];

    public function info()
    {
        return $this->hasOne('App\User', 'id', 'student_users_id');
    }

    public function score()
    {
        return $this->hasOne('App\StudentRecords', 'student_id', 'student_users_id');
    }
}
