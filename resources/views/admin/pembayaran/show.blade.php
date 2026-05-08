@extends('layout.main')

@section('content')
<style>
    /* Custom style tipis-tipis biar nggak standar banget */
    .detail-card { border: none; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); }
    .info-label { font-size: 0.85rem; color: #a1acb8; text-transform: uppercase; letter-spacing: 1px; }
    .info-value { font-weight: 600; color: #566a7f; }
    .receipt-line { border-style: dashed; border-color: #d9dee3; }
</style>

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0">
            <span class="text-muted fw-light">Transaksi /</span> #{{ $pembayaran->id_pembayaran }}
        </h4>
        <!--<button onclick="window.print()" class="btn btn-outline-primary">-->
            <!--<i class="bx bx-printer me-1"></i> Print Receipt-->
        <!--</button>-->
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
                    <h4 class="mb-1">{{ $pembayaran->tagihan->pelanggan->nama_pelanggan }}</h4>
                    <p class="text-muted small">ID: {{ $pembayaran->tagihan->pelanggan->username }}</p>
                    
                    <div class="d-flex justify-content-center gap-3 mt-4">
                        <div class="bg-label-info p-2 rounded w-50">
                            <h5 class="mb-0">{{ $pembayaran->tagihan->pelanggan->tarif->daya }}</h5>
                            <small>VA</small>
                        </div>
                        <div class="bg-label-secondary p-2 rounded w-50">
                            <h5 class="mb-0">KWH</h5>
                            <small>{{ $pembayaran->tagihan->pelanggan->nomor_kwh }}</small>
                        </div>
                    </div>
                </div>
                <div class="card-body border-top">
                    <div class="mb-3">
                        <label class="info-label d-block">Alamat Pengiriman Tagihan</label>
                        <span class="info-value">{{ $pembayaran->tagihan->pelanggan->alamat }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Panel Rincian Pembayaran -->
        <div class="col-md-8">
            <div class="card detail-card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Invoice Details</h5>
                    <span class="badge bg-label-success">PAID</span>
                </div>
                <div class="card-body mt-2">
                    <div class="row mb-4">
                        <div class="col-sm-6">
                            <label class="info-label">Admin Pemroses</label>
                            <p class="info-value text-primary">{{ $pembayaran->user->nama_admin }}</p>
                        </div>
                        <div class="col-sm-6 text-sm-end">
                            <label class="info-label">Tanggal Bayar</label>
                            <p class="info-value">{{ \Carbon\Carbon::parse($pembayaran->tgl_pembayaran)->format('d M Y, H:i') }}</p>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <thead class="border-bottom">
                                <tr>
                                    <th class="ps-0">Deskripsi Layanan</th>
                                    <th class="text-end">Bulan</th>
                                    <th class="text-end pe-0">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="ps-0">
                                        <span class="fw-bold d-block">Tagihan Listrik Pascabayar</span>
                                        <small class="text-muted">Tarif: Rp {{ number_format($pembayaran->tagihan->pelanggan->tarif->tarif_per_kwh) }}/KWH</small>
                                    </td>
                                    <td class="text-end text-uppercase">{{ $pembayaran->bulan_bayar }}</td>
                                    <td class="text-end pe-0 fw-bold">Rp {{ number_format($pembayaran->total_tagihan) }}</td>
                                </tr>
                                <tr>
                                    <td class="ps-0">Biaya Administrasi</td>
                                    <td class="text-end">-</td>
                                    <td class="text-end pe-0 fw-bold">Rp {{ number_format($pembayaran->biaya_admin) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <hr class="receipt-line my-4">

                    <div class="row justify-content-end">
                        <div class="col-md-5">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="fw-semibold">Total Pembayaran</span>
                                <span class="fw-bold text-success fs-5">Rp {{ number_format($pembayaran->total_bayar) }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="mt-5 d-flex justify-content-start gap-2 d-print-none">
                        <a href="{{ route('admin.pembayaran.pembayaran') }}" class="btn btn-label-secondary">
                            <i class="bx bx-chevron-left"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection