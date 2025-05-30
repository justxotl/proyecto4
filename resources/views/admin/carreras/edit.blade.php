@extends('adminlte::page')

@section('title', 'Modificar Carrera')

@section('content_header')
    <div class="row">
        <h1 class="ml-4 mt-3"><b>Modificar "{{ $carreras->nombre }}"</b></h1>
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
            <div class="card card-outline card-success">
                <div class="card-header">
                    <h3 class="card-title mt-1">Ingrese los datos a modificar:</h3>

                    <div class="card-tools">
                        <a href="{{ url('/admin/carreras') }}" class="btn btn-sm btn-secondary">Volver</a>
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                    </div>
                    <!-- /.card-tools -->
                </div>

                <!-- /.card-header -->
                <div class="card-body">
                    <form action="{{ url('admin/carreras', $carreras->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form group">
                                    <label for="">Nombre de la Carrera:</label>
                                    <input type="text" name="nombre_carrera" value="{{ $carreras->nombre }}"
                                        class="form-control @error('nombre_carrera') is-invalid @enderror" autocomplete="off" autofocus required>

                                    @error('nombre_carrera')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <br>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form group">
                                    <button type="submit" class="btn btn-success">Actualizar Carrera</button>
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
