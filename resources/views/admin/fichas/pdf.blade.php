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
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid black !important;
            padding: 8px;
            vertical-align: top;
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

        .footer {
            position: fixed;
            bottom: 30px;
            width: 100%;
            text-align: center;
            font-size: 0.9rem;
            color: #333;
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
                <h2>Ciudad Bolívar, Estado Bolívar</h2>
                <h2>Formato de Ficha Bibliográfica</h2>
            </div>
        </div>

        <!-- Título de la ficha -->
        <h2 class="text-center">{{ $ficha->titulo }}</h2>

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

    <!-- Pie de página -->
    <div class="footer">
        Ciudad Bolívar, {{ \Carbon\Carbon::now()->format('d/m/Y') }}
    </div>

</body>

</html>
