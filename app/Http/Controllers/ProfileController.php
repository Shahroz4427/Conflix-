<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('auth.profile', ['user' => auth()->user()]);
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',

            // Only validate password fields if a new password is being set
            'old_password' => [
                'nullable',
                function ($attribute, $value, $fail) use ($user, $request) {
                    if ($request->filled('password') && !Hash::check($value, $user->password)) {
                        $fail('Your password was not updated, since the provided old password does not match.');
                    }
                }
            ],
            'password' => [
                'nullable', 'min:6', 'confirmed', 'different:old_password'
            ],
        ]);

        // Update name and email
        $user->name = $validated['name'];
        $user->email = $validated['email'];

        // If password fields are filled, update password
        if ($request->filled('password')) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        $request->session()->flash('status', 'Profile updated successfully.');

        return back();
    }
}
