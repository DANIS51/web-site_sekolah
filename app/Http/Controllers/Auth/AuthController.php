<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends \App\Http\Controllers\Controller
{
    //
  public function showLoginForm()
  {
    if (Auth::check()) {
        return redirect()->route('dashboard');
      
    }
    return view('auth.login');
  }

  public function login(Request $request)
  {
    $login = $request->validate([
      'username' => 'required|string',
      'password' => 'required|string|min:6',
    ]
    );
     if (Auth::attempt($login)) {
    $request->session()->regenerate();
    if (Auth::user()->role == 'admin') {
      return redirect()->route('dashboard')->with('success', 'Login success sebagai Admin');
    } else {
      return redirect()->route('dashboard')->with('success', 'Login success sebagai Operator');
    }

  }
  return back()->withErrors([
    'username' => 'username Atau Password Salah',
  ])->onlyInput('username');
  }

  public function logout(Request $request)
  {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('public.index')->with('success', 'Logout Berhasil');
  }
 
}
