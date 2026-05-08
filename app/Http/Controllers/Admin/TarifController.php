<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Tarif;
use Illuminate\Http\Request;

class TarifController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function tarif()
    {
        $tarif = Tarif::all();
        return view('admin.tarif.tarif', compact('tarif'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.tarif.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'daya' => 'required|max:20',
                'tarif_per_kwh' => 'required|max:50',
            ],
            [
                'daya.required' => 'Daya wajib diisi',
                'daya.max' => 'Daya maksimal 20 karakter',
                'tarif_per_kwh.required' => 'Tarif Per KWH wajib diisi',
                'tarif_per_kwh.max' => 'Tarif maksimal 50 karakter',
            ]
        );
        //tambah data produk
        Tarif::create([
            'daya' => $request->daya,
            'tarif_per_kwh' => $request->tarif_per_kwh,
        ]);
        return redirect()->route('admin.tarif.tarif');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tarif $id)
    {
        return view('admin.tarif.edit', compact('id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'daya' => 'required|max:20',
            'tarif_per_kwh' => 'required|numeric',
        ], [
            'daya.required' => 'Daya wajib diisi',
            'daya.max' => 'Daya maksimal 20 karakter',
            'tarif_per_kwh.required' => 'Tarif Per KWH wajib diisi',
            'tarif_per_kwh.numeric' => 'Tarif Per KWH harus berupa angka',
        ]);
        //ambil produk lama
        $tarif = Tarif::findOrFail($id);

        //update data produk
        $tarif->update([
            'daya' => $request->daya,
            'tarif_per_kwh' => $request->tarif_per_kwh,
        ]);

        return redirect()->route('admin.tarif.tarif');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Tarif $id)
    {
        $id->delete();
        return redirect()->route('admin.tarif.tarif')->with('success', 'Data berhasil dihapus');
    }
}
