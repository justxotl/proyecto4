@extends('adminlte::page')

@section('title', 'Modificar Usuario')

@section('content')
    <div class="row">
        <h1 class="ml-4 mt-3"><b>Modificar "{{ $usuario->name }}"</b></h1>
    </div>

    <hr>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-success">
                <div class="card-header">
                    <h3 class="card-title">Coloque los datos a modificar:</h3>

                    <div class="card-tools">
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
                                    <label for="">Nombre:</label>
                                    <input type="text" name="nombre" value="{{ $usuario->infoper->nombre }}"
                                        class="form-control" required>
                                    @error('nombre')
                                        <small style="color: red;">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form group">
                                    <label for="">Apellido:</label>
                                    <input type="text" name="apellido" value="{{ $usuario->infoper->apellido }}"
                                        class="form-control" required>
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
                                    <input type="text" name="name" value="{{ $usuario->name }}" class="form-control" required>
                                    @error('name')
                                        <small style="color: red;">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form group">
                                    <label for="">Cédula:</label>
                                    <input type="text" name="ci_us" value="{{ $usuario->infoper->ci_us }}"
                                        class="form-control" required>
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
                                    <input type="email" name="email" value="{{ $usuario->email }}" class="form-control"
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
                                    <input type="password" name="password" value="{{ old('password') }}"
                                        class="form-control">
                                    @error('password')
                                        <small style="color: red;">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        
                            <div class="col-md-6">
                                <div class="form group">
                                    <label for="">Verificación de contraseña:</label>
                                    <input type="password" name="password_confirmation" class="form-control">
                                    @error('password_confirmation')
                                        <small style="color: red;">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-12">
                                <div class="form group">
                                    <a href="{{ url('admin/usuarios') }}" class="btn btn-danger">Cancelar</a>
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
