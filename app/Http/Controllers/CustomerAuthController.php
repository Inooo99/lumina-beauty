<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class CustomerAuthController extends Controller
{
    // --- REGISTER ---
    public function showRegister()
    {
        return view('auth.register');
    }

    public function processRegister(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed', // butuh input name="password_confirmation"
            'phone' => 'required',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => 'customer'
        ]);

        return redirect()->route('customer.login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    // --- LOGIN ---
    public function showLogin()
    {
        return view('auth.login-customer');
    }

    public function processLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Cek Role
            if(Auth::user()->role == 'admin'){
                return redirect()->route('admin.products.index');
            }
            
            // Jika Customer, balik ke Home
            return redirect()->route('home');
        }

        return back()->withErrors(['email' => 'Email atau password salah.']);
    }

    // --- LOGOUT ---
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}