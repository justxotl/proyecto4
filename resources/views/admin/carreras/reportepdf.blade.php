<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reporte de Carreras PDF</title>

    <!-- Bootstrap CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <style>
        @page {
            margin: 60px 40px 60px 40px;
            size: letter landscape;
        }

        body {
            font-family: "Times New Roman", serif;
            font-size: 12px;
        }

        header {
            text-align: center;
            margin-bottom: 5px;
        }

        .logo {
            float: left;
            width: 55px;
        }

        .header-text {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            table-layout: fixed;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 5px;
            word-wrap: break-word;
            text-align: center;
            vertical-align: top;
        }

        th {
            background-color: #5084b4;
            color: white;
            font-weight: bold;
        }

        tr:nth-child(even) td {
            background-color: #cadae8;
        }

        .wrap-col {
            white-space: normal;
        }

        footer {
            position: fixed;
            bottom: -30px;
            right: 0;
            font-size: 10px;
        }
    </style>
</head>

<body>

    <header>
        <div style="overflow: hidden;">
            <img src="{{ public_path('images/LogoUDO.png') }}" class="logo">
            <div class="header-text">
                <h3 style="margin: 0;">Universidad de Oriente — Núcleo Bolívar</h3>
                <h3 style="margin: 0;">Biblioteca — Sistema de Gestión de Fichas Bibliográficas</h3>
                <p style="margin: 0;"><b>Ciudad Bolívar, Estado Bolívar, {{ date('d/m/Y') }}</b></p>
                <h4 style="margin: 10px 0;">Listado de Carreras Registradas</h4>
            </div>
        </div>
    </header>

    <table>
        <thead>
            <tr>
                <th style="width: 10%;">ID</th>
                <th style="width: 90%;">Nombre de Carrera</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($carreras as $carrera)
                <tr>
                    <td>{{ $carrera->id }}</td>
                    <td class="wrap-col">{{ $carrera->nombre }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <script type="text/php">
    if (isset($pdf)) {
        $font = $fontMetrics->get_font("Times New Roman", "normal");
        $size = 8;
        $pdf->page_text(700, 570, "Página {PAGE_NUM} de {PAGE_COUNT}", $font, $size);
    }
    </script>
</body>

</html>
