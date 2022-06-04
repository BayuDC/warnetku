<?php

namespace App\Http\Controllers;

use App\Http\Requests\OperatorUpdateRequest;
use App\Http\Requests\ProfileUpdatePasswordRequest;
use Exception;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile.index', [
            'operator' => Auth::user()
        ]);
    }

    public function edit()
    {
        return view('profile.edit', [
            'operator' => Auth::user()
        ]);
    }

    public function update(OperatorUpdateRequest $request)
    {
        $operator = Auth::user();
        $validated = $request->validated();

        try {
            $operator->updateOrFail($validated);

            return redirect()->route('me.show')->with('success', 'Profile updated successfully');
        } catch (Exception $e) {
            return redirect()->route('me.show')->with('error', 'Failed to update profile');
        }
    }

    public function editPassword()
    {
        return view('profile.edit-password', [
            'operator' => Auth::user()
        ]);
    }

    public function updatePassword(ProfileUpdatePasswordRequest $request)
    {
        $validated = $request->validated();

        try {
            Auth::user()->updateOrFail([
                'password' => bcrypt($validated['password'])
            ]);

            return redirect()->route('me.show')->with('success', 'Password updated successfully');
        } catch (Exception $e) {
            return redirect()->route('me.show')->with('error', 'Failed to update password');
        }
    }
}
