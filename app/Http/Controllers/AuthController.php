<?php

namespace App\Http\Controllers;

use App\Http\Requests\OperatorLoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function index()
    {
        return view('login');
    }

    public function login(OperatorLoginRequest $request)
    {
        $validated = $request->validated();

        if (!Auth::attempt($validated))
            return back()->with('error', 'Login Failed')->withInput();

        $request->session()->regenerate();

        return redirect()->route('home');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
