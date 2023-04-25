@extends('dashboard.admin.layouts.dashboard')

@section('content')
    <style>
        #DataTables_Table_0_wrapper .row:first-child,
        #DataTables_Table_0_wrapper .row:last-child {
            margin: 1rem;
        }
    </style>
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold">Laporan Kegiatan Magang</h4>

        <form action="">
            <div class="row">
                <div class="col-12 col-md-4 mb-3">
                    <label for="f" class="form-label">Dari Tanggal Kegiatan</label>
                    <input type="date" class="form-control" required name="f" id="f"
                        value="{{ request()->get('f') }}">
                </div>
                <div class="col-12 col-md-4 mb-3">
                    <label for="t" class="form-label">Sampai Tanggal Kegiatan</label>
                    <input type="date" class="form-control" required name="t" id="t"
                        value="{{ request()->get('t') }}">
                </div>
                <div class="col-12 col-md-4 mb-3">
                    <label class="form-label d-block" style="visibility: hidden;">Button</label>
                    <button type="submit" class="btn btn-success">Filter</button>
                    <a href="/admin/print/internship-programs?f={{ request()->get('f') }}&t={{ request()->get('t') }}"
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
                            <th class="text-center">Tanggal Kegiatan Mulai</th>
                            <th class="text-center">Tanggal Kegiatan Selesai</th>
                            <th class="text-center">Pembimbing</th>
                            <th class="text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($internship_programs as $internship_program)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $internship_program->start_date }}</td>
                                <td class="text-center">{{ $internship_program->end_date }}</td>
                                <td class="text-center">{{ $internship_program->supervisor->name }}</td>
                                <td class="text-center">
                                    @if ($internship_program->internship_status == 1)
                                        <span class="badge bg-label-success me-1">Selesai</span>
                                    @elseif ($internship_program->internship_status == 2)
                                        <span class="badge bg-label-info me-1">Sedang Berjalan</span>
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
