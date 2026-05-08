<?php

namespace App\Http\Controllers\pelanggan;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\Pelanggan;

class LoginPelangganController extends Controller
{

    //menampilkan login
    public function index()
    {
        $tagih = Pelanggan::all();
        return view('pelanggan.login', compact('tagih'));
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

        if (Auth::guard('pelanggan')->attempt($infologin)) {
            return redirect()->route('pelanggan.dashboard');
        } else {
            // return 'gagal'
            return redirect('/')->withErrors('username dan password tidak valid');
        }
    }


    // logout
    public function logout(Request $request)
    {
        Auth::guard('pelanggan')->logout(); // logout user
        $request->session()->invalidate(); // hapus session
        $request->session()->regenerateToken(); // regenerasi token CSRF

        return redirect('/')->with('success', 'Anda telah logout');
    }
}
