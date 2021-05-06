<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use SoftDeletes;

class StudentRecords extends Model
{
    #use SoftDeletes;
    protected $connection = 'pgsql';
    protected $table = 'student_records';
    protected $guarded = [];
}
