@extends('dashboard.admin.layouts.dashboard')

@section('content')
    <style>
        #DataTables_Table_0_wrapper .row:first-child,
        #DataTables_Table_0_wrapper .row:last-child {
            margin: 1rem;
        }
    </style>
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold">Data Pengajuan Magang</h4>

        <div class="card">
            <div class="table-responsive text-nowrap" style="overflow: hidden!important;">
                <table class="table dataTables">
                    <thead>
                        <tr>
                            <th class="fit text-center">No</th>
                            <th class="text-center">NIS/NIM/NPM</th>
                            <th class="text-center">Nama Lengkap</th>
                            <th class="text-center">Nama Instansi</th>
                            <th class="fit">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($internship_applications as $internship_application)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $internship_application->id_number }}</td>
                                <td>{{ $internship_application->name }}</td>
                                <td class="text-center">{{ $internship_application->institution }}</td>
                                <td class="text-center">
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item"
                                                href="/admin/internship-application/{{ $internship_application->id }}">
                                                <i class="bx bx-edit-alt me-2"></i> Lihat
                                            </a>
                                            <form action="/admin/internship-application/{{ $internship_application->id }}"
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
