@extends ('adminlte::page')

@section('title', 'Detalle del Préstamo')

@section('content_header')
    <div class="row">
        <h1 class="ml-4 mt-3"><b>Detalle del Préstamo</b></h1>
    </div>
@stop

@section('content')
    <hr>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-info">
                <div class="card-header">
                    <h3 class="card-title mt-1">Datos del Préstamo</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.prestamos.index') }}" class="btn btn-sm btn-secondary">Volver</a>
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        {{-- Ficha --}}
                        <div class="form-group col-md-12">
                            <label class="ml-1">Ficha Bibliográfica:</label>
                            <div class="input-group">
                                <textarea class="form-control" rows="3" readonly>{{ $prestamo->ficha->titulo ?? 'Sin ficha' }}</textarea>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span
                                            class="fas fa-quote-right {{ config('adminlte.classes_auth_icon', '') }}"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        {{-- Cédula --}}
                        <div class="form-group col-md-6">
                            <label class="ml-1">Cédula del Prestatario:</label>
                            <div class="input-group">
                                <input type="text" class="form-control"
                                    value="{{ $prestamo->prestatario->ci_prestatario }}" readonly>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-id-card {{ config('adminlte.classes_auth_icon', '') }}"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- Teléfono --}}
                        <div class="form-group col-md-6">
                            <label class="ml-1">Teléfono del Prestatario:</label>
                            <div class="input-group">
                                <input type="text" class="form-control" value="{{ $prestamo->prestatario->tlf_prestatario }}"
                                    readonly>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-phone {{ config('adminlte.classes_auth_icon', '') }}"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        {{-- Nombre --}}
                        <div class="form-group col-md-6">
                            <label class="ml-1">Nombre(s) del Prestatario:</label>
                            <div class=input-group>
                                <input type="text" class="form-control"
                                    value="{{ $prestamo->prestatario->nombre_prestatario }}" readonly>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-user {{ config('adminlte.classes_auth_icon', '') }}"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- Apellido --}}
                        <div class="form-group col-md-6">
                            <label class="ml-1">Apellido(s) del Prestatario:</label>
                            <div class="input-group">
                                <input type="text" class="form-control"
                                    value="{{ $prestamo->prestatario->apellido_prestatario }}" readonly>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-user {{ config('adminlte.classes_auth_icon', '') }}"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        {{-- Fecha de Préstamo --}}
                        <div class="form-group col-md-4">
                            <label class="ml-1">Fecha de Préstamo:</label>
                            <div class="input-group">
                                <input type="text" class="form-control"
                                    value="{{ \Carbon\Carbon::parse($prestamo->fecha_prestamo)->format('d/m/Y') }}" readonly>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-file-upload {{ config('adminlte.classes_auth_icon', '') }}"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- Fecha de Devolución --}}
                        <div class="form-group col-md-4">
                            <label class="ml-1">Fecha de Devolución:</label>
                            <div class="input-group">
                                <input type="text" class="form-control"
                                    value="{{ \Carbon\Carbon::parse($prestamo->fecha_devolucion)->format('d/m/Y') }}" readonly>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span
                                            class="fas fa-file-download {{ config('adminlte.classes_auth_icon', '') }}"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- Fecha de Entrega --}}
                        <div class="form-group col-md-4">
                            <label class="ml-1">Fecha de Entrega:</label>
                            <div class="input-group">
                                <input type="text" class="form-control"
                                    value="{{ $prestamo->fecha_entrega ? \Carbon\Carbon::parse($prestamo->fecha_entrega)->format('d/m/Y') : 'Devolución Pendiente' }}"
                                    readonly>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span
                                            class="fas fa-calendar-check {{ config('adminlte.classes_auth_icon', '') }}"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@stop
