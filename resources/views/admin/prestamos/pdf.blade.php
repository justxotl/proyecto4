<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Comprobante de Préstamo</title>
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

        th, td {
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
            width: 35%;
            text-align: left;
        }

        .tabla-detalles td {
            width: 65%;
        }

        .firmas {
            margin-top: 50px;
        }

        .firmas td {
            border: none;
            text-align: center;
            padding-top: 40px;
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

        .codigo {
            margin-top: 10px;
            text-align: right;
            font-size: 11px;
            color: #555;
        }

    </style>
</head>
<body>

    <!-- ENCABEZADO -->
    <div class="header">
        <img src="{{ public_path('images/LogoUDO.png') }}" alt="Logo UDO">
        <div class="header-text">
            <h1>UNIVERSIDAD DE ORIENTE</h1>
            <p>Núcleo Bolívar — Biblioteca</p>
            <p>Ciudad Bolívar, {{ \Carbon\Carbon::now()->format('d/m/Y') }}</p>
        </div>
    </div>

    <!-- TÍTULO -->
    <h3>Comprobante de Préstamo</h3>

    <!-- FICHA BIBLIOGRÁFICA -->
    <h2>Ficha Bibliográfica Prestada</h2>
    <table class="tabla-detalles">
        <tr>
            <th>Título</th>
            <td>{{ $prestamo->ficha->titulo ?? 'Sin ficha' }}</td>
        </tr>
        <tr>
            <th>Materia / Carrera</th>
            <td>{{ $prestamo->ficha->carrera->nombre ?? 'No especificada' }}</td>
        </tr>
        <tr>
            <th>Autores</th>
            <td>
                @foreach($prestamo->ficha->autor as $autor)
                    {{ $autor->nombre_autor }} {{ $autor->apellido_autor }} ({{ $autor->ci_autor }})<br>
                @endforeach
            </td>
        </tr>
        <tr>
            <th>Fecha de la Ficha</th>
            <td>{{ $prestamo->ficha->fecha ?? 'No registrada' }}</td>
        </tr>
    </table>

    <!-- DATOS DEL PRESTATARIO -->
    <h2>Datos del Prestatario</h2>
    <table class="tabla-detalles">
        <tr>
            <th>Cédula</th>
            <td>{{ $prestamo->ci_prestatario }}</td>
        </tr>
        <tr>
            <th>Nombre</th>
            <td>{{ $prestamo->nombre_prestatario }}</td>
        </tr>
        <tr>
            <th>Apellido</th>
            <td>{{ $prestamo->apellido_prestatario }}</td>
        </tr>
        <tr>
            <th>Teléfono</th>
            <td>{{ $prestamo->tlf_prestatario }}</td>
        </tr>
    </table>

    <!-- DATOS DEL PRÉSTAMO -->
    <h2>Detalles del Préstamo</h2>
    <table class="tabla-detalles">
        <tr>
            <th>Fecha de Préstamo</th>
            <td>{{ \Carbon\Carbon::parse($prestamo->fecha_prestamo)->format('d/m/Y') }}</td>
        </tr>
        <tr>
            <th>Fecha de Devolución</th>
            <td>{{ \Carbon\Carbon::parse($prestamo->fecha_devolucion)->format('d/m/Y') }}</td>
        </tr>
        <tr>
            <th>Fecha de Entrega</th>
            <td>
                {{ $prestamo->fecha_entrega ? \Carbon\Carbon::parse($prestamo->fecha_entrega)->format('d/m/Y') : 'Devolución Pendiente' }}
            </td>
        </tr>
        <tr>
            <th>Estado</th>
            <td>{{ ucfirst($prestamo->estado) }}</td>
        </tr>
    </table>

    <!-- FIRMAS -->
    <table class="firmas" style="width: 100%;">
        <tr>
            <td>_________________________<br>Firma del Prestatario</td>
            <td>_________________________<br>Firma del Responsable</td>
        </tr>
    </table>

    <!-- PIE DE PÁGINA -->
    <div class="footer">
        Biblioteca UDO Núcleo Bolívar — Tel: 0285-XXXXXXX — Email: biblioteca@udo.edu.ve
    </div>

</body>
</html>

