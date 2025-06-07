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
                            <button type="button" class="btn btn-sm btn-info" data-toggle="modal"
                                data-target="#modalPrestatarios">
                                <i class="fas fa-users"></i> Ver Prestatarios
                            </button>
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
                                        <td>{{ $prestamo->prestatario->ci_prestatario }}</td>
                                        <td>{{ Carbon::parse($prestamo->fecha_prestamo)->format('d/m/Y') }}</td>
                                        <td>{{ Carbon::parse($prestamo->fecha_devolucion)->format('d/m/Y') }}</td>
                                        @php
                                            $hoy = Carbon::today();
                                            $fechaPrestamo = Carbon::parse($prestamo->fecha_prestamo);
                                            $fechaDevolucion = Carbon::parse($prestamo->fecha_devolucion);

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
                                                            onclick="askDevolver{{ $prestamo->id }}(event)"
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
                                                        function askDevolver{{ $prestamo->id }}(event) {
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
    <!-- Modal -->
    <div class="modal fade" id="modalPrestatarios" tabindex="-1" role="dialog" data-backdrop="static"
        data-keyboard="false" aria-labelledby="modalPrestatariosLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h4 class="card-title mt-2">Listado de Prestatarios</h4>
                            <div class="card-tools">
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#modalRegistrarPrestatario">
                                    <i class="fas fa-plus"></i> Nuevo Prestatario
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="tablaPrestatarios"
                                    class="table table-bordered table-hover table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center">#</th>
                                            <th style="text-align: center">Cédula</th>
                                            <th style="text-align: center">Nombre</th>
                                            <th style="text-align: center">Apellido</th>
                                            <th style="text-align: center">Teléfono</th>
                                            <th style="text-align: center">Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($prestatarios as $prestatario)
                                            <tr id="fila-prestatario-{{ $prestatario->id }}">
                                                <td>{{ $loop->iteration }}</td>
                                                <td class="editable" data-campo="ci_prestatario">
                                                    {{ $prestatario->ci_prestatario }}
                                                </td>
                                                <td class="editable" data-campo="nombre_prestatario">
                                                    {{ $prestatario->nombre_prestatario }}</td>
                                                <td class="editable" data-campo="apellido_prestatario">
                                                    {{ $prestatario->apellido_prestatario }}</td>
                                                <td class="editable" data-campo="tlf_prestatario">
                                                    {{ $prestatario->tlf_prestatario }}</td>
                                                <td class="acciones">
                                                    <a href="javascript:void(0);"
                                                        onclick="editarPrestatario({{ $prestatario->id }})"
                                                        class="btn btn-success btn-sm" title="Editar"><i
                                                            class="fas fa-pen"></i></a>
                                                    <form action="{{ route('prestatarios.destroy', $prestatario->id) }}"
                                                        method="POST" style="display:inline;"
                                                        onclick="askEliminarPrestatario({{ $prestatario->id }}, event)"
                                                        id="form{{ $prestatario->id }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm"
                                                            title="Eliminar"><i class="fas fa-trash"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal para registrar prestatario -->
    <div class="modal fade col-md-12" id="modalRegistrarPrestatario" data-backdrop="static" data-keyboard="false"
        tabindex="-1" role="dialog" aria-labelledby="modalRegistrarPrestatarioLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form id="formNuevoPrestatario">
                @csrf
                <div class="modal-content">
                    <div class="card card-outline card-success m-0">
                        <div class="card-header">
                            <h4 class="card-title mt-1">Registrar Prestatario</h4>
                        </div>
                        <div class="card-body">

                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label>Cédula del prestatario:</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Cédula del Prestatario"
                                            maxlength="8" inputmode="numeric" pattern="[0-9]*" name="ci_prestatario"
                                            autocomplete="off" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="fas fa-id-card"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    <label>Nombre(s) del prestatario:</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control"
                                            placeholder="Nombre(s) del Prestatario" name="nombre_prestatario"
                                            autocomplete="off" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="fas fa-user"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    <label>Apellido(s) del prestatario:</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control"
                                            placeholder="Apellido(s) del Prestatario" name="apellido_prestatario"
                                            autocomplete="off" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="fas fa-user"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    <label>Teléfono del prestatario:</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Teléfono del Prestatario"
                                            maxlength="11" inputmode="numeric" pattern="[0-9]*" name="tlf_prestatario"
                                            autocomplete="off" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="fas fa-phone"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-center">
                                <button type="submit" class="btn btn-success">Registrar</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            </div>
                        </div>
                    </div>
            </form>
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
                destroy: true,
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
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Préstamos",
                    "infoEmpty": "Mostrando 0 a 0 de 0 Préstamos",
                    "infoFiltered": "(Filtrado de _MAX_ total Préstamos)",
                    "lengthMenu": "Mostrar _MENU_ Préstamos",
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
                                            '{{ route('prestamos.exportar.pdf') }}',
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
                                            "{{ route('prestamos.exportar') }}";
                                    }
                                });
                            },
                        }
                    @endcan
                ]
            }).buttons().container().appendTo('#example1_wrapper .row:eq(0)');
        });

        $('#modalPrestatarios').on('shown.bs.modal', function() {
            var table = $('#tablaPrestatarios').DataTable({
                pageLength: 5,
                lengthMenu: [
                    [5, 10, 20],
                    [5, 10, 20]
                ],
                responsive: true,
                lengthChange: true,
                autoWidth: false,
                destroy: true,
                language: {
                    url: '{{ asset('plugins/es-ES.json') }}'
                },
            });
        });


        function editarPrestatario(id) {
            var fila = $('#fila-prestatario-' + id);
            fila.find('.editable').each(function() {
                var valor = $(this).text().trim();
                var campo = $(this).data('campo');
                let atributos = 'class="form-control form-control-sm"';

                if (campo === 'ci_prestatario') {
                    atributos += ' autocomplete="off" maxlength="8" minlength="6" inputmode="numeric"';
                }
                if (campo === 'tlf_prestatario') {
                    atributos += ' autocomplete="off" maxlength="11" minlength="11" inputmode="numeric"';
                }
                if (campo === 'nombre_prestatario' || campo === 'apellido_prestatario') {
                    atributos += ' autocomplete="off" maxlength="255"';
                }

                $(this).attr('data-valor-original', valor);
                $(this).html('<input type="text" ' + atributos + ' value="' + valor + '" name="' + campo + '">');
            });
            fila.find('.acciones').html(
                '<button class="btn btn-primary btn-sm" onclick="guardarPrestatario(' + id +
                ')"><i class="fas fa-save"></i></button>' +
                '<button class="btn btn-secondary btn-sm ms-2 ml-1" onclick="cancelarEdicion(' + id +
                ')"><i class="fas fa-times"></i></button>'
            );
        }

        function cancelarEdicion(id) {
            var fila = $('#fila-prestatario-' + id);
            fila.find('.editable').each(function() {
                var valorOriginal = $(this).attr('data-valor-original');
                $(this).html(valorOriginal);
            });
            // Restaura los botones originales
            fila.find('.acciones').html(
                `<a href="javascript:void(0);" onclick="editarPrestatario(${id})" class="btn btn-success btn-sm" title="Editar"><i class="fas fa-pen"></i></a>
            <form action="${'{{ route('prestatarios.destroy', ':id') }}'.replace(':id', id)}" method="POST" style="display:inline;" onclick="askEliminarPrestatario(${id}, event)" id="form${id}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="_method" value="DELETE">
            <button type="submit" class="btn btn-danger btn-sm" title="Eliminar"><i class="fas fa-trash"></i></button>
            </form>`
            );
        }

        function guardarPrestatario(id) {
            var fila = $('#fila-prestatario-' + id);
            var data = {
                _token: '{{ csrf_token() }}',
                ci_prestatario: fila.find('input[name=ci_prestatario]').val(),
                nombre_prestatario: fila.find('input[name=nombre_prestatario]').val(),
                apellido_prestatario: fila.find('input[name=apellido_prestatario]').val(),
                tlf_prestatario: fila.find('input[name=tlf_prestatario]').val(),
            };
            $.ajax({
                url: "{{ route('prestatarios.update', ':id') }}".replace(':id', id),
                method: 'PUT',
                data: data,
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: '¡Actualizado!',
                        text: 'El prestatario ha sido actualizado correctamente.',
                        timer: 1800,
                        showConfirmButton: false
                    });
                    setTimeout(function() {
                        location.reload();
                    }, 1800);
                },
                error: function(xhr) {
                    if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {

                        let mensajes = '';
                        Object.values(xhr.responseJSON.errors).forEach(function(msgArr) {
                            mensajes += msgArr.join('<br>') + '<br>';
                        });
                        Swal.fire({
                            icon: 'error',
                            title: 'Error de validación de campos.',
                            html: mensajes,
                        });
                    } else if (xhr.responseJSON && xhr.responseJSON.message) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: xhr.responseJSON.message,
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'No se pudo guardar el cambio.',
                        });
                    }
                }
            });
        }

        function askEliminarPrestatario(id, event) {
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
                    $('#form' + id).submit();
                }
            });
        }

        let registroExitoso = false;

        $('#formNuevoPrestatario').submit(function(e) {
            e.preventDefault();

            const datos = $(this).serialize();

            $.ajax({
                url: "{{ route('prestatarios.store') }}",
                method: "POST",
                data: datos,
                success: function(response) {
                    registroExitoso = true;
                    $('#modalRegistrarPrestatario').modal('hide');
                    Swal.fire({
                        icon: 'success',
                        title: '¡Prestatario registrado!',
                        text: 'El prestatario ha sido registrado correctamente.',
                        timer: 1500,
                        showConfirmButton: false
                    });
                    setTimeout(function() {
                        location.reload();
                    }, 1500);
                },
                error: function(xhr) {
                    if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {

                        let mensajes = '';
                        Object.values(xhr.responseJSON.errors).forEach(function(msgArr) {
                            mensajes += msgArr.join('<br>') + '<br>';
                        });
                        Swal.fire({
                            icon: 'error',
                            title: 'Error de validación de campos.',
                            html: mensajes,
                        });
                    } else if (xhr.responseJSON && xhr.responseJSON.message) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: xhr.responseJSON.message,
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'No se pudo guardar el cambio.',
                        });
                    }
                }
            });
        });

        $('#modalRegistrarPrestatario').on('show.bs.modal', function() {
            $('#modalPrestatarios').modal('hide');
        });

        $('#modalRegistrarPrestatario').on('hidden.bs.modal', function() {
            if (!registroExitoso) {
                $('#modalPrestatarios').modal('show');
            }
            registroExitoso = false;
        });
    </script>
@stop
