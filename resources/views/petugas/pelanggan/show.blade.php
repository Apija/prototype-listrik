@extends('layout.main3')

@section('content')
<style>
    /* Custom style tipis-tipis biar nggak standar banget */
    .detail-card { border: none; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); }
    .info-label { font-size: 0.85rem; color: #a1acb8; text-transform: uppercase; letter-spacing: 1px; }
    .info-value { font-weight: 600; color: #566a7f; }
</style>

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0">
            <span class="text-muted fw-light">Data Pelanggan /</span> Detail #{{ $pelanggan->username }}
        </h4>
        <a href="{{ route('petugas.pelanggan.pelanggan') }}" class="btn btn-secondary">
            <i class="bx bx-chevron-left me-1"></i> Kembali
        </a>
    </div>

    <div class="row">
        <!-- Panel Profil Pelanggan -->
        <div class="col-md-4">
            <div class="card detail-card mb-4">
                <div class="card-body text-center pt-5">
                    <div class="avatar avatar-xl mx-auto mb-3">
                        <span class="avatar-initial rounded-circle bg-label-primary">
                            <i class="bx bx-user fs-1"></i>
                        </span>
                    </div>
                    <!-- Field: nama_pelanggan -->
                    <h4 class="mb-1">{{ $pelanggan->nama_pelanggan }}</h4>
                    <!-- Field: username -->
                    <p class="text-muted small">ID Akun: {{ $pelanggan->username }}</p>
                    
                    <div class="d-flex justify-content-center gap-3 mt-4">
                        <div class="bg-label-info p-3 rounded w-50">
                            <!-- Relasi: id_tarif -> daya -->
                            <h5 class="mb-0">{{ $pelanggan->tarif->daya ?? '-' }}</h5>
                            <small>VA</small>
                        </div>
                        <div class="bg-label-secondary p-3 rounded w-50">
                            <!-- Field: nomor_kwh -->
                            <h5 class="mb-0">KWH</h5>
                            <small>{{ $pelanggan->nomor_kwh }}</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Panel Informasi Lengkap -->
        <div class="col-md-8">
            <div class="card detail-card">
                <div class="card-header border-bottom">
                    <h5 class="mb-0">Informasi Lengkap Pelanggan</h5>
                </div>
                <div class="card-body pt-4">
                    <div class="row g-4">
                        <div class="col-sm-6">
                            <label class="info-label d-block">Nama Lengkap</label>
                            <span class="info-value fs-5">{{ $pelanggan->nama_pelanggan }}</span>
                        </div>
                        <div class="col-sm-6">
                            <label class="info-label d-block">Nomor Meteran (KWH)</label>
                            <span class="info-value fs-5">{{ $pelanggan->nomor_kwh }}</span>
                        </div>
                        <div class="col-sm-6">
                            <label class="info-label d-block">Username Sistem</label>
                            <span class="info-value">{{ $pelanggan->username }}</span>
                        </div>
                        <div class="col-sm-6">
                            <label class="info-label d-block">Golongan Tarif (ID)</label>
                            <span class="info-value">{{ $pelanggan->id_tarif }} - {{ $pelanggan->tarif->tarif_per_kwh ?? '' }}/Kwh</span>
                        </div>
                        <div class="col-12">
                            <hr class="my-2">
                        </div>
                        <div class="col-12">
                            <label class="info-label d-block">Alamat Lengkap</label>
                            <!-- Field: alamat -->
                            <p class="info-value mb-0">{{ $pelanggan->alamat }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection