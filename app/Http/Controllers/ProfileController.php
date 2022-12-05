<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ProfileController extends BaseController
{
    //

    function indexRegister()
    {
        if (Session::get('user')) return redirect()->route('home');

        return view('register');
    }
    function indexLogin()
    {
        if (Session::get('user')) return redirect()->route('home');

        return view('login');
    }

    function register(Request $req)
    {
        $rules = [
            'fullname' => 'required|string|min:3',
            'email' => 'unique:users,email|email',
            'password' => 'required|string|min:6',
            'confirmPassword' => 'required|same:password'
        ];

        $validator = Validator::make($req->all(), $rules);

        if ($validator->fails()) return back()->withErrors($validator);

        $user = new User();
        $user->username = $req->fullname;
        $user->email = $req->email;
        $user->role = 'customer';
        $user->password = Hash::make($req->password, [
            'rounds' => 12,
        ]);

        $user->save();
        return redirect()->route('login')->with('register_success', 'Registered!');
    }

    function login(Request $req)
    {
        $rules = [
            'email' => 'required|exists:users,email',
            'password' => 'required'
        ];

        $validator = Validator::make($req->all(), $rules);

        if ($validator->fails()) return back()->withErrors($validator);

        $credentials = [
            'email' => $req->email,
            'password' => $req->password
        ];

        if (!Auth::attempt($credentials)) return back()->withErrors('invalid credentials');

        Session::put('user', Auth::user());
        // dd($req->remember);
        if ($req->remember === 'on') {

            Cookie::queue('email', $req->email, 30);
            Cookie::queue('password', $req->password, 30);
        } else {
            Cookie::queue(Cookie::forget('email'));
            Cookie::queue(Cookie::forget('password'));
        }

        return redirect('/home');
    }

    function logout()
    {
        Auth::logout();
        Session::flush();
        return redirect()->route('login');
    }


    
}
