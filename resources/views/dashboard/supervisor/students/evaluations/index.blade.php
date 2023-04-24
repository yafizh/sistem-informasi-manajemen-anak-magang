@extends('dashboard.supervisor.layouts.dashboard')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold">Detail Kegiatan Magang</h4>

        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-pills flex-column flex-md-row mb-3">
                    <li class="nav-item">
                        <a class="nav-link"
                            href="/supervisor/internship-programs/{{ $internship_program->id }}?student_status={{ request()->get('student_status') }}">
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
                        <a class="nav-link active" href="javascript:void(0);">
                            <i class="bx bx-link-alt me-1"></i>
                            Penilaian
                        </a>
                    </li>
                </ul>
                <div class="card mb-4">
                    <div class="card-body">
                        @foreach ($internship_program->internshipStudents as $internshipStudent)
                            <div class="row">
                                <div class="mb-3 col-md-4">
                                    <img src="{{ asset('storage/' . $internshipStudent->student->photo) }}" class="w-100"
                                        style="object-fit: cover">
                                    <h5 class="text-center pt-3 mb-0">{{ $internshipStudent->student->id_number }}</h5>
                                    <h6 class="text-center mb-0 text-muted">{{ $internshipStudent->student->name }}</h6>
                                </div>
                                <div class="mb-3 col-md-8 row">
                                    <div class="mb-3 col-12 col-sm-6">
                                        <label class="form-label">Sikap</label>
                                        <input class="form-control text-center" type="number" disabled
                                            value="{{ $internshipStudent->evaluation->attitude ?? 0 }}" />
                                    </div>
                                    <div class="mb-3 col-12 col-sm-6">
                                        <label class="form-label">Disiplin</label>
                                        <input class="form-control text-center" type="number" disabled
                                            value="{{ $internshipStudent->evaluation->discipline ?? 0 }}" />
                                    </div>
                                    <div class="mb-3 col-12 col-sm-6">
                                        <label class="form-label">Ketekunan</label>
                                        <input class="form-control text-center" type="number" disabled
                                            value="{{ $internshipStudent->evaluation->diligence ?? 0 }}" />
                                    </div>
                                    <div class="mb-3 col-12 col-sm-6">
                                        <label class="form-label">Kerja Mandiri</label>
                                        <input class="form-control text-center" type="number" disabled
                                            value="{{ $internshipStudent->evaluation->independent_work ?? 0 }}" />
                                    </div>
                                    <div class="mb-3 col-12 col-sm-6">
                                        <label class="form-label">Kerja Sama</label>
                                        <input class="form-control text-center" type="number" disabled
                                            value="{{ $internshipStudent->evaluation->collaboration ?? 0 }}" />
                                    </div>
                                    <div class="mb-3 col-12 col-sm-6">
                                        <label class="form-label">Ketepatan</label>
                                        <input class="form-control text-center" type="number" disabled
                                            value="{{ $internshipStudent->evaluation->accuracy ?? 0 }}" />
                                    </div>
                                    <div class="mb-3 col-12 col-sm-6">
                                        <label class="form-label">Komunikasi</label>
                                        <input class="form-control text-center" type="number" disabled
                                            value="{{ $internshipStudent->evaluation->communication ?? 0 }}" />
                                    </div>
                                    <div class="mb-3 col-12 col-sm-6">
                                        <label class="form-label">Kreatifitas</label>
                                        <input class="form-control text-center" type="number" disabled
                                            value="{{ $internshipStudent->evaluation->creativity ?? 0 }}" />
                                    </div>
                                    <div class="mb-3 col-12">
                                        <label class="form-label">Nilai Rata-Rata</label>
                                        <input class="form-control text-center" type="number" disabled
                                            value="{{ $internshipStudent->evaluation->creativity ?? 0 }}" />
                                    </div>
                                    <div class="mb-3 col-12 justify-content-end d-flex">
                                        <a href="/supervisor/students/{{ $internship_program->id }}/evaluations/{{ $internshipStudent->id }}?student_status={{ $internship_program->student_status }}"
                                            class="btn btn-primary">Penilaian</a>
                                    </div>
                                </div>
                            </div>
                            <hr>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
