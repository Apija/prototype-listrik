@extends('layout.main')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
                <!-- Basic Bootstrap Table -->
                <div class="card">
                    <h5 class="card-header">Tarif Listrik
                    </h5>
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="d-flex align-items-center gap-2" style="width: auto;">
                            <a href="{{ route('admin.tarif.create') }}" class="btn btn-primary text-nowrap">
                                Add Data
                            </a>

                        </div>
                    </div>
                    <div class="table-responsive text-nowrap">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Daya</th>
                                    <th>Tarif Per KWH</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach ($tarif as $t)
                                    <tr>
                                        <td>
                                            <i class="text-danger me-4"></i>
                                            <span>{{ $loop->iteration }}</span>
                                        </td>
                                        <td>{{ $t->daya }}</td>
                                        <td>{{ $t->tarif_per_kwh }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                    data-bs-toggle="dropdown">
                                                    <i class="icon-base bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="{{ route('admin.tarif.edit', $t->id_tarif) }}">
                                                        <i class="icon-base bx bx-edit-alt me-1"></i> Edit
                                                    </a>
                                                    <form id="delete-form-{{ $t->id_tarif }}"
                                                        action="{{ route('admin.tarif.delete', $t->id_tarif) }}" method="POST"
                                                        style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                    <a class="dropdown-item" href="javascript:void(0);"
                                                        onclick="event.preventDefault(); 
                                                        if (confirm('Yakin ingin menghapus data ini?')) {
                                                            document.getElementById('delete-form-{{ $t->id_tarif }}').submit();}"><i
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
            </div>
        @endsection
