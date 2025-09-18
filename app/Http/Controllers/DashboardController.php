<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $user = auth()->user();

        if($user->role == 'admin') {
            return view('admin.dashboard', compact('user'));
        } else {
            return view('operator.dashboard', compact('user'));
        }
    }

    public function profile(){
        $user = Auth::user();
        return view('profile', compact('user'));
    }

    public function editProfile(Request $request){
        $user = Auth::user();
        $validasi = $request->validate([
            'username' => 'required|string|max:255|unique:users,username,'.$user->id_user . ',id_user',
            'comfirmasi_password' => 'nullable|string|min:6',
            'password' => 'required_with|string|min:6|confirmed',
        ]);

        $user->username = $validasi['username'];
    }


}
