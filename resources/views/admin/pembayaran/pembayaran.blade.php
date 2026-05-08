@extends('layout.main')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="content-wrapper">
            
            <!-- Struktur Pembungkus Utama Halaman -->
            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="card">
                    <!-- Judul Tabel -->
                    <h5 class="card-header">Pembayaran Tagihan Listik</h5>
                    
                    <!-- Bagian Tombol Aksi (Tambah Data) -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="d-flex align-items-center gap-2" style="width: auto;">
                            <a href="{{ route('admin.pembayaran.create') }}" class="btn btn-primary text-nowrap">
                                <i class="bx bx-plus me-1"></i> Add Data
                            </a>
                        </div>
                    </div>

                    <!-- Container Tabel Responsive -->
                    <div class="table-responsive text-nowrap">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Pelanggan</th>
                                    <th>No KWH</th>
                                    <th>Tanggal</th>
                                    <th>Bulan</th>
                                    <th>Total Tagihan</th>
                                    <th>Biaya Admin</th>
                                    <th>Total Bayar</th>
                                    <th>Nama Admin</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Looping Data Pembayaran dari Database -->
                                @foreach ($pembayaran as $pm)
                                    <tr>
                                        {{-- Iterasi Nomor Otomatis --}}
                                        <td>{{ $loop->iteration }}</td>
                                        
                                        {{-- Mengambil Nama Pelanggan melalui Relasi Tagihan --}}
                                        <td>{{ $pm->tagihan->pelanggan->nama_pelanggan }}</td>
                                        
                                        {{-- Mengambil Nomor KWH melalui Relasi Tagihan --}}
                                        <td>{{ $pm->tagihan->pelanggan->nomor_kwh }}</td>
                                        
                                        <td>{{ $pm->tgl_pembayaran }}</td>
                                        <td>{{ $pm->bulan_bayar }}</td>
                                        
                                        {{-- Format Rupiah untuk Nominal Uang --}}
                                        <td>Rp {{ number_format($pm->total_tagihan, 0, ',', '.') }}</td>
                                        <td>Rp {{ number_format($pm->biaya_admin, 0, ',', '.') }}</td>
                                        <td>Rp {{ number_format($pm->total_bayar, 0, ',', '.') }}</td>
                                        
                                        {{-- Menampilkan Username Admin, Jika Kosong tampilkan tanda strip --}}
                                        <td>{{ $pm->user->username ?? '-' }}</td>
                                        
                                        <td>
                                            <!-- Menu Dropdown Aksi -->
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                    data-bs-toggle="dropdown">
                                                    <i class="icon-base bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <!-- Link Menuju Halaman Detail -->
                                                    <a class="dropdown-item" href="{{ route('admin.pembayaran.show', $pm->id_pembayaran) }}">
                                                        <i class="icon-base bx bx-show"></i> Detail
                                                    </a>

                                                    <!-- Form Hapus Data (Disembunyikan) -->
                                                    <form id="delete-form-{{ $pm->id_pembayaran }}"
                                                        action="{{ route('admin.pembayaran.delete', $pm->id_pembayaran) }}"
                                                        method="POST" style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>

                                                    <!-- Link Trigger Konfirmasi Hapus via JavaScript -->
                                                    <a class="dropdown-item" href="javascript:void(0);"
                                                        onclick="event.preventDefault(); 
                                                        if (confirm('Yakin ingin menghapus data ini?')) {
                                                            document.getElementById('delete-form-{{ $pm->id_pembayaran }}').submit();
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

                {{-- Placeholder untuk bagian dashboard lainnya --}}
            </div>
        </div>
    </div>
@endsection