@extends('adminlte::page')

@section('title', 'Modificar Usuario')

@section('content_header')
    <div class="row">
        <h1 class="ml-4 mt-3"><b>Modificar "{{ $usuario->name }}"</b></h1>
    </div>
@stop

@section('content')

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
                                <div class="form group">
                                    <label for="">Nombre(s):</label>
                                    <input type="text" name="nombre" value="{{ $usuario->infoper->nombre }}"
                                        class="form-control" autocomplete="off" required>
                                    @error('nombre')
                                        <small style="color: red;">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form group">
                                    <label for="">Apellido(s):</label>
                                    <input type="text" name="apellido" value="{{ $usuario->infoper->apellido }}"
                                        class="form-control" autocomplete="off" required>
                                    @error('apellido')
                                        <small style="color: red;">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-md-6">
                                <div class="form group">
                                    <label for="">Nombre de Usuario:</label>
                                    <input type="text" name="name" value="{{ $usuario->name }}" class="form-control" autocomplete="off" required>
                                    @error('name')
                                        <small style="color: red;">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form group">
                                    <label for="">Cédula:</label>
                                    <input type="text" name="ci_us" maxlength="8" inputmode="numeric" pattern="[0-9]*" value="{{ $usuario->infoper->ci_us }}"
                                        class="form-control" autocomplete="off" required>
                                    @error('ci_us')
                                        <small style="color: red;">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-md-6">
                                <div class="form group">
                                    <label for="">Email:</label>
                                    <input type="email" name="email" value="{{ $usuario->email }}" class="form-control" autocomplete="off"
                                        required>
                                    @error('email')
                                        <small style="color: red;">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="form group col-md-6">
                                <label for="">Rol:</label>
                                <select name="rol" id="rol" class="form-select form-control">
                                    @foreach ($roles as $rol)
                                        <option value="{{$rol->name}}" {{$rol->name == $usuario->roles->pluck('name')->implode(', ') ? 'selected': ''}}>{{ $rol->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-md-6">
                                <div class="form group">
                                    <label for="">Contraseña:</label>
                                    <input type="password" name="password" value="{{ old('password') }}" placeholder="{{ __('adminlte::adminlte.password') }}" class="form-control">
                                    @error('password')
                                        <small style="color: red;">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        
                            <div class="col-md-6">
                                <div class="form group">
                                    <label for="">Verificación de contraseña:</label>
                                    <input type="password" name="password_confirmation" placeholder="{{ __('adminlte::adminlte.retype_password') }}" class="form-control">
                                    @error('password_confirmation')
                                        <small style="color: red;">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
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
