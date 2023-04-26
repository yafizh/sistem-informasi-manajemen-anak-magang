@extends('dashboard.admin.layouts.dashboard')

@section('content')
    <style>
        #DataTables_Table_0_wrapper .row:first-child,
        #DataTables_Table_0_wrapper .row:last-child {
            margin: 1rem;
        }
    </style>
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold">Laporan {{ request()->get('student_status') == 1 ? 'Siswa' : 'Mahasiswa' }}</h4>

        <form action="">
            <input type="text" name="student_status" value="{{ request()->get('student_status') }}" hidden>
            <div class="row">
                <div class="col-12 col-md-4 mb-3">
                    <label for="f" class="form-label">Dari Tanggal Diterima</label>
                    <input type="date" class="form-control" required name="f" id="f"
                        value="{{ request()->get('f') }}">
                </div>
                <div class="col-12 col-md-4 mb-3">
                    <label for="t" class="form-label">Sampai Tanggal Diterima</label>
                    <input type="date" class="form-control" required name="t" id="t"
                        value="{{ request()->get('t') }}">
                </div>
                <div class="col-12 col-md-4 mb-3">
                    <label class="form-label d-block" style="visibility: hidden;">Button</label>
                    <button type="submit" class="btn btn-success">Filter</button>
                    <a href="/admin/print/students?student_status={{ request()->get('student_status') }}&f={{ request()->get('f') }}&t={{ request()->get('t') }}"
                        class="btn btn-primary" target="_blank">
                        Cetak
                    </a>
                </div>
            </div>
        </form>

        <div class="card">
            <div class="table-responsive text-nowrap" style="overflow: hidden!important;">
                <table class="table dataTables">
                    <thead>
                        <tr>
                            <th class="fit text-center">No</th>
                            <th class="text-center">Tanggal Diterima</th>
                            <th class="text-center">NIS/NIM/NPM</th>
                            <th class="text-center">Nama Lengkap</th>
                            <th class="text-center">Nama Instansi</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($students as $student)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $student->internshipApplication->verification_date }}</td>
                                <td class="text-center">{{ $student->id_number }}</td>
                                <td>{{ $student->name }}</td>
                                <td class="text-center">{{ $student->institution }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
