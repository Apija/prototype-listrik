@extends('layout.main')
@section('content')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <!-- Basic Layout & Basic with Icons -->
            <div class="row mb-6 gy-6">
                <!-- Basic Layout -->
                <div class="col-xxl">
                    <div class="card">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">Tambah Pembayaran</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.pembayaran.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                {{-- pilih pelanggan --}}
                                <div class="row mb-6">
                                    <label class="col-sm-2 col-form-label" for="id_tarif">Nama Pelanggan</label>
                                    <div class="col-sm-10">
                                        <select class="form-control @error('id_tagihan') is-invalid @enderror"
                                            id="tagihanSelect" name="id_tagihan">

                                            <option value="">- Pilih Pelanggan -</option>

                                            @foreach ($tagihan as $tg)
                                                <option value="{{ $tg->id_tagihan }}"
                                                    data-pelanggan="{{ $tg->id_pelanggan }}"
                                                    data-total="{{ $tg->total_bayar }}">

                                                    {{ $tg->pelanggan->nama_pelanggan }}

                                                </option>
                                            @endforeach
                                        </select>
                                        @error('id_tagihan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        @error('id_tarif')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-6">
                                    <label class="col-sm-2 col-form-label" for="id_user">Admin </label>
                                    <div class="col-sm-10">
                                        <select class="form-control @error('id_user') is-invalid @enderror" id="id_user"
                                            name="id_user" value="{{ old('id_user') }}">
                                            <option>- Pilih Nama Admin -</option>
                                            @foreach ($users as $u)
                                                <option value="{{ $u->id_user }}">
                                                    {{ $u->nama_admin }}</option>
                                            @endforeach
                                        </select>
                                        @error('id_user')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                {{-- hidden id pelanggan --}}
                                <input type="hidden" name="id_pelanggan" id="id_pelanggan">
                                {{-- biaya admin --}}
                                <div class="row mb-6">
                                    <label class="col-sm-2 col-form-label">Biaya Admin</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" value="Rp 2.500" readonly>
                                    </div>
                                </div>
                                <div class="row justify-content-end">
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary">Send</button>
                                    </div>
                                </div>
                                {{-- Total Pembayaran --}}
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label fw-bold">
                                        Total Pembayaran
                                    </label>
                                    <div class="col-sm-9">
                                        <span class="text-success fw-bold">

                                            Rp {{ number_format($pembayaran->sum('total_bayar'), 0, ',', '.') }}

                                        </span>
                                    </div>
                                </div>

                                {{-- Tanggal Pembayaran Terakhir --}}
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label fw-bold">
                                        Tanggal Pembayaran
                                    </label>

                                    <div class="col-sm-9">

                                        @if ($pembayaran->count() > 0)
                                            {{ $pembayaran->last()->tgl_pembayaran }}
                                        @else
                                            <span class="text-danger">
                                                Belum ada pembayaran
                                            </span>
                                        @endif

                                    </div>
                                </div>
                            </form>
                            <script>
                                const select = document.getElementById('tagihanSelect');

                                select.addEventListener('change', function() {

                                    const selected = this.options[this.selectedIndex];

                                    const total = parseInt(selected.dataset.total || 0);
                                    const pelanggan = selected.dataset.pelanggan;

                                    const admin = 2500;
                                    const total_bayar = total + admin;

                                    document.getElementById('id_pelanggan').value = pelanggan;

                                    document.getElementById('total_tagihan').value =
                                        'Rp ' + total.toLocaleString('id-ID');

                                    document.getElementById('total_bayar').value =
                                        'Rp ' + total_bayar.toLocaleString('id-ID');
                                });
                            </script>
                        </div>
                    </div>
                </div>
            @endsection
