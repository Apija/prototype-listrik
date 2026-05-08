@extends('layout.main2')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">

        {{-- 1. GREETING --}}
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="card bg-primary text-white shadow-none">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <h4 class="text-white mb-1">Halo, {{ Auth::guard('pelanggan')->user()->nama_pelanggan }}! 👋</h4>
                            <p class="mb-0">ID Pelanggan:
                                <strong>{{ Auth::guard('pelanggan')->user()->id_pelanggan }}</strong>
                            </p>
                        </div>
                        <i class="bx bx-bolt-circle bx-lg opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            {{-- 2. INFO TAGIHAN TERBARU --}}
            <div class="col-md-7 mb-4">
                <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="card-title m-0">Tagihan Terakhir</h5>
                        {{-- Menampilkan bulan dari data tagihan terbaru, bukan bulan sekarang --}}
                        <span class="badge bg-label-danger">
                            Bulan {{ date('F', mktime(0, 0, 0, $tagihanTerbaru->bulan, 10)) }}
                        </span>
                    </div>
                    <div class="card-body text-center py-4">
                        <p class="mb-1">Total yang harus dibayar:</p>

                        @if ($tagihanTerbaru && $tagihanTerbaru->status != 'Lunas')
                            <h2 class="text-danger fw-bold mb-3">
                                Rp {{ number_format($totalHarusDibayar, 0, ',', '.') }}
                            </h2>
                            <div class="alert alert-warning d-flex align-items-center justify-content-center"
                                role="alert">
                                <i class="bx bx-error me-2"></i> Segera lakukan pembayaran sebelum jatuh tempo.
                            </div>
                        @else
                            <h2 class="text-success fw-bold mb-3">Rp 0</h2>
                            <div class="alert alert-success d-flex align-items-center justify-content-center"
                                role="alert">
                                <i class="bx bx-check-circle me-2"></i> Semua tagihan sudah lunas!
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- 3. STATUS & RINGKASAN --}}
            <div class="col-md-5 mb-4">
                <div class="card h-100">
                    <div class="card-header">
                        <h5 class="card-title m-0">Info Penggunaan</h5>
                    </div>
                    <div class="card-body">
                        <ul class="p-0 m-0">
                            <li class="d-flex mb-4 pb-1">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-info"><i
                                            class="bx bx-tachometer"></i></span>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0">Meteran Terakhir</h6>
                                        <small class="text-muted">Pemakaian bulan ini</small>
                                    </div>
                                    <div class="user-progress">
                                        {{-- Ambil selisih meter dari tagihan terbaru --}}
                                        <small class="fw-bold">
                                            {{ ($tagihanTerbaru->penggunaan->meter_akhir ?? 0) - ($tagihanTerbaru->penggunaan->meter_awal ?? 0) }}
                                            kWh
                                        </small>
                                    </div>
                                </div>
                            </li>
                            <li class="d-flex">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-success"><i
                                            class="bx bx-badge-check"></i></span>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0">Status Akun</h6>
                                        <small class="text-muted">Daya Listrik</small>
                                    </div>
                                    <div class="user-progress">
                                        <small class="fw-bold">{{ Auth::guard('pelanggan')->user()->tarif->daya ?? '-' }}
                                            VA</small>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        {{-- 4. RIWAYAT TAGIHAN --}}
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <h5 class="card-header">Riwayat Tagihan</h5>
                    <div class="table-responsive text-nowrap">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Bulan/Tahun</th>
                                    <th>Meter Awal</th>
                                    <th>Meter Akhir</th>
                                    <th>Pemakaian</th>
                                    <th>Total Bayar</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach ($riwayatTagihan as $rt)
                                    @php
                                        // Hitung pemakaian per baris
                                        $pemakaian =
                                            ($rt->penggunaan->meter_akhir ?? 0) - ($rt->penggunaan->meter_awal ?? 0);
                                        // Hitung total bayar (mengambil tarif dari user login)
                                        $total_per_baris =
                                            $pemakaian * (Auth::guard('pelanggan')->user()->tarif->tarif_per_kwh ?? 0);
                                    @endphp
                                    <tr>
                                        <td><strong>{{ $rt->bulan }} / {{ $rt->tahun }}</strong></td>
                                        <td>{{ $rt->penggunaan->meter_awal ?? '-' }}</td>
                                        <td>{{ $rt->penggunaan->meter_akhir ?? '-' }}</td>
                                        <td>{{ $pemakaian }} kWh</td>
                                        {{-- Tampilkan hasil hitungan @php di atas --}}
                                        <td>Rp {{ number_format($total_per_baris, 0, ',', '.') }}</td>
                                        <td>
                                            @if ($rt->status == 'lunas')
                                                <span class="badge bg-label-success">Lunas</span>
                                            @else
                                                <span class="badge bg-label-danger">Belum Bayar</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
