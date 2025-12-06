<?php

namespace App\Http\Controllers\Admin;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $user = User::all();
        return view('admin.user', compact('user'));
    }

    // Create User
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|unique:users,username|max:100',
            'email' => 'required|email|max:255|unique:users,email',
            'address' => 'required|string|max:255',
            'password' => 'required|string|min:6',
            'role' => 'required|in:admin,anggota'
        ]);

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'address' => $request->address,
            'password_hash' => $request->password, // Laravel auto-hash via cast
            'role' => $request->role
        ]);

        return response()->json(['success' => true, 'user' => $user]);
    }

    // Get User by ID (Edit)
    public function show($id)
    {
        $user = User::where('user_id', $id)->firstOrFail();
        return response()->json($user);
    }

    // Update User (HANYA ROLE)
    public function update(Request $request, $id)
    {
        $user = User::where('user_id', $id)->firstOrFail();

        $validatedData = $request->validate([
            'role' => 'required|in:admin,anggota'
        ]);

        $user->update([
            'role' => $validatedData['role']
        ]);

        return response()->json(['success' => true]);
    }

    // Delete User
    public function destroy($id)
    {
        $user = User::where('user_id', $id)->firstOrFail();
        $user->delete();

        return response()->json(['success' => true]);
    }
}