<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ficha PDF</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Times New Roman', Times, serif, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            page-break-inside: avoid;
            /* Evita cortes dentro de contenedores */
        }

        .header {
            display: flex;
            align-items: center;
            margin-bottom: 30px;
        }

        .header img {
            float: right;
            width: 60px;
            height: auto;
            margin-right: 20px;
        }

        .header-text h2 {
            margin: 0;
            font-size: 1.2rem;
        }

        h2.text-center {
            margin-top: 20px;
            margin-bottom: 30px;
            font-weight: bold;
        }

        table {
            width: 100%;
            font-size: 0.75rem;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid black !important;
            padding: 8px;
            vertical-align: middle;
        }

        thead th {
            background-color: #d1e7ff !important;
            text-align: center;
        }

        /* Ancho de columnas de la tabla de autores */
        .tabla-autores th,
        .tabla-autores td {
            width: 33.33%;
            text-align: center;
        }

        /* Ancho personalizado para la tabla de detalles */
        .tabla-detalles th {
            background-color: #d1e7ff !important;
            text-align: center;
            width: 15%;
        }

        .tabla-detalles td {
            width: 85%;
        }

        thead {
            display: table-header-group;
            /* Asegura que los encabezados de tabla se repitan en cada página */
        }

        tbody {
            display: table-row-group;
        }

        tr {
            page-break-inside: auto;
            /* Evita cortes dentro de filas de tabla */
        }

        .page-break {
            page-break-before: always;
            /* Fuerza un salto de página */
        }
    </style>
</head>

<body>

    <div class="container">
        <!-- Encabezado -->
        <div class="header">
            <img src="{{ public_path('images/LogoUDO.png') }}" alt="Logo UDO">
            <div class="header-text">
                <h2>Universidad de Oriente — Núcleo Bolívar</h2>
                <h2>Ciudad Bolívar, Estado Bolívar, {{ \Carbon\Carbon::now()->format('d/m/Y') }}</h2>
                <h2>Formato de Ficha Bibliográfica</h2>
            </div>
        </div>

        <!-- Título de la ficha -->
        <h3 class="text-center">{{ $ficha->titulo }}</h3>

        <!-- Tabla de autores -->
        <h2>Autores</h2>
        <table class="table table-bordered tabla-autores">
            <thead>
                <tr>
                    <th>C.I.</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ficha->autor as $autor)
                    <tr>
                        <td>{{ $autor->ci_autor }}</td>
                        <td>{{ $autor->nombre_autor }}</td>
                        <td>{{ $autor->apellido_autor }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Tabla de detalles -->
        <h2>Detalles de la Ficha</h2>
        <table class="table table-bordered tabla-detalles">
            <tbody>
                <tr>
                    <th>Fecha</th>
                    <td>{{ $ficha->fecha }}</td>
                </tr>
                <tr>
                    <th>Carrera</th>
                    <td>{{ $ficha->carrera->nombre }}</td>
                </tr>
                <tr>
                    <th>Resumen</th>
                    <td>{{ $ficha->resumen }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>
