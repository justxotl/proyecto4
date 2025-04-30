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
                    <h3 class="card-title mt-1">Datos Registrados</h3>

                    <div class="card-tools">
                        <a href="{{ url('/admin/usuarios') }}" class="btn btn-secondary">Volver</a>
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-angle-down"></i>
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form group">
                                    <label for="">Nombre de Usuario</label>
                                    <p>{{$usuario->name}}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form group">
                                    <label for="">Nombre</label>
                                    <p>{{$usuario->infoper->ci_us}}</p>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form group">
                                    <label for="">Nombre</label>
                                    <p>{{$usuario->infoper->nombre}}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form group">
                                    <label for="">Apellido</label>
                                    <p>{{$usuario->infoper->apellido}}</p>
                                </div>
                            </div>
                        </div>

                        <br>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form group">
                                    <label for="">Email</label>
                                    <p>{{$usuario->email}}</p>
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
