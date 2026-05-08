@extends('layout.loginmain')

@section('content')
    <style>
        /* Custom CSS untuk memperkecil/mempercantik tampilan */
        .bg-gradient-login {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            position: relative;
            overflow: hidden;
        }

        /* Dekorasi Lingkaran di Background */
        .bg-circle {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            z-index: 0;
        }

        /* Styling Kartu Login dengan efek Glassmorphism */
        .card-login {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.95);
            border: none;
            border-radius: 1.5rem;
            transition: transform 0.3s ease;
        }

        /* Efek hover untuk mengangkat kartu */
        .card-login:hover {
            transform: translateY(-5px);
        }

        /* Styling elemen input form */
        .form-control {
            border-radius: 0.8rem;
            padding: 12px 15px;
            border: 1px solid #d2d6da;
            transition: all 0.2s ease;
        }

        /* Efek fokus pada input form */
        .form-control:focus {
            border-color: #764ba2;
            box-shadow: 0 0 0 3px rgba(118, 75, 162, 0.2);
        }

        /* Styling tombol login dengan gradient */
        .btn-login {
            background: linear-gradient(310deg, #764ba2 0%, #667eea 100%);
            border: none;
            border-radius: 0.8rem;
            padding: 12px;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
        }

        /* Efek bayangan dan scaling pada tombol saat hover */
        .btn-login:hover {
            box-shadow: 0 7px 14px rgba(0, 0, 0, 0.1), 0 3px 6px rgba(0, 0, 0, 0.08);
            transform: scale(1.02);
        }

        /* Pengaturan posisi ikon dalam input */
        .icon-input {
            position: absolute;
            right: 15px;
            top: 38px;
            color: #adb5bd;
        }
    </style>

    <main class="main-content mt-0">
        <!-- Section Header dengan Background Gradient -->
        <div class="page-header min-vh-100 bg-gradient-login">
            <!-- Dekorasi Elemen Visual (Lingkaran) -->
            <div class="bg-circle" style="width: 300px; height: 300px; top: -50px; left: -50px;"></div>
            <div class="bg-circle" style="width: 200px; height: 200px; bottom: -50px; right: -50px;"></div>

            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-4 col-lg-5 col-md-7">
                        <!-- Kartu Utama Form Login -->
                        <div class="card card-login shadow-2xl z-index-1">
                            <!-- Header Kartu: Judul dan Deskripsi -->
                            <div class="card-header pb-0 text-center pt-5 bg-transparent">
                                <h3 class="font-weight-bolder text-dark">E-Lis</h3>
                                <p class="mb-0 text-muted font-weight-bold">Portal Pembayaran Listrik</p>
                                <small class="text-secondary">Silakan login dengan Username Pelanggan Anda</small>
                            </div>

                            <div class="card-body px-4 pt-4">
                                <!-- Form Login -->
                                <form action="{{ route('pelanggan.login.autheticate') }}" method="post" role="form">
                                    @csrf <!-- Token Keamanan Laravel -->
                                    
                                    <!-- Input Username / ID Pelanggan -->
                                    <div class="mb-3 position-relative">
                                        <label class="form-label text-uppercase text-xs font-weight-bolder opacity-7 ps-2">
                                            Username Pelanggan
                                        </label>
                                        <input type="text" name="username" class="form-control"
                                            placeholder="521XXXXXXXXX" aria-label="ID Pelanggan" autocomplete="off"
                                            required>
                                    </div>

                                    <!-- Input Password -->
                                    <div class="mb-3 position-relative">
                                        <label class="form-label text-uppercase text-xs font-weight-bolder opacity-7 ps-2">
                                            PASSWORD
                                        </label>
                                        <input type="password" name="password" class="form-control" placeholder="••••••"
                                            aria-label="Password" required>
                                    </div>

                                    <!-- Tombol Submit -->
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-login text-white w-100 mt-4 mb-3">
                                            Cek Tagihan Sekarang <i class="fas fa-arrow-right ms-2"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- Akhir Kartu Login -->
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection