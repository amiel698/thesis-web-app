<?php

namespace App\Http\Controllers;

use App\Students;
use App\Teacher;
use Illuminate\Http\Request;
use Symfony\Component\VarDumper\Cloner\Stub;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Students::get(['first_name', 'last_name', 'student_id']);
        return response()->json(['students'=>$students]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $students = Students::create($request->all());
        return response()->json($students);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $students = Students::find($id);
        return response()->json(['students'=>$students]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Teacher $students)
    {
        $students->update($request->all);
        return response()->json($students);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Students $students)
    {
        $students->delete();
        return response()->json("deleted");
    }

    public function verifyPassword(Request $request)
    {
        $method = $request->method();
        if($method == 'POST')
        {
            $student_id = $request->student_id;
            $password = $request->password;
            $students = Students::get();
            foreach($students as $student){
                if($student_id == $student->student_id and $password == $student->password){

                    $response = 'OK';
                    return response($response);
                }
                else if($student_id == $student->student_id and $password != $student->password){
                    return response('Wrong Password');
                }
                else if($student_id != $student->student_id and $password == $student->password){
                    return response('Wrong Student ID');
                }
                else if($student_id != $student->student_id and $password != $student->password){
                    return response('Wrong Credentials');
                }
            }
        }
    }
}
