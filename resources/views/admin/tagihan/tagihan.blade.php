@extends('layout.main')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="card">
                    <h5 class="card-header">Data Tagihan Listrik
                    </h5>
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="d-flex align-items-center gap-2" style="width: auto;">
                            <a href="{{ route('admin.tagihan.generate') }}" class="btn btn-primary text-nowrap">
                                Generate Tagihan
                            </a>

                        </div>
                    </div>
                    <div class="table-responsive text-nowrap">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Pelanggan</th>
                                    <th>Nomor KWH</th>
                                    <th>Bulan</th>
                                    <th>Tahun</th>
                                    <th>Jumlah Meter</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tagihan as $tg)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $tg->pelanggan->nama_pelanggan }}</td>
                                        <td>{{ $tg->pelanggan->nomor_kwh }}</td>

                                        {{-- Bulan (ubah ke nama) --}}
                                        <td>
                                            {{ \Carbon\Carbon::create()->month($tg->bulan)->translatedFormat('F') }}
                                        </td>

                                        <td>{{ $tg->tahun }}</td>
                                        <td>{{ $tg->jumlah_meter }}</td>
                                        {{-- Status --}}
                                        <td>
                                            <div class="dropdown">
                                                <button type="button"
                                                    class="btn btn-sm btn-outline-primary dropdown-toggle"
                                                    data-bs-toggle="dropdown">
                                                    {{ $tg->status }}
                                                </button>

                                                <div class="dropdown-menu">

                                                    <form action="{{ route('admin.tagihan.updateStatus', $tg->id_tagihan) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="status_pembayaran" value="Belum Lunas">
                                                        <button type="submit" class="dropdown-item">
                                                            <i class="bx bx-x-circle me-1 text-primary"></i> Belum Lunas
                                                        </button>
                                                    </form>
                                                    <form action="{{ route('admin.tagihan.updateStatus', $tg->id_tagihan) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="status_pembayaran" value="Lunas">
                                                        <button type="submit" class="dropdown-item">
                                                            <i class="bx bx-loader-circle me-1 text-warning"></i> Lunas
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                    data-bs-toggle="dropdown">
                                                    <i class="icon-base bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <form id="delete-form-{{ $tg->id_tagihan }}"
                                                        action="{{ route('admin.penggunaan.delete', $tg->id_tagihan) }}"
                                                        method="POST" style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                    <a class="dropdown-item" href="javascript:void(0);"
                                                        onclick="event.preventDefault(); 
                                                        if (confirm('Yakin ingin menghapus data ini?')) {
                                                            document.getElementById('delete-form-{{ $tg->id_tagihan }}').submit();}"><i
                                                            class="icon-base bx bx-trash me-1"></i> Delete</a>
                                                </div>
                                            </div>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Tambahkan bagian dashboard lainnya --}}
            </div>
        </div>
    </div>
@endsection
