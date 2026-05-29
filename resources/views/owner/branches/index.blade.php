@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h3>Monitoring Cabang</h3>
            <small class="text-muted">Owner Panel - Semua Cabang Akademi</small>
        </div>

        <!-- BUTTON TAMBAH -->
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
            <i class="bi bi-plus"></i> Tambah Cabang
        </button>
    </div>

    {{-- STAT --}}
    <div class="row g-3 mb-4">

        <div class="col-md-4">
            <div class="card p-3">
                <h6>Total Cabang</h6>
                <h3>{{ $total }}</h3>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-3">
                <h6>Cabang Aktif</h6>
                <h3>{{ $active }}</h3>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-3">
                <h6>Total Siswa Semua Cabang</h6>
                <h3>{{ $students }}</h3>
            </div>
        </div>

    </div>

    {{-- TABLE --}}
    <div class="card">
        <div class="card-body table-responsive">

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nama Cabang</th>
                        <th>Kota</th>
                        <th>Siswa</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($branches as $branch)
                        <tr>
                            <td>{{ $branch->name }}</td>
                            <td>{{ $branch->city }}</td>
                            <td>{{ $branch->students->count() }}</td>
                            <td>
                                <span class="badge bg-{{ $branch->status == 'active' ? 'success' : 'danger' }}">
                                    {{ $branch->status }}
                                </span>
                            </td>

                            <td class="d-flex gap-2">

                                <!-- EDIT -->
                                <button class="btn btn-sm btn-warning"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editModal{{ $branch->id }}">
                                    Edit
                                </button>

                                <!-- DELETE -->
                              <form method="POST" action="{{ route('owner.branches.destroy', $branch->id) }}" onsubmit="return confirm('Hapus cabang ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Hapus</button>
                                </form>

                            </td>
                        </tr>

                        <!-- EDIT MODAL -->
                        <div class="modal fade" id="editModal{{ $branch->id }}">
                            <div class="modal-dialog">
                                <div class="modal-content p-3">

                                    <form method="POST" action="{{ route('owner.branches.update', $branch->id) }}">
                                        @csrf
                                        @method('PUT')

                                        <input class="form-control mb-2" name="name" value="{{ $branch->name }}">
                                        <input class="form-control mb-2" name="city" value="{{ $branch->city }}">

                                        <select name="status" class="form-control mb-2">
                                            <option value="active" {{ $branch->status=='active'?'selected':'' }}>Active</option>
                                            <option value="inactive">Inactive</option>
                                        </select>

                                        <button class="btn btn-success w-100">Update</button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>

</div>

<!-- ADD MODAL -->
<div class="modal fade" id="addModal">
    <div class="modal-dialog">
        <div class="modal-content p-3">

            <form method="POST" action="{{ route('owner.branches.store') }}">
                @csrf

                <input class="form-control mb-2" name="name" placeholder="Nama Cabang">
                <input class="form-control mb-2" name="city" placeholder="Kota">

                <button class="btn btn-primary w-100">Simpan</button>
            </form>

        </div>
    </div>
</div>

@endsection