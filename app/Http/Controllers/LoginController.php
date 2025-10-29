<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function index()
    {
        return view('login');
    }

    public function process(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'remember_me' => 'boolean'
        ]);
        if(Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')], $request->boolean('remember_me'))) {
            return redirect('/');
        } else {
            return back()->withInput()->withErrors([
                'email' => 'Invalid credentials'
            ]);
        }
    }

}
