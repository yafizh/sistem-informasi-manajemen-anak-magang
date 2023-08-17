<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <style type="text/css">
        @page {
            size: A4 landscape;
        }

        .pagebreak {
            page-break-before: always;
        }


        @media screen,
        print {


            body,
            html {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
                margin: 0;
                padding: 0;
                /* height: 100vh; */
                position: relative;
                overflow: hidden;
            }

            #certificate {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
                margin: 0;
                padding: 0;
                height: 100vh;
                position: relative;
                overflow: hidden;
            }

            .square {
                width: 500px;
                height: 500px;
                transform: rotate(30deg);
                background-color: #550216;
                position: absolute;
            }

            .square-with-border {
                width: 500px;
                height: 500px;
                border: 10px solid #fdcd5e;
                position: absolute;
            }

            .bar {
                width: 100px;
                height: 500px;
                background-color: #efe6e9;
                position: absolute;
                transform: rotate(30deg);
            }
        }

        @font-face {
            font-family: WorderfulDay;
            src: url("/assets/font/Wonderful Day.ttf");
        }

        main {
            /* background-color: red; */
            width: 60rem;
            margin: auto;
            text-align: center;
        }

        .certificate {
            font-size: 3rem;
            font-weight: bold;
        }

        .name {
            font-size: 3rem;
            font-family: "WorderfulDay", Times, serif;
        }

        .id_number,
        .at {
            margin-bottom: 3rem;
        }

        .reason,
        .at {
            font-style: italic;
        }

        .sign-line {
            width: 12rem;
            height: 0.1rem;
            background-color: black;
            margin: auto;
        }
    </style>
</head>

<body>
    <div id="certificate" class="p-0 m-0">
        <div class="square" style="top: -220; left: -250">
            <div class="square-with-border" style="top: -120; left: -60"></div>
            <div class="square-with-border" style="top: 450; left: -40"></div>
        </div>
        <div class="bar" style="bottom: -100; left: -70"></div>
        <div class="bar" style="bottom: -300; left: -40"></div>

        <main>
            <div style="width: 10rem; margin: 1rem auto">
                <img src="https://www.telkom.co.id/images/bumper_telkom_indonesia.webp" style="width: 100%" />
            </div>
            <img src="{{ asset('assets/img/badge.png') }}"
                style="width: 14rem; position: absolute; top: 40; right: 100; z-index: 99;" />
            <div class="certificate">SERTIFIKAT</div>
            <div class="to">diberikan kepada</div>
            <div class="name">{{ $name }}</div>
            <div class="id_number">{{ $student_status == 1 ? 'NIS/NISN' : 'NIM/NPM' }}. {{ $id_number }}</div>
            <div class="reason">
                telah melaksanakan praktik magang di PT. Telekomunikasi Indonesia
                (Persero)
            </div>
            <div class="at">Periode Magang {{ $start_date }} - {{ $end_date }}</div>
            <div>Mengetahui,</div>
            <div>HEAD OF REPRESENTATIVE OFFICE MARABAHAN</div>
            <br /><br /><br /><br /><br /><br />
            <div class="sign-line"></div>
            <div>DIMITRI ERLANGGA</div>
            <div>NIK. 960277</div>
        </main>

        <div class="square" style="bottom: -220; right: -250">
            <div class="square-with-border" style="bottom: -120; right: -60"></div>
            <div class="square-with-border" style="bottom: 450; right: -40"></div>
        </div>
        <div class="bar" style="top: -100; right: -70"></div>
        <div class="bar" style="top: -300; right: -40"></div>
    </div>

    <div class="pagebreak"></div>
    <div class="container p-5">
        <h4 class="text-center mb-5">DAFTAR PENILAIAN</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Aspek Penilaian</th>
                    <th class="text-center">Skor Nilai</th>
                    <th class="text-center">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $total = 0;
                @endphp
                @foreach ($evalutationTable as $value)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td class="text-center">{{ $value['name'] }}</td>
                        <td class="text-center">{{ $value['value'] }}</td>
                        <td class="text-center">{{ $value['description'] }}</td>
                    </tr>
                    @php
                        $total += $value['value'];
                    @endphp
                @endforeach
                <tr>
                    <td colspan="2">Total</td>
                    <td colspan="2" class="text-center"><strong>{{ $total }}</strong></td>
                </tr>
                <tr>
                    <td colspan="2">Rata - Rata</td>
                    <td colspan="2" class="text-center"><strong>{{ round($total / 8, 2) }}</strong></td>
                </tr>
            </tbody>
        </table>
    </div>
    <script>
        window.print();
    </script>
</body>

</html>
