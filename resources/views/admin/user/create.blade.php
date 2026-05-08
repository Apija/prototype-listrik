@extends('layout.main')

@section('content')
    <!-- Wrapper Utama Konten -->
    <div class="content-wrapper">
        <!-- Konten Halaman -->
        <div class="container-xxl flex-grow-1 container-p-y">
            
            <!-- Grid Layout untuk Form -->
            <div class="row mb-6 gy-6">
                <div class="col-xxl">
                    <!-- Kartu Form Tambah Admin -->
                    <div class="card">
                        <!-- Header Kartu -->
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">Tambah Admin</h5>
                        </div>

                        <div class="card-body">
                            <!-- Awal Form: Mengarah ke fungsi store di controller -->
                            <!-- enctype="multipart/form-data" digunakan jika ada upload file nantinya -->
                            <form action="{{ route('admin.user.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf <!-- Token Keamanan Laravel -->

                                <!-- Input Username -->
                                <div class="row mb-6">
                                    <label class="col-sm-2 col-form-label" for="username">Username</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control @error('username') is-invalid @enderror"
                                            id="username" name="username" value="{{ old('username') }}">
                                        @error('username')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Input Password -->
                                <div class="row mb-6">
                                    <label class="col-sm-2 col-form-label" for="password">Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                                            id="password" name="password">
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
                                            id="nama_admin" name="nama_admin" value="{{ old('nama_admin') }}">
                                        @error('nama_admin')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Pilihan Dropdown level -->
                                <div class="row mb-6">
                                    <label class="col-sm-2 col-form-label" for="id_level">Level</label>
                                    <div class="col-sm-10">
                                        <select class="form-control @error('id_level') is-invalid @enderror" id="id_level" name="id_level">
                                            <option value="">- Pilih Level -</option>
                                            @foreach ($level as $l)
                                                <option value="{{ $l->id_level }}" {{ old('id_level') == $l->id_level ? 'selected' : '' }}>
                                                    {{ $l->nama_level }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('id_level')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Tombol Submit -->
                                <div class="row justify-content-end">
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary">
                                            <i class='bx bx-save me-1'></i> Simpan Data
                                        </button>
                                        <a href="{{ route('admin.user.user') }}" class="btn btn-outline-secondary">
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