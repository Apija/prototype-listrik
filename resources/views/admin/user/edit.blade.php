@extends('layout.main')

@section('content')
    <!-- Wrapper Utama Konten -->
    <div class="content-wrapper">
        <!-- Konten Halaman -->
        <div class="container-xxl flex-grow-1 container-p-y">
            
            <!-- Grid Layout untuk Form Edit -->
            <div class="row mb-6 gy-6">
                <div class="col-xxl">
                    <!-- Kartu Form Edit Pelanggan -->
                    <div class="card">
                        <!-- Header Kartu -->
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">Edit Data Admin</h5>
                        </div>

                        <div class="card-body">
                            <!-- Awal Form: Mengarah ke fungsi update di controller dengan parameter ID -->
                            <form action="{{ route('admin.user.update', $id->id_user) }}" method="POST" enctype="multipart/form-data">
                                @csrf          <!-- Token Keamanan Laravel -->
                                @method('PUT') <!-- Method Spoofing: Laravel memerlukan PUT/PATCH untuk update data -->

                                <!-- Input Username -->
                                <div class="row mb-6">
                                    <label class="col-sm-2 col-form-label" for="username">Username</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control @error('username') is-invalid @enderror"
                                            id="username" name="username" value="{{ $id->username }}">
                                        @error('username')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Input Password (Biasanya dikosongkan jika tidak ingin ganti) -->
                                <div class="row mb-6">
                                    <label class="col-sm-2 col-form-label" for="password">Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                                            id="password" name="password" placeholder="Kosongkan jika tidak ingin mengubah password">
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Input Nama Admin -->
                                <div class="row mb-6">
                                    <label class="col-sm-2 col-form-label" for="nama_admin">Nama Admin</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control @error('nama_admin') is-invalid @enderror"
                                            id="nama_admin" name="nama_admin" value="{{ $id->nama_admin }}">
                                        @error('nama_admin')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Dropdown Pilih Daya (Level) -->
                                <div class="row mb-6">
                                    <label class="col-sm-2 col-form-label" for="id_level">Level</label>
                                    <div class="col-sm-10">
                                        <select class="form-select @error('id_level') is-invalid @enderror" id="id_level" name="id_level">
                                            <option value="">Pilih Level</option>
                                            @foreach ($level as $l)
                                                <!-- Logika Penyeleksian Otomatis: Jika ID Level sama dengan data di DB, maka tandai sebagai 'selected' -->
                                                <option value="{{ $l->id_level }}" {{ $l->id_level == $id->id_level ? 'selected' : '' }}>
                                                    {{ $l->nama_level }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('id_level')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Tombol Aksi -->
                                <div class="row justify-content-end">
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary">
                                            <i class='bx bx-send me-1'></i> Update Data
                                        </button>
                                        <a href="{{ route('admin.user.user') }}" class="btn btn-outline-secondary">
                                            <i class='bx bx-x me-1'></i> Batal
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