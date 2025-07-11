@extends ('adminlte::page')

@section('title', 'Actualización de Fichas')

@section('content_header')
    <meta name="quitar-autor-url" content="{{ route('fichas.quitar', ':id') }}">
    <meta name="buscar-autor-url" content="{{ route('fichas.buscar', ':id') }}">

    <div class="row">
        <h1 class="ml-4 mt-3"><b>Actualización de Ficha</b></h1>
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
            <div class="card card-outline card-success">

                <div class="card-header">
                    <h3 class="card-title mt-1">Modifique la información correspondiente:</h3>
                    <div class="card-tools">
                        <a href="{{ url('/admin/fichas') }}" class="btn btn-sm btn-secondary">Volver</a>
                        <a href="javascript:void(0)" class="btn btn-sm btn-primary addRow"><i
                                class="fas fa-plus {{ config('adminlte.classes_auth_icon', '') }}"></i>&nbsp; Autor
                            Adicional</a>
                    </div>
                </div>

                <div class="card-body">

                    <form action="{{ url('admin/fichas', $ficha->id) }}" method="POST" id="form_ficha">
                        @csrf
                        @method('PUT')
                        <button type="submit" disabled hidden aria-hidden="true"></button>

                        <div id="autores_previos">
                            @foreach ($ficha->autor as $autor)
                                <div class="row autor-item">
                                    {{-- CI field --}}
                                    <div class="input-group mb-3 col-md-3">
                                        <input type="text" name="ci_autor[]" maxlength="8" inputmode="numeric"
                                            pattern="[0-9]*" onkeyup="buscarAutor(event)"
                                            class="form-control @error('ci_autor') is-invalid @enderror"
                                            value="{{ $autor->ci_autor }}" placeholder="CI del Autor" autocomplete="off"
                                            autofocus required>

                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span
                                                    class="fas fa-id-card {{ config('adminlte.classes_auth_icon', '') }}"></span>
                                            </div>
                                        </div>
                                        @error('ci_autor')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    {{-- Nombre field --}}
                                    <div class="input-group mb-3 col-md-3" id="nombreAutor">
                                        <input type="text" name="nombre_autor[]"
                                            class="form-control @error('nombre_autor') is-invalid @enderror"
                                            value="{{ $autor->nombre_autor }}" placeholder="Nombre del Autor"
                                            autocomplete="off" required>

                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span
                                                    class="fas fa-user {{ config('adminlte.classes_auth_icon', '') }}"></span>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Apellido field --}}
                                    <div class="input-group mb-3 col-md-3" id="apellidoAutor">
                                        <input type="text" name="apellido_autor[]"
                                            class="form-control @error('apellido_autor') is-invalid @enderror"
                                            value="{{ $autor->apellido_autor }}" placeholder="Apellido del Autor"
                                            autocomplete="off" required>

                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span
                                                    class="fas fa-user {{ config('adminlte.classes_auth_icon', '') }}"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <a href='javascript:void(0)' class=' col-md-3 mb-3 btn btn-danger deleteRow'><i
                                            class="fas fa-user-times"></i></a>
                                </div>
                            @endforeach
                        </div>

                        <div id="ficha_plus">

                        </div>

                        <div class="row" id="titleFicha">
                            {{-- Titulo field --}}
                            <div class="input-group mb-3 col-md-12">
                                <input type="text" name="titulo"
                                    class="form-control @error('titulo') is-invalid @enderror" value="{{ $ficha->titulo }}"
                                    placeholder="Título del Trabajo" id="titulo" autocomplete="off" required>
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
                                    id="fecha" required>
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
                                <select name="carrera" id="carrera" class=" form-select form-control">
                                    @foreach ($carreras as $carrera)
                                        <option value="{{ $carrera->id }}"
                                            {{ $carrera->id == $ficha->carrera_id ? 'selected' : '' }}>
                                            {{ $carrera->nombre }}</option>
                                    @endforeach
                                </select>

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

                                <textarea name="resumen" id="resumen" rows="4" class="form-control @error('resumen') is-invalid @enderror"
                                    placeholder="Resumen del Trabajo" form="form_ficha" required>{{ $ficha->resumen }}</textarea>

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

                        {{-- Register button --}}
                        <button type="submit" class="btn btn-success">Actualizar</button>
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
