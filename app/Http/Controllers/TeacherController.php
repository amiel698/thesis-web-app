<?php

namespace App\Http\Controllers;

use App\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function getTeachers(){
        return response()->json(Teacher::get());
    }
}
