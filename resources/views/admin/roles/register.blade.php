@extends ('adminlte::page')

@section('title', 'Registro de Roles')

@section('content_header')
    <div class="row">
        <h1 class="ml-4 mt-3"><b>Registro de Roles</b></h1>
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
                                        <span class="fas fa-pen {{ config('adminlte.classes_auth_icon', '') }}"></span>
                                    </div>
                                </div>
                                @error('name')
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
