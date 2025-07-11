@extends ('adminlte::page')

@section('title', 'Registro de Préstamos')

@section('content_header')
    <div class="row">
        <h1 class="ml-4 mt-3"><b>Registro de Préstamos</b></h1>
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
            <div class="card card-outline card-info">

                <div class="card-header">
                    <h3 class="card-title mt-1">Ingrese la información solicitada:</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.prestamos.index') }}" class="btn btn-sm btn-secondary">Volver</a>
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>

                <div class="card-body">

                    <form action="{{ route('admin.prestamos.store') }}" method="post">
                        @csrf

                        <div class="row">

                            <div class="form-group col-md-12">
                                <label for="ficha_id" class="ml-1">Ficha Bibliográfica:</label>
                                <select name="ficha_id" id="ficha_id"
                                    class="form-control select2 @error('ficha_id') is-invalid @enderror" required>
                                    <option value="">Seleccione una ficha...</option>
                                    @foreach ($fichas as $ficha)
                                        @php
                                            // Verifica si la ficha está prestada
                                            $prestada = \App\Models\Prestamo::where('ficha_id', $ficha->id)
                                                ->where('estado', 'prestado')
                                                ->exists();
                                        @endphp
                                        <option value="{{ $ficha->id }}"
                                            {{ old('ficha_id') == $ficha->id ? 'selected' : '' }}
                                            {{ $prestada ? 'disabled' : '' }} data-prestada="{{ $prestada ? '1' : '0' }}">
                                            {{ $ficha->titulo }}{{ $prestada ? ' (Prestada)' : '' }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('ficha_id')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">

                            {{-- Cédula --}}
                            <div class="form-group col-md-6">
                                <label for="ci_prestatario" class="ml-1">Cédula del Prestatario:</label>
                                <div class="input-group">
                                    <input type="text" name="ci_prestatario" id="ci_prestatario"
                                        placeholder="Cédula del Prestatario" maxlength="8" inputmode="numeric"
                                        pattern="[0-9]*" class="form-control @error('ci_prestatario') is-invalid @enderror"
                                        value="{{ old('ci_prestatario') }}" autocomplete="off" required>
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="fas fa-id-card"></i>
                                        </span>
                                    </div>
                                    @error('ci_prestatario')
                                        <span class="invalid-feedback d-block"
                                            role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Teléfono --}}
                            <div class="form-group col-md-6">
                                <label for="telefono_prestatario" class="ml-1">Teléfono del Prestatario:</label>
                                <div class="input-group">
                                    <input type="text" name="tlf_prestatario" id="tlf_prestatario"
                                        placeholder="Teléfono del Prestatario" maxlength="11" inputmode="numeric"
                                        pattern="[0-9]*" class="form-control @error('tlf_prestatario') is-invalid @enderror"
                                        value="{{ old('tlf_prestatario') }}" autocomplete="off" required>
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="fas fa-phone"></i>
                                        </span>
                                    </div>
                                    @error('telefono_prestatario')
                                        <span class="invalid-feedback d-block"
                                            role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            {{-- Nombre --}}
                            <div class="form-group col-md-6">
                                <label for="nombre_prestatario" class="ml-1">Nombre(s) del Prestatario:</label>
                                <div class="input-group">
                                    <input type="text" name="nombre_prestatario" id="nombre_prestatario"
                                        placeholder="Nombre(s) del Prestatario"
                                        class="form-control @error('nombre_prestatario') is-invalid @enderror"
                                        value="{{ old('nombre_prestatario') }}" autocomplete="off" required>
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="fas fa-user"></i>
                                        </span>
                                    </div>
                                    @error('nombre_prestatario')
                                        <span class="invalid-feedback d-block"
                                            role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Apellido --}}
                            <div class="form-group col-md-6">
                                <label for="apellido_prestatario" class="ml-1">Apellido(s) del Prestatario:</label>
                                <div class="input-group">
                                    <input type="text" name="apellido_prestatario" id="apellido_prestatario"
                                        placeholder="Apellido(s) del Prestatario"
                                        class="form-control @error('apellido_prestatario') is-invalid @enderror"
                                        value="{{ old('apellido_prestatario') }}" autocomplete="off" required>
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="fas fa-user"></i>
                                        </span>
                                    </div>
                                    @error('apellido_prestatario')
                                        <span class="invalid-feedback"
                                            role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            {{-- Fecha de Préstamo --}}
                            <div class="form-group col-md-6">
                                <label for="fecha_prestamo" class="ml-1">Fecha de Préstamo:</label>
                                <div class="input-group">
                                    <input type="date" name="fecha_prestamo" id="fecha_prestamo"
                                        class="form-control @error('fecha_prestamo') is-invalid @enderror"
                                        value="{{ old('fecha_prestamo') }}" required>
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="fas fa-file-upload"></i>
                                        </span>
                                    </div>
                                    @error('fecha_prestamo')
                                        <span class="invalid-feedback d-block"
                                            role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Fecha de Devolución --}}
                            <div class="form-group col-md-6">
                                <label for="fecha_devolucion" class="ml-1">Fecha de Devolución:</label>
                                <div class="input-group">
                                    <input type="date" name="fecha_devolucion" id="fecha_devolucion"
                                        class="form-control @error('fecha_devolucion') is-invalid @enderror"
                                        value="{{ old('fecha_devolucion') }}" required>
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="fas fa-file-download"></i>
                                        </span>
                                    </div>
                                    @error('fecha_devolucion')
                                        <span class="invalid-feedback d-block"
                                            role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
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
        label {
            font-weight: bold;
        }

        /* Ajusta la altura y el padding del select2 para que coincida con Bootstrap */
        .select2-container .select2-selection--single {
            height: 38px !important;
            padding: 6px 12px !important;
            border: 1px solid #ced4da !important;
            border-radius: 0.25rem !important;
            background-color: #fff !important;
            box-shadow: none !important;
            display: flex;
            align-items: center;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 24px !important;
            color: #495057 !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 36px !important;
            right: 10px !important;
        }

        /* Cambia el fondo del menú desplegable */
        .select2-container--default .select2-dropdown {
            background-color: #f8fafc !important;
            border-color: #007bff !important;
        }

        /* Cambia el color de las opciones al pasar el mouse */
        .select2-container--default .select2-results__option--highlighted[aria-selected] {
            background-color: #007bff !important;
            color: #fff !important;
        }

        /* Cambia el color de las opciones seleccionadas */
        .select2-container--default .select2-results__option[aria-selected="true"] {
            background-color: #e2e6ea !important;
            color: #212529 !important;
        }
    </style>
@stop

@section('js')

    <script>
        $(document).ready(function() {
            $('.select2').select2({
                width: '100%'
            });

            $('#ficha_id').on('select2:selecting', function(e) {
                var option = $(e.params.args.data.element);
                if (option.data('prestada') == '1') {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Ficha no disponible',
                        text: 'Esta ficha ya está prestada y no puede ser seleccionada.',
                    });
                    e.preventDefault();
                }
            });

        });

        $('#fecha_prestamo').on('change', function() {
            let fechaMin = $(this).val();
            $('#fecha_devolucion').attr('min', fechaMin);
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#ci_prestatario').on('blur', function() {
                let ci = $(this).val();
                console.log('blur event', ci); // <-- agrega esto
                if (ci.length > 0) {
                    $.ajax({
                        url: "{{ route('prestatarios.buscar') }}",
                        method: 'GET',
                        data: {
                            ci_prestatario: ci
                        },
                        success: function(data) {
                            console.log('respuesta ajax', data); // <-- agrega esto
                            if (data) {
                                $('#nombre_prestatario').val(data.nombre_prestatario);
                                $('#apellido_prestatario').val(data.apellido_prestatario);
                                $('#tlf_prestatario').val(data.tlf_prestatario);
                            } else {
                                $('#nombre_prestatario').val('');
                                $('#apellido_prestatario').val('');
                                $('#tlf_prestatario').val('');
                            }
                        }
                    });
                }
            });
        });
    </script>

@stop
