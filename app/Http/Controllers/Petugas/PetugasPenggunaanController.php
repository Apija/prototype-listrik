<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Penggunaan;
use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PetugasPenggunaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function penggunaan()
    {
        $pelanggan = Pelanggan::all();
        $penggunaan = Penggunaan::with(['pelanggan'])->get();
        $query = Penggunaan::with(['pelanggan']);

        return view('petugas.penggunaan.penggunaan', compact('penggunaan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pelanggan = Pelanggan::all();
        return view('petugas.penggunaan.create', compact('pelanggan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'id_pelanggan' => 'required',
                'bulan' => 'required|max:50',
                'tahun' => 'required|integer',
                'meter_awal' => 'required|numeric',
                'meter_akhir' => 'required|numeric',
            ],
            [
                'id_pelanggan.required' => 'Pelanggan wajib diisi',
                'bulan.required' => 'Bulan wajib diisi',
                'bulan.max' => 'Bulan maksimal 50 karakter',
                'tahun.required' => 'Tahun wajib diisi',
                'tahun.integer' => 'Tahun harus berupa angka',
                'meter_awal.required' => 'Meter Awal wajib diisi',
                'meter_awal.numeric' => 'Meter Awal harus berupa angka',
                'meter_akhir.required' => 'Meter Akhir wajib diisi',
                'meter_akhir.numeric' => 'Meter Akhir harus berupa angka',
            ]
        );

        Penggunaan::create([
            'id_pelanggan' => $request->id_pelanggan,
            'bulan' => $request->bulan,
            'tahun' => $request->tahun,
            'meter_awal' => $request->meter_awal,
            'meter_akhir' => $request->meter_akhir
        ]);
        //tambah data produk
        return redirect()->route('petugas.penggunaan.penggunaan');
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
    public function edit(Penggunaan $id)
    {
        $pelanggan = Pelanggan::all();
        return view('petugas.penggunaan.edit', compact('id', 'pelanggan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(
            [
                'id_pelanggan' => 'required',
                'bulan' => 'required|max:50',
                'tahun' => 'required|integer',
                'meter_awal' => 'required|numeric',
                'meter_akhir' => 'required|numeric',
            ],
            [
                'id_pelanggan.required' => 'Pelanggan wajib diisi',
                'bulan.required' => 'Bulan wajib diisi',
                'bulan.max' => 'Bulan maksimal 50 karakter',
                'tahun.required' => 'Tahun wajib diisi',
                'tahun.integer' => 'Tahun harus berupa angka',
                'meter_awal.required' => 'Meter Awal wajib diisi',
                'meter_awal.numeric' => 'Meter Awal harus berupa angka',
                'meter_akhir.required' => 'Meter Akhir wajib diisi',
                'meter_akhir.numeric' => 'Meter Akhir harus berupa angka',
            ]
        );
        //ambil produk lama
        $penggunaan = Penggunaan::findOrFail($id);

        //update data produk
        $penggunaan->update([
            'id_pelanggan' => $request->id_pelanggan,
            'bulan' => $request->bulan,
            'tahun' => $request->tahun,
            'meter_awal' => $request->meter_awal,
            'meter_akhir' => $request->meter_akhir
        ]);
        return redirect()->route('petugas.penggunaan.penggunaan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Penggunaan $id)
    {
        $id->delete();
        return redirect()->route('petugas.penggunaan.penggunaan')->with('success', 'Data berhasil dihapus');
    }
}
