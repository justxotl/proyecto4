@extends ('adminlte::page')

@section('title', 'Registro de Fichas')

@section('content_header')
<meta name="buscar-autor-url" content="{{ route('fichas.buscar', ':id') }}">
    <div class="row">
        <h1 class="ml-4 mt-3"><b>Registro de Ficha</b></h1>
    </div>
@stop

@section('content')

    <hr>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-info">

                <div class="card-header">
                    <h3 class="card-title mt-1">Ingrese la información solicitada:</h3>
                    <div class="card-tools mt-1">
                        <a href="{{ url('/admin/fichas') }}" class="btn btn-sm btn-secondary">Volver</a>
                        <a href="javascript:void(0)" class="btn btn-sm btn-info addRow"><i
                                class="fas fa-plus {{ config('adminlte.classes_auth_icon', '') }}"></i>&nbsp; Autor
                            Adicional</a>
                    </div>
                </div>

                <div class="card-body">

                    <form action="{{ url('admin/fichas/register') }}" id="form_ficha" method="post">

                        @csrf
                        
                        <button type="submit" disabled hidden aria-hidden="true"></button>
                        <input type="hidden" id="uri" value="{{ route('admin.fichas.index') }}">

                        <div class="row">
                            {{-- CI field --}}
                            <div class="input-group mb-3 col-md-4">
                                <input type="text" name="ci_autor[]" onkeyup="buscarAutor(event)" maxlength="8" inputmode="numeric" pattern="[0-9]*"
                                    class="form-control"
                                    value="{{ old('ci_autor') }}" placeholder="CI del Autor" id="ciautor" required
                                    autofocus autocomplete="off">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-id-card {{ config('adminlte.classes_auth_icon', '') }}"></span>
                                    </div>
                                </div>
                            </div>

                            {{-- Nombre field --}}
                            <div class="input-group mb-3 col-md-4" style="visibility: hidden" id="nombreAutor">
                                <input type="text" name="nombre_autor[]"
                                    class="form-control"
                                    value="{{ old('nombre_autor') }}" placeholder="Nombre del Autor" autocomplete="off" id="autorN"
                                    required>

                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-user {{ config('adminlte.classes_auth_icon', '') }}"></span>
                                    </div>
                                </div>
                            </div>

                            {{-- Apellido field --}}
                            <div class="input-group mb-3 col-md-4" style="visibility: hidden" id="apellidoAutor">
                                <input type="text" name="apellido_autor[]"
                                    class="form-control"
                                    value="{{ old('apellido_autor') }}" placeholder="Apellido del Autor" autocomplete="off" id="autorA"
                                    required>

                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-user {{ config('adminlte.classes_auth_icon', '') }}"></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="ficha_plus">

                        </div>

                        <div class="row" style="visibility: hidden" id="titleFicha">
                            {{-- Titulo field --}}
                            <div class="input-group mb-3 col-md-12">
                                <input type="text" name="titulo"
                                    class="form-control" value="{{ old('titulo') }}"
                                    placeholder="Título del Trabajo" id="titulo" autocomplete="off" required>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span
                                            class="fas fa-quote-right {{ config('adminlte.classes_auth_icon', '') }}"></span>
                                    </div>
                                </div>
                            </div>

                            {{-- Fecha field --}}
                            <div class="input-group mb-3 col-md-6">
                                <input type="date" name="fecha"
                                    class="form-control" value="{{ old('fecha') }}"
                                    id="fecha" required>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span
                                            class="fas fa-calendar {{ config('adminlte.classes_auth_icon', '') }}"></span>
                                    </div>
                                </div>

                            </div>

                            {{-- Carrera field --}}
                            <div class="input-group mb-3 col-md-6" id="carreraTrabajo">
                                <select name="carrera" id="carrera" class=" form-select form-control">
                                    @foreach ($carreras as $carrera)
                                        <option value="{{ $carrera->id }}">{{ $carrera->nombre }}</option>
                                    @endforeach
                                </select>

                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span
                                            class="fas fa-graduation-cap {{ config('adminlte.classes_auth_icon', '') }}"></span>
                                    </div>
                                </div>
                            </div>

                            {{-- Resumen field --}}
                            <div class="input-group mb-3 col-md-12">

                                <textarea name="resumen" id="resumen" rows="4" class="form-control"
                                    value="{{ old('resumen') }}" placeholder="Resumen del Trabajo" autocomplete="off" form="form_ficha" required></textarea>

                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span
                                            class="fas fa-quote-right {{ config('adminlte.classes_auth_icon', '') }}"></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Register button --}}
                        <button type="button" class="btn btn-primary" onclick="registrarAutor(event)">Registrar</button>
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
