<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required',
        ]);
        $user = User::where('name', $request->name)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->withErrors(['name' => 'Nama atau password salah.',])->withInput();
        }
        if ($user->role === 'user') {
            return redirect()->route('users.index');
        }
        if ($user->role === 'admin') {
            return redirect()->route('admins.index');
        }
        return back()->withErrors(['name' => 'Role akun tidak dikenali.',]);
    }
}
