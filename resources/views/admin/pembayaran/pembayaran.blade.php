@extends('layout.main')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="card">
                    <h5 class="card-header">Pembayaran Tagihan Listik</h5>
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="d-flex align-items-center gap-2" style="width: auto;">
                            <a href="{{ route('admin.pembayaran.create') }}" class="btn btn-primary text-nowrap">
                                Add Data
                            </a>

                        </div>
                    </div>
                    <div class="table-responsive text-nowrap">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Pelanggan</th>
                                    <th>No KWH</th>
                                    <th>Tanggal</th>
                                    <th>Bulan</th>
                                    <th>Total Tagihan</th>
                                    <th>Biaya Admin</th>
                                    <th>Total Bayar</th>
                                    <th>Nama Admin</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pembayaran as $pm)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $pm->tagihan->pelanggan->nama_pelanggan }}</td>
                                        <td>{{ $pm->tagihan->pelanggan->nomor_kwh }}</td>
                                        <td>{{ $pm->tgl_pembayaran }}</td>
                                        <td>{{ $pm->bulan_bayar }}</td>
                                        <td>Rp {{ number_format($pm->total_tagihan, 0, ',', '.') }}</td>
                                        <td>Rp {{ number_format($pm->biaya_admin, 0, ',', '.') }}</td>
                                        <td>Rp {{ number_format($pm->total_bayar, 0, ',', '.') }}</td>
                                        <td>{{ $pm->user->username ?? '-' }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                    data-bs-toggle="dropdown">
                                                    <i class="icon-base bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                bx bx-show
                                                <div class="dropdown-menu">

                                                    <form id="delete-form-{{ $pm->id_pembayaran }}"
                                                        action="{{ route('admin.penggunaan.delete', $pm->id_pembayaran) }}"
                                                        method="POST" style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                    <a class="dropdown-item" href="javascript:void(0);"
                                                        onclick="event.preventDefault(); 
                                                        if (confirm('Yakin ingin menghapus data ini?')) {
                                                            document.getElementById('delete-form-{{ $pm->id_pembayaran }}').submit();}"><i
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
