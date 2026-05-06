<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class LoginPelangganController extends Controller
{

    //menampilkan login
    public function index()
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
            return redirect()->route('laundry');
        } else {
            // return 'gagal'
            return redirect('/')->withErrors('username dan password tidak valid');
        }
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
