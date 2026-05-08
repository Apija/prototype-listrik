@extends('layout.main')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="content-wrapper">
            
            <!-- Konten Utama -->
            <div class="container-xxl flex-grow-1 container-p-y">
                
                <!-- Kartu Tabel Pelanggan -->
                <div class="card">
                    <h5 class="card-header">Data Pelanggan</h5>
                    
                    <!-- Area Tombol Aksi (Tambah Data) -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="d-flex align-items-center gap-2" style="width: auto;">
                            <a href="{{ route('admin.pelanggan.create') }}" class="btn btn-primary text-nowrap">
                                <i class="bx bx-plus me-1"></i> Add Data
                            </a>
                        </div>
                    </div>

                    <!-- Tabel Responsive -->
                    <div class="table-responsive text-nowrap">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Username</th>
                                    <th>Nomor KWH</th>
                                    <th>Nama Pelanggan</th>
                                    <th>Alamat</th>
                                    <th>Daya</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            
                            <tbody class="table-border-bottom-0">
                                <!-- Looping Data Pelanggan dari Controller -->
                                @foreach ($pelanggan as $p)
                                    <tr>
                                        <td>
                                            <!-- Menampilkan nomor urut otomatis -->
                                            <span>{{ $loop->iteration }}</span>
                                        </td>
                                        <td>{{ $p->username }}</td>
                                        <td>{{ $p->nomor_kwh }}</td>
                                        <td>{{ $p->nama_pelanggan }}</td>
                                        <td>{{ $p->alamat }}</td>
                                        <!-- Mengambil data daya melalui relasi model 'tarif' -->
                                        <td>{{ $p->tarif->daya }} VA</td>
                                        
                                        <td>
                                            <!-- Menu Dropdown untuk Aksi (Edit/Delete) -->
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                    <i class="icon-base bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    
                                                    <!-- Tombol Edit -->
                                                    <a class="dropdown-item" href="{{ route('admin.pelanggan.edit', $p->id_pelanggan) }}">
                                                        <i class="icon-base bx bx-edit-alt me-1"></i> Edit
                                                    </a>

                                                    <!-- Form Hapus (Hidden) -->
                                                    <!-- Dibuat form terpisah karena method DELETE memerlukan CSRF token -->
                                                    <form id="delete-form-{{ $p->id_pelanggan }}"
                                                        action="{{ route('admin.pelanggan.delete', $p->id_pelanggan) }}" method="POST"
                                                        style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>

                                                    <!-- Tombol Hapus dengan Konfirmasi JavaScript -->
                                                    <a class="dropdown-item" href="javascript:void(0);"
                                                        onclick="event.preventDefault(); 
                                                        if (confirm('Yakin ingin menghapus data pelanggan ini?')) {
                                                            document.getElementById('delete-form-{{ $p->id_pelanggan }}').submit();
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