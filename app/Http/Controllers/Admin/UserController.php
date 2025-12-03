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

    //Create User
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|unique:user,username|max:100',
            'email' => 'required|email|max:255',
            'address' => 'required|string|max:255',
            'password_hash' => 'required|string|max:255',
            'role' => 'required|in:admin,anggota'
        ]);

        User::create([
            'username' => $request->username,
            'password_hash' => $request->password_hash,
            'role' => $request->role
        ]);

        return redirect()->route('admin.user.index')->with('success', 'User created successfully');
    }

    //Update User
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Validasi menggunakan 'sometimes'
        // Artinya: Jika input dikirim, validasi aturannya. Jika tidak dikirim, abaikan.
        $validatedData = $request->validate([
            'username' => [
                'sometimes', 
                'string', 
                'max:100',
                // Cek unik ke tabel 'user' kolom 'username', tapi abaikan ID user ini sendiri
                Rule::unique('user', 'username')->ignore($user->user_id, 'user_id') 
            ],
            'email' => 'sometimes|email|max:255',
            'address' => 'sometimes|string|max:255',
            'password_hash' => 'sometimes|string|max:255',
            'role'          => 'sometimes|in:admin,anggota'
        ]);

        // Logika Password:
        // Hapus password_hash dari array data jika user tidak mengirim password baru (atau kosong)
        if (!$request->filled('password_hash')) {
            unset($validatedData['password_hash']);
        }

        // Update hanya field yang ada di $validatedData
        // Jika field tidak dikirim di form, nilai lama di database tidak akan berubah.
        $user->update($validatedData);

        return redirect()->route('admin.user.index')->with('success', 'User updated successfully');
    }

    //Delete User
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.user.index')->with('success', 'User deleted successfully');
    }
}
