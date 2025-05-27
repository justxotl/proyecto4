@extends('adminlte::page')

@section('title', 'Información de Usuario')

@extends('adminlte::page')

@section('title', 'Información de Usuario')

@section('content')
    <div class="row">
        <h1 class="ml-4 mt-4"><b>Información de "{{$usuario->name}}"</b></h1>
    </div>

    <hr>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-info">
                <div class="card-header">
                    <h3 class="card-title mt-1"><b>Datos Registrados:</b></h3>

                    <div class="card-tools">
                        <a href="{{ url('/admin/usuarios') }}" class="btn btn-sm btn-secondary">Volver</a>
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-angle-down"></i>
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Nombre de Usuario:</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" value="{{ $usuario->name }}" disabled>
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="fas fa-user"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Cédula:</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" value="{{ $usuario->infoper->ci_us }}" disabled>
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="fas fa-id-card"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Nombre:</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" value="{{ $usuario->infoper->nombre }}" disabled>
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="fas fa-id-card"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Apellido:</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" value="{{ $usuario->infoper->apellido }}" disabled>
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="fas fa-id-card"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Email:</label>
                                <div class="input-group">
                                    <input type="email" class="form-control" value="{{ $usuario->email }}" disabled>
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="fas fa-envelope"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Rol:</label>
                                <div class="input-group">
                                    <input type="email" class="form-control" value="{{ $usuario->roles->pluck('name')->implode(', ') }}" disabled>
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="fas fa-filter"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection