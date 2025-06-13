@extends ('adminlte::page')

@section('title', 'Permisos del Rol')

@section('content_header')
    <div class="row">
        <h1 class="ml-2 mt-3"><b>Asignación de Permisos ({{ $rol->name }})</b></h1>
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
                    <h3 class="card-title mt-1">Marque los permisos a otorgar:</h3>

                    <div class="card-tools">
                        <a href="{{ route('admin.roles.index') }}" class="btn btn-sm btn-secondary">Volver</a>
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-angle-down"></i>
                        </button>
                    </div>
                </div>

                <div class="card-body">

                    <form action="{{ url('admin/roles/asignar', $rol->id) }}" method="post">
                        @csrf
                        @method('PUT')

                        @foreach ($permisos as $modulos => $grupoPermisos)
                            <div class="col-md-12">
                                <h4>{{ $modulos }}</h4>
                                @foreach ($grupoPermisos as $permiso)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="permisos[]"
                                            value="{{ $permiso->id }}"
                                            {{ $rol->hasPermissionTo($permiso->name) ? 'checked' : '' }}>
                                        <label for="" class="form-check-label">{{ $permiso->name }}</label>
                                    </div>
                                @endforeach
                                <hr>
                            </div>
                        @endforeach

                        {{-- Register button --}}
                        <button type="submit" class="btn btn-primary">Asignar</button>
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
