@extends ('adminlte::page')

@section('title', 'Registro de Autores')

@section('content_header')
    <div class="row">
        <h1 class="ml-4 mt-3"><b>Registro de Autores</b></h1>
    </div>
@stop

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <hr>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-info">

                <div class="card-header">
                    <h3 class="card-title">Ingrese la información solicitada:</h3>
                </div>

                <div class="card-body">

                    <form action="{{ url('admin/autores/register') }}" method="post">
                        @csrf

                        {{-- Nombre field --}}
                        <div class="row">

                            {{-- CI User field --}}
                            <div class="input-group mb-3 col-md-12">
                                <input type="text" name="ci_autor"
                                    class="form-control @error('ci_autor') is-invalid @enderror" value="{{ old('ci_autor') }}"
                                    placeholder="Cédula de Identidad" required autofocus>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-id-card {{ config('adminlte.classes_auth_icon', '') }}"></span>
                                    </div>
                                </div>
                                @error('ci_us')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            {{-- Nombre field --}}
                            <div class="input-group mb-3 col-md-12">
                                <input type="text" name="nombre_autor"
                                    class="form-control @error('nombre_autor') is-invalid @enderror" value="{{ old('nombre_autor') }}"
                                    placeholder="Nombre" required>

                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-user {{ config('adminlte.classes_auth_icon', '') }}"></span>
                                    </div>
                                </div>

                                @error('nombre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            {{-- Apellido field --}}
                            <div class="input-group mb-3 col-md-12">
                                <input type="text" name="apellido_autor"
                                    class="form-control @error('apellido_autor') is-invalid @enderror"
                                    value="{{ old('apellido_autor') }}" placeholder="Apellido" required>

                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-user {{ config('adminlte.classes_auth_icon', '') }}"></span>
                                    </div>
                                </div>

                                @error('apellido')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- Register button --}}
                        <a href="{{ url('/admin/autores') }}" class="btn btn-secondary">Volver</a> &nbsp;
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
