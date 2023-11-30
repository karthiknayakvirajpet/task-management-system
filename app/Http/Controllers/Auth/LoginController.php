<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /************************************************************************
    *Login Form
    *************************************************************************/
    public function loginForm()
    {
        //If user is already logged in then redirect to home
        if (Auth::check()) {
            return redirect('/index-task');
        }
        return view('auth.login');
    }

    /************************************************************************
    *Login function
    *************************************************************************/
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) 
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        //login credentials
        $credentials = $request->only('email', 'password');

        //authentication logic
        if (Auth::attempt($credentials))
        {
            $user = Auth::user();
            return redirect()->intended('/index-task');
        }

        return redirect()->back()->withInput()->withErrors(['login' => 'Invalid credentials.']);
    }

    /************************************************************************
    *Logout function
    *************************************************************************/
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
