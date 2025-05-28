@extends('adminlte::page')

@php
    use Carbon\Carbon;
@endphp

@section('content_header')
    <div class="row">
        <h1 class="ml-4 mt-2"><b>Listado de Préstamos</b></h1>
    </div>
    <hr>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h2 class="card-title mt-2">Préstamos Realizados</h2>
                    @can('Registrar Préstamo')
                        <div class="card-tools">
                            <a href="{{ route('admin.prestamos.register') }}" class="btn btn-primary"><i
                                    class="fa fa-plus"></i>&nbsp;
                                Nuevo Préstamo</a>
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
                                    <th style="text-align: center">Título</th>
                                    <th style="text-align: center">CI. Prestatario</th>
                                    <th style="text-align: center">F. Préstamo</th>
                                    <th style="text-align: center">F. Devolución</th>
                                    <th style="text-align: center">Estado</th>
                                    <th style="text-align: center">Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $contador = 1;
                                @endphp
                                @foreach ($prestamos as $prestamo)
                                    <tr>
                                        <td>{{ $contador++ }}</td>
                                        <td class="truncate-3-lines" title="{{ $prestamo->ficha->titulo }}">
                                            {{ $prestamo->ficha->titulo }}</td>
                                        <td>{{ $prestamo->ci_prestatario }}</td>
                                        <td>{{ $prestamo->fecha_prestamo }}</td>
                                        <td>{{ $prestamo->fecha_devolucion }}</td>
                                        @php
                                            $hoy = Carbon::today();
                                            $fechaPrestamo = Carbon::createFromFormat(
                                                'd/m/Y',
                                                $prestamo->fecha_prestamo,
                                            );
                                            $fechaDevolucion = Carbon::createFromFormat(
                                                'd/m/Y',
                                                $prestamo->fecha_devolucion,
                                            );

                                            $fechaEntrega = $prestamo->fecha_entrega
                                                ? Carbon::parse($prestamo->fecha_entrega)
                                                : null;
                                        @endphp

                                        <td>
                                            @php
                                                $estadoCalculado = '';
                                                if ($prestamo->estado === 'devuelto') {
                                                    if ($fechaEntrega && $fechaEntrega->lte($fechaDevolucion)) {
                                                        $estadoCalculado = 'Devuelto a Tiempo';
                                                    } elseif ($fechaEntrega && $fechaEntrega->gt($fechaDevolucion)) {
                                                        $estadoCalculado = 'Devolución Tardía';
                                                    } else {
                                                        $estadoCalculado = 'Devuelto';
                                                    }
                                                } else {
                                                    if ($hoy->gte($fechaPrestamo) && $hoy->lte($fechaDevolucion)) {
                                                        $estadoCalculado = 'Prestado';
                                                    } elseif ($hoy->gt($fechaDevolucion)) {
                                                        $estadoCalculado = 'Atrasado';
                                                    } else {
                                                        $estadoCalculado = 'Pendiente';
                                                    }
                                                }
                                            @endphp
                                            <span class="sr-only">{{ $estadoCalculado }}</span>
                                            @if ($estadoCalculado === 'Devuelto a Tiempo')
                                                <span class="badge badge-success">Devuelto a Tiempo</span>
                                            @elseif ($estadoCalculado === 'Devolución Tardía')
                                                <span class="badge badge-warning">Devolución Tardía</span>
                                            @elseif ($estadoCalculado === 'Prestado')
                                                <span class="badge badge-primary">Prestado</span>
                                            @elseif ($estadoCalculado === 'Atrasado')
                                                <span class="badge badge-danger">Atrasado</span>
                                            @else
                                                <span class="badge badge-secondary">Pendiente</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                @can('Editar Préstamo')
                                                    @if ($prestamo->estado === 'prestado')
                                                        <a href="{{ route('admin.prestamos.edit', $prestamo->id) }}"
                                                            class="btn btn-success btn-sm" title="Editar"><i
                                                                class="fas fa-pen"></i></a>
                                                    @endif
                                                @endcan

                                                @can('Ver Información de Préstamo')
                                                    <a href="{{ route('admin.prestamos.show', $prestamo->id) }}"
                                                        class="btn btn-info btn-sm"><i class="fas fa-eye"
                                                            title="Ver Más"></i></a>
                                                @endcan

                                                @can('Marcar Préstamo como Devuelto')
                                                    @if ($prestamo->estado === 'prestado')
                                                        <form action="{{ route('admin.prestamos.devolver', $prestamo->id) }}"
                                                            method="post" style="display:inline;"
                                                            onclick="ask{{ $prestamo->id }}(event)"
                                                            id="miFormularioDevolver{{ $prestamo->id }}">
                                                            @csrf
                                                            @method('PUT')
                                                            <button type="submit" class="btn btn-warning btn-sm"
                                                                title="Marcar como Devuelto">
                                                                <i class="fas fa-undo"></i>
                                                            </button>
                                                        </form>
                                                    @endcan
                                                    <script>
                                                        function ask{{ $prestamo->id }}(event) {
                                                            event.preventDefault();
                                                            Swal.fire({
                                                                title: '¿Desea marcar este préstamo como devuelto?',
                                                                text: '',
                                                                icon: 'question',
                                                                showDenyButton: true,
                                                                confirmButtonText: 'Marcar como devuelto',
                                                                confirmButtonColor: '#ffc107',
                                                                denyButtonColor: '#949494',
                                                                denyButtonText: 'Cancelar',
                                                            }).then((result) => {
                                                                if (result.isConfirmed) {
                                                                    var form = $('#miFormularioDevolver{{ $prestamo->id }}');
                                                                    form.submit();
                                                                }
                                                            });
                                                        }
                                                        </script>
                                                @endif

                                                @can('Exportar Reporte de Préstamos')
                                                    <a href="{{ url('admin/prestamos/pdf/' . $prestamo->id) }}"
                                                        class="btn btn-secondary btn-sm" target="_blank">
                                                        <i class="fas fa-file-pdf"></i>
                                                    </a>
                                                @endcan

                                                @can('Eliminar Préstamo')
                                                    <form action="{{ route('admin.prestamos.destroy', $prestamo->id) }}"
                                                        method="post" onclick="preguntar{{ $prestamo->id }}(event)"
                                                        id="miFormulario{{ $prestamo->id }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm" title="Eliminar">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                @endcan

                                                <script>
                                                    function preguntar{{ $prestamo->id }}(event) {
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
                                                                var form = $('#miFormulario{{ $prestamo->id }}');
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

        /* Truncar contenido a 3 líneas con puntos suspensivos */
        .truncate-3-lines {
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: normal;
            text-align: center;
            vertical-align: top;
            word-break: break-word;
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
                "columnDefs": [{
                        "width": "4%",
                        "targets": 0
                    },
                    {
                        "width": "30%",
                        "targets": 1
                    },
                    {
                        "width": "12%",
                        "targets": 2
                    },
                    {
                        "width": "12%",
                        "targets": 3
                    },
                    {
                        "width": "12%",
                        "targets": 4
                    },
                    {
                        "width": "10%",
                        "targets": 5
                    },
                    {
                        "width": "20%",
                        "targets": 6
                    }
                ],
                "language": {
                    "emptyTable": "No hay información",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Fichas",
                    "infoEmpty": "Mostrando 0 a 0 de 0 Fichas",
                    "infoFiltered": "(Filtrado de _MAX_ total Fichas)",
                    "lengthMenu": "Mostrar _MENU_ Fichas",
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
                    @can('Exportar Reporte de Préstamos')
                        {
                            text: '<i class="fas fa-file-pdf"></i> PDF',
                            className: 'btn btn-danger',
                            action: function() {
                                window.open('{{ route('prestamos.exportar.pdf') }}', '_blank');
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
                                            "{{ route('prestamos.exportar') }}";
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
