<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\StudentRecords;
use Illuminate\Support\Facades\DB;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;
use App\Charts\ChartTest;
use App\Charts\AdminChart;
use App\Students;
use Illuminate\Support\Arr;


class StudentController extends Controller
{
	public function index(Request $request)
	{
		$search = '';
		$query = User::whereUserType(1);
		if($request->has('search') && $request->search != '') {
			$search = trim($request->search);
			$query = $query->where(function($query) use ($search) {
				$query->where('first_name', 'LIKE', "%$search%")->orWhere('last_name', 'LIKE', "%$search%");
			});
		}
		$rows = $query->orderBy('created_at', 'ASC')->paginate(50);
		#dd($rows);
		$data = compact('rows', 'search');
		return view('student.index', $data);
	}

	public function show($id)
	{
		$search = '';
		$student = User::find($id);

		if (is_null($student)) {
			abort(404);
		}

		$records = StudentRecords::whereStudentId($id)->orderBy('created_at', 'DESC')->paginate(100);

		$data = compact('student', 'records', 'search');
		return view('student.show', $data);
	}

	public function create()
	{
		$route = route('student.store');
		$button_text = 'Save';
		$first_name = old('first_name');
		$last_name = old('last_name');
		$email = old('email');
		$password = old('password');
		$confirm_password = old('confirm_password');

		$data = compact('route', 'button_text', 'first_name', 'last_name', 'email', 'password', 'confirm_password');
		return view('student.form', $data);
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
			'user_type' => 1,
		]);

		return redirect()->route('student.create')->with('success_msg', 'Student successfully added!');
	}

	public function edit($id)
	{
		$row = User::find($id);
		if (is_null($row)) {
			abort(404);
		}

		$route = route('student.update', $id);
		$button_text = 'Update';
		$first_name = $row->first_name;
		$last_name = $row->last_name;
		$email = $row->email;
		$password = '';
		$confirm_password = '';

		$data = compact('route', 'button_text', 'first_name', 'last_name', 'email', 'password', 'confirm_password');
		return view('student.form', $data);
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

		return redirect()->route('student.edit', $id)->with('success_msg', 'Student successfully updated!');
	}

	public function api_scores($id)
	{
		$data = $this->scores($id);
		return response()->json($data);
	}

	public function scores($id)
	{
		$data = [
			'categories' => [],
			'easy' => [
				'name' => 'easy',
				'data' => []
			],
			'medium' => [
				'name' => 'medium',
				'data' => []
			],
			'hard' => [
				'name' => 'hard',
				'data' => []
			]
		];
		$rows = StudentRecords::whereStudentId($id)->orderBy('difficulty', 'ASC')->orderBy('created_at','ASC')->get();
		$easy_counter = 0;
		$medium_counter = 0;
		$hard_counter = 0;
		foreach ($rows as $row) {

			if ($row->difficulty == 'easy') {
				$data['easy']['data'][$easy_counter] = $row->score;
				$easy_counter++;
			}elseif ($row->difficulty == 'medium') {
				$data['medium']['data'][$medium_counter] = $row->score;
				$medium_counter++;
			}elseif ($row->difficulty == 'hard') {
				$data['hard']['data'][$hard_counter] = $row->score;
				$hard_counter++;
			}
		}



		$categories = StudentRecords::whereStudentId($id)->groupBy('month_char')->orderBy('month_char', 'ASC')->get([DB::raw('to_char(created_at, \'YYYY-MM\') month_char')]);

		$n = 0;
		foreach ($categories as $category) {
			$data['categories'][$n] = $category->month_char;
			$n++;
		}


        return $data;
	}

    public function charts($id){
        $data = $this->scores($id);
        return view('student.chart', compact('data'));
    }

    public function charts_test($id){

        $score = StudentRecords::whereStudentId($id)->orderBy('created_at','ASC')->groupBy('score','created_at','difficulty')->having('difficulty', '=', 'easy')->pluck('score');
        $months = StudentRecords::whereStudentId($id)->orderBy('created_at','ASC')->groupBy('score','created_at','difficulty')->having('difficulty', '=', 'easy')->get(DB::raw('to_char(created_at, \'MON-DD-YYYY\') as month'))->pluck('month');

        $score_medium = StudentRecords::whereStudentId($id)->orderBy('created_at','ASC')->groupBy('score','created_at','difficulty')->having('difficulty', '=', 'medium')->pluck('score');
        $months_medium = StudentRecords::whereStudentId($id)->orderBy('created_at','ASC')->groupBy('score','created_at','difficulty')->having('difficulty', '=', 'medium')->get(DB::raw('to_char(created_at, \'MON-DD-YYYY\') as month'))->pluck('month');

        $score_hard = StudentRecords::whereStudentId($id)->orderBy('created_at','ASC')->groupBy('score','created_at','difficulty')->having('difficulty', '=', 'hard')->pluck('score');
        $months_hard = StudentRecords::whereStudentId($id)->orderBy('created_at','ASC')->groupBy('score','created_at','difficulty')->having('difficulty', '=', 'hard')->get(DB::raw('to_char(created_at, \'MON-DD-YYYY\') as month'))->pluck('month');

        $student = User::findOrFail($id);


        //Easy
        $chart = new ChartTest;
        $chart->labels($months->values());
        $chart->dataset('Easy', 'line', $score->values())->color('red');



        //Medium
        $chart_medium = new ChartTest;
        $chart_medium->labels($months_medium->values());
        $chart_medium->dataset('Medium', 'line', $score_medium->values())->color('blue');

		//Hard
		$chart_hard = new ChartTest;
		$chart_hard->labels($months_hard->values());
		$chart_hard->dataset('Hard', 'line', $score_hard->values())->color('green');



        return view('student.chart', compact('chart','chart_medium','chart_hard','student'));
    }

    public function piechart(){
        $teacher = User::where('user_type', 2)->get()->count();
        $student = User::where('user_type', 1)->get()->count();

        $chart_test = new AdminChart;
        $chart_test->dataset('Users', 'doughnut', [$teacher->values(),$student->values()]);

        return view('home', compact('chart_test'));
    }


}
