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
                            <h5 class="mb-0">Edit Penggunaan</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.penggunaan.update', $id->id_penggunaan) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row mb-6">
                                    <label class="col-sm-2 col-form-label" for="id_pelanggan">Nama Pelanggan</label>
                                    <div class="col-sm-10">
                                        <select class="form-select @error('id_pelanggan') is-invalid @enderror"
                                            id="id_pelanggan" name="id_pelanggan">
                                            <option value="">Pilih Nama Pelanggan</option>
                                            @foreach ($pelanggan as $p)
                                                <option value="{{ $p->id_pelanggan }}"
                                                    {{ $p->id_pelanggan == $id->id_pelanggan ? 'selected' : '' }}>
                                                    {{ $p->nama_pelanggan }}
                                                </option>
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
                                            name="bulan" value="{{ $id->bulan }}">
                                            <option value="">- Pilih Bulan -</option>
                                            <option value="1" {{ $id->bulan == 1 ? 'selected' : '' }}>Januari</option>
                                            <option value="2" {{ $id->bulan == 2 ? 'selected' : '' }}>Februari</option>
                                            <option value="3" {{ $id->bulan == 3 ? 'selected' : '' }}>Maret</option>
                                            <option value="4" {{ $id->bulan == 4 ? 'selected' : '' }}>April</option>
                                            <option value="5" {{ $id->bulan == 5 ? 'selected' : '' }}>Mei</option>
                                            <option value="6" {{ $id->bulan == 6 ? 'selected' : '' }}>Juni</option>
                                            <option value="7" {{ $id->bulan == 7 ? 'selected' : '' }}>Juli</option>
                                            <option value="8" {{ $id->bulan == 8 ? 'selected' : '' }}>Agustus</option>
                                            <option value="9" {{ $id->bulan == 9 ? 'selected' : '' }}>September</option>
                                            <option value="10" {{ $id->bulan == 10 ? 'selected' : '' }}>Oktober</option>
                                            <option value="11" {{ $id->bulan == 11 ? 'selected' : '' }}>November</option>
                                            <option value="12" {{ $id->bulan == 12 ? 'selected' : '' }}>Desember</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-6">
                                    <label class="col-sm-2 col-form-label" for="tahun">Tahun</label>
                                    <div class="col-sm-10">
                                        <input type="year" class="form-control @error('tahun') is-invalid @enderror"
                                            id="tahun" name="tahun" value="{{ $id->tahun }}">
                                        @error('tahun')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-6">
                                    <label class="col-sm-2 col-form-label" for="meter_awal">Meter Awal</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control @error('meter_awal') is-invalid @enderror"
                                            id="meter_awal" name="meter_awal" value="{{ $id->meter_awal }}">
                                        @error('meter_awal')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-6">
                                    <label class="col-sm-2 col-form-label" for="meter_akhir">Meter Akhir</label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('meter_akhir') is-invalid @enderror" id="meter_akhir"
                                            name="meter_akhir" value="{{ $id->meter_akhir }}">
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
