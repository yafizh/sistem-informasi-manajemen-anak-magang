@extends('dashboard.admin.layouts.dashboard')

@section('content')
    <style>
        #DataTables_Table_0_wrapper .row:first-child,
        #DataTables_Table_0_wrapper .row:last-child {
            margin: 1rem;
        }
    </style>
    <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold align-middle">Data Pengguna {{request()->get('student_status') == 1 ? 'Siswa' : 'Mahasiswa'}}</h4>

        <div class="card">
            <div class="table-responsive text-nowrap" style="overflow: hidden!important;">
                <table class="table dataTables">
                    <thead>
                        <tr>
                            <th class="fit text-center">No</th>
                            <th class="text-center">Username</th>
                            <th class="text-center">Nama</th>
                            <th class="fit">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($students as $student)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $student->id_number }}</td>
                                <td>{{ $student->name }}</td>
                                <td class="text-center">
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item"
                                                href="/change-password?user_id={{ $student->user->id }}">
                                                <i class="bx bx-edit-alt me-2"></i> Ganti Password
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
