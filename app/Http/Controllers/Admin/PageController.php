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

        $sre = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($sre)) {
            return redirect('/admin');
        }

        return back()->withErrors(['error' => 'Invalid email or password']);
    }


    public function showDashboard()
    {
        return view('admin.dashboard');
    }
}
