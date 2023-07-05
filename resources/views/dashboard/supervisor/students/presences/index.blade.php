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
                        <a class="nav-link"
                            href="/supervisor/students/{{ $internship_program->id }}?student_status={{ request()->get('student_status') }}">
                            @if (request()->get('student_status') == 1)
                                <i class="bx bxs-user-circle me-1"></i> Siswa
                            @else
                                <i class="bx bxs-graduation me-1"></i> Mahasiswa
                            @endif
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="javascript:void(0);">
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
                    <div class="card-header d-flex justify-content-end">
                        <a href="/supervisor/students/{{ $internship_program->id }}/presences/create?student_status={{ request()->get('student_status') }}"
                            class="btn btn-primary">Tambah Presensi</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive text-nowrap" style="overflow: hidden!important;">
                            <table class="table dataTables pb-5">
                                <thead>
                                    <tr>
                                        <th class="fit text-center">No</th>
                                        <th class="text-center">Tanggal</th>
                                        @if (request()->get('student_status') == 1)
                                            <th class="text-center">NIS/NISN</th>
                                        @else
                                            <th class="text-center">NIM/NPM</th>
                                        @endif
                                        <th class="text-center">Nama</th>
                                        <th class="text-center">Status</th>
                                        <th class="fit">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @if ($internship_program->studentPresences->count())
                                        @foreach ($internship_program->studentPresences as $student_presence)
                                            <tr>
                                                <td class="text-center fit">{{ $loop->iteration }}</td>
                                                <td class="text-center">{{ $student_presence->formated_date }}</td>
                                                <td class="text-center">
                                                    {{ $student_presence->internshipStudent->student->id_number }}</td>
                                                <td class="text-center">
                                                    {{ $student_presence->internshipStudent->student->name }}</td>
                                                <td class="text-center">
                                                    @if ($student_presence->status == 1)
                                                        <span class="badge bg-label-success me-1">Hadir</span>
                                                    @elseif ($student_presence->status == 2)
                                                        <span class="badge bg-label-warning me-1">Sakit</span>
                                                    @elseif ($student_presence->status == 3)
                                                        <span class="badge bg-label-info me-1">Izin</span>
                                                    @else
                                                        @if ($student_presence->date < Date('Y-m-d'))
                                                            <span class="badge bg-label-danger me-1">Alpa</span>
                                                        @else
                                                            Belum Mengisi Presensi
                                                        @endif
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <div class="dropdown">
                                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                            data-bs-toggle="dropdown">
                                                            <i class="bx bx-dots-vertical-rounded"></i>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item"
                                                                href="/supervisor/students/{{ $internship_program->id }}/presences/{{ $student_presence->id }}/edit">
                                                                <i class="bx bx-edit-alt me-2"></i> Edit/Lihat
                                                            </a>
                                                            <form
                                                                action="/supervisor/students/{{ $internship_program->id }}/presences/{{ $student_presence->id }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="dropdown-item"
                                                                    onclick="return confirm('Are you sure?')">
                                                                    <i class="bx bx-trash me-2"></i> Hapus
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
