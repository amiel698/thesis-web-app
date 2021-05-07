<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Charts\ChartTest;
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

        $chart_test = new ChartTest;
        $chart_test->labels(['Jan', 'Feb', 'Mar']);
        $chart_test->dataset('Users', 'doughnut', $teacher->values());

        return view('home', compact('chart_test'));
    }


}
