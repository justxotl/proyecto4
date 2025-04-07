@extends('adminlte::page')

@section('title', 'Modificar Autor')

@section('content')
    <div class="row">
        <h1 class="ml-4 mt-3"><b>Modificar "{{ $autor->nombre_autor }} {{ $autor->apellido_autor }}"</b></h1>
    </div>

    <hr>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-success">
                <div class="card-header">
                    <h3 class="card-title">Ingrese los datos a modificar:</h3>

                    <div class="card-tools">
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
                                    <label for="">Cédula de Identidad</label>
                                    <input type="text" name="ci_autor" value="{{ $autor->ci_autor }}"
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
                                    <label for="">Nombre(s)</label>
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
                                    <label for="">Apellido(s)</label>
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
                                    <a href="{{ url('admin/autores') }}" class="btn btn-danger">Cancelar</a> &nbsp;
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
