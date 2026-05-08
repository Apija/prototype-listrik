@extends('layout.main2')

@section('content')
    @php
        $user = Auth::guard('pelanggan')->user();
    @endphp

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-12">
                {{-- HEADER / COVER --}}
                <div class="card mb-4">
                    <div class="user-profile-header-banner">
                        {{-- Banner warna solid atau gradient agar estetik --}}
                        <div
                            style="height: 150px; background: linear-gradient(to right, #696cff, #a8aaff); border-radius: 8px 8px 0 0;">
                        </div>
                    </div>
                    <div
                        class="user-profile-header d-flex flex-column flex-sm-row align-items-sm-end align-items-center mb-4">
                        <div class="flex-shrink-0 mt-n5 ms-sm-4 zindex-1">
                            <div class="avatar avatar-xl border border-5 border-white rounded-circle bg-white shadow"
                                style="width: 120px; height: 120px;">
                                <div
                                    class="bg-label-primary p-2 h-100 d-flex align-items-center justify-content-center rounded-circle">
                                    <i class="bx bx-user" style="font-size: 60px;"></i>
                                </div>
                            </div>
                        </div>
                        <div class="flex-grow-1 mt-3 mt-sm-5 ms-3">
                            <div
                                class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start gap-4 flex-wrap">
                                <div class="user-profile-info">
                                    <h4 class="mb-1 fw-bold">{{ $user?->nama_pelanggan ?? '-' }}</h4>
                                    <ul
                                        class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-3">
                                        <li class="list-inline-item fw-medium">
                                            <i class='bx bx-id-card'></i> ID: {{ $user?->id_pelanggan ?? '-' }}
                                        </li>
                                        <li class="list-inline-item fw-medium text-primary">
                                            <i class='bx bx-bolt-circle'></i> {{ $user?->tarif?->daya ?? '-' }} VA
                                        </li>
                                    </ul>
                                </div>
                                <div class="me-4 mb-1">
                                    <span class="badge bg-label-success">Status: Aktif</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            {{-- SISI KIRI: Info Utama --}}
            <div class="col-xl-8 col-lg-7 col-md-7">
                <div class="card mb-4 shadow-sm border-0">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0"><i class="bx bx-detail me-2"></i>Informasi Akun</h5>
                    </div>
                    <div class="card-body mt-2">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label text-uppercase small fw-bold">Username</label>
                                <div class="form-control bg-light border-0 py-2">{{ $user?->username ?? '-' }}</div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-uppercase small fw-bold">Nomor KWH</label>
                                <div class="form-control bg-light border-0 py-2 font-monospace">
                                    {{ $user?->nomor_kwh ?? '-' }}</div>
                            </div>
                            <div class="col-12 mt-4">
                                <label class="form-label text-uppercase small fw-bold">Alamat Terdaftar</label>
                                <div class="form-control bg-light border-0 py-3">
                                    <i class="bx bx-map me-1 text-danger"></i> {{ $user?->alamat ?? '-' }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- SISI KANAN: Keamanan & Info Tarif --}}
            <div class="col-xl-4 col-lg-5 col-md-5">
                {{-- Info Tarif --}}
                <div class="card mb-4 border-0 shadow-sm bg-label-primary">
                    <div class="card-body">
                        <h6 class="fw-bold mb-3">Detail Tarif</h6>
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span>Golongan Daya</span>
                            <span class="fw-bold">{{ $user?->tarif?->daya ?? '-' }} VA</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-0">
                            <span>Biaya per KWh</span>
                            <span class="fw-bold text-primary">Rp
                                {{ number_format($user?->tarif?->tarif_per_kwh ?? 0, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>

                {{-- Keamanan --}}
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="avatar flex-shrink-0 me-3">
                                <span class="avatar-initial rounded bg-label-warning"><i
                                        class="bx bx-shield-quarter"></i></span>
                            </div>
                            <div>
                                <h6 class="mb-0">Keamanan</h6>
                                <small class="text-muted">Kelola password Anda</small>
                            </div>
                        </div>
                        <p class="small text-muted mb-3">Sangat disarankan untuk mengganti password secara berkala untuk
                            menjaga keamanan akun.</p>
                        <a href="#" class="btn btn-primary w-100 btn-sm">
                            <i class="bx bx-lock-open-alt me-1"></i> Ubah Password
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Tambahan agar avatar "nangkring" di atas banner */
        .mt-n5 {
            margin-top: -60px !important;
        }

        .zindex-1 {
            z-index: 1;
        }

        .bg-light {
            background-color: #f8f9fa !important;
        }
    </style>
@endsection
