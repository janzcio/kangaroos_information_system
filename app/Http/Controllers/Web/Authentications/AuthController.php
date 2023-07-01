<?php

namespace App\Http\Controllers\Web\Authentications;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::user()) {
            return redirect()->intended('/kangaroos');
        }
        return view('pages.authentication.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {

            $user = Auth::user();
            $token = $user->createToken('auth_token')->plainTextToken;
            $user->token = $token;

            // set session for current user
            Session::put('user', $user);

            // Authentication passed...
            $request->session()->regenerate();
            return redirect()->intended('/kangaroos');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout()
    {
        Auth::logout();
        Session::flush();
        return redirect('/login');
    }
}
