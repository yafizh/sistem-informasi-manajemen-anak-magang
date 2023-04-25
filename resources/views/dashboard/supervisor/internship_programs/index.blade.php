@extends('dashboard.supervisor.layouts.dashboard')

@section('content')
    <style>
        #DataTables_Table_0_wrapper .row:first-child,
        #DataTables_Table_0_wrapper .row:last-child {
            margin: 1rem;
        }
    </style>
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold align-middle">Data Kegiatan Magang {{request()->get('student_status') == 1 ? 'Siswa' : 'Mahasiswa'}}</h4>

        <div class="card">
            <div class="table-responsive text-nowrap" style="overflow: hidden!important;">
                <table class="table dataTables pb-5">
                    <thead>
                        <tr>
                            <th class="fit text-center">No</th>
                            <th class="text-center">Tanggal Mulai</th>
                            <th class="text-center">Tanggal Selesai</th>
                            <th class="text-center">Status</th>
                            <th class="fit">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($internship_programs as $internship_program)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $internship_program->start_date }}</td>
                                <td class="text-center">{{ $internship_program->end_date }}</td>
                                <td class="text-center">
                                    @if ($internship_program->internship_status == 2)
                                        <span class="badge bg-label-success me-1">Selesai</span>
                                    @elseif ($internship_program->internship_status == 1)
                                        <span class="badge bg-label-info me-1">Sedang Berjalan</span>
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
                                                href="/supervisor/internship-programs/{{ $internship_program->id }}?student_status={{ request()->get('student_status') }}">
                                                <i class="bx bx-show me-2"></i> Lihat
                                            </a>
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
