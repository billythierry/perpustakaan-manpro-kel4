<?php

namespace App\Http\Controllers\Auth;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string|unique:user,username',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|in:admin,anggota'
        ]);

        User::create([
            'username' => $validated['username'],
            'password_hash' => $validated['password'],
            'role' => $validated['role'] // Sementara dulu
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil, silakan login.');
    }
}
