<?php

namespace App\Http\Controllers\Petugas;

use App\Models\Tagihan;
use App\Models\Penggunaan;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PetugasTagihanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function tagihan()
    {
        $tagihan = Tagihan::with(['pelanggan', 'penggunaan'])->get();
        return view('petugas.tagihan.tagihan', compact('tagihan'));
    }

    // 🔹 2. Generate tagihan dari penggunaan
    public function generate()
    {
        $penggunaan = Penggunaan::with(['pelanggan.tarif'])->get();

        foreach ($penggunaan as $p) {

            // cek kalau sudah ada tagihan, skip
            $cek = Tagihan::where('id_penggunaan', $p->id_penggunaan)->first();
            if ($cek) continue;

            $jumlah_meter = $p->meter_akhir - $p->meter_awal;
            $tarif = $p->pelanggan->tarif->tarif_per_kwh;

            Tagihan::create([
                'id_penggunaan' => $p->id_penggunaan,
                'id_pelanggan' => $p->id_pelanggan,
                'bulan' => $p->bulan,
                'tahun' => $p->tahun,
                'jumlah_meter' => $jumlah_meter,
                'status' => 'belum_lunas'
            ]);
        }

        return redirect()->back()->with('success', 'Tagihan berhasil digenerate');
    }
    // 🔹 3. Detail tagihan
    public function show($id)
    {
        $tagihan = Tagihan::with(['pelanggan', 'penggunaan'])->findOrFail($id);
        return view('petugas.tagihan.show', compact('tagihan'));
    }

    // 🔹 4. Update status (lunas / belum)
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:lunas,belum_lunas'
        ]);

        $tagihan = Tagihan::findOrFail($id);
        $tagihan->update([
            'status' => $request->status
        ]);

        return redirect()->back()->with('success', 'Status berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        $tagihan = Tagihan::findOrFail($id);
        $tagihan->delete();

        return redirect()->back()->with('success', 'Tagihan dihapus');
    }
}
