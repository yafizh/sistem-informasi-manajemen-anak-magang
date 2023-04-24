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
            <style>
                table th.sticky {
                    background-color: white;
                    position: sticky;
                    left: 0;
                    z-index: 4;
                }

                table td.sticky {
                    background-color: white;
                    position: sticky;
                    left: 0;
                }
            </style>
            <div class="card-body">
                <div class="table-responsive text-nowrap">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th rowspan="2" class="text-center align-middle sticky">Bulan</th>
                                <th class="text-center" colspan="31">Tanggal</th>
                            </tr>
                            <tr>
                                @for ($i = 1; $i <= 31; $i++)
                                    <th class="text-center">{{ $i }}</th>
                                @endfor
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($table as $item)
                                <tr>
                                    <td class="sticky">{{ $item['date'] }}</td>
                                    @foreach ($item['presences'] as $presence)
                                        @if ($presence == 1)
                                            <td class="text-center">H</td>
                                        @elseif ($presence == 2)
                                            <td class="text-center">S</td>
                                        @elseif ($presence == 3)
                                            <td class="text-center">I</td>
                                        @elseif ($presence == null)
                                            @if ($loop->iteration < Date('d'))
                                                <td class="text-center">A</td>
                                            @else
                                                <td class="text-center"></td>
                                            @endif
                                        @else
                                            <td class="text-center">{{ $presence }}</td>
                                        @endif
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <p class="pt-3"><strong>Keterangan</strong></p>
                <table>
                    <tr>
                        <td class="text-center">-</td>
                        <td class="px-2">:</td>
                        <td>Tidak Ada Presensi</td>
                    </tr>
                    <tr>
                        <td class="text-center">A</td>
                        <td class="px-2">:</td>
                        <td>Tidak Hadir</td>
                    </tr>
                    <tr>
                        <td class="text-center">H</td>
                        <td class="px-2">:</td>
                        <td>Hadir</td>
                    </tr>
                    <tr>
                        <td class="text-center">S</td>
                        <td class="px-2">:</td>
                        <td>Sakit</td>
                    </tr>
                    <tr>
                        <td class="text-center">I</td>
                        <td class="px-2">:</td>
                        <td>Izin</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection
