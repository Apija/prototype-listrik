@extends('layout.loginmain')

@section('content')
<style>
    /* Style yang lebih simpel dan profesional untuk Admin */
    .bg-admin {
        background-color: #f8f9fa; /* Abu-abu sangat muda khas dashboard admin */
        min-height: 100vh;
        display: flex;
        align-items: center;
    }

    .card-admin {
        border: none;
        border-top: 4px solid #344767; /* Aksen garis tebal di atas untuk kesan kokoh */
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        border-radius: 0.75rem;
    }

    .btn-admin {
        background-color: #344767;
        color: white;
        font-weight: 600;
        border-radius: 0.5rem;
        padding: 10px;
        transition: all 0.2s;
    }

    .btn-admin:hover {
        background-color: #25334d;
        color: white;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }

    .form-control-admin {
        border-radius: 0.5rem;
        border: 1px solid #d2d6da;
        font-size: 0.9rem;
    }

    .form-control-admin:focus {
        border-color: #344767;
        box-shadow: none;
    }
</style>

<main class="main-content mt-0">
    <div class="bg-admin">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-4 col-lg-5 col-md-7">
                    <div class="card card-admin">
                        <div class="card-header pb-0 text-start bg-white border-0 pt-4">
                            <h4 class="font-weight-bolder text-dark">Admin Login</h4>
                            <p class="mb-0 text-sm text-muted">Masuk ke panel kontrol sistem</p>
                        </div>
                        
                        <div class="card-body">
                            <form action="{{ route('login.proses') }}" method="post" role="form">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label text-xs font-weight-bold">Username</label>
                                    <input type="text" name="username" class="form-control form-control-admin" 
                                           placeholder="username" required autofocus>
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label text-xs font-weight-bold">Password</label>
                                    <input type="password" name="password" class="form-control form-control-admin" 
                                           placeholder="••••••••" required>
                                </div>

                                <button type="submit" class="btn btn-admin w-100 mb-2">
                                    Masuk Ke Panel <i class="fas fa-sign-in-alt ms-1"></i>
                                </button>
                            </form>
                        </div>
                        
                        <div class="card-footer text-center border-0 pt-0 pb-4">
                            <p class="text-xs text-muted">
                                &copy; {{ date('Y') }} Sistem E-Lis v1.0
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection