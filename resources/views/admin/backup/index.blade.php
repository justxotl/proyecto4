@extends('adminlte::page')

@section('content_header')
    <div class="row">
        <h1 class="ml-4 mt-2"><b>Respaldo y Restauración de Base de Datos</b></h1>
    </div>
    <hr>
@stop

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h2 class="card-title mt-2">Respaldos Creados:</h2>
                    <div class="card-tools">
                        <a href="{{ url('/admin/backup/create') }}" class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp;
                            Nuevo Respaldo</a>
                    </div>
                    <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-hover table-striped table-sm">
                            <thead>
                                <tr>
                                    <th style="text-align: center">#</th>
                                    <th style="text-align: center">Nombre</th>
                                    <th style="text-align: center">Fecha</th>
                                    <th style="text-align: center">Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $contador = 1;
                                @endphp
                                @foreach ($backups as $backup)
                                    <tr>
                                        <td style="text-align: center">{{ $contador++ }}</td>
                                        <td style="text-align: center">{{ basename($backup) }}</td>
                                        <td style="text-align: center">
                                            {{ date('d-m-Y H:i:s', Storage::lastModified($backup)) }}</td>
                                        <td style="text-align: center">
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="{{ url('admin/backup/descargar/' . basename($backup)) }}"
                                                    class="btn btn-success btn-sm"><i class="fa fa-download"></i></a>
                                                @php
                                                    $backupName = basename($backup);
                                                    $backupId = md5($backupName);
                                                @endphp

                                                <form action="{{ url('admin/backup/eliminar/' . $backupName) }}"
                                                    method="post" onclick="preguntar{{ $backupId }}(event)"
                                                    id="miFormulario{{ $backupId }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" title="Eliminar">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>

                                                <script>
                                                    function preguntar{{ $backupId }}(event) {
                                                        event.preventDefault();
                                                        Swal.fire({
                                                            title: '¿Estás seguro de eliminar este respaldo?',
                                                            text: "",
                                                            icon: 'question',
                                                            showDenyButton: true,
                                                            confirmButtonText: 'Eliminar',
                                                            confirmButtonColor: '#dc3545',
                                                            denyButtonColor: '#949494',
                                                            denyButtonText: 'Cancelar',
                                                        }).then((result) => {
                                                            if (result.isConfirmed) {
                                                                document.getElementById("miFormulario{{ $backupId }}").submit();
                                                            }
                                                        });
                                                    }
                                                </script>

                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <div class="col-md-6">
            <div class="card card-outline card-info">
                <div class="card-header">
                    <h2 class="card-title mt-2">Restaurar desde Respaldo:</h2>
                </div>
                <div class="card-body">
                    <form action="{{ url('/admin/backup/restore') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="backup_file">Seleccione un punto de restauración:</label>
                            <select name="backup_file" size="5" class="form-control" required>
                                @foreach ($backups as $backup)
                                    <option value="{{ basename($backup) }}">{{ basename($backup) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-info mt-2">
                            <i class="fa fa-rotate-left"></i> Restaurar Base de Datos
                        </button>
                    </form>
                </div>
            </div>
        </div>

    </div>
@stop

@section('css')
    <style>
        /* Fondo transparente y sin borde en el contenedor */
        #example1_wrapper .dt-buttons {
            background-color: transparent;
            box-shadow: none;
            border: none;
            display: flex;
            justify-content: center;
            /* Centrar los botones */
            gap: 10px;
            /* Espaciado entre botones */
            margin-bottom: 15px;
            /* Separar botones de la tabla */
        }

        /* Estilo personalizado para los botones */
        #example1_wrapper .btn {
            color: #fff;
            /* Color del texto en blanco */
            padding: 5px 15px;
            /* Espaciado interno */
            font-size: 14px;
            /* Tamaño de fuente */
        }

        .table td {
            vertical-align: middle;
            /* Centra verticalmente el contenido */
            text-align: center;
            /* Centra horizontalmente el contenido */
        }

        a.btn,
        button.btn {
            display: inline-block;
            /* Asegura que ambas etiquetas se comporten igual */
            padding: 5px 15px;
            /* Relleno interno */
            font-size: 14px;
            /* Tamaño de fuente */
            text-align: center;
            /* Centrar el texto */
            vertical-align: middle;
            /* Alineación vertical */
            border: none;
            /* Elimina bordes predeterminados */
            text-decoration: none;
            /* Elimina subrayado en enlaces */
            cursor: pointer;
            /* Asegura que el cursor sea consistente */
        }

        .btn-group {
            display: inline-flex;
            /* Asegura que los botones estén en línea */
            justify-content: center;
            /* Centra horizontalmente los botones dentro del grupo */
            align-items: center;
            /* Centra verticalmente los botones dentro del grupo */
        }

        .btn-group .btn {
            border-radius: 0;
            /* Elimina bordes redondeados internos */
        }

        .btn-group .btn:first-child {
            border-top-left-radius: 4px;
            /* Redondea la esquina superior izquierda */
            border-bottom-left-radius: 4px;
            /* Redondea la esquina inferior izquierda */
        }

        .btn-group .btn:last-child {
            border-top-right-radius: 4px;
            /* Redondea la esquina superior derecha */
            border-bottom-right-radius: 4px;
            /* Redondea la esquina inferior derecha */
        }

        .btn-group .btn+.btn {
            margin-left: 0;
            /* Elimina el espacio entre botones */
        }

        /* Colores por tipo de botón */
        .btn-danger {
            background-color: #dc3545;
            border: none;
        }

        .btn-success {
            background-color: #28a745;
            border: none;
        }

        .btn-info {
            background-color: #17a2b8;
            border: none;
        }

        .btn-warning {
            background-color: #ffc107;
            color: #212529;
            border: none;
        }

        .btn-default {
            background-color: #6e7176;
            color: #212529;
            border: none;
        }
    </style>
@stop

@section('js')
    <script>
        $(function() {
            $("#example1").DataTable({
                "pageLength": 5,
                "lengthMenu": [
                    [5, 10, 25, 50],
                    [5, 10, 25, 50]
                ],
                "columnDefs": [{
                        width: "10%",
                        targets: 0
                    },
                    {
                        width: "40%",
                        targets: 1
                    },
                    {
                        width: "25%",
                        targets: 2
                    },
                    {
                        width: "25%",
                        targets: 3
                    }
                ],
                "language": {
                    "emptyTable": "No hay información",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Respaldos",
                    "infoEmpty": "Mostrando 0 a 0 de 0 Respaldos",
                    "infoFiltered": "(Filtrado de _MAX_ total Respaldos)",
                    "lengthMenu": "Mostrar _MENU_ Respaldos",
                    "loadingRecords": "Cargando...",
                    "processing": "Procesando...",
                    "search": "Buscador:",
                    "zeroRecords": "Sin resultados encontrados",
                    "paginate": {
                        "first": "Primero",
                        "last": "Último",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                },
                "responsive": true,
                "lengthChange": true,
                "autoWidth": false,

            })
        });
    </script>
@stop
