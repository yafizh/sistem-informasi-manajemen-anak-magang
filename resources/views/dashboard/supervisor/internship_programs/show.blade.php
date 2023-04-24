@extends('dashboard.supervisor.layouts.dashboard')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold">Detail Kegiatan Magang</h4>

        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-pills flex-column flex-md-row mb-3">
                    <li class="nav-item">
                        <a class="nav-link active" href="javascript:void(0);">
                            <i class="bx bx-user me-1"></i> Periode Magang
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"
                            href="/supervisor/students/{{ $internship_program->id }}?student_status={{ request()->get('student_status') }}">
                            <i class="bx bx-link-alt me-1"></i>
                            Siswa/Mahasiswa
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"
                            href="/supervisor/students/{{ $internship_program->id }}/presences?student_status={{ request()->get('student_status') }}">
                            <i class="bx bx-link-alt me-1"></i>
                            Riwayat Presensi
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"
                            href="/supervisor/students/{{ $internship_program->id }}/presence-table?student_status={{ request()->get('student_status') }}">
                            <i class="bx bx-link-alt me-1"></i>
                            Tabel Presensi
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"
                            href="/supervisor/students/{{ $internship_program->id }}/evaluations?student_status={{ request()->get('student_status') }}">
                            <i class="bx bx-link-alt me-1"></i>
                            Penilaian
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
                            <div class="mb-3 col-md-12 d-flex justify-content-end">
                                <button class="btn btn-primary">Akhiri Kegiatan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
