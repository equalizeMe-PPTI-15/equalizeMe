<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function checkUser(Request $request){
        $credentials = $request->validate([
            'nik' => 'required|max:16|min:16',
            'password' => 'required|min:5|max:255',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            $user = Auth::user();

            return redirect()->intended('/home', $user);
        }
        
        return back()->with('loginError', 'wrong input nik or password!');

        // Session::flash('status', 'failed');
        // Session::flash('message', 'wrong input nik or password');

        // return redirect('/login');

    }

    public function login() {
        return view("/login");
    }

}
