<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            $credentials = $request->only('email', 'password');

            if (Auth::attempt($credentials)) {
                return redirect()->route('admin.dashboard');
            }

            return redirect()->route('admin.login')->with('error', 'Invalid credentials');
        }

        return view('admin.login');
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function logout()
    {
        auth()->logout();
        return redirect('/admin/login');
    }
}
