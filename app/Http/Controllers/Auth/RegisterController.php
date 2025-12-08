<?php

namespace App\Http\Controllers\Auth;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string|unique:users,username',
            'password' => 'required|string|min:6|confirmed',
            'email' => 'required|email|max:255',
            'address' => 'required|string|max:255'
        ]);

        User::create([
            'username' => $validated['username'],
            'password_hash' => Hash::make($validated['password']),
            'email' => $validated['email'],
            'address' => $validated['address'],
            'role' => 'anggota', // default server-side
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil, silakan login.');
    }
}
