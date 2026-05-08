<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Tarif;
use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PetugasPelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function pelanggan()
    {
        $pelanggan = Tarif::all();
        $pelanggan = Pelanggan::with(['tarif'])->get();
        $query = Pelanggan::with(['tarif']);

        return view('petugas.pelanggan.pelanggan', compact('pelanggan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tarif = Tarif::all();
        return view('petugas.pelanggan.create', compact('tarif'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {

       $tarif = Tarif::all();
       $pelanggan = Pelanggan::with(['tarif'])->findOrFail($id);
        return view('petugas.pelanggan.show', compact('pelanggan', 'tarif'));
    
    }
}
