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
                            <h5 class="mb-0">Edit Tarif</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.tarif.update', $id->id_tarif) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row mb-6">
                                    <label class="col-sm-2 col-form-label" for="daya">Daya</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control @error('daya') is-invalid @enderror"
                                            id="daya" name="daya" value="{{ $id->daya }}">
                                        @error('daya')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-6">
                                    <label class="col-sm-2 col-form-label" for="tarif_per_kwh">Tarif Per KWH</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control @error('tarif_per_kwh') is-invalid @enderror"
                                            id="tarif_per_kwh" name="tarif_per_kwh" value="{{ $id->tarif_per_kwh }}" step="0.01">
                                        @error('tarif_per_kwh')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row justify-content-end">
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary">Send</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endsection
