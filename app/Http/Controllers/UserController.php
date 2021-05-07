<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use app\Charts\ChartTest;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index(){
        $teacher = User::where('user_type', 2)->get()->count();
        $student = User::where('user_type', 1)->get()->count();

        $chart = new ChartTest;
        $chart->labels(['Jan', 'Feb', 'Mar']);
        $chart->dataset('Users by trimester', 'doughnut', [$teacher->values(),$student->values()]);

        return view('home',compact('chart'));
    }


}
