<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Level;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function user()
    {
        $level = Level::all();
        $user = User::with(['level'])->get();
        return view('admin.user.user', compact('user', 'level'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $level = Level::all();
        return view('admin.user.create', compact('level'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'username' => 'required|max:20',
                'password' => 'required|max:50',
                'nama_admin' => 'required|max:50',
                'id_level' => 'required',
            ],
            [
                'username.required' => 'Username wajib diisi',
                'username.max' => 'Username maksimal 20 karakter',
                'password.required' => 'Password wajib diisi',
                'password.max' => 'Password maksimal 50 karakter',
                'nama_admin.required' => 'Nama Admin wajib diisi',
                'id_level.required' => 'Level wajib diisi',
            ]
        );

        User::create([
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'nama_admin' => $request->nama_admin,
            'id_level' => $request->id_level
        ]);
        //tambah data produk
        return redirect()->route('admin.user.user');
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $id)
    {
        $level = Level::all();
        return view('admin.user.edit', compact('id', 'level'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(
            [
                'username' => 'required|max:20',
                'password' => 'nullable|max:50',
                'nama_admin' => 'required|max:50',
                'id_level' => 'required',
            ],
            [
                'username.required' => 'Username wajib diisi',
                'username.max' => 'Username maksimal 20 karakter',
                'password.max' => 'Password maksimal 50 karakter',
                'nama_admin.required' => 'Nama Admin wajib diisi',
                'id_level.required' => 'Level wajib diisi',
                'alamat.required' => 'Alamat wajib diisi',
                'id_tarif.required' => 'Tarif wajib diisi',
            ]
        );
        //ambil produk lama
        $user = User::findOrFail($id);

        //update data produk
        $data = [
            'username' => $request->username,
            'nama_admin' => $request->nama_admin,
            'id_level' => $request->id_level,
        ];
        // password hanya diupdate kalau diisi
        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.user.user');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(User $id)
    {
        $id->delete();
        return redirect()->route('admin.user.user')->with('success', 'Data berhasil dihapus');
    }
}
