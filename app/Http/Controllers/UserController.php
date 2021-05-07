<?php

namespace App\Http\Controllers;

use App\Charts\AdminChart;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index(){
        $teacher = User::where('user_type', 2)->get(DB::raw('COUNT(*) as count'))->pluck('count');
        $student = User::where('user_type', 1)->get(DB::raw('COUNT(*) as count'))->pluck('count');

        $chart_test = new AdminChart();
        $chart_test->labels(['Jan', 'Feb', 'Mar']);
        $chart_test->dataset('Users', 'doughnut', [$teacher->values(), $student->values()]);

        return view('home', ['chart_test' => $chart_test]);
    }


}
