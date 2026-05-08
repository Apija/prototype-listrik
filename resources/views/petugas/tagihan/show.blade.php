@extends('layout.main3')

@section('content')
<style>
    .detail-card { border: none; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); }
    .info-label { font-size: 0.85rem; color: #a1acb8; text-transform: uppercase; letter-spacing: 1px; }
    .info-value { font-weight: 600; color: #566a7f; }
    .status-badge { padding: 0.5rem 1rem; border-radius: 10px; font-weight: bold; }
</style>

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0">
            <span class="text-muted fw-light">Detail Tagihan /</span> #{{ $tagihan->id_tagihan }}
        </h4>
        <a href="{{ route('petugas.tagihan.tagihan') }}" class="btn btn-secondary">
            <i class="bx bx-chevron-left me-1"></i> Kembali
        </a>
    </div>

    <div class="row">
        <!-- Panel Profil Pelanggan -->
        <div class="col-md-4">
            <div class="card detail-card mb-4">
                <div class="card-body text-center pt-5">
                    <div class="avatar avatar-xl mx-auto mb-3">
                        <span class="avatar-initial rounded-circle bg-label-info">
                            <i class="bx bx-receipt fs-1"></i>
                        </span>
                    </div>
                    <h4 class="mb-1">{{ $tagihan->pelanggan->nama_pelanggan }}</h4>
                    <p class="text-muted small">ID Pelanggan: {{ $tagihan->id_pelanggan }}</p>
                    
                    <div class="mt-4">
                        <span class="status-badge {{ $tagihan->status == 'Lunas' ? 'bg-label-success' : 'bg-label-danger' }}">
                            {{ strtoupper($tagihan->status) }}
                        </span>
                    </div>

                    <div class="d-flex justify-content-center gap-3 mt-4">
                        <div class="bg-label-primary p-3 rounded w-50">
                            <h5 class="mb-0">{{ $tagihan->bulan }}</h5>
                            <small>{{ $tagihan->tahun }}</small>
                        </div>
                        <div class="bg-label-secondary p-3 rounded w-50">
                            <h5 class="mb-0">{{ $tagihan->jumlah_meter }}</h5>
                            <small>METER</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Panel Rincian Tagihan -->
        <div class="col-md-8">
            <div class="card detail-card">
                <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Rincian Penggunaan & Tagihan</h5>
                    <small class="text-muted">ID Penggunaan: #{{ $tagihan->id_penggunaan }}</small>
                </div>
                <div class="card-body pt-4">
                    <div class="row g-4">
                        <!-- Data Pelanggan -->
                        <div class="col-sm-6">
                            <label class="info-label d-block">Nama Pelanggan</label>
                            <span class="info-value">{{ $tagihan->pelanggan->nama_pelanggan }}</span>
                        </div>
                        <div class="col-sm-6">
                            <label class="info-label d-block">Nomor KWH</label>
                            <span class="info-value">{{ $tagihan->pelanggan->nomor_kwh }}</span>
                        </div>

                        <!-- Data Penggunaan -->
                        <div class="col-sm-6">
                            <label class="info-label d-block">Periode Tagihan</label>
                            <span class="info-value">{{ $tagihan->bulan }} {{ $tagihan->tahun }}</span>
                        </div>
                        <div class="col-sm-6">
                            <label class="info-label d-block">Pemakaian Meter</label>
                            <span class="info-value text-primary fs-5">{{ $tagihan->jumlah_meter }} kWh</span>
                        </div>

                        <div class="col-12">
                            <hr class="my-2">
                        </div>

                        <!-- Data Teknis -->
                        <div class="col-sm-6">
                            <label class="info-label d-block">Golongan Daya</label>
                            <span class="info-value">{{ $tagihan->pelanggan->tarif->daya ?? '-' }} VA</span>
                        </div>
                        <div class="col-sm-6">
                            <label class="info-label d-block">Tarif per kWh</label>
                            <span class="info-value">Rp {{ number_format($tagihan->pelanggan->tarif->tarif_per_kwh ?? 0, 0, ',', '.') }}</span>
                        </div>

                        <div class="col-12">
                            <label class="info-label d-block">Alamat Pemasangan</label>
                            <p class="info-value mb-0">{{ $tagihan->pelanggan->alamat }}</p>
                        </div>
                    </div>

                    @if($tagihan->status != 'Lunas')
                    <div class="mt-5">
                        <a href="{{ route('petugas.pembayaran.create', ['id' => $tagihan->id_tagihan]) }}" class="btn btn-success">
                            <i class="bx bx-wallet me-1"></i> Proses Pembayaran
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection