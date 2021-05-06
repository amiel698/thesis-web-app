<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Word extends Model
{
    use SoftDeletes;
    protected $connection = 'pgsql';
    protected $table = 'words';
    protected $guarded = [];
}
