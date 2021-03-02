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
        $user->date_created = new Carbon();
        $user->time_created = new Carbon();
        $user->save();
        return view('home');
    }

    public function loginUser(Request $request){
        $user_name = $request->user_name;
        $password = $request->password;
        $users = User::get();
        foreach($users as $user){
            if($user_name == $user->user_name and $password == $user->password){
                $user->login = new Carbon();
                $user->save();
                return view('home');
            }
            else{
                return view('welcome');
            }
        }
    }
}
