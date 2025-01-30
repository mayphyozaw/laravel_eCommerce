<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function showLogin()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $cre = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($cre)) {
            return redirect('/admin')->with('success', 'Welcome Admin');
        }

        return back()->with('error', 'Email and Password are incorrect');
    }

    public function logout()
    {
        auth()->guard('admin')->logout();
        return redirect('/');
    }

    public function showDashboard()
    {
        return view('admin.dashboard');
    }
}
