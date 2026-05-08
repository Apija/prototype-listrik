@extends('layout.main')

@section('content')
    <!-- Wrapper Utama Konten -->
    <div class="content-wrapper">
        <!-- Konten Utama -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row mb-6 gy-6">
                
                <!-- Kolom Layout Form Edit -->
                <div class="col-xxl">
                    <div class="card">
                        <!-- Header Card -->
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">Edit Tarif</h5>
                        </div>

                        <div class="card-body">
                            {{-- 
                                Form Update: 
                                1. Mengirimkan parameter ID ke route agar sistem tahu data mana yang diubah.
                                2. @csrf: Keamanan token Laravel.
                                3. @method('PUT'): Karena HTML form hanya mendukung GET/POST, 
                                   kita perlu spoofing method ke PUT untuk proses update data.
                            --}}
                            <form action="{{ route('admin.tarif.update', $id->id_tarif) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <!-- Input Daya -->
                                <div class="row mb-6">
                                    <label class="col-sm-2 col-form-label" for="daya">Daya</label>
                                    <div class="col-sm-10">
                                        {{-- Value diambil dari database melalui variabel $id --}}
                                        <input type="text" class="form-control @error('daya') is-invalid @enderror"
                                            id="daya" name="daya" value="{{ $id->daya }}">
                                        
                                        @error('daya')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Input Tarif Per KWH -->
                                <div class="row mb-6">
                                    <label class="col-sm-2 col-form-label" for="tarif_per_kwh">Tarif Per KWH</label>
                                    <div class="col-sm-10">
                                        {{-- Menggunakan type="number" agar user hanya bisa input angka --}}
                                        <input type="number" class="form-control @error('tarif_per_kwh') is-invalid @enderror"
                                            id="tarif_per_kwh" name="tarif_per_kwh" value="{{ $id->tarif_per_kwh }}" step="0.01">
                                        
                                        @error('tarif_per_kwh')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Tombol Aksi (Kirim & Batal) -->
                                <div class="row justify-content-end">
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary">
                                            <i class='bx bx-send me-1'></i> Update Data
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