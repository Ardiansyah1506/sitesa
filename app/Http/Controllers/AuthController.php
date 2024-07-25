<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();

            if ($user->role == 1) {
                
                return redirect()->route('admin.index')->with('success', 'Berhasil login');

            } elseif ($user->role == 2) {

                return redirect()->route('prodi.index')->with('success', 'Berhasil login');

            } elseif ($user->role == 3) {

                return redirect()->route('dosbim.index')->with('success', 'Berhasil login');

            } elseif ($user->role == 4) {

                return redirect()->route('mhs.index')->with('success', 'Berhasil login');

            }
        }   

        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
