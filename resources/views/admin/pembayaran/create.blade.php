@extends('layout.main')

@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row mb-6 gy-6">
                <div class="col-xxl">
                    <div class="card">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">Tambah Pembayaran</h5>
                        </div>
                        <div class="card-body">
                            <!-- Form Input Pembayaran -->
                            <form action="{{ route('admin.pembayaran.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <!-- Pilih Tagihan Pelanggan -->
                                <div class="row mb-6">
                                    <label class="col-sm-2 col-form-label" for="tagihanSelect">Nama Pelanggan</label>
                                    <div class="col-sm-10">
                                        <select id="tagihanSelect" class="form-select" name="id_tagihan">
                                            <option value="">- Pilih Pelanggan (Tagihan) -</option>
                                            @foreach ($tagihan as $t)
                                                @php
                                                    // Hitung nominal tagihan: (Meter Akhir - Meter Awal) * Tarif
                                                    $pemakaian =
                                                        $t->penggunaan->meter_akhir - $t->penggunaan->meter_awal;
                                                    $tarif = $t->pelanggan->tarif->tarif_per_kwh;
                                                    $nominalTagihan = $pemakaian * $tarif;
                                                @endphp

                                                <option value="{{ $t->id_tagihan }}" data-total="{{ $nominalTagihan }}"
                                                    data-pelanggan="{{ $t->id_pelanggan }}">
                                                    {{ $t->pelanggan->nama_pelanggan }} - (Bulan: {{ $t->bulan }})
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('id_tagihan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Pilih Admin/User yang bertugas -->
                                <div class="row mb-6">
                                    <label class="col-sm-2 col-form-label" for="id_user">Admin Pengelola</label>
                                    <div class="col-sm-10">
                                        <select class="form-control @error('id_user') is-invalid @enderror" id="id_user"
                                            name="id_user">
                                            <option value="">- Pilih Nama Admin -</option>
                                            @foreach ($users as $u)
                                                <option value="{{ $u->id_user }}"
                                                    {{ old('id_user') == $u->id_user ? 'selected' : '' }}>
                                                    {{ $u->nama_admin }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('id_user')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Hidden Input untuk menyimpan ID Pelanggan secara otomatis via JS -->
                                <input type="hidden" name="id_pelanggan" id="id_pelanggan">

                                <div class="row mb-6">
                                    <label class="col-sm-2 col-form-label">Biaya Admin</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" value="Rp 2.500" readonly>
                                    </div>
                                </div>

                                <!-- Tombol Submit -->
                                <div class="row justify-content-end">
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary">
                                            <i class='bx bx-check-circle me-1'></i> Proses Pembayaran
                                        </button>
                                        <a href="{{ route('admin.pembayaran.pembayaran') }}"
                                            class="btn btn-outline-secondary">Cancel</a>
                                    </div>
                                </div>
                            </form>

                            <hr class="my-6">

                            <!-- Info Ringkasan Pembayaran Global -->
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label fw-bold">Total Seluruh Pembayaran</label>
                                <div class="col-sm-9">
                                    <span class="text-success fw-bold" id="display_total">Rp 0</span>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label fw-bold">Tanggal Transaksi Terakhir</label>
                                <div class="col-sm-9">
                                    @if ($pembayaran->count() > 0)
                                        <span class="badge bg-label-info">{{ $pembayaran->last()->tgl_pembayaran }}</span>
                                    @else
                                        <span class="text-danger small italic">Belum ada riwayat pembayaran</span>
                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Script Otomatisasi Perhitungan -->
    <script>
        document.getElementById('tagihanSelect').addEventListener('change', function() {
            const selected = this.options[this.selectedIndex];

            // Pastikan dataset dibaca dengan benar
            const totalTagihan = parseInt(selected.dataset.total || 0);
            const idPelanggan = selected.dataset.pelanggan || '';
            const biayaAdmin = 2500;
            const totalBayar = totalTagihan + biayaAdmin;

            // 1. Update ID Pelanggan (jika ada input hidden)
            const inputId = document.getElementById('id_pelanggan');
            if (inputId) inputId.value = idPelanggan;

            // 2. Update Tampilan Angka (Gunakan innerText jika itu teks berwarna hijau di gambar)
            // Sesuaikan ID 'display_total' dengan ID yang ada di HTML bagian angka hijau itu
            const displayTotal = document.getElementById('display_total');
            if (displayTotal) {
                displayTotal.innerText = 'Rp ' + totalBayar.toLocaleString('id-ID');
            }

            // Jika kamu juga ingin mengupdate input field (jika ada)
            const inputTotal = document.getElementById('total_bayar');
            if (inputTotal) {
                inputTotal.value = 'Rp ' + totalBayar.toLocaleString('id-ID');
            }
        });
    </script>
@endsection
