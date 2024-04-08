<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Login
    public function login()
    {
        if (Auth::check()) {
            return redirect('/dashboard');
        }
        return view('auth.login',[
            'title' => 'Login'
        ]);
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'login' => 'required',
            'password' => 'required',
        ]);

        $fieldType = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'driver_license_number';
        $credentials = [
            $fieldType => $request->login,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
        return redirect('/dashboard')->with('error', 'Login gagal');
        }

        return back()->with('loginError', 'Login failed!');
    }

    // Register
    public function register()
    {
        if (Auth::check()) {
            // If authenticated, redirect to the dashboard or any other page
            return redirect('/dashboard');
        }
        return view('auth.register',[
            'title' => 'Register'
        ]);
    }

    public function store(Request $request)
{
    $validatedData = $request->validate([
        'name' => 'required|max:255',
        'driver_license_number' => 'required|numeric|unique:users',
        'phone_number' => 'required|numeric|unique:users',
        'address' => 'required|max:255',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:5|max:255|confirmed'
    ]);

    $validatedData['password'] = Hash::make($validatedData['password']);

    $user = User::create($validatedData);
    Auth::login($user);
    if ( $user) {
        return redirect('/dashboard')->with('success', 'Pendaftaran berhasil');
    }
    return redirect()->back()->with('error', 'Pendaftaran gagal');

}


    // Reset Password
    public function password()
    {
        if (Auth::check()) {
            // If authenticated, redirect to the dashboard or any other page
            return redirect('/dashboard');
        }
        return view('auth.password',[
            'title' => 'Reset Password'
        ]);
    }

    // Logout
        public function logout()
    {
        Auth::logout();
        request()
            ->session()
            ->invalidate();
        request()
            ->session()
            ->regenerateToken();
        return redirect('/login');
    }
}
