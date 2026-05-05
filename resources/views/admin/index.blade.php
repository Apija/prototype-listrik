@extends('layout.main2')

@section('content')
<style>
    .welcome-container {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .hello-card {
        text-align: center;
        padding: 3rem;
        background: white;
        border-radius: 2rem;
        box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
    }
    .hello-card:hover {
        transform: scale(1.05);
    }
    .display-1 {
        background: linear-gradient(to right, #667eea, #764ba2);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        font-weight: 900;
    }
</style>

<div class="welcome-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="hello-card">
                    <h1 class="display-1 mb-3">Hello, Admin!</h1>
                    <p class="lead text-secondary mb-4">
                        Selamat datang di aplikasi pembayaran listrik Anda. 
                        Sistem siap digunakan untuk memudahkan transaksi Anda.
                    </p>
                    <hr class="my-4" style="width: 50px; border-top: 3px solid #764ba2; margin: 0 auto;">
                    <div class="mt-4">
                        <a href="{{ url('/') }}" class="btn btn-primary btn-lg rounded-pill px-5 shadow">
                            Kembali ke Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection