@extends('dashboard.student.layouts.dashboard')

@section('content')
    <style>
        #DataTables_Table_0_wrapper .row:first-child,
        #DataTables_Table_0_wrapper .row:last-child {
            margin: 1rem;
        }
    </style>
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold">Data Presensi</h4>

        <div class="card">
            <div class="table-responsive text-nowrap" style="overflow: hidden!important;">
                <table class="table dataTables">
                    <thead>
                        <tr>
                            <th class="fit text-center">No</th>
                            <th class="text-center">Tanggal</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Kegiatan</th>
                            <th class="fit">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($student_presence as $presence)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $presence->date }}</td>
                                <td class="text-center">
                                    @if ($presence->status == 1)
                                        <span class="badge bg-label-success me-1">Hadir</span>
                                    @elseif ($presence->status == 2)
                                        <span class="badge bg-label-warning me-1">Sakit</span>
                                    @elseif ($presence->status == 3)
                                        <span class="badge bg-label-info me-1">Izin</span>
                                    @else
                                        @if ($presence->date < Date('Y-m-d'))
                                            <span class="badge bg-label-danger me-1">Alpa</span>
                                        @else
                                            Belum Mengisi Presensi
                                        @endif
                                    @endif
                                </td>
                                <td>{{ $presence->activity ?? 'Belum Mengisi Kegiatan' }}</td>
                                <td class="text-center">
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="/student/presences/{{ $presence->id }}/edit">
                                                <i class="bx bx-edit-alt me-2"></i> Perbaharui Kegiatan
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
