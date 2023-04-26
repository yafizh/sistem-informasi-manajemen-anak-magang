<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laporan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    @include('dashboard.admin.prints.header')
    <h4 class="text-center my-3">Laporan</h4>
    <section class="p-3">
        <strong>
            <span style="width: 150px; display: inline-block;">Filter</span>
        </strong>
        <br>
        <span style="width: 150px; display: inline-block;">
            {{ request()->get('student_status') == 1 ? 'NIS/NISN' : 'NPM/NIM' }}
        </span>
        <span>: {{ $student->id_number }}</span>
        <br>
        <span style="width: 150px; display: inline-block;">Nama</span>
        <span>: {{ $student->name }}</span>
    </section>
    <main class="p-3">
        @if ($table)
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
        @endif
    </main>
    @include('dashboard.admin.prints.footer')
</body>

</html>
