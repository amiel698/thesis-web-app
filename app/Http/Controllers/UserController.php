<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function registerUser(Request $request){
        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->user_name = $request->user_name;
        $user->user_type = 1; //student - 1; teacher - 2
        $user->password = md5($request->password);
        $user->date_created = new Carbon();
        $user->time_created = new Carbon();
        $user->save();
        return view('home');
    }

    // public function loginUser(Request $request){
    //     $user_name = $request->user_name;
    //     $password = md5($request->password);
    //     $users = User::get();
    //     foreach($users as $user){
    //         if($user_name == $user->user_name and $password == $user->password){
    //             $user->login = new Carbon();
    //             $user->save();
    //             return view('home');
    //         }
    //     }
    // }

    public function authenticate(Request $request){
        $credentials = $request->only('user_name', 'password');

        if(Auth::attempt($credentials)){
            $user = User::get('login');
            $user->login = new Carbon();
            return redirect()->intended('home');
        }
    }

    public function verifyPassword(Request $request)
    {
        $method = $request->method();
        if($method == 'POST')
        {
            $user_name = $request->user_name;
            $password = md5($request->password);
            $users = User::get();
            foreach($users as $user){
                if($user_name == $user->user_name and $password == $user->password){

                    $user->login = new Carbon();
                    $user->save();
                    $response = 'OK';
                    return response($response);
                }
                else if($user_name == $user->user_name and $password != $user->password){
                    return response('Wrong Password');
                }
                else if($user_name != $user->user_name and $password == $user->password){
                    return response('Wrong User ID');
                }
                else if($user_name != $user->user_name and $password != $user->password){
                    return response('Wrong Credentials');
                }
            }
        }
    }
}
