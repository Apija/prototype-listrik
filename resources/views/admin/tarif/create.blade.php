@extends('layout.main')

@section('content')
    <!-- Wrapper utama konten -->
    <div class="content-wrapper">
        
        <!-- Kontainer Bootstrap untuk padding dan responsivitas -->
        <div class="container-xxl flex-grow-1 container-p-y">
            
            <!-- Grid System Bootstrap -->
            <div class="row mb-6 gy-6">
                
                <!-- Kolom Layout -->
                <div class="col-xxl">
                    <!-- Card sebagai wadah form agar terlihat rapi -->
                    <div class="card">
                        <!-- Header Form -->
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">Tambah Tarif</h5>
                        </div>

                        <div class="card-body">
                            {{-- 
                                Form Action: Mengarah ke route store untuk menyimpan data.
                                Method POST: Standar pengiriman data baru.
                                CSRF: Wajib ada di Laravel untuk keamanan dari serangan cross-site request forgery.
                            --}}
                            <form action="{{ route('admin.tarif.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <!-- Input Daya -->
                                <div class="row mb-6">
                                    <label class="col-sm-2 col-form-label" for="daya">Daya</label>
                                    <div class="col-sm-10">
                                        {{-- 
                                            is-invalid: Class akan muncul jika ada error validasi pada field 'daya'.
                                            old('daya'): Berfungsi agar data yang diketik tidak hilang jika form gagal divalidasi.
                                        --}}
                                        <input type="text" class="form-control @error('daya') is-invalid @enderror"
                                            id="daya" name="daya" value="{{ old('daya') }}" placeholder="Contoh: 900">
                                        
                                        <!-- Pesan Error Validasi untuk Daya -->
                                        @error('daya')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Input Tarif Per KWH -->
                                <div class="row mb-6">
                                    <label class="col-sm-2 col-form-label" for="tarif_per_kwh">Tarif Per KWH</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control @error('tarif_per_kwh') is-invalid @enderror"
                                            id="tarif_per_kwh" name="tarif_per_kwh" value="{{ old('tarif_per_kwh') }}" placeholder="Contoh: 1500">
                                        
                                        <!-- Pesan Error Validasi untuk Tarif -->
                                        @error('tarif_per_kwh')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Tombol Aksi -->
                                <div class="row justify-content-end">
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary">
                                            <i class='bx bx-save me-1'></i> Simpan Data
                                        </button>
                                        <a href="{{ route('admin.tarif.tarif') }}" class="btn btn-outline-secondary">
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