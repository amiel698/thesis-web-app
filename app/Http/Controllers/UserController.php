<?php

namespace App\Http\Controllers;

use App\Charts\AdminChart;
use Illuminate\Http\Request;
use App\User;
use App\Charts\ChartTest;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index(){
        $teacher = User::where('user_type', 2)->get()->count();
        $student = User::where('user_type', 1)->get()->count();

        $chart_test = new AdminChart();
        $chart_test->labels(['Jan', 'Feb', 'Mar']);
        $chart_test->dataset('Users', 'doughnut', [$teacher->values(), $student->values()]);

        return view('home')->with(['chart_test' => $chart_test]);
    }


}
