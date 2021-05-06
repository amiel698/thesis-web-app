<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class AuthController extends Controller
{
	public function login()
	{
		return view('login');
	}

    public function register()
    {
        return view('register');
    }


    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|same:confirm_password',
            'user_type' => 'required'
        ]);

        User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => bcrypt(trim($request->password)),
            'user_type' => $request->user_type
        ]);

        return redirect()->route('register')->with('success_msg', 'User successfully added!');
    }








	public function authentication(Request $request)
	{
		$authentication = Auth::attempt($request->only(['email', 'password']));
		if ($authentication) {
			return redirect()->route('home');
		} else {
			return redirect()->route('login')->with('auth_msg', 'Invalid Username and Password!');
		}
	}

    public function authentication_mobile(Request $request)
	{
		$authentication = Auth::attempt($request->only(['email', 'password']));
		if ($authentication) {
			return response('OK');
		} else {
			return response('Invalid Username and Password!');
		}
	}

	public function logout()
	{
		Auth::logout();
		return redirect()->route('login');
	}

	public function api_authentication(Request $request)
	{
		if (Auth::attempt($request->only(['email', 'password']))) {
			Auth::user()->message = 'Success';
			return response()->json(['login' => true, 'user' => Auth::user()]);
		} else {
			return response()->json(['login' => false, 'user'=>['message'=>'Invalid Credentials']]);
		}
	}

	public function api_logout()
	{
		Auth::logout();
		return response()->json(['logout' => true, 'message'=>'Success']);
	}
}
