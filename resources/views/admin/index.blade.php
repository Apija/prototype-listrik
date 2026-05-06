@extends('layout.main')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">

        {{-- 1. HEADER WELCOME --}}
        <div class="card mb-4 border-0 shadow-sm">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="text-primary mb-0">Portal Admin Listrik ⚡</h4>
                    <p class="mb-0">Monitoring tagihan dan penggunaan energi pelanggan secara real-time.</p>
                </div>
                <div class="d-none d-md-block">
                    <span class="badge bg-label-warning px-3 py-2">
                        <i class="bx bx-bolt-circle me-1"></i> Sistem Aktif
                    </span>
                </div>
            </div>
        </div>

        {{-- 2. KARTU STATISTIK (PEMBAYARAN) --}}
        <div class="row mb-4">
            {{-- Tagihan Terbayar Bulan Ini --}}
            <div class="col-lg-6 col-md-6 col-12 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between">
                            <div class="content-left">
                                <span class="fw-bold text-muted">Pelunasan Tagihan ({{ date('F') }})</span>
                                <div class="d-flex align-items-end mt-2">
                                    {{--<h3 class="mb-0 me-2 text-success">Rp {{ number_format($totalBulanIni, 0, ',', '.') }}</h3>
                                    <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> Aktif</small> --}}
                                </div>
                                <small>Total penerimaan pembayaran bulan ini</small>
                            </div>
                            <div class="avatar">
                                <span class="avatar-initial rounded bg-label-success">
                                    <i class="bx bx-check-shield bx-sm"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Akumulasi Pendapatan Tahunan --}}
            <div class="col-lg-6 col-md-6 col-12 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between">
                            <div class="content-left">
                                <span class="fw-bold text-muted">Total Revenue Tahun {{ date('Y') }}</span>
                                <div class="d-flex align-items-end mt-2">
                                    {{-- <h3 class="mb-0 me-2 text-warning">Rp {{ number_format($totalTahunIni, 0, ',', '.') }}</h3>
                                    <small class="text-warning fw-semibold">Target: 85%</small> --}}
                                </div>
                                <small>Akumulasi dari seluruh ID pelanggan</small>
                            </div>
                            <div class="avatar">
                                <span class="avatar-initial rounded bg-label-warning">
                                    <i class="bx bx-bolt-circle bx-sm"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            {{-- 3. GRAFIK HARIAN (TREN PEMBAYARAN) --}}
            <div class="col-md-7 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center bg-transparent">
                        <h5 class="card-title m-0 text-dark font-weight-bold">📈 Tren Pembayaran Harian</h5>
                        <small class="text-muted">Periode {{ date('M Y') }}</small>
                    </div>
                    <div class="card-body">
                        <canvas id="dailyChart" style="max-height: 250px;"></canvas>
                    </div>
                </div>
            </div>

            {{-- 4. GRAFIK TAHUNAN (ANALISIS PENDAPATAN) --}}
            <div class="col-md-5 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-header bg-transparent">
                        <h5 class="card-title m-0 text-dark font-weight-bold">📊 Rekapitulasi Bulanan</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="monthlyChart" style="max-height: 250px;"></canvas>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection