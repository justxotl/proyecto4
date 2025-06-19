@extends('adminlte::page')

@section('content_header')
    <div class="row">
        <h1 class="ml-2 mt-2"><b>Bienvenid@, {{ Auth::user()->name }} ({{ Auth::user()->email }})</b></h1>
    </div>
    <hr>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-info">
                <div class="card-header">
                    <h3 class="card-title mt-1">Datos del Usuario:</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                    <!-- /.card-tools -->
                </div>

                <!-- /.card-header -->
                <div class="card-body">
                    <form action="{{ url('admin/usuarios', Auth::User()->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="redirect_to" value="perfil">
                        <div class="row">

                            <div class="col-md-4">
                                <div class="form group">
                                    <label for="">Cédula:</label>
                                    <div class="input-group">
                                        <input type="text" name="ci_us" value="{{ Auth::User()->infoper->ci_us }}"
                                            class="form-control" readonly>
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-id-card"></span>
                                            </div>
                                        </div>
                                    </div>
                                    @error('ci_us')
                                        <small style="color: red;">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form group">
                                    <label for="">Nombre:</label>
                                    <div class="input-group">
                                        <input type="text" name="nombre" value="{{ Auth::User()->infoper->nombre }}"
                                            class="form-control" readonly>
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-user"></span>
                                            </div>
                                        </div>
                                    </div>
                                    @error('nombre')
                                        <small style="color: red;">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form group">
                                    <label for="">Apellido:</label>
                                    <div class="input-group">
                                        <input type="text" name="apellido" value="{{ Auth::User()->infoper->apellido }}"
                                            class="form-control" readonly>
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-user"></span>
                                            </div>
                                        </div>
                                    </div>
                                    @error('apellido')
                                        <small style="color: red;">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        @can('Editar Perfil de Usuario')
                            <div class="row">
                                <div class="col-md-12">
                                    <h3 class="text-center mt-4 mb-4"><b>Datos Actualizables:</b></h3>
                                </div>
                            </div>

                            {{-- Nombre de Usuario --}}
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="">Nombre de Usuario:</label>
                                    <div class="input-group">
                                        <input type="text" name="name" value="{{ Auth::User()->name }}"
                                            class="form-control" autocomplete="off" required>
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-user"></span>
                                            </div>
                                        </div>
                                    </div>
                                    @error('name')
                                        <small style="color: red;">{{ $message }}</small>
                                    @enderror
                                </div>

                                {{-- Email --}}
                                <div class="form-group col-md-6">
                                    <label for="">Email:</label>
                                    <div class="input-group">
                                        <input type="email" name="email" value="{{ Auth::User()->email }}"
                                            class="form-control" autocomplete="off" required>
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-envelope"></span>
                                            </div>
                                        </div>
                                    </div>
                                    @error('email')
                                        <small style="color: red;">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            {{-- Pregunta #1 --}}
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="">Pregunta #1:</label>
                                    <div class="input-group">
                                        <input type="text" name="preguntauno" value="{{ $preguntas->pregunta_uno }}"
                                            class="form-control" autocomplete="off" placeholder="Pregunta de Seguridad #1">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-question-circle"></span>
                                            </div>
                                        </div>
                                    </div>
                                    @error('preguntauno')
                                        <small style="color: red;">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="">Pregunta #2:</label>
                                    <div class="input-group">
                                        <input type="text" name="preguntados" value="{{ $preguntas->pregunta_dos }}"
                                            class="form-control" placeholder="Pregunta de Seguridad #2" autocomplete="off">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-question-circle"></span>
                                            </div>
                                        </div>
                                    </div>
                                    @error('preguntados')
                                        <small style="color: red;">{{ $message }}</small>
                                    @enderror
                                </div>

                            </div>
                            {{-- Respuesta #1 --}}
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="">Respuesta #1:</label>
                                    <div class="input-group">
                                        <input type="text" name="respuestauno" value="{{ $preguntas->respuesta_uno }}"
                                            class="form-control" placeholder="Respuesta de Seguridad #1" autocomplete="off">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-key"></span>
                                            </div>
                                        </div>
                                    </div>
                                    @error('respuestauno')
                                        <small style="color: red;">{{ $message }}</small>
                                    @enderror
                                </div>

                                {{-- Respuesta #1 --}}
                                <div class="form-group col-md-6">
                                    <label for="">Respuesta #2:</label>
                                    <div class="input-group">
                                        <input type="text" name="respuestados" value="{{ $preguntas->respuesta_dos }}"
                                            class="form-control" placeholder="Respuesta de Seguridad #2" autocomplete="off">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-key"></span>
                                            </div>
                                        </div>
                                    </div>
                                    @error('respuestados')
                                        <small style="color: red;">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <br>

                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <div class="form group">
                                        <button type="submit" class="btn btn-primary">Actualizar</button>
                                    </div>
                                </div>
                            </div>
                        @endcan
                    </form>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
@stop

@section('css')
    <style>
        .content-header,
        .content-header h1,
        .content-header .content-title {
            overflow-wrap: break-word;
            word-break: break-word;
            white-space: normal !important;
        }
    </style>
@stop

@can('Editar Perfil de Usuario')
    @section('js')
        <script src="{{ asset('plugins/sweetalert2.all.min.js') }}"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                let pregunta1 = document.querySelector('input[name="preguntauno"]').value.trim();
                let pregunta2 = document.querySelector('input[name="preguntados"]').value.trim();
                let respuesta1 = document.querySelector('input[name="respuestauno"]').value.trim();
                let respuesta2 = document.querySelector('input[name="respuestados"]').value.trim();

                if (!pregunta1 || !pregunta2 || !respuesta1 || !respuesta2) {
                    Swal.fire({
                        title: '¡Atención!',
                        text: 'Debes completar tus preguntas y respuestas de seguridad para proteger tu cuenta.',
                        icon: 'warning',
                        confirmButtonText: 'Entendido'
                    });
                }
            });

            document.querySelector('form').addEventListener('submit', function(e) {
                let pregunta1 = document.querySelector('input[name="preguntauno"]').value.trim();
                let pregunta2 = document.querySelector('input[name="preguntados"]').value.trim();
                let respuesta1 = document.querySelector('input[name="respuestauno"]').value.trim();
                let respuesta2 = document.querySelector('input[name="respuestados"]').value.trim();

                if (!pregunta1 || !pregunta2 || !respuesta1 || !respuesta2) {
                    e.preventDefault();
                    Swal.fire({
                        title: '¡Atención!',
                        text: 'Debes completar las preguntas y respuestas de seguridad antes de actualizar tus datos.',
                        icon: 'warning',
                        confirmButtonText: 'Entendido'
                    });
                }
            });
        </script>
    @stop
@endcan
