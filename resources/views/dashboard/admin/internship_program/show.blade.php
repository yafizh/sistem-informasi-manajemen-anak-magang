@extends('dashboard.admin.layouts.dashboard')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold">Detail Kegiatan Magang</h4>

        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-pills flex-column flex-md-row mb-3">
                    <li class="nav-item">
                        <a class="nav-link active" href="javascript:void(0);">
                            <i class="bx bxs-calendar-week me-1"></i> Periode Magang
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"
                            href="/admin/internship-programs/{{ $internship_program->id }}/supervisor?student_status={{ request()->get('student_status') }}">
                            <i class="bx bxs-user-badge me-1"></i> Pembimbing
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"
                            href="/admin/internship-students/{{ $internship_program->id }}?student_status={{ request()->get('student_status') }}">
                            @if (request()->get('student_status') == 1)
                                <i class="bx bxs-user-circle me-1"></i> Siswa
                            @else
                                <i class="bx bxs-graduation me-1"></i> Mahasiswa
                            @endif
                        </a>
                    </li>
                </ul>
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Tanggal Mulai</label>
                                <input class="form-control" type="text" disabled
                                    value="{{ $internship_program->start_date }}" />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Tanggal Selesai</label>
                                <input class="form-control" type="text" disabled
                                    value="{{ $internship_program->end_date }}" />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label d-block">Status</label>
                                @if ($internship_program->internship_status == 2)
                                    <span class="badge bg-label-success me-1">Selesai</span>
                                @elseif ($internship_program->internship_status == 1)
                                    <span class="badge bg-label-info me-1">Sedang Berjalan</span>
                                @endif
                            </div>
                            @if ($internship_program->internship_status == 1)
                                <div class="mb-3 col-md-12 d-flex justify-content-end">
                                    <a href="/admin/internship-programs/{{ $internship_program->id }}/done"
                                        class="btn btn-primary">Akhiri Kegiatan</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
