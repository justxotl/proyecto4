@extends ('adminlte::page')

@section('title', 'Detalles de Ficha')

@section('content_header')
    <div class="row">
        <h1 class="ml-4 mt-3"><b>Detalles de la Ficha</b></h1>
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
                    <h3 class="card-title mt-2">Ingrese la información solicitada:</h3>
                    <div class="card-tools">
                        <a href="{{ url('/admin/fichas') }}" class="btn btn-secondary">Volver</a>
                    </div>
                </div>

                <div class="card-body">

                    <form action="{{ url('admin/fichas/register') }}" id="form_ficha" method="post">
                        @csrf
                        @foreach ($ficha->autor as $autor)
                            <div class="row">
                                {{-- CI field --}}
                                <div class="input-group mb-3 col-md-4">
                                    <input type="text" name="ci_autor[]" onkeyup="buscarAutor(event)"
                                        class="form-control @error('ci_autor') is-invalid @enderror"
                                        value="{{ $autor->ci_autor }}" placeholder="CI del Autor" id="ciautor" disabled>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span
                                                class="fas fa-id-card {{ config('adminlte.classes_auth_icon', '') }}"></span>
                                        </div>
                                    </div>
                                </div>

                                {{-- Nombre field --}}
                                <div class="input-group mb-3 col-md-4" id="nombreAutor">
                                    <input type="text" name="nombre_autor[]"
                                        class="form-control @error('nombre_autor') is-invalid @enderror"
                                        value="{{ $autor->nombre_autor }}" placeholder="Nombre del Autor" id="autorN"
                                        disabled>

                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-user {{ config('adminlte.classes_auth_icon', '') }}"></span>
                                        </div>
                                    </div>
                                </div>

                                {{-- Apellido field --}}
                                <div class="input-group mb-3 col-md-4" id="apellidoAutor">
                                    <input type="text" name="apellido_autor[]"
                                        class="form-control @error('apellido_autor') is-invalid @enderror"
                                        value="{{ $autor->apellido_autor }}" placeholder="Apellido del Autor" id="autorA"
                                        disabled>

                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-user {{ config('adminlte.classes_auth_icon', '') }}"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="row" id="titleFicha">
                            {{-- Titulo field --}}
                            <div class="input-group mb-3 col-md-12">
                                <textarea name="resumen" id="resumen" rows="3" class="form-control" disabled>{{ $ficha->titulo }}</textarea>
                                
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span
                                            class="fas fa-quote-right {{ config('adminlte.classes_auth_icon', '') }}"></span>
                                    </div>
                                </div>
                                @error('titulo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            {{-- Fecha field --}}
                            <div class="input-group mb-3 col-md-6">
                                <input type="date" name="fecha"
                                    class="form-control @error('fecha') is-invalid @enderror" value="{{ $ficha->fecha }}"
                                    id="fecha" disabled>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span
                                            class="fas fa-calendar {{ config('adminlte.classes_auth_icon', '') }}"></span>
                                    </div>
                                </div>
                                @error('fecha')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            {{-- Carrera field --}}
                            <div class="input-group mb-3 col-md-6" id="carreraTrabajo">
                                <input type="text" name="carrera"
                                    class="form-control @error('titulo') is-invalid @enderror"
                                    value="{{ $ficha->carrera->nombre }}" placeholder="Carrera" id="carrera" disabled>

                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span
                                            class="fas fa-graduation-cap {{ config('adminlte.classes_auth_icon', '') }}"></span>
                                    </div>
                                </div>

                                @error('carrera')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            {{-- Resumen field --}}
                            <div class="input-group mb-3 col-md-12">

                                <textarea name="resumen" id="resumen" rows="5" class="form-control" disabled>{{ $ficha->resumen }}</textarea>

                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span
                                            class="fas fa-quote-right {{ config('adminlte.classes_auth_icon', '') }}"></span>
                                    </div>
                                </div>

                                @error('resumen')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@stop

@section('css')
@stop

@section('js')

@stop
