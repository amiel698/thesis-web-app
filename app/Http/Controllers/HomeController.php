<?php

namespace App\Http\Controllers;

use App\Charts\AdminChart;
use App\User;
use Illuminate\Http\Request;
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
            // $chart_test->minimalist(true);
            $chart_test->displayLegend(true);
            $chart_test->labels('Teacher');
            $chart_test->labels('Students');
            $chart_test->dataset('Users', 'bar', $teacher->values())->color(['red'])->backgroundcolor(['red']);
            $chart_test->dataset('Users', 'bar', $teacher->values())->color(['blue'])->backgroundcolor(['blue']);

            return view('home', ['chart_test' => $chart_test]);
        }
}
