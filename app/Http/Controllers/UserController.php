<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;


class UserController extends Controller
{
    public function registerUser(Request $request){
        $user = User::create($request->all());
        $user->save();

    }
}
