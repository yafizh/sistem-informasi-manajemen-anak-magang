@extends('dashboard.admin.layouts.dashboard')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold">Detail Kegiatan Magang</h4>

        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-pills flex-column flex-md-row mb-3">
                    <li class="nav-item">
                        <a class="nav-link"
                            href="/admin/internship-programs/{{ $internship_program->id }}?student_status={{ request()->get('student_status') }}">
                            <i class="bx bxs-calendar-week me-1"></i> Periode Magang
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="javascript:void(0);">
                            <i class="bx bxs-user-badge me-1"></i> Pembimbing
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"
                            href="/admin/internship-students/{{ $internship_program->id }}?student_status={{ request()->get('student_status') }}">
                            <i class="bx bxs-user-circle me-1"></i> Siswa/Mahasiswa
                        </a>
                    </li>
                </ul>
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-start align-items-sm-center gap-4">
                            <img src="{{ asset('storage/' . $internship_program->supervisor->photo) }}" alt="user-avatar"
                                class="d-block rounded" style="object-fit: cover;" height="100" width="100"
                                id="uploadedAvatar" />
                        </div>
                    </div>
                    <hr class="my-0" />
                    <div class="card-body">
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label">NIP</label>
                                <input class="form-control" type="text" disabled
                                    value="{{ $internship_program->supervisor->id_number }}" />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Nama</label>
                                <input class="form-control" type="text" disabled
                                    value="{{ $internship_program->supervisor->name }}" />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Nomor Telepon</label>
                                <input class="form-control" type="text" disabled
                                    value="{{ $internship_program->supervisor->phone_number }}" />
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label">Tempat Lahir</label>
                                <input class="form-control" type="text" disabled
                                    value="{{ $internship_program->supervisor->birth_place }}" />
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label">Tanggal Lahir</label>
                                <input class="form-control" type="text" disabled
                                    value="{{ $internship_program->supervisor->birth_date }}" />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Email</label>
                                <input class="form-control" type="text" disabled
                                    value="{{ $internship_program->supervisor->email }}" />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Jenis Kelamin</label>
                                <input class="form-control" type="text" disabled
                                    value="{{ $internship_program->supervisor->sex }}" />
                            </div>
                        </div>
                    </div>
                    <!-- /Account -->
                </div>
            </div>
        </div>
    </div>
@endsection
