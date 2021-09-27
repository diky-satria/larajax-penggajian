<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function login()
    {
        request()->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ],[
            'email.required' => 'Email harus di isi',
            'email.email' => 'Email tidak valid',
            'password.required' => 'Password harus di isi',
            'password.min' => 'Password minimal 6 karakter'
        ]);

        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            if(Auth::user()->role == 'admin'){
                return redirect('dashboard');
            }else{
                return redirect('user');
            }
        }

        return redirect('/')->with('message', 'Email dan Password tidak sesuai');
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/')->with('logout', 'Anda telah keluar');
    }
}
