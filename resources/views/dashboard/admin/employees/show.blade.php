@extends('dashboard.admin.layouts.dashboard')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold">Detail Pegawai</h4>

        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-pills flex-column flex-md-row mb-3">
                    <li class="nav-item">
                        <a class="nav-link active" href="javascript:void(0);"><i class="bx bx-user me-1"></i> Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="pages-account-settings-notifications.html"><i class="bx bx-bell me-1"></i>
                            #</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="pages-account-settings-connections.html"><i
                                class="bx bx-link-alt me-1"></i> #</a>
                    </li>
                </ul>
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-start align-items-sm-center gap-4">
                            <img src="{{ asset('storage/' . $employee->photo) }}" alt="user-avatar" class="d-block rounded"
                                height="100" width="100" id="uploadedAvatar" />
                        </div>
                    </div>
                    <hr class="my-0" />
                    <div class="card-body">
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label">NIP</label>
                                <input class="form-control" type="text" disabled value="{{ $employee->id_number }}" />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Nama</label>
                                <input class="form-control" type="text" disabled value="{{ $employee->name }}" />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Nomor Telepon</label>
                                <input class="form-control" type="text" disabled value="{{ $employee->phone_number }}" />
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label">Tempat Lahir</label>
                                <input class="form-control" type="text" disabled value="{{ $employee->birth_place }}" />
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label">Tanggal Lahir</label>
                                <input class="form-control" type="text" disabled value="{{ $employee->birth_date }}" />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Email</label>
                                <input class="form-control" type="text" disabled value="{{ $employee->email }}" />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Jenis Kelamin</label>
                                <input class="form-control" type="text" disabled value="{{ $employee->sex }}" />
                            </div>
                            <div class="col-12 d-flex justify-content-end gap-2">
                                <a href="/admin/employees/{{ $employee->id }}/edit" class="btn btn-warning">Edit</a>
                                <form action="/admin/employees/{{ $employee->id }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- /Account -->
                </div>
            </div>
        </div>
    </div>
@endsection
