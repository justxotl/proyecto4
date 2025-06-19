@extends ('adminlte::page')

@section('title', 'Registro de Roles')

@section('content_header')
    <div class="row">
        <h1 class="ml-2 mt-3"><b>Registro de Roles</b></h1>
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
                        <a href="{{ route('admin.roles.index') }}" class="btn btn-sm btn-secondary">Volver</a>
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-angle-down"></i>
                        </button>
                    </div>
                </div>

                <div class="card-body">

                    <form action="{{ url('admin/roles/register') }}" method="post">
                        @csrf

                        {{-- Nombre field --}}
                        <div class="row">

                            <div class="input-group mb-3 col-md-12">
                                <input type="text" name="name"
                                    class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}"
                                    placeholder="Nombre del Rol" autocomplete="off" required autofocus>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-filter {{ config('adminlte.classes_auth_icon', '') }}"></span>
                                    </div>
                                </div>

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

@section('js')
@stop
