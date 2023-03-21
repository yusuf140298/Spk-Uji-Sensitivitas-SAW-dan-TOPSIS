<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index(){
		return view('LoginPage');
	}

	public function login(){
        $ambil = request()->validate([
            'nip' => 'required',
            'password' => 'required',
        ]);
        if(Auth::attempt($ambil)){
            return redirect()->intended('/');
        }else{
            return back()->with('fail','Maaf, Kami Tidak Menumukan Akun anda');
        }
	}

	public function logout(Request $request)
	{
		Auth::logout();
		$request->session()->invalidate();
		$request->session()->regenerateToken();
    
		return redirect('/');
	}
}
