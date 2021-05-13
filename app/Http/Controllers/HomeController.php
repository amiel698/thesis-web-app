<?php

namespace App\Http\Controllers;

use App\Charts\AdminChart;
use App\User;
use App\Students;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

        public function index(){


            $teacher = User::where('user_type', 2)->get(DB::raw('COUNT(*) as count'))->pluck('count');
            $student = User::where('user_type', 1)->get(DB::raw('COUNT(*) as count'))->pluck('count');

            $chart_test = new AdminChart();
            $chart_test->minimalist(true);
            $chart_test->displayLegend(true);
            $chart_test->labels(['Teacher', 'Student']);
            $chart_test->dataset('Users','pie', [$teacher->values(), $student->values()])->color(['red', 'blue'])->backgroundcolor(['red', 'blue']);

            return view('home', ['chart_test' => $chart_test]);
        }

        public function show()
        {
            $search = '';
            $id = Auth::user()->id;
            $teacher = User::find($id);
            if (is_null($teacher)) {
                abort(404);
            }
            $query = Students::with(['info'])->whereTeacherUsersId($teacher->id);
            $stud_id = Students::with(['info'])->whereTeacherUsersId($teacher->id)->pluck('student_users_id');
            dd($stud_id);
            $rows = $query->orderBy('created_at', 'ASC')->paginate(50);
            
           




            return view('home', compact('rows'));
        }


}
