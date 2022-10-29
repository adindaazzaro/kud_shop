<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CLogin extends Controller
{
    public function index()
    {
        return view('login');
    }
    public function auth(Request $request)
    {
        // dd($request->all());
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        $remember = false;
        if(isset($request->remember)){
            $remember = true;
        }
        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
 
            return redirect(url('admin/home'));
        }
 
        return redirect('/admin')->with('msg','Email atau Password salah');
    }
    public function logout(Request $request)
    {
        Auth::logout();
 
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/admin');
    }
}
