<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    // public function registerUser(Request $request){
    //     $user = new User();
    //     $user->first_name = $request->first_name;
    //     $user->last_name = $request->last_name;
    //     $user->user_name = $request->user_name;
    //     $user->user_type = 1; //student - 1; teacher - 2
    //     $user->password = md5($request->password);
    //     $user->date_created = new Carbon();
    //     $user->time_created = new Carbon();
    //     $user->save();
    //     return view('home');
    // }

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

    public function index(){
        $users = User::all()->where('user_type', 1);
        return view('home', compact('users'));
    }





    public function login(){
        return view('auth.login');
    }

    public function register(){
        return view('auth.register');
    }


    public function save(Request $request){
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'user_name' => 'required|unique:users',
            'password' => 'required|min:5|max:12',
            'user_type' => 'required',
        ]);

        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->user_name = $request->user_name;
        $user->password = Hash::make($request->password);
        $user->user_type = $request->user_type;
        $user->date_created = new Carbon();
        $user->time_created = new Carbon();
        $query = $user->save();

        if($query){
            return back()->with('Success', 'You have been registered');
        }
        else{
            return back()->with('Fail', 'Something went wrong');
        }
    }

    public function check(Request $request){
        $request->validate([
            'user_name' => 'required',
            'password' => 'required|min:5|max:12'
        ]);

        $user = User::where('user_name', '=', $request->user_name)->first();
        if($user){
            if(Hash::check($request->password, $user->password)){
                $request->session()->put('LoggedUser',$user->id);
                $user->login = new Carbon();
                $user->save();
                return redirect('home');
            }
            else{
                return back()->with('fail', 'Invalid password');
            }
        }
        else{
            return back()->with('fail', 'User does not exist');
        }

    }

    public function home(){
        $data = ['LoggedUserInfo' => User::where('id', '=', session('LoggedUser'))->first()];
        return view('home', $data);
    }

    public function logout(){
        if(session()->has('LoggedUser')){
            session()->pull('LoggedUser');
            return redirect('login');
        }
    }




    public function verifyPassword(Request $request){
        $user = User::where('user_name', '=', $request->user_name)->first();
        if($user){
            if(Hash::check($request->password, $user->password)){

                $user->login = new Carbon();
                $user->save();
                $response = 'OK';
                return response($response);
            }
            else{
                return response('Wrong Password');
            }
        }
        else{
            return response('User Does not Exist');
        }
    }




    // public function verifyPassword(Request $request)
    // {
    //     $method = $request->method();
    //     if($method == 'POST')
    //     {
    //         $user_name = $request->user_name;
    //         $password = md5($request->password);
    //         $users = User::get();
    //         foreach($users as $user){
    //             if($user_name == $user->user_name and $password == $user->password){

    //                 $user->login = new Carbon();
    //                 $user->save();
    //                 $response = 'OK';
    //                 return response($response);
    //             }
    //             else if($user_name == $user->user_name and $password != $user->password){
    //                 return response('Wrong Password');
    //             }
    //             else if($user_name != $user->user_name and $password == $user->password){
    //                 return response('Wrong User ID');
    //             }
    //             else if($user_name != $user->user_name and $password != $user->password){
    //                 return response('Wrong Credentials');
    //             }
    //         }
    //     }
    // }
}
