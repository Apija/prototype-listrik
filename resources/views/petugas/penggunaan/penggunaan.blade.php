@extends('layout.main3')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="content-wrapper">
            
            <!-- Area Utama Tabel -->
            <div class="container-xxl flex-grow-1 container-p-y">
                
                <!-- Card Container untuk Tabel -->
                <div class="card">
                    <h5 class="card-header">Penggunaan Listrik</h5>
                    
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="d-flex align-items-center gap-2" style="width: auto;">
                            <!-- Tombol untuk menuju halaman tambah data -->
                            <a href="{{ route('petugas.penggunaan.create') }}" class="btn btn-primary text-nowrap">
                                <i class="bx bx-plus me-1"></i> Add Data
                            </a>
                        </div>
                    </div>

                    <!-- Responsive Table Wrapper -->
                    <div class="table-responsive text-nowrap">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Pelanggan</th>
                                    <th>Bulan</th>
                                    <th>Tahun</th>
                                    <th>Meter Awal</th>
                                    <th>Meter Akhir</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                {{-- Melakukan perulangan data dari variabel $penggunaan --}}
                                @foreach ($penggunaan as $pe)
                                    <tr>
                                        <td>
                                            <i class="text-danger me-4"></i>
                                            {{-- Menampilkan nomor urut otomatis --}}
                                            <span>{{ $loop->iteration }}</span>
                                        </td>
                                        {{-- Mengambil nama pelanggan melalui relasi model --}}
                                        <td>{{ $pe->pelanggan->nama_pelanggan }}</td>
                                        <td>{{ $pe->bulan }}</td>
                                        <td>{{ $pe->tahun }}</td>
                                        <td>{{ $pe->meter_awal }}</td>
                                        <td>{{ $pe->meter_akhir }}</td>
                                        <td>
                                            <!-- Dropdown Menu untuk Aksi (Edit/Delete) -->
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                    data-bs-toggle="dropdown">
                                                    <i class="icon-base bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <!-- Link ke Halaman Edit -->
                                                    <a class="dropdown-item" href="{{ route('petugas.penggunaan.edit', $pe->id_penggunaan) }}">
                                                        <i class="icon-base bx bx-edit-alt me-1"></i> Edit
                                                    </a>

                                                    <!-- Form Hapus Data (Disembunyikan untuk keamanan) -->
                                                    <form id="delete-form-{{ $pe->id_penggunaan }}"
                                                        action="{{ route('petugas.penggunaan.delete', $pe->id_penggunaan) }}" method="POST"
                                                        style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>

                                                    <!-- Tombol Hapus dengan Konfirmasi JavaScript -->
                                                    <a class="dropdown-item" href="javascript:void(0);"
                                                        onclick="event.preventDefault(); 
                                                        if (confirm('Yakin ingin menghapus data ini?')) {
                                                            document.getElementById('delete-form-{{ $pe->id_penggunaan }}').submit();
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
            </div>
        </div>
    </div>
@endsection