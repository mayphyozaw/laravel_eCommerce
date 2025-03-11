<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function postLogin(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'Email Not found');
        }
        if (!Hash::check($request->password, $user->password)) {
            return redirect()->back()->with('error', 'Wrong Password');
        }

        auth()->login($user);
        return redirect('/')->with('ok', 'Welcome ' . $user->name);
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function postRegister(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'image' => 'required|mimes:png,jpg,webp',
            'phone' => 'required',
            'address' => 'required',



        ]);

        // check already email

        $findUser = User::where('email', request()->email)->first();
        if ($findUser) {
            return redirect()->back()->with('error', 'Email already exit');
        }

        //file upload
        $file = request()->file('image');
        $file_name = uniqid() . $file->getClientOriginalName();
        $file->move(public_path('/images/'), $file_name);
        $user = User::create([
            'image' => $file_name,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'address' => $request->address,

        ]);
        auth()->login($user);

        return redirect('/')->with('ok', 'Welcome ' . $user->name);
    }

    public function logout()
    {
        auth()->logout();
        return redirect('/login');
    }
}
