@extends('adminlte::page')

@section('content_header')
    <div class="row">
        <h1 class="ml-4 mt-2"><b>Listado de Fichas</b></h1>
    </div>
    <hr>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h2 class="card-title mt-2">Fichas Bibliográficas</h2>

                    @can('Registrar Ficha')
                        <div class="card-tools">
                            <a href="{{ url('/admin/fichas/register') }}" class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp;
                                Nueva Ficha</a>
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
                                    <th style="text-align: center">Fecha</th>
                                    <th style="text-align: center">Título</th>
                                    <th style="text-align: center">Autor(es)</th>
                                    <th style="text-align: center">Materia</th>
                                    <th style="text-align: center">Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $contador = 1;
                                @endphp
                                @foreach ($fichas as $ficha)
                                    <tr>
                                        <td style="text-align: center">{{ $contador++ }}</td>
                                        <td style="text-align: center">
                                            {{ \Carbon\Carbon::parse($ficha->fecha)->format('d-m-Y') }}</td>
                                        <td class="titulo-columna" title="{{ $ficha->titulo }}">{{ $ficha->titulo }}</td>
                                        <td style="text-align: center">
                                            @if (count($ficha->autor) > 1)
                                                <a href="#" class="ver-autores-link" data-toggle="modal"
                                                    data-target="#modalAutores" data-ficha-id="{{ $ficha->id }}"
                                                    data-autores='@json($ficha->autor)'>
                                                    Ver ({{ count($ficha->autor) }}) autores
                                                </a>
                                                <span style="display:none">
                                                    {{ collect($ficha->autor)->map(function ($a) {
                                                            return $a->nombre_autor . ' ' . $a->apellido_autor;
                                                        })->implode(' ') }}
                                                </span>
                                            @elseif (count($ficha->autor) === 1)
                                                {{ $ficha->autor[0]->nombre_autor }} {{ $ficha->autor[0]->apellido_autor }}
                                            @else
                                                Sin autores
                                            @endif
                                        </td>
                                        <td>{{ $ficha->carrera->nombre }}</td>
                                        <td style="text-align: center">
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                @can('Editar Ficha')
                                                    <a href="{{ url('/admin/fichas/' . $ficha->id . '/edit') }}"
                                                        class="btn btn-success btn-sm">
                                                        <i class="fas fa-pen"></i>
                                                    </a>
                                                @endcan
                                                @can('Ver Información de Ficha')
                                                    <a href="{{ url('admin/fichas/' . $ficha->id) }}"
                                                        class="btn btn-info btn-sm">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                @endcan
                                                @can('Exportar Reporte de Ficha Única')
                                                    <a href="{{ url('admin/fichas/pdf/' . $ficha->id) }}"
                                                        class="btn btn-secondary btn-sm" target="_blank">
                                                        <i class="fas fa-file-pdf"></i>
                                                    </a>
                                                @endcan
                                                @can('Eliminar Ficha')
                                                    <form action="{{ url('/admin/fichas', $ficha->id) }}" method="post"
                                                        onclick="preguntar{{ $ficha->id }}(event)"
                                                        id="miFormulario{{ $ficha->id }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                @endcan
                                                <script>
                                                    function preguntar{{ $ficha->id }}(event) {
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
                                                                var form = $('#miFormulario{{ $ficha->id }}');
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
                        <!-- Modal -->
                        <div class="modal fade" id="modalAutores" tabindex="-1" role="dialog"
                            aria-labelledby="modalAutoresLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header mt-2 ml-3">
                                        <h5 class="modal-title">Autores de la ficha</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <ul id="lista-autores" class="list-group"></ul>
                                    </div>
                                </div>
                            </div>
                        </div>
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

        .titulo-columna {
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
                        "width": "5%",
                        "targets": 0
                    },
                    {
                        "width": "10%",
                        "targets": 1
                    },
                    {
                        "width": "30%",
                        "targets": 2
                    },
                    {
                        "width": "25%",
                        "targets": 3
                    },
                    {
                        "width": "15%",
                        "targets": 4
                    },
                    {
                        "width": "15%",
                        "targets": 5
                    },
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
                    @can('Exportar Reporte de Fichas')
                        {
                            text: '<i class="fas fa-file-pdf"></i> PDF',
                            className: 'btn btn-danger',
                            action: function() {
                                window.open('{{ route('fichas.exportar.pdf') }}', '_blank');
                            }
                        }, 
                        {
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
                                            "{{ route('fichas.exportar') }}";
                                    }
                                });
                            },
                        }
                    @endcan
                ]
            }).buttons().container().appendTo('#example1_wrapper .row:eq(0)');
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.ver-autores-link').on('click', function() {
                const autores = $(this).data('autores');
                const lista = $('#lista-autores');
                lista.empty();

                if (Array.isArray(autores)) {
                    autores.forEach(function(autor) {
                        lista.append(
                            `<li class="list-group-item">${autor.nombre_autor} ${autor.apellido_autor} (C.I: ${autor.ci_autor})</li>`
                        );
                    });
                }
            });
        });
    </script>
@stop
