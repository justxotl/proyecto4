@extends ('adminlte::page')

@section('title', 'Registro de Autores')

@section('content_header')
    <div class="row">
        <h1 class="ml-4 mt-3"><b>Registro de Autores</b></h1>
    </div>
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

    <hr>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-info">

                <div class="card-header">
                    <h3 class="card-title mt-1">Ingrese la información solicitada:</h3>
                    <div class="card-tools">
                        <a href="{{ url('/admin/autores') }}" class="btn btn-sm btn-secondary">Volver</a>
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>

                <div class="card-body">

                    <form action="{{ url('admin/autores/register') }}" method="post">
                        @csrf

                        {{-- Nombre field --}}
                        <div class="row">

                            {{-- CI User field --}}
                            <div class="input-group mb-3 col-md-12">
                                <input type="text" name="ci_autor" maxlength="8" inputmode="numeric"
                                        pattern="[0-9]*"
                                    class="form-control @error('ci_autor') is-invalid @enderror" value="{{ old('ci_autor') }}"
                                    placeholder="Cédula de Identidad del Autor" autocomplete="off" required autofocus>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-id-card {{ config('adminlte.classes_auth_icon', '') }}"></span>
                                    </div>
                                </div>
                                @error('ci_autor')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            {{-- Nombre field --}}
                            <div class="input-group mb-3 col-md-12">
                                <input type="text" name="nombre_autor"
                                    class="form-control @error('nombre_autor') is-invalid @enderror" value="{{ old('nombre_autor') }}"
                                    placeholder="Nombre del Autor" autocomplete="off" required>

                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-user {{ config('adminlte.classes_auth_icon', '') }}"></span>
                                    </div>
                                </div>

                                @error('nombre_autor')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            {{-- Apellido field --}}
                            <div class="input-group mb-3 col-md-12">
                                <input type="text" name="apellido_autor"
                                    class="form-control @error('apellido_autor') is-invalid @enderror"
                                    value="{{ old('apellido_autor') }}" placeholder="Apellido del Autor" autocomplete="off" required>

                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-user {{ config('adminlte.classes_auth_icon', '') }}"></span>
                                    </div>
                                </div>

                                @error('apellido_autor')
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
