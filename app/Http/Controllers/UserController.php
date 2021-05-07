<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Charts\ChartTest;
use App\Charts\AdminChart;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index(){
        $teacher = User::select(DB::raw("COUNT(*) as count"))
        ->where('user_type', 2)
        ->pluck('count');
        $student = User::select(DB::raw("COUNT(*) as count"))
        ->where('user_type', 2)
        ->pluck('count');

        $chart_test = new AdminChart;
        $chart_test->labels(['Jan', 'Feb', 'Mar']);
        $chart_test->dataset('Users', 'doughnut', $teacher);

        return view('home')->with(['chart_test' => $chart_test]);
    }


}
