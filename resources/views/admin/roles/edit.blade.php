@extends('adminlte::page')

@section('title', 'Modificar Rol')

@section('content_header')
    <div class="row">
        <h1 class="ml-2 mt-3"><b>Modificar "{{ $rol->name }}"</b></h1>
    </div>
    <hr>
@stop

@section('content')

    @if ($errors->any())
        <div class="">
            <ul>
                @foreach ($errors->all() as $error)
                    <li><span class="invalid-feedback d-block" role="alert"><strong>{{ $error }}</strong></span></li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-success">
                <div class="card-header">
                    <h3 class="card-title mt-1">Ingrese los datos a modificar:</h3>

                    <div class="card-tools">
                        <a href="{{ route('admin.roles.index') }}" class="btn btn-sm btn-secondary">Volver</a>
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                    <!-- /.card-tools -->
                </div>

                <!-- /.card-header -->
                <div class="card-body">
                    <form action="{{ url('admin/roles', $rol->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form group">
                                    <label for="">Nombre del Rol:</label>
                                    <div class="input-group mb-3">
                                        <input type="text" name="name" value="{{ old('name', $rol->name) }}"
                                            placeholder="Nombre del Rol"
                                            class="form-control @error('name') is-invalid @enderror" autocomplete="off"
                                            required autofocus>
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span
                                                    class="fas fa-filter {{ config('adminlte.classes_auth_icon', '') }}"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success">Actualizar Rol</button>
                    </form>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection

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
