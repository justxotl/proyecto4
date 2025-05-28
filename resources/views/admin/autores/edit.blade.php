@extends('adminlte::page')

@section('title', 'Modificar Autor')

@section('content_header')
    <div class="row">
        <h1 class="ml-4 mt-2"><b>Modificar "{{ $autor->nombre_autor }} {{ $autor->apellido_autor }}"</b></h1>
    </div>
    <hr>
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

    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-success">
                <div class="card-header">
                    <h3 class="card-title mt-1">Ingrese los datos a modificar:</h3>

                    <div class="card-tools">
                        <a href="{{ url('/admin/autores') }}" class="btn btn-sm btn-secondary">Volver</a>
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                    <!-- /.card-tools -->
                </div>

                <!-- /.card-header -->
                <div class="card-body">
                    <form action="{{ url('admin/autores', $autor->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form group">
                                    <label for="">Cédula de Identidad:</label>
                                    <input type="text" name="ci_autor" maxlength="8" value="{{ $autor->ci_autor }}"
                                        class="form-control" required>
                                    @error('ci_autor')
                                        <small style="color: red;">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <br>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form group">
                                    <label for="">Nombre(s):</label>
                                    <input type="text" name="nombre_autor" value="{{ $autor->nombre_autor }}"
                                        class="form-control" required>
                                    @error('nombre_autor')
                                        <small style="color: red;">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <br>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form group">
                                    <label for="">Apellido(s):</label>
                                    <input type="text" name="apellido_autor" value="{{ $autor->apellido_autor }}"
                                        class="form-control" required>
                                    @error('apellido_autor')
                                        <small style="color: red;">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <br>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form group">
                                    <button type="submit" class="btn btn-success">Actualizar Autor</button>
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
