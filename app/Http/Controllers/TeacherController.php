<?php

namespace App\Http\Controllers;

use App\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function getTeachers(){
        return response()->json(Teacher::get());
    }

    public function getTeachersbyID($id){
        return response()->json(Teacher::find($id));
    }

    public function addTeacher(Request $request){
        $teacher = Teacher::create($request->all());
        return response()->json($teacher);
    }


}
