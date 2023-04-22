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
                            <i class="bx bx-user me-1"></i> Periode Magang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"
                            href="/admin/internship-programs/{{ $internship_program->id }}/supervisor?student_status={{ request()->get('student_status') }}">
                            <i class="bx bx-bell me-1"></i> Pembimbing
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="javascript:void(0);">
                            <i class="bx bx-link-alt me-1"></i>
                            Siswa/Mahasiswa
                        </a>
                    </li>
                </ul>
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-end mb-3">
                            <a href="/admin/internship-students/{{ $internship_program->id }}/create?student_status={{ request()->get('student_status') }}"
                                class="btn btn-primary">Tambah</a>
                        </div>
                        <div class="table-responsive text-nowrap pb-5" style="overflow: hidden!important;">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="fit text-center">No</th>
                                        <th class="text-center">NIS/NPM</th>
                                        <th class="text-center">Nama</th>
                                        <th class="text-center">Asal Sekolah atau Asal Kampus</th>
                                        <th class="fit">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @if ($internship_program->students->count())
                                        @foreach ($internship_program->students as $student)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td class="text-center">{{ $student->id_number }}</td>
                                                <td class="text-center">{{ $student->name }}</td>
                                                <td class="text-center">{{ $student->institution }}</td>
                                                <td class="text-center">
                                                    <div class="dropdown">
                                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                            data-bs-toggle="dropdown">
                                                            <i class="bx bx-dots-vertical-rounded"></i>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <form
                                                                action="/admin/internship-students/{{ $internship_program->id }}/{{ $student->id }}"
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
                                        <tr>
                                            <td colspan="5" class="text-center">Siswa/Mahasiswa Belum Ditambahakan</td>
                                        </tr>
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
