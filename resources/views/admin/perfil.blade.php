@extends('adminlte::page')

@section('content_header')
    <div class="row">
        <h1 class="ml-4 mt-2"><b>Bienvenido, {{ Auth::user()->name }} ({{Auth::user()->email}})</b></h1>
    </div>
    <hr>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-info">
                <div class="card-header">
                    <h3 class="card-title mt-1">Datos:</h3>

                    {{-- <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div> --}}
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
                                    <input type="text" name="ci_us" value="{{ Auth::User()->infoper->ci_us }}"
                                        class="form-control" readonly>
                                    @error('ci_us')
                                        <small style="color: red;">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form group">
                                    <label for="">Nombre:</label>
                                    <input type="text" name="nombre" value="{{ Auth::User()->infoper->nombre }}"
                                        class="form-control" readonly>
                                    @error('nombre')
                                        <small style="color: red;">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form group">
                                    <label for="">Apellido:</label>
                                    <input type="text" name="apellido" value="{{ Auth::User()->infoper->apellido }}"
                                        class="form-control" readonly>
                                    @error('apellido')
                                        <small style="color: red;">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <h3 class="text-center mt-4 mb-4"><b>Datos Actualizables:</b></h3>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-md-6">
                                <div class="form group">
                                    <label for="">Nombre de Usuario:</label>
                                    <input type="text" name="name" value="{{ Auth::User()->name }}"
                                        class="form-control" required>
                                    @error('name')
                                        <small style="color: red;">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form group">
                                    <label for="">Email:</label>
                                    <input type="email" name="email" value="{{ Auth::User()->email }}"
                                        class="form-control" required>
                                    @error('email')
                                        <small style="color: red;">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-md-6">
                                <div class="form group">
                                    <label for="">Pregunta #1:</label>
                                    <input type="text" name="preguntauno" value="{{ $preguntas->pregunta_uno }}"
                                        class="form-control">
                                    @error('preguntauno')
                                        <small style="color: red;">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form group">
                                    <label for="">Pregunta #2:</label>
                                    <input type="text" name="preguntados" value="{{ $preguntas->pregunta_dos }}"
                                        class="form-control">
                                    @error('preguntados')
                                        <small style="color: red;">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mt-1">
                            <div class="col-md-6">
                                <div class="form group">
                                    <label for="">Respuesta #1:</label>
                                    <input type="text" name="respuestauno" value="{{ $preguntas->respuesta_uno }}"
                                        class="form-control">
                                    @error('respuestauno')
                                        <small style="color: red;">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form group">
                                    <label for="">Respuesta #2:</label>
                                    <input type="text" name="respuestados" value="{{ $preguntas->respuesta_dos }}"
                                        class="form-control">
                                    @error('respuestados')
                                        <small style="color: red;">{{ $message }}</small>
                                    @enderror
                                </div>
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
                    </form>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
@stop

@section('css')

@stop

@section('js')

@stop
