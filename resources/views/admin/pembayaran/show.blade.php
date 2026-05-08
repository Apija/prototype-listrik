@extends('layout.main')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">

        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Pelanggan /</span> Detail Pelanggan
        </h4>

        <div class="row">

            {{-- CARD KIRI --}}
            <div class="col-xl-4 col-lg-5 col-md-5">
                <div class="card mb-4">
                    <div class="card-body">

                        <div class="user-avatar-section">
                            <div class="d-flex align-items-center flex-column">

                                <div class="bg-label-primary p-3 rounded-circle mb-3">
                                    <i class="bx bx-user bx-lg"></i>
                                </div>

                                <div class="user-info text-center">
                                    <h4 class="mb-2">
                                        {{ $pelanggan->nama_pelanggan }}
                                    </h4>

                                    <span class="badge bg-label-secondary text-uppercase">
                                        ID: {{ $pelanggan->id_pelanggan }}
                                    </span>
                                </div>

                            </div>
                        </div>

                        <div class="d-flex justify-content-around flex-wrap mt-4 py-3 border-top border-bottom">

                            <div class="d-flex align-items-start mt-3 gap-3">

                                <span class="badge bg-label-primary p-2 rounded">
                                    <i class="bx bx-bolt-circle bx-sm"></i>
                                </span>

                                <div>
                                    <h5 class="mb-0">
                                        {{ $pelanggan->tarif->daya ?? '-' }} VA
                                    </h5>
                                    <small>Daya Listrik</small>
                                </div>

                            </div>

                        </div>

                    </div>
                </div>
            </div>

            {{-- CARD KANAN --}}
            <div class="col-xl-8 col-lg-7 col-md-7">

                <div class="card mb-4">

                    <h5 class="card-header border-bottom">
                        Informasi Lengkap
                    </h5>

                    <div class="card-body mt-3">

                        {{-- Username --}}
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label fw-bold">
                                Username
                            </label>

                            <div class="col-sm-9">
                                <input type="text" readonly class="form-control-plaintext text-primary fw-bold"
                                    value="{{ $pelanggan->username }}">
                            </div>
                        </div>

                        {{-- Nama --}}
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label fw-bold">
                                Nama Pelanggan
                            </label>

                            <div class="col-sm-9">
                                <input type="text" readonly class="form-control-plaintext"
                                    value="{{ $pelanggan->nama_pelanggan }}">
                            </div>
                        </div>

                        {{-- Nomor KWH --}}
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label fw-bold">
                                Nomor KWH
                            </label>

                            <div class="col-sm-9">
                                <input type="text" readonly class="form-control-plaintext"
                                    value="{{ $pelanggan->nomor_kwh }}">
                            </div>
                        </div>

                        {{-- Alamat --}}
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label fw-bold">
                                Alamat Lengkap
                            </label>

                            <div class="col-sm-9">
                                <p class="form-control-plaintext">
                                    {{ $pelanggan->alamat }}
                                </p>
                            </div>
                        </div>

                        {{-- Tarif --}}
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label fw-bold">
                                Tarif / KWH
                            </label>

                            <div class="col-sm-9">
                                <span class="text-success fw-bold">
                                    Rp {{ number_format($pelanggan->tarif->tarif_per_kwh ?? 0, 0, ',', '.') }}
                                </span>
                            </div>
                        </div>

                        {{-- Daya --}}
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label fw-bold">
                                Daya
                            </label>

                            <div class="col-sm-9">
                                <span class="badge bg-label-primary">
                                    {{ $pelanggan->tarif->daya ?? '-' }} VA
                                </span>
                            </div>
                        </div>
                        {{-- Total Pembayaran --}}
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label fw-bold">
                                Total Pembayaran
                            </label>

                            <div class="col-sm-9">
                                <span class="text-success fw-bold">

                                    Rp {{ number_format($pelanggan->pembayaran->sum('total_bayar'), 0, ',', '.') }}

                                </span>
                            </div>
                        </div>

                        {{-- Tanggal Pembayaran Terakhir --}}
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label fw-bold">
                                Tgl Pembayaran
                            </label>

                            <div class="col-sm-9">

                                @if ($pelanggan->pembayaran->count() > 0)
                                    {{ $pelanggan->pembayaran->last()->tanggal_pembayaran }}
                                @else
                                    <span class="text-danger">
                                        Belum ada pembayaran
                                    </span>
                                @endif

                            </div>
                        </div>

                        <hr class="my-4">

                        {{-- BUTTON --}}
                        <div class="d-flex justify-content-end gap-2">

                            <a href="{{ route('admin.pelanggan.pelanggan') }}" class="btn btn-label-secondary">

                                <i class="bx bx-arrow-back me-1"></i>
                                Kembali
                            </a>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection