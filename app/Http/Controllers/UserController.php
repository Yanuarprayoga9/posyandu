<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->latest()->paginate(10);
        return view('users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::pluck('name', 'name'); // ['admin'=>'admin', ...]
        return view('users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'  => ['required','string','max:255'],
            'email' => ['required','email','max:255','unique:users,email'],
            'password' => ['required','min:6','confirmed'],
            'role'  => ['required', Rule::in(Role::pluck('name')->toArray())],
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email'=> $data['email'],
            'password' => bcrypt($data['password']),
        ]);
        $user->syncRoles([$data['role']]);

        return redirect()->route('users.index')->with('success','User berhasil dibuat');
    }

    public function edit(User $user)
    {
        $roles = Role::pluck('name','name');
        return view('users.edit', compact('user','roles'));
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name'  => ['required','string','max:255'],
            'email' => ['required','email','max:255', Rule::unique('users','email')->ignore($user->id)],
            'password' => ['nullable','min:6','confirmed'],
            'role'  => ['required', Rule::in(Role::pluck('name')->toArray())],
        ]);

        $user->name  = $data['name'];
        $user->email = $data['email'];
        if (!empty($data['password'])) {
            $user->password = bcrypt($data['password']);
        }
        $user->save();
        $user->syncRoles([$data['role']]);

        return redirect()->route('users.index')->with('success','User berhasil diupdate');
    }

    public function destroy(User $user)
    {
        // Hindari hapus diri sendiri (opsional)
        if (auth()->id() === $user->id) {
            return back()->with('error','Tidak boleh menghapus akun sendiri');
        }
        $user->delete();
        return redirect()->route('users.index')->with('success','User dihapus');
    }
}
