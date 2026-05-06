@extends('layout.main')
@section('content')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <!-- Basic Layout & Basic with Icons -->
            <div class="row mb-6 gy-6">
                <!-- Basic Layout -->
                <div class="col-xxl">
                    <div class="card">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">Tambah Pelanggan</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.pelanggan.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
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
                                <div class="row mb-6">
                                    <label class="col-sm-2 col-form-label" for="nomor_kwh">Nomor KWH</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control @error('nomor_kwh') is-invalid @enderror"
                                            id="nomor_kwh" name="nomor_kwh" value="{{ old('nomor_kwh') }}">
                                        @error('nomor_kwh')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-6">
                                    <label class="col-sm-2 col-form-label" for="nama_pelanggan">Nama Pelanggan</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control @error('nama_pelanggan') is-invalid @enderror"
                                            id="nama_pelanggan" name="nama_pelanggan" value="{{ old('nama_pelanggan') }}">
                                        @error('nama_pelanggan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div><div class="row mb-6">
                                    <label class="col-sm-2 col-form-label" for="alamat">Alamat</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control @error('alamat') is-invalid @enderror"
                                            id="alamat" name="alamat" value="{{ old('alamat') }}">
                                        @error('alamat')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-6" >
                                    <label class="col-sm-2 col-form-label" for="id_tarif">Daya :</label>
                                    <div class="col-sm-10">
                                    <select class="form-control @error('id_tarif') is-invalid @enderror" id="id_tarif"
                                        name="id_tarif" value="{{ old('id_tarif') }}">
                                        <option>- Pilih Tarif -</option>
                                        @foreach ($tarif as $t)
                                            <option value="{{ $t->id_tarif }}">
                                                {{ $t->daya }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_tarif')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    </div>
                                </div>
                                <input type="hidden" id="tgl_selesai" name="tgl_selesai">
                                <div class="row justify-content-end">
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary">Send</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
 @endsection