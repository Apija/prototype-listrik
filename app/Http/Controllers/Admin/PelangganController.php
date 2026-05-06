<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tarif;
use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function pelanggan()
    {
        $pelanggan = Tarif::all();
        $pelanggan = Pelanggan::with(['tarif'])->get();
        $query = Pelanggan::with(['tarif']);

        return view('admin.pelanggan.pelanggan', compact('pelanggan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tarif = Tarif::all();
        return view('admin.pelanggan.create', compact('tarif'));
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
                'nomor_kwh' => 'required|max:20',
                'nama_pelanggan' => 'required|max:50',
                'alamat' => 'required|max:100',
                'id_tarif' => 'required',
            ],
            [
                'username.required' => 'Username wajib diisi',
                'username.max' => 'Username maksimal 20 karakter',
                'password.required' => 'Password wajib diisi',
                'password.max' => 'Password maksimal 50 karakter',
                'nomor_kwh.required' => 'Nomor KWH wajib diisi',
                'nama_pelanggan.required' => 'Nama Pelanggan wajib diisi',
                'alamat.required' => 'Alamat wajib diisi',
                'id_tarif.required' => 'Tarif wajib diisi',
            ]
        );

        Pelanggan::create([
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'nomor_kwh' => $request->nomor_kwh,
            'nama_pelanggan' => $request->nama_pelanggan,
            'alamat' => $request->alamat,
            'id_tarif' => $request->id_tarif
        ]);
        //tambah data produk
        return redirect()->route('admin.pelanggan.pelanggan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pelanggan $id)
    {
        $tarif = Tarif::all();
        return view('admin.pelanggan.edit', compact('id', 'tarif'));
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
                'nomor_kwh' => 'required|max:20',
                'nama_pelanggan' => 'required|max:50',
                'alamat' => 'required|max:100',
                'id_tarif' => 'required',
            ],
            [
                'username.required' => 'Username wajib diisi',
                'username.max' => 'Username maksimal 20 karakter',
                'password.max' => 'Password maksimal 50 karakter',
                'nomor_kwh.required' => 'Nomor KWH wajib diisi',
                'nama_pelanggan.required' => 'Nama Pelanggan wajib diisi',
                'alamat.required' => 'Alamat wajib diisi',
                'id_tarif.required' => 'Tarif wajib diisi',
            ]
        );
        //ambil produk lama
        $pelanggan = Pelanggan::findOrFail($id);

        //update data produk
        $pelanggan->update([
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'nomor_kwh' => $request->nomor_kwh,
            'nama_pelanggan' => $request->nama_pelanggan,
            'alamat' => $request->alamat,
            'id_tarif' => $request->id_tarif
        ]);
        return redirect()->route('admin.pelanggan.pelanggan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Pelanggan $id)
    {
        $id->delete();
        return redirect()->route('admin.pelanggan.pelanggan')->with('success', 'Data berhasil dihapus');
    }
}
