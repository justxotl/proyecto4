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

                    <div class="card-tools">
                        <a href="{{ url('/admin/fichas/register') }}" class="btn btn-primary">Nueva Ficha</a>
                    </div>
                    <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body">
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
                                    <td style="text-align: center">{{ $ficha->fecha }}</td>
                                    <td>{{ $ficha->titulo}}</td>
                                    <td>
                                    @foreach ($ficha->autor as $autor)
                                        {{ $autor->nombre_autor }} {{ $autor->apellido_autor }}<br>
                                    @endforeach
                                    </td>
                                    <td>{{ $ficha->carrera->nombre }}</td>
                                    <td style="text-align: center">
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="{{ url('/admin/fichas/' . $ficha->id . '/edit') }}" type="button"
                                                style="border-radius: 3px"; class="btn btn-success btn-sm"><i
                                                    class="fas fa-pencil-alt"></i></a> &nbsp;
                                                    <a href="{{url('admin/fichas/'.$ficha->id)}}" type="button" style="border-radius: 3px"; class="btn btn-info btn-sm" ><i class="bi bi-eye fas fa-eye"></i></a> &nbsp;
                                            <form action="{{ url('/admin/fichas', $ficha->id) }}" method="post"
                                                onclick="preguntar{{ $ficha->id }}(event)"
                                                id="miFormulario{{ $ficha->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"><i
                                                        class="fas fa-trash"></i></button>
                                            </form>
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
                buttons: [{
                        text: '<i class="fas fa-copy"></i> COPIAR',
                        extend: 'copy',
                        className: 'btn btn-default'
                    },
                    {
                        text: '<i class="fas fa-file-pdf"></i> PDF',
                        extend: 'pdf',
                        className: 'btn btn-danger'
                    },
                    {
                        text: '<i class="fas fa-file-csv"></i> CSV',
                        extend: 'csv',
                        className: 'btn btn-info'
                    },
                    {
                        text: '<i class="fas fa-file-excel"></i> EXCEL',
                        extend: 'excel',
                        className: 'btn btn-success'
                    },
                    {
                        text: '<i class="fas fa-print"></i> IMPRIMIR',
                        extend: 'print',
                        className: 'btn btn-warning'
                    }
                ]
            }).buttons().container().appendTo('#example1_wrapper .row:eq(0)');
        });
    </script>
@stop
