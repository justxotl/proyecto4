@extends('adminlte::page')

@section('title', 'Modificar Usuario')

@section('content_header')
    <div class="row">
        <h1 class="ml-4 mt-3"><b>Modificar "{{ $usuario->name }}"</b></h1>
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
                    <h3 class="card-title mt-1">Coloque los datos a modificar:</h3>

                    <div class="card-tools">
                        <a href="{{ route('admin.usuarios.index') }}" class="btn btn-sm btn-secondary">Volver</a>
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                    <!-- /.card-tools -->
                </div>

                <!-- /.card-header -->
                <div class="card-body">
                    <form action="{{ url('admin/usuarios', $usuario->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="redirect_to" value="usuarios">
                        <div class="row">
                            <div class="col-md-6">
                                {{-- Nombre(s) --}}
                                <label for="nombre">Nombre(s):</label>
                                <div class="input-group mb-2">
                                    <input type="text" name="nombre" id="nombre" value="{{ $usuario->infoper->nombre }}"
                                        class="form-control" autocomplete="off" required placeholder="Nombre">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-id-card"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                {{-- Apellido(s) --}}
                                <label for="apellido">Apellido(s):</label>
                                <div class="input-group mb-2">
                                    <input type="text" name="apellido" id="apellido" value="{{ $usuario->infoper->apellido }}"
                                        class="form-control" autocomplete="off" required placeholder="Apellido">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-id-card"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                {{-- Nombre de Usuario --}}
                                <label for="name">Nombre de Usuario:</label>
                                <div class="input-group mb-2">
                                    <input type="text" name="name" id="name" value="{{ $usuario->name }}"
                                        class="form-control" autocomplete="off" required placeholder="Nombre de Usuario">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-user"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                {{-- Cédula --}}
                                <label for="ci_us">Cédula:</label>
                                <div class="input-group mb-2">
                                    <input type="text" name="ci_us" id="ci_us" maxlength="8" inputmode="numeric"
                                        pattern="[0-9]*" value="{{ $usuario->infoper->ci_us }}" class="form-control"
                                        autocomplete="off" required placeholder="Cédula">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-id-card"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                {{-- Email --}}
                                <label for="email">Email:</label>
                                <div class="input-group mb-2">
                                    <input type="email" name="email" id="email" value="{{ $usuario->email }}"
                                        class="form-control" autocomplete="off" required placeholder="Email">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-envelope"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                {{-- Rol --}}
                                <label for="rol">Rol:</label>
                                <div class="input-group mb-2">
                                    <select name="rol" id="rol" class="form-select form-control">
                                        @foreach ($roles as $rol)
                                            <option value="{{ $rol->name }}"
                                                {{ $rol->name == $usuario->roles->pluck('name')->implode(', ') ? 'selected' : '' }}>
                                                {{ $rol->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-filter"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                {{-- Contraseña --}}
                                <label for="password">Contraseña:</label>
                                <div class="input-group mb-2">
                                    <input type="password" name="password" id="password"
                                        placeholder="{{ __('adminlte::adminlte.password') }}" class="form-control">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-lock"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                {{-- Confirmar Contraseña --}}
                                <label for="password_confirmation">Confirmar Contraseña:</label>
                                <div class="input-group mb-2">
                                    <input type="password" name="password_confirmation" id="password_confirmation"
                                        placeholder="{{ __('adminlte::adminlte.retype_password') }}" class="form-control">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-lock"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-md-12">
                                <div class="form group">
                                    <button type="submit" class="btn btn-success">Actualizar Usuario</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection
