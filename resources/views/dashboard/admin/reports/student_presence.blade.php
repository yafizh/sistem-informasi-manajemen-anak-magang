@extends('dashboard.admin.layouts.dashboard')

@section('content')
    <style>
        #DataTables_Table_0_wrapper .row:first-child,
        #DataTables_Table_0_wrapper .row:last-child {
            margin: 1rem;
        }
    </style>
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold">Laporan Presensi {{ request()->get('student_status') == 1 ? 'Siswa' : 'Mahasiswa' }}</h4>

        <form action="">
            <input type="text" name="student_status" value="{{ request()->get('student_status') }}" hidden>
            <div class="row">
                <div class="col-12 col-md-4 mb-3">
                    <label for="f" class="form-label">Dari Tanggal</label>
                    <input type="date" class="form-control" required name="f" id="f"
                        value="{{ request()->get('f') }}">
                </div>
                <div class="col-12 col-md-4 mb-3">
                    <label for="t" class="form-label">Sampai Tanggal</label>
                    <input type="date" class="form-control" required name="t" id="t"
                        value="{{ request()->get('t') }}">
                </div>
                <div class="col-12 col-md-4 mb-3">
                    <label class="form-label d-block" style="visibility: hidden;">Button</label>
                    <button type="submit" class="btn btn-success">Filter</button>
                    <a href="/admin/print/student-presences?student_status={{ request()->get('student_status') }}&f={{ request()->get('f') }}&t={{ request()->get('t') }}"
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
                            <th class="text-center">Tanggal</th>
                            <th class="text-center">
                                {{ request()->get('student_status') == 1 ? 'NIS/NISN' : 'NIM/NPM' }}
                            </th>
                            <th class="text-center">Nama Lengkap</th>
                            <th class="text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($presences as $presence)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $presence->date }}</td>
                                <td class="text-center">{{ $presence->internshipStudent->student->id_number }}</td>
                                <td>{{ $presence->internshipStudent->student->name }}</td>
                                <td class="text-center">
                                    @if ($presence->status == 1)
                                        Hadir
                                    @elseif ($presence->status == 2)
                                        Sakit
                                    @elseif ($presence->status == 3)
                                        Izin
                                    @else
                                        @if ($presence->date < Date('Y-m-d'))
                                            Alpa
                                        @else
                                            Belum Mengisi Presensi
                                        @endif
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
