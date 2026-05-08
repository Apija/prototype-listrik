@extends('layout.main')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">

                <!-- Card Container untuk Data Tagihan -->
                <div class="card">
                    <h5 class="card-header">Data Tagihan Listrik</h5>

                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="d-flex align-items-center gap-2" style="width: auto;">
                            <!-- Tombol untuk menjalankan fungsi Generate Tagihan otomatis -->
                            <a href="{{ route('admin.tagihan.generate') }}" class="btn btn-primary text-nowrap">
                                Generate Tagihan
                            </a>
                        </div>
                    </div>

                    <!-- Tabel Responsive -->
                    <div class="table-responsive text-nowrap">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Pelanggan</th>
                                    <th>Nomor KWH</th>
                                    <th>Bulan</th>
                                    <th>Tahun</th>
                                    <th>Jumlah Meter</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- Looping data tagihan dari database --}}
                                @foreach ($tagihan as $tg)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        {{-- Mengambil data nama dan nomor KWH dari relasi model pelanggan --}}
                                        <td>{{ $tg->pelanggan->nama_pelanggan }}</td>
                                        <td>{{ $tg->pelanggan->nomor_kwh }}</td>

                                        <!-- Logika Konversi Angka Bulan ke Nama Bulan (Contoh: 1 -> Januari) -->
                                        <td>
                                            {{ \Carbon\Carbon::create()->month($tg->bulan)->translatedFormat('F') }}
                                        </td>

                                        <td>{{ $tg->tahun }}</td>
                                        <td>{{ $tg->jumlah_meter }}</td>

                                        <!-- Menampilkan Badge Berwarna berdasarkan Status Pembayaran -->
                                        <td>
                                            <span
                                                class="badge bg-label-{{ $tg->status == 'lunas' ? 'success' : 'danger' }}">
                                                {{ $tg->status == 'lunas' ? 'Lunas' : 'Belum Lunas' }}
                                            </span>
                                        </td>

                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                    data-bs-toggle="dropdown">
                                                    <i class="icon-base bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <!-- Tombol Detail untuk melihat rincian tagihan -->
                                                    <a class="dropdown-item"
                                                        href="{{ route('admin.tagihan.show', $tg->id_tagihan) }}">
                                                        <i class="icon-base bx bx-show"></i> Detail
                                                    </a>
                                                    <!-- Form Delete Tagihan -->
                                                    <form id="delete-form-{{ $tg->id_tagihan }}"
                                                        action="{{ route('admin.tagihan.delete', $tg->id_tagihan) }}"
                                                        method="POST" style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>

                                                    <!-- Link Konfirmasi Hapus Data -->
                                                    <a class="dropdown-item" href="javascript:void(0);"
                                                        onclick="event.preventDefault(); 
                                                        if (confirm('Yakin ingin menghapus data ini?')) {
                                                            document.getElementById('delete-form-{{ $tg->id_tagihan }}').submit();
                                                        }">
                                                        <i class="icon-base bx bx-trash me-1"></i> Delete
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Tempat untuk konten tambahan jika diperlukan --}}
            </div>
        </div>
    </div>
@endsection
