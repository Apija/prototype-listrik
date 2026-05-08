@extends('layout.main3')

@section('content')
    <!-- Pembungkus Utama Konten -->
    <div class="content-wrapper">
        
        <!-- Container dengan Padding dan Layout Responsif -->
        <div class="container-xxl flex-grow-1 container-p-y">
            
            <!-- Grid Layout untuk Form -->
            <div class="row mb-6 gy-6">
                
                <!-- Kolom Utama -->
                <div class="col-xxl">
                    <div class="card">
                        <!-- Judul Card / Form -->
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">Tambah Penggunaan</h5>
                        </div>

                        <div class="card-body">
                            <!-- Form Input Penggunaan Listrik -->
                            <!-- Mengarah ke route store dengan method POST -->
                            <form action="{{ route('petugas.penggunaan.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf {{-- Token keamanan Laravel untuk mencegah serangan CSRF --}}

                                <!-- Pilihan Pelanggan -->
                                <div class="row mb-6">
                                    <label class="col-sm-2 col-form-label" for="id_pelanggan">Pelanggan </label>
                                    <div class="col-sm-10">
                                        <select class="form-control @error('id_pelanggan') is-invalid @enderror"
                                            id="id_pelanggan" name="id_pelanggan">
                                            <option>- Pilih Pelanggan -</option>
                                            @foreach ($pelanggan as $p)
                                                <option value="{{ $p->id_pelanggan }}" {{ old('id_pelanggan') == $p->id_pelanggan ? 'selected' : '' }}>
                                                    {{ $p->nama_pelanggan }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('id_pelanggan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Pilihan Bulan Penggunaan -->
                                <div class="row mb-6">
                                    <label class="col-sm-2 col-form-label" for="bulan">Bulan </label>
                                    <div class="col-sm-10">
                                        <select class="form-control @error('bulan') is-invalid @enderror" id="bulan" name="bulan">
                                            <option value="">- Pilih Bulan -</option>
                                            @php
                                                $nama_bulan = [
                                                    1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
                                                    5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
                                                    9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
                                                ];
                                            @endphp
                                            @foreach ($nama_bulan as $key => $val)
                                                <option value="{{ $key }}" {{ old('bulan') == $key ? 'selected' : '' }}>{{ $val }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!-- Input Tahun (Format Year) -->
                                <div class="row mb-6">
                                    <label class="col-sm-2 col-form-label" for="tahun">Tahun</label>
                                    <div class="col-sm-10">
                                        <input type="year" class="form-control @error('tahun') is-invalid @enderror"
                                            id="tahun" name="tahun" value="{{ old('tahun') }}" placeholder="Contoh: 2024">
                                        @error('tahun')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Input Angka Meter Awal -->
                                <div class="row mb-6">
                                    <label class="col-sm-2 col-form-label" for="meter_awal">Meter Awal</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control @error('meter_awal') is-invalid @enderror"
                                            id="meter_awal" name="meter_awal" value="{{ old('meter_awal') }}">
                                        @error('meter_awal')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Input Angka Meter Akhir -->
                                <div class="row mb-6">
                                    <label class="col-sm-2 col-form-label" for="meter_akhir">Meter Akhir</label>
                                    <div class="col-sm-10">
                                        <input type="number"
                                            class="form-control @error('meter_akhir') is-invalid @enderror" id="meter_akhir"
                                            name="meter_akhir" value="{{ old('meter_akhir') }}">
                                        @error('meter_akhir')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Tombol Submit Form -->
                                <div class="row justify-content-end">
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary">
                                            <i class='bx bx-save me-1'></i> Simpan Data
                                        </button>
                                        <a href="{{ route('petugas.penggunaan.penggunaan') }}" class="btn btn-outline-secondary">
                                            <i class='bx bx-x me-1'></i> Cancel
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection