<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Students;
use Illuminate\Support\Facades\Auth;
use Laravel\Ui\Presets\React;

class TeacherController extends Controller
{
	public function index(Request $request)
	{
		$search = '';
		$query = User::whereUserType(2);
		if($request->has('search') && $request->search != '') {
			$search = trim($request->search);
			$query = $query->where(function($query) use ($search) {
				$query->where('first_name', 'LIKE', "%$search%")->orWhere('last_name', 'LIKE', "%$search%");
			});
		}
		$rows = $query->orderBy('last_name', 'ASC')->paginate(50);
		$data = compact('rows', 'search');
		return view('teacher.index', $data);
	}

	public function create()
	{
		$route = route('teacher.store');
		$button_text = 'Save';
		$first_name = old('first_name');
		$last_name = old('last_name');
		$email = old('email');
		$password = old('password');
		$confirm_password = old('confirm_password');

		$data = compact('route', 'button_text', 'first_name', 'last_name', 'email', 'password', 'confirm_password');
		return view('teacher.form', $data);
	}

	public function store(Request $request)
	{
		$request->validate([
        	'first_name' => 'required',
        	'last_name' => 'required',
        	'email' => 'required|email|unique:users',
        	'password' => 'required|same:confirm_password'
		]);

		User::create([
			'first_name' => $request->first_name,
			'last_name' => $request->last_name,
			'email' => $request->email,
			'password' => bcrypt(trim($request->password)),
			'user_type' => 2,
		]);

		return redirect()->route('teacher.create')->with('success_msg', 'Teacher successfully added!');
	}

	public function edit($id)
	{
		$row = User::find($id);
		if (is_null($row)) {
			abort(404);
		}

		$route = route('teacher.update', $id);
		$button_text = 'Update';
		$first_name = $row->first_name;
		$last_name = $row->last_name;
		$email = $row->email;
		$password = '';
		$confirm_password = '';

		$data = compact('route', 'button_text', 'first_name', 'last_name', 'email', 'password', 'confirm_password');
		return view('teacher.form', $data);
	}

	public function update($id, Request $request)
	{
		$input = [
        	'first_name' => 'required',
        	'last_name' => 'required',
        	'email' => 'required|email'
		];

		$data = [
			'first_name' => $request->first_name,
			'last_name' => $request->last_name,
			'email' => $request->email
		];

		if ($request->password != '' || $request->confirm_password != '') {
			$input['password'] = 'same:confirm_password';
			$data['password'] = bcrypt(trim($request->password));
		}

		$request->validate($input);

		User::where('id', $id)->update($data);

		return redirect()->route('teacher.edit', $id)->with('success_msg', 'Teacher successfully updated!');
	}

	public function show($id, Request $request)
	{
		$search = '';
		$teacher = User::find($id);
		if (is_null($teacher)) {
			abort(404);
		}
		#dd(Auth::user()->id);
		$query = Students::with(['info'])->whereTeacherUsersId($teacher->id);

		/*if (Auth::user()->user_type != 0) {
			$query = $query->whereTeacherUsersId(Auth::user()->id);
		} else {
			$query = $query->whereTeacherUsersId($teacher->id);
		}*/

		if($request->has('search') && $request->search != '') {
			$search = trim($request->search);
			$query = $query->where(function($query) use ($search) {
				$query->where('first_name', 'LIKE', "%$search%")->orWhere('last_name', 'LIKE', "%$search%");
			});
		}


		$rows = $query->orderBy('created_at', 'ASC')->paginate(50);



		$data = compact('rows', 'teacher', 'search');
        view()->share('students', 'data');
		return view('teacher.show', $data);
	}

	public function delete($id)
	{

		$data = Students::where('student_users_id', $id)->pluck('teacher_users_id')->first();


        //  Students::where('student_users_id', $id)->delete();


		Students::where('student_users_id', $id)->delete();

		return redirect()->route('teacher.show', $data)->with('success_msg', 'Student successfully removed!');
	}


	public function create_student()
	{
		$route = route('teacher.store_student');
		$button_text = 'Save';
		$teacher_user_id = old('teacher_user_id');
		$student_user_id = old('student_user_id');
		$student_name = old('student_name');
		$user_id = Auth::user()->id;

		$teachers = User::whereUserType(2)->orderBy('last_name', 'ASC')->get();
		#$students = User::whereUserType(1)->orderBy('last_name', 'ASC')->get();

		// $students = User::whereUserType(1)->orderBy('last_name', 'ASC')->get();
		$students = User::whereUserType(1)->whereNotIn('id', function($query){
			$query->select('student_users_id')->from('students');
		})->orderBy('last_name', 'ASC')->get();

		$data = compact('route', 'button_text', 'teacher_user_id', 'student_user_id', 'student_name', 'teachers', 'students');
		return view('teacher.student-form', $data);
	}

	public function store_student(Request $request)
	{


		$request->validate([
        	'teacher_user_id' => 'required',
        	'student_user_id' => 'required|unique:students,student_users_id'
		]);
		#$count = Students::where('student_users_id', $request->student_user_id)->where('teacher_users_id', Auth::user()->id)->count();
		$count = Students::where('student_users_id', $request->student_user_id)->count();

		if ($count >  0) {
			return back()->withErrors(['Student already taken!']);
		}


        $data = $request->student_user_id;
        foreach($data as $datas){
		 Students::create([
			'student_users_id' => $datas,
			'teacher_users_id' => $request->teacher_user_id
		]);
    }


		return redirect()->route('teacher.create_student')->with('success_msg', 'Student successfully added!');
	}
}
