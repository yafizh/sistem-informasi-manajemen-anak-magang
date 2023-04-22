@extends('dashboard.admin.layouts.dashboard')

@section('content')
    <style>
        #DataTables_Table_0_wrapper .row:first-child,
        #DataTables_Table_0_wrapper .row:last-child {
            margin: 1rem;
        }
    </style>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex justify-content-between py-3 align-items-center">
            <h4 class="fw-bold align-middle mb-0">Data Kegiatan Magang Siswa/Mahasiswa</h4>
            <a href="/admin/internship-programs/create?student_status={{ request()->get('student_status') }}"
                class="btn btn-primary">Tambah</a>
        </div>

        <div class="card">
            <div class="table-responsive text-nowrap" style="overflow: hidden!important;">
                <table class="table dataTables pb-5">
                    <thead>
                        <tr>
                            <th class="fit text-center">No</th>
                            <th class="text-center">Pembimbing</th>
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
                                <td class="text-center">{{ $internship_program->supervisor->name }}</td>
                                <td class="text-center">{{ $internship_program->start_date }}</td>
                                <td class="text-center">{{ $internship_program->end_date }}</td>
                                <td class="text-center">{{ $internship_program->internship_status }}</td>
                                <td class="text-center">
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item"
                                                href="/admin/internship-programs/{{ $internship_program->id }}?student_status={{ request()->get('student_status') }}">
                                                <i class="bx bx-edit-alt me-2"></i> Lihat
                                            </a>
                                            <a class="dropdown-item"
                                                href="/admin/internship-programs/{{ $internship_program->id }}/edit">
                                                <i class="bx bx-edit-alt me-2"></i> Edit
                                            </a>
                                            <form action="/admin/internship-programs/{{ $internship_program->id }}"
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
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection