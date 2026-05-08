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
                                        <select class="form-control @error('id_tagihan') is-invalid @enderror"
                                            id="tagihanSelect" name="id_tagihan">
                                            <option value="">- Pilih Pelanggan (Tagihan) -</option>
                                            @foreach ($tagihan as $tg)
                                                {{-- Kita simpan data tambahan (ID pelanggan & nominal) di atribut data-* untuk dibaca JS --}}
                                                <option value="{{ $tg->id_tagihan }}"
                                                    data-pelanggan="{{ $tg->id_pelanggan }}"
                                                    data-total="{{ $tg->total_bayar }}">
                                                    {{ $tg->pelanggan->nama_pelanggan }} - (Bulan: {{ $tg->bulan }})
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
                                        <select class="form-control @error('id_user') is-invalid @enderror" id="id_user" name="id_user">
                                            <option value="">- Pilih Nama Admin -</option>
                                            @foreach ($users as $u)
                                                <option value="{{ $u->id_user }}" {{ old('id_user') == $u->id_user ? 'selected' : '' }}>
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

                                <!-- Detail Biaya (Readonly) -->
                                <div class="row mb-6">
                                    <label class="col-sm-2 col-form-label">Total Tagihan</label>
                                    <div class="col-sm-10">
                                        <input type="text" id="total_tagihan" class="form-control" value="Rp 0" readonly>
                                    </div>
                                </div>

                                <div class="row mb-6">
                                    <label class="col-sm-2 col-form-label">Biaya Admin</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" value="Rp 2.500" readonly>
                                    </div>
                                </div>

                                <div class="row mb-6">
                                    <label class="col-sm-2 col-form-label fw-bold">Total Bayar</label>
                                    <div class="col-sm-10">
                                        <input type="text" id="total_bayar" class="form-control fw-bold text-primary" value="Rp 0" readonly>
                                    </div>
                                </div>

                                <!-- Tombol Submit -->
                                <div class="row justify-content-end">
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary">
                                            <i class='bx bx-check-circle me-1'></i> Proses Pembayaran
                                        </button>
                                        <a href="{{ route('admin.pembayaran.pembayaran') }}" class="btn btn-outline-secondary">Cancel</a>
                                    </div>
                                </div>
                            </form>

                            <hr class="my-6">

                            <!-- Info Ringkasan Pembayaran Global -->
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label fw-bold">Total Seluruh Pembayaran</label>
                                <div class="col-sm-9">
                                    <span class="text-success fw-bold">
                                        Rp {{ number_format($pembayaran->sum('total_bayar'), 0, ',', '.') }}
                                    </span>
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
            // Ambil opsi yang dipilih
            const selected = this.options[this.selectedIndex];
            
            // Ambil data dari atribut data-*
            const totalTagihan = parseInt(selected.dataset.total || 0);
            const idPelanggan = selected.dataset.pelanggan || '';
            const biayaAdmin = 2500;
            const totalBayar = totalTagihan + biayaAdmin;

            // Masukkan ID pelanggan ke input hidden
            document.getElementById('id_pelanggan').value = idPelanggan;

            // Update tampilan angka (Format Rupiah)
            document.getElementById('total_tagihan').value = 
                'Rp ' + totalTagihan.toLocaleString('id-ID');

            document.getElementById('total_bayar').value = 
                'Rp ' + totalBayar.toLocaleString('id-ID');
        });
    </script>
@endsection