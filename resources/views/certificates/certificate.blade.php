<html>

<head>
    <style type="text/css">
        @page {
            size: A4 landscape;
        }

        @media screen,
        print {

            body,
            html {
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
            margin-bottom: 2rem;
        }

        .to {
            margin-bottom: 2rem;
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
        <div>dengan nilai</div>
        <h1>{{ $evaluation }}</h1>
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
    <script>
        window.print();
    </script>
</body>

</html>
