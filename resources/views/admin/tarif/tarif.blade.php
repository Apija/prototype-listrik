@extends('layout.main')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="content-wrapper">
            <!-- Konten Utama -->
            <div class="container-xxl flex-grow-1 container-p-y">
                
                <!-- Card untuk membungkus Tabel Tarif -->
                <div class="card">
                    <h5 class="card-header">Tarif Listrik</h5>
                    
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="d-flex align-items-center gap-2" style="width: auto;">
                            <!-- Tombol Tambah Data -->
                            <a href="{{ route('admin.tarif.create') }}" class="btn btn-primary text-nowrap">
                                <i class="bx bx-plus me-1"></i> Add Data
                            </a>
                        </div>
                    </div>

                    <!-- Wrapper Tabel agar bisa discroll pada layar kecil -->
                    <div class="table-responsive text-nowrap">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Daya</th>
                                    <th>Tarif Per KWH</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                {{-- Melakukan looping data dari variabel $tarif yang dikirim Controller --}}
                                @foreach ($tarif as $t)
                                    <tr>
                                        <td>
                                            <i class="text-danger me-4"></i>
                                            {{-- Menampilkan nomor urut (1, 2, 3, dst) --}}
                                            <span>{{ $loop->iteration }}</span>
                                        </td>
                                        {{-- Menampilkan daya (Contoh: 900, 1300) --}}
                                        <td>{{ $t->daya }} VA</td>
                                        {{-- Menampilkan tarif per KWH --}}
                                        <td>Rp {{ number_format($t->tarif_per_kwh, 0, ',', '.') }}</td>
                                        <td>
                                            <!-- Tombol Aksi Dropdown -->
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                    data-bs-toggle="dropdown">
                                                    <i class="icon-base bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <!-- Link Edit Data berdasarkan ID Tarif -->
                                                    <a class="dropdown-item" href="{{ route('admin.tarif.edit', $t->id_tarif) }}">
                                                        <i class="icon-base bx bx-edit-alt me-1"></i> Edit
                                                    </a>

                                                    {{-- 
                                                        Form Hapus: 
                                                        Menggunakan ID unik pada form agar JavaScript tahu form mana yang harus di-submit 
                                                    --}}
                                                    <form id="delete-form-{{ $t->id_tarif }}"
                                                        action="{{ route('admin.tarif.delete', $t->id_tarif) }}" method="POST"
                                                        style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>

                                                    <!-- Tombol Hapus dengan Konfirmasi -->
                                                    <a class="dropdown-item" href="javascript:void(0);"
                                                        onclick="event.preventDefault(); 
                                                        if (confirm('Yakin ingin menghapus data tarif ini?')) {
                                                            document.getElementById('delete-form-{{ $t->id_tarif }}').submit();
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