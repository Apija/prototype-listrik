<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use App\Models\Tagihan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PembayaranController extends Controller
{
    // 🔹 1. List pembayaran
    public function pembayaran()
    {
        $pembayaran = Pembayaran::with(['tagihan.pelanggan'])->get();
        return view('admin.pembayaran.pembayaran', compact('pembayaran'));
    }

    // 🔹 2. Form bayar (ambil dari tagihan)
    public function create()
    {
        $tagihan = Tagihan::with([
            'pelanggan',
            'penggunaan.pelanggan.tarif'
        ])->where('status', 'belum_lunas')->get();
        $users = User::all();
        $pembayaran = Pembayaran::all();
        return view('admin.pembayaran.create', compact('tagihan', 'pembayaran', 'users'));
    }

    // 🔹 3. Simpan pembayaran
    public function store(Request $request)
    {
        $request->validate([
            'id_tagihan' => 'required',
            'id_pelanggan' => 'required',
            'id_user' => 'required'
        ]);

         // ambil data tagihan beserta relasi yang dibutuhkan

        $tagihan = Tagihan::with([
            'penggunaan.pelanggan.tarif'
        ])->findOrFail($request->id_tagihan);

        // biaya admin
        $biaya_admin = 2500;

        // hitung total tagihan otomatis
        $total_tagihan =
            $tagihan->jumlah_meter *
            $tagihan->penggunaan->pelanggan->tarif->tarif_per_kwh;

        // total akhir
        $total_bayar = $total_tagihan + $biaya_admin;

        Pembayaran::create([
            'id_tagihan' => $tagihan->id_tagihan,
            'id_pelanggan' => $tagihan->id_pelanggan,
            'tgl_pembayaran' => now(),
            'bulan_bayar' => $tagihan->bulan,
            // otomatis
            'total_tagihan' => $total_tagihan,
            'biaya_admin' => $biaya_admin,
            'total_bayar' => $total_bayar,
            'id_user' => $request->id_user,
        ]);

        // update status tagihan
        $tagihan->update([
            'status' => 'lunas'
        ]);

        return redirect()
            ->route('admin.pembayaran.pembayaran')
            ->with('success', 'Pembayaran berhasil');
    }

    // 🔹 4. Detail pembayaran
    public function show($id)
    {
        $pembayaran = Pembayaran::with(['tagihan.pelanggan'])->findOrFail($id);
        return view('admin.pembayaran.show', compact('pembayaran'));
    }

    // 🔹 5. Hapus (opsional)
    public function delete($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);

        // rollback status tagihan
        $pembayaran->tagihan->update([
            'status' => 'belum_lunas'
        ]);

        $pembayaran->delete();

        return redirect()->back()->with('success', 'Data dihapus');
    }
}
