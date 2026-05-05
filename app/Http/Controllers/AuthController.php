<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    //menampilkan login
    public function login()
    {
        return view('login');
    }
    
    //verifikasi use and password
    public function autheticate(Request $request)
    {
        Session::flash('username', $request->username);

        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ], [
            'username.required' => 'username wajib disini',
            'password.required' => 'password wajib disini',
        ]);

        $infologin = [
            'username' => $request->username,
            'password' => $request->password,
        ];

        if (Auth::attempt($infologin)) {

            // Ambil user yang sedang login
            $user = Auth::user();

            // Arahkan sesuai role
            if ($user->nama_level === 'admin') {
                return redirect()->route('dashboard'); // admin dashboard
            }

            if ($user->nama_level === 'petugas') {
                return redirect()->route('petugas.dashboard'); // petugas dashboard
            }

            // Jika role tidak dikenali
            Auth::logout();
            return redirect('/login')->withErrors('Role tidak dikenal.');
        }

        return redirect('/login')->withErrors('username dan password tidak valid');
    }

    // logout
    public function logout(Request $request)
    {
        Auth::logout(); // logout user
        $request->session()->invalidate(); // hapus session
        $request->session()->regenerateToken(); // regenerasi token CSRF

        return redirect('/login')->with('success', 'Anda telah logout');
    }
}
