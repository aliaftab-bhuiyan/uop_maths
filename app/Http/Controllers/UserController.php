<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\View\View;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except(['logout']);
    }
    public function signup(): View
    {
        return \view('auth.signup');
    }

    public function register(Request $request): RedirectResponse
    {
        $username = User::generateUniqueUsername();
        $request->validate([
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|between:6,255|confirmed'
        ]);
        User::create([
            'username'=>Str::upper($username),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);
        return redirect()->route('login')
            ->with('success', 'You have successfully registered.');
    }
    public function signin(): View
    {
        return \view('auth.signin');
    }
    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(Auth::attempt($credentials))
        {
            $request->session()->regenerate();
            return redirect()->route('feed')
                ->with('success', 'You have successfully logged in!');
        }

        return back()
            ->with('error', 'Something went wrong! Given email or password is invalid.')->onlyInput('email');

    }
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')
            ->with('You have logged out successfully!');
    }
}
