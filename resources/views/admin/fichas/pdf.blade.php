<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Ficha Bibliográfica</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <style>
        body {
            font-family: 'Times New Roman', serif;
            font-size: 13px;
            margin: 40px 30px;
        }

        .header {
            display: flex;
            align-items: center;
            border-bottom: 2px solid #003366;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .header img {
            float: right;
            width: 50px;
            height: auto;
            margin-right: 20px;
        }

        .header-text h1 {
            margin: 0;
            font-size: 18px;
            color: #003366;
        }

        .header-text p {
            margin: 0;
            font-size: 13px;
        }

        h2 {
            font-size: 16px;
            margin-top: 25px;
            color: #003366;
            border-bottom: 1px solid #ccc;
        }

        h3 {
            text-align: center;
            margin: 20px 0;
            font-size: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 6px 8px;
            vertical-align: middle;
        }

        thead th {
            background-color: #d1e7ff;
            text-align: center;
        }

        .tabla-detalles th {
            background-color: #d1e7ff;
            width: 20%;
            text-align: center;
        }

        .tabla-detalles td {
            width: 80%;
        }

        .firmas {
            margin-top: 30px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .firma-encargado {
            text-align: center;
        }

        .footer {
            position: fixed;
            bottom: -10px;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 11px;
            color: #888;
        }

    </style>
</head>

<body>
    <div class="container">
        <!-- Encabezado -->
        <div class="header">
            <img src="{{ public_path('images/LogoUDO.png') }}" alt="Logo UDO">
            <div class="header-text">
                <h1>UNIVERSIDAD DE ORIENTE</h1>
                <p>Núcleo Bolívar — Biblioteca</p>
                <p>Ciudad Bolívar, {{ \Carbon\Carbon::now()->format('d/m/Y') }}</p>
            </div>
        </div>

        <!-- Título -->
        <h3>Comprobante de Ficha Bibliográfica</h3>
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
                    <td>{{ Carbon\Carbon::parse($ficha->fecha)->format('d/m/Y') }}</td>
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

        <!-- Firma -->
        <div class="firmas">
            <div class="firma-encargado">
                <p>______________________________</p>
                <p>Firma del Encargado</p>
            </div>
        </div>
        <!-- Pie de página -->
        <div class="footer">
            Biblioteca UDO Núcleo Bolívar — Tel: 0285-XXXXXXX — Email: biblioteca@udo.edu.ve
        </div>
    </div>
</body>

</html>
