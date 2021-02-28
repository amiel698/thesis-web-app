<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;


class UserController extends Controller
{
    public function registerUser(Request $request){
        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->user_name = $request->user_name;
        $user->password = $request->password;
        $user->save();
        return view('home');
    }
}
