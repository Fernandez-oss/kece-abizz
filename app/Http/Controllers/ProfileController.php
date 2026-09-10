<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display Initial Profile Setup (/name)
     * Redirects to profile.show if profile name is already set up.
     */
    public function createName()
    {
        $user = Auth::user();

        if ($user && !empty($user->name)) {
            return redirect()->route('profile.show');
        }

        return view('Name');
    }

    /**
     * Store Initial Profile Data (Name & Image)
     */
    public function storeName(Request $request)
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user = Auth::user();
        $user->name = $request->name;

        if ($request->hasFile('profile_image')) {
            $imageName = time() . '.' . $request->profile_image->extension();
            $request->profile_image->move(public_path('profile_images'), $imageName);
            $user->profile_image = $imageName;
        }

        $user->save();

        return redirect()->route('home')->with('success', 'Profile setup successfully completed!');
    }

    /**
     * Display Profile Page Based on User Role
     */
    public function show()
    {
        $user = Auth::user();

        $role = strtolower($user->role ?? '');

        if ($role === 'admin' || $role === 'administrator') {
            return view('profile.admin', compact('user'));
        }

        return view('profile.user', compact('user'));
    }

    /**
     * Update Profile Information (Name, Email & Profile Image)
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name'          => 'required|string|max:255',
            'email'         => 'required|email|max:255|unique:users,email,' . $user->id,
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        // Process profile image upload
        if ($request->hasFile('profile_image')) {
            // Delete old image if exists
            if ($user->profile_image && file_exists(public_path('profile_images/' . $user->profile_image))) {
                unlink(public_path('profile_images/' . $user->profile_image));
            }

            $imageName = time() . '.' . $request->profile_image->extension();
            $request->profile_image->move(public_path('profile_images'), $imageName);
            $user->profile_image = $imageName;
        }

        $user->save();

        return back()->with('success', 'Profile updated successfully!');
    }

    /**
     * Update Account Password
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password'         => 'required|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password does not match!']);
        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with('success', 'Password updated successfully!');
    }
}