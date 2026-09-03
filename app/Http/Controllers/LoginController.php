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
            return redirect()->route('proposals.index');
        }
        if ($user->role === 'Accepter') {
            return redirect()->route('accepters.index');
        }
        if ($user->role === 'Cashier') {
            return redirect()->route('cashiers.index');
        }
        return back()->withErrors(['name' => 'Role akun tidak dikenali.',]);
    }
}
