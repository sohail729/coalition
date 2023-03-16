<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{

    public function showLoginForm(){
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect()->intended('/');
        }
        return back()->with('alert-danger', 'Incorrect username or password!');

    }

    public function showRegistrationForm(){
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $user = new User;
        $user->name =  $request->name;
        $user->email =  $request->email;
        $user->password =  bcrypt($request->password);
        $user->save();
        return redirect('login')->with('alert-success', 'Great! You have Successfully registered');

    }

    public function logout() {
        Session::flush();
        Auth::logout();
        return redirect('login');
    }

}
