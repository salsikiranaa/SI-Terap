<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function registerView() {
        return view('auth.register');
    }

    public function register(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'name.required' => 'name is required',
            'name.string' => 'invalid data type of name',
            'name.max' => 'name is too long',
            'email.required' => 'email is required',
            'email.string' => 'invalid data type of email',
            'email.email' => 'invalid email format',
            'email.max' => 'email is too long',
            'email.unique' => 'email is already taken',
            'password.required' => 'password is required',
            'password.string' => 'invalid data type of password',
            'password.min' => 'number of password minimum characters is 8',
            'password.confirmed' => 'unconfirmed password',
        ]);

        $cred = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];

        $user = User::create($cred);

        if (!$user) return back()->withErrors('Failed to register');
        $attempt = Auth::attempt(['email' => $request->email, 'password' => $request->password]);
        if (!$attempt) return redirect()->route('login')->with('success', 'Registration successful');
        return redirect()->route('home')->with('success', 'Registration successful');
    }

    public function loginView() {
        $previous_url = session('_previous')['url'];
        return view('auth.login', [
            'previous_url' => $previous_url,
        ]);
    }

    public function login(Request $request) {
        $request->validate([
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
        ], [
            'email.required' => 'email is required',
            'email.string' => 'invalid data type of email',
            'email.email' => 'invalid email format',
            'email.max' => 'email is too long',
            'password.required' => 'password is required',
            'password.string' => 'invalid data type of password',
            'password.min' => 'number of password minimum characters is 8',
        ]);

        $user = User::select('password')->where('email', $request->email)->first();
        if (!$user) return back()->withErrors('user cannot found');
        if (!Hash::check($request->password, $user->password)) return back()->withErrors('invalid password');
        $attempt = Auth::attempt(['email' => $request->email, 'password' => $request->password]);
        if (!$attempt) return back()->withErrors('invalid email or password');

        if ($request->previous_url) return redirect($request->previous_url)->with('success', 'login successful');
        if (Auth::user()->role_id == 1) return redirect()->route('manage.dashboard')->with('success', 'login successful');
        return redirect()->route('home')->with('success', 'login successful');
    }

    public function logout() {
        Auth::logout();
        $previous_url = session('_previous')['url'];
        if ($previous_url) return redirect($previous_url);
        return redirect()->route('home')->with('success', 'logout successful');
    }
}
