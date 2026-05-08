<?php

namespace App\Http\Controllers\pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Tagihan;
use App\Models\Penggunaan;
use App\Models\Tarif;
use App\Models\Pelanggan;


use Illuminate\Http\Request;

class ProfilePelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function dashboard()
    {
        $user = Auth::guard('pelanggan')->user();

        // 1. Ambil tagihan terbaru milik pelanggan ini saja
        $tagihanTerbaru = Tagihan::where('id_pelanggan', $user->id_pelanggan)
            ->with('penggunaan')
            // Penjelasan: Status 'belum_lunas' akan diprioritaskan (0), baru 'lunas' (1)
            ->orderByRaw("FIELD(status, 'belum_lunas', 'lunas') ASC")
            ->orderBy('tahun', 'desc')
            ->orderBy('bulan', 'desc')
            ->first();

        $totalHarusDibayar = 0;

        // 2. Cek jika ada tagihan dan statusnya belum lunas
        if ($tagihanTerbaru && $tagihanTerbaru->status != 'Lunas') {

            // Ambil data penggunaan terkait
            $penggunaan = $tagihanTerbaru->penggunaan;

            if ($penggunaan) {
                // Hitung jumlah pemakaian kWh
                $jumlah_meter = $penggunaan->meter_akhir - $penggunaan->meter_awal;

                // Ambil tarif per kwh dari relasi pelanggan ke tarif
                // Pastikan di model Pelanggan sudah ada function tarif()
                $tarif_per_kwh = $user->tarif->tarif_per_kwh ?? 0;

                // Hitung total uang
                $totalHarusDibayar = $jumlah_meter * $tarif_per_kwh + 2500; // Tambahkan biaya admin
            }
        }

        // 3. Ambil riwayat untuk tabel
        $riwayatTagihan = Tagihan::where('id_pelanggan', $user->id_pelanggan)
            ->orderBy('tahun', 'desc')
            ->get();

        return view('pelanggan.dashboard', compact('tagihanTerbaru', 'totalHarusDibayar', 'riwayatTagihan', 'user'));
    }
    public function profil()
    {
        // Mengambil data pelanggan yang sedang login beserta relasi tarifnya
        $user = Auth::guard('pelanggan')->user();

        $pelanggan = Pelanggan::with('tarif')
            ->find($user->id_pelanggan);

        return view('pelanggan.profil', compact('pelanggan'));
    }
}
