@extends('adminlte::page')

@section('content_header')
    <div class="row">
        <h1 class="ml-4 mt-2"><b>Listado de Roles</b></h1>
    </div>
    <hr>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h2 class="card-title mt-2">Roles registrados:</h2>

                    @can('Registrar Rol')
                        <div class="card-tools">
                            <a href="{{ url('/admin/roles/register') }}" class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp;
                                Nuevo Rol</a>
                        </div>
                    @endcan
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
                                    <th style="text-align: center">Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $contador = 1;
                                @endphp
                                @foreach ($roles as $rol)
                                    <tr>
                                        <td style="text-align: center">{{ $contador++ }}</td>
                                        <td>{{ $rol->name }}</td>
                                        <td style="text-align: center">
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                @can('Editar Rol')
                                                    <a href="{{ url('/admin/roles/' . $rol->id . '/edit') }}" type="button"
                                                        class="btn btn-success btn-sm" title="Editar Rol"><i
                                                            class="fas fa-pencil-alt"></i></a>

                                                    <a href="{{ url('/admin/roles/' . $rol->id . '/asignar') }}" type="button"
                                                        class="btn btn-info btn-sm" title="Asignar Permisos"><i
                                                            class="fas fa-tasks"></i></a>
                                                @endcan
                                                @can('Eliminar Rol')
                                                    <form action="{{ url('/admin/roles', $rol->id) }}" method="post"
                                                        onclick="preguntar{{ $rol->id }}(event)"
                                                        id="miFormulario{{ $rol->id }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm"
                                                            title="Eliminar Rol"><i class="fas fa-trash"></i></button>
                                                    </form>
                                                @endcan
                                                <script>
                                                    function preguntar{{ $rol->id }}(event) {
                                                        event.preventDefault();
                                                        Swal.fire({
                                                            title: '¿Desea eliminar este registro?',
                                                            text: '',
                                                            icon: 'question',
                                                            showDenyButton: true,
                                                            confirmButtonText: 'Eliminar',
                                                            confirmButtonColor: '#a5161d',
                                                            denyButtonColor: '#949494',
                                                            denyButtonText: 'Cancelar',
                                                        }).then((result) => {
                                                            if (result.isConfirmed) {
                                                                var form = $('#miFormulario{{ $rol->id }}');
                                                                form.submit();
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
            margin-bottom: 5px;
            /* Separar botones de la tabla */
        }

        /* Estilo personalizado para los botones */
        #example1_wrapper .btn {
            color: #fff;
            /* Color del texto en blanco */
            padding: 5px 10px;
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
            padding: 5px 10px;
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
                "language": {
                    "emptyTable": "No hay información",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Roles",
                    "infoEmpty": "Mostrando 0 a 0 de 0 Roles",
                    "infoFiltered": "(Filtrado de _MAX_ total Roles)",
                    "lengthMenu": "Mostrar _MENU_ Roles",
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
                buttons: [
                    @can('Exportar Reporte de Roles')
                        {
                            text: '<i class="fas fa-file-pdf"></i> PDF',
                            className: 'btn btn-danger',
                            action: function() {
                                Swal.fire({
                                    title: '¿Desea exportar la tabla en un archivo PDF?',
                                    text: '',
                                    icon: 'question',
                                    showDenyButton: true,
                                    confirmButtonText: 'Exportar',
                                    confirmButtonColor: '#dc3545',
                                    denyButtonColor: '#949494',
                                    denyButtonText: 'Cancelar',
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.open(
                                            '{{ route('roles.exportar.pdf') }}',
                                            '_blank');
                                    }
                                });
                            }
                        }, {
                            text: '<i class="fas fa-file-csv"></i>  EXCEL',
                            className: 'btn btn-success',
                            action: function(e, dt, node, config) {
                                Swal.fire({
                                    title: '¿Desea exportar la tabla en un archivo Excel?',
                                    text: '',
                                    icon: 'question',
                                    showDenyButton: true,
                                    confirmButtonText: 'Exportar',
                                    confirmButtonColor: '#28a745',
                                    denyButtonColor: '#949494',
                                    denyButtonText: 'Cancelar',
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.href =
                                            "{{ route('roles.exportar') }}";
                                    }
                                });
                            },
                        }
                    @endcan
                ]
            }).buttons().container().appendTo('#example1_wrapper .row:eq(0)');
        });
    </script>
@stop
