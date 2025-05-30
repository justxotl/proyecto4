@extends ('adminlte::page')

@section('title', 'Registro de Carreras')

@section('content_header')
    <div class="row">
        <h1 class="ml-4 mt-3"><b>Registro de Carreras</b></h1>
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
            <div class="card card-outline card-info">

                <div class="card-header">
                    <h3 class="card-title mt-1">Ingrese la información solicitada:</h3>
                    <div class="card-tools">
                        <a href="{{ url('/admin/carreras') }}" class="btn btn-sm btn-secondary">Volver</a>
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                    </div>

                </div>

                <div class="card-body">

                    <form action="{{ url('admin/carreras/register') }}" method="post">
                        @csrf

                        <div class="row">

                            {{-- Nombre field --}}
                            <div class="input-group mb-3 col-md-12">
                                <input type="text" name="nombre_carrera"
                                    class="form-control @error('nombre_carrera') is-invalid @enderror"
                                    value="{{ old('nombre_carrera') }}" placeholder="Nombre de la Carrera" autocomplete="off" required autofocus>

                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-graduation-cap {{ config('adminlte.classes_auth_icon', '') }}"></span>
                                    </div>
                                </div>

                                @error('nombre_carrera')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- Register button --}}
                        <button type="submit" class="btn btn-primary">Registrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>

@stop

@section('css')
@stop

@section('js')
@stop
