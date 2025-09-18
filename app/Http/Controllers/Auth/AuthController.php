<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
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
      'usernmae' => 'required|string',
      'password' => 'required|string|min:6',
    ]
    );
     if (Auth::attempt($login)) {
    $request->session()->regenerate();
    if (Auth::user()->role == 'admin') {
      return redirect()->route('admin.dashboard');
    } else {
      return redirect()->route('Operator.dashboard')->with('success', 'Login success sebagai Operator');
    }

  }
  return back()->withErrors([
    'usernmae' => 'Username Atau Password Salah',
  ])->onlyInput('usernmae');
  }

  public function logout(Request $request)
  {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('login')->with('success', 'Logout Berhasil');
  }
 
}
