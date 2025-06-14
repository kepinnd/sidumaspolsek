<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    public function index()
    {
        $users = User::whereIn('role', ['kapolsek', 'petugas_spkt', 'masyarakat'])->latest()->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:kapolsek,petugas_spkt,masyarakat'],
            'nik' => $request->role == 'masyarakat' ? ['required', 'string', 'max:16', 'unique:users,nik'] : ['nullable', 'string', 'max:16', 'unique:users,nik'],
            'alamat' => $request->role == 'masyarakat' ? ['required', 'string'] : ['nullable', 'string'],
            'no_telp' => $request->role == 'masyarakat' ? ['required', 'string', 'max:15'] : ['nullable', 'string', 'max:15'],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'nik' => $request->nik,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil ditambahkan.');
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'role' => ['required', 'in:kapolsek,petugas_spkt,masyarakat'],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
            'nik' => $request->role == 'masyarakat' ? ['required', 'string', 'max:16', 'unique:users,nik,' . $user->id] : ['nullable', 'string', 'max:16', 'unique:users,nik,' . $user->id],
            'alamat' => $request->role == 'masyarakat' ? ['required', 'string'] : ['nullable', 'string'],
            'no_telp' => $request->role == 'masyarakat' ? ['required', 'string', 'max:15'] : ['nullable', 'string', 'max:15'],
        ]);

        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'nik' => $request->nik,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
        ];

        if ($request->filled('password')) {
            $userData['password'] = Hash::make($request->password);
        }

        $user->update($userData);

        return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
       
    }
}
