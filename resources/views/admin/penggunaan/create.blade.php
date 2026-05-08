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
                            <h5 class="mb-0">Tambah Penggunaan</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.penggunaan.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-6">
                                    <label class="col-sm-2 col-form-label" for="id_pelanggan">Pelanggan </label>
                                    <div class="col-sm-10">
                                        <select class="form-control @error('id_pelanggan') is-invalid @enderror"
                                            id="id_pelanggan" name="id_pelanggan" value="{{ old('id_pelanggan') }}">
                                            <option>- Pilih Pelanggan -</option>
                                            @foreach ($pelanggan as $p)
                                                <option value="{{ $p->id_pelanggan }}">
                                                    {{ $p->nama_pelanggan }}</option>
                                            @endforeach
                                        </select>
                                        @error('id_pelanggan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-6">
                                    <label class="col-sm-2 col-form-label" for="bulan">Bulan </label>
                                    <div class="col-sm-10">
                                        <select class="form-control @error('bulan') is-invalid @enderror" id="bulan"
                                            name="bulan" value="{{ old('bulan') }}">
                                            <option value="">- Pilih Bulan -</option>
                                            <option value="1">Januari</option>
                                            <option value="2">Februari</option>
                                            <option value="3">Maret</option>
                                            <option value="4">April</option>
                                            <option value="5">Mei</option>
                                            <option value="6">Juni</option>
                                            <option value="7">Juli</option>
                                            <option value="8">Agustus</option>
                                            <option value="9">September</option>
                                            <option value="10">Oktober</option>
                                            <option value="11">November</option>
                                            <option value="12">Desember</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-6">
                                    <label class="col-sm-2 col-form-label" for="tahun">Tahun</label>
                                    <div class="col-sm-10">
                                        <input type="year" class="form-control @error('tahun') is-invalid @enderror"
                                            id="tahun" name="tahun" value="{{ old('tahun') }}">
                                        @error('tahun')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

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
