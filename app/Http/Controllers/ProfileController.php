<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller {
    public function index() {
        return view('profile.index', [
            'operator' => Auth::user()
        ]);
    }
    public function edit() {
        return view('profile.edit', [
            'operator' => Auth::user()
        ]);
    }
    public function update(Request $request) {
        $operator = Auth::user();
        $validated = $request->validate([
            'fullname' => 'required|regex:/^[a-zA-Z0-9\s]+$/',
            'username' => [
                'required',
                'exclude_if:username,' . $operator->username,
                'unique:operators',
                'regex:/^[a-zA-Z0-9\_]+$/'
            ],
        ]);

        try {
            $operator->updateOrFail($validated);

            return redirect('/me')->with('success', 'Profile updated successfully');
        } catch (\Exception $e) {
            return redirect('/me')->with('error', 'Failed to update profile');
        }
    }
}
