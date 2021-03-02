<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;


class UserController extends Controller
{
    public function registerUser(Request $request){
        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->user_name = $request->user_name;
        $user->password = $request->password;
        $user->date_created = Carbon::parse($user['date_created'])->format('M d Y');
        $user->time_created = Carbon::parse($user['time_created'])->format('h:i:s');
        $user->save();
        return view('home');
    }
}
