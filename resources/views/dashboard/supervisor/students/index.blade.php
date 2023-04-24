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
                            <i class="bx bx-calendar me-1"></i> Periode Magang
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="javascript:void(0);">
                            @if (request()->get('student_status') == 1)
                                <i class="bx bxs-user-circle me-1"></i> Siswa
                            @else
                                <i class="bx bxs-graduation me-1"></i> Mahasiswa
                            @endif
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"
                            href="/supervisor/students/{{ $internship_program->id }}/presences?student_status={{ request()->get('student_status') }}">
                            <i class="bx bx-spreadsheet me-1"></i> Riwayat Presensi
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"
                            href="/supervisor/students/{{ $internship_program->id }}/presence-table?student_status={{ request()->get('student_status') }}">
                            <i class="bx bx-table me-1"></i> Tabel Presensi
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"
                            href="/supervisor/students/{{ $internship_program->id }}/evaluations?student_status={{ request()->get('student_status') }}">
                            <i class="bx bx-id-card me-1"></i> Penilaian
                        </a>
                    </li>
                </ul>
                <div class="card mb-4">
                    <div class="card-body">
                        @foreach ($internship_program->students as $student)
                            <div class="row">
                                <div class="mb-3 col-md-4">
                                    <img src="{{ asset('storage/' . $student->photo) }}" class="w-100"
                                        style="object-fit: cover">
                                </div>
                                <div class="mb-3 col-md-8">
                                    <div class="mb-3">
                                        @if (request()->get('student_status') == 1)
                                            <label class="form-label">NIS/NISN</label>
                                        @else
                                            <label class="form-label">NIM/NPM</label>
                                        @endif
                                        <input class="form-control" type="text" disabled
                                            value="{{ $student->id_number }}" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Nama</label>
                                        <input class="form-control" type="text" disabled value="{{ $student->name }}" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Nama Sekolah atau Nama Kampus</label>
                                        <input class="form-control" type="text" disabled
                                            value="{{ $student->institution }}" />
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
