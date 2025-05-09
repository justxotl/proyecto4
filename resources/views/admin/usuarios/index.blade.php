@extends('adminlte::page')

@section('content_header')
    <div class="row">
        <h1 class="ml-4 mt-2"><b>Listado de Usuarios</b></h1>
    </div>
    <hr>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h2 class="card-title mt-2">Usuarios registrados</h2>

                    <div class="card-tools">
                        <a href="{{ url('/admin/usuarios/register') }}" class="btn btn-primary">Nuevo Usuario</a>
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
                                    <th style="text-align: center">Nombre de Usuario</th>
                                    <th style="text-align: center">Nombre(s)</th>
                                    <th style="text-align: center">Apellido(s)</th>
                                    <th style="text-align: center">Correo</th>
                                    <th style="text-align: center">Cédula</th>
                                    <th style="text-align: center">Rol</th>
                                    <th style="text-align: center">Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $contador = 1;
                                @endphp
                                @foreach ($usuarios as $usuario)
                                    <tr>
                                        <td style="text-align: center">{{ $contador++ }}</td>
                                        <td>{{ $usuario->name }}</td>
                                        <td>{{ $usuario->infoper->nombre }}</td>
                                        <td>{{ $usuario->infoper->apellido }}</td>
                                        <td>{{ $usuario->email }}</td>
                                        <td>{{ $usuario->infoper->ci_us }}</td>
                                        <td>{{ $usuario->roles->pluck('name')->implode(', ') }}</td>
                                        <td style="text-align: center">
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="{{ url('/admin/usuarios/' . $usuario->id . '/edit') }}"
                                                    type="button" style="border-radius: 3px";
                                                    class="btn btn-success btn-sm"><i class="fas fa-pencil-alt"></i></a>
                                                &nbsp;
                                                <a href="{{ url('admin/usuarios/' . $usuario->id) }}" type="button"
                                                    style="border-radius: 3px"; class="btn btn-info btn-sm"><i
                                                        class="bi bi-eye fas fa-eye"></i></a> &nbsp;
                                                <form action="{{ url('/admin/usuarios', $usuario->id) }}" method="post"
                                                    onclick="preguntar{{ $usuario->id }}(event)"
                                                    id="miFormulario{{ $usuario->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i
                                                            class="fas fa-trash"></i></button>
                                                </form>
                                                <script>
                                                    function preguntar{{ $usuario->id }}(event) {
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
                                                                var form = $('#miFormulario{{ $usuario->id }}');
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
            margin-bottom: 15px;
            /* Separar botones de la tabla */
        }

        /* Estilo personalizado para los botones */
        #example1_wrapper .btn {
            color: #fff;
            /* Color del texto en blanco */
            border-radius: 4px;
            /* Bordes redondeados */
            padding: 5px 15px;
            /* Espaciado interno */
            font-size: 14px;
            /* Tamaño de fuente */
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
                "responsive": true,
                "lengthChange": true,
                "autoWidth": false,

                "language": {
                    "emptyTable": "No hay información",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Usuarios",
                    "infoEmpty": "Mostrando 0 a 0 de 0 Usuarios",
                    "infoFiltered": "(Filtrado de _MAX_ total Usuarios)",
                    "lengthMenu": "Mostrar _MENU_ Usuarios",
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

                buttons: [{
                        text: '<i class="fas fa-copy"></i> COPIAR',
                        extend: 'copy',
                        className: 'btn btn-default'
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="fas fa-file-pdf"></i> PDF',
                        className: 'btn btn-danger',
                        orientation: 'landscape',
                        pageSize: 'A4',
                        title: 'Listado de Usuarios',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6] // columnas a exportar
                        },
                        customize: function(doc) {
                            doc.styles.title = {
                                fontSize: 16,
                                alignment: 'center',
                                bold: true
                            };

                            doc.pageMargins = [40, 60, 40, 60];

                            doc.footer = function(currentPage, pageCount) {
                                return {
                                    text: 'Página ' + currentPage.toString() + ' de ' +
                                        pageCount,
                                    alignment: 'right',
                                    margin: [0, 0, 20, 0]
                                };
                            };

                            doc.content[1].table.widths = ['5%', '15%', '15%', '15%', '30%', '10%',
                                '10%'
                            ]; // ancho por columna

                            // Centrar el texto de todas las celdas
                            var body = doc.content[1].table.body;
                            body.forEach(function(row, rowIndex) {
                                row.forEach(function(cell, cellIndex) {
                                    if (rowIndex === 0) {
                                        // Encabezados de la tabla
                                        cell.alignment = 'center';
                                        cell.bold = true;
                                    } else {
                                        // Celdas del cuerpo
                                        cell.alignment = 'center';
                                    }
                                });
                            });
                        }

                    },
                ]
            }).buttons().container().appendTo('#example1_wrapper .row:eq(0)');
        });
    </script>
@stop
