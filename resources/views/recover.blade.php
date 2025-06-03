@extends('adminlte::auth.auth-page', ['authType' => 'login'])

@section('adminlte_css_pre')
    <link rel="stylesheet" href="{{ asset('vendor/icheck-bootstrap/icheck-bootstrap.min.css') }}">
@stop

@section('adminlte_js')
    @stack('js')
    @yield('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        let userId = null;

        $('#ciForm').submit(function(e) {
            e.preventDefault();
            let ci = $('#ci_recover').val();
            $.post('{{ url('admin/usuarios/recover') }}', {
                _token: '{{ csrf_token() }}',
                ci_recover: ci
            }, function(data) {
                if (data.success) {
                    userId = data.user_id;
                    $('#ciForm').hide();
                    $('#pregunta_uno').val(data.pregunta_uno);
                    $('#pregunta_dos').val(data.pregunta_dos);
                    $('#preguntasForm').show();
                } else {
                    Swal.fire("Error", "Usuario no encontrado o sin preguntas registradas", "error");
                }
            }).fail(function() {
                Swal.fire("Error", "Ocurrió un error al procesar la solicitud.", "error");
            });
        });

        $('#preguntasForm').submit(function(e) {
            e.preventDefault();
            $.post('{{ url('admin/usuarios/verificarPreguntas') }}', {
                _token: '{{ csrf_token() }}',
                user_id: userId,
                respuesta_uno: $('#respuesta_uno').val(),
                respuesta_dos: $('#respuesta_dos').val()
            }, function(response) {
                if (response.status === 'ok') {
                    $('#preguntasForm').hide();
                    $('#resetForm').show();
                } else {
                    Swal.fire("Error", "Respuestas incorrectas", "error");
                }
            });
        });

        $('#resetForm').submit(function(e) {
            e.preventDefault();
            if ($('#password').val() !== $('#password_confirmation').val()) {
                Swal.fire("Error", "Las contraseñas no coinciden", "error");
                return;
            }
            Swal.fire({
                title: '¿Confirmar nueva contraseña?',
                icon: 'warning',
                showCancelButton: true,
                cancelButtonColor: '#d33',
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Sí, confirmar',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.post('{{ url('admin/usuarios/resetPassword') }}', {
                        _token: '{{ csrf_token() }}',
                        user_id: userId,
                        password: $('#password').val()
                    }, function(response) {
                        if (response.status === 'ok') {
                            Swal.fire("Listo", "Contraseña reestablecida.", "success")
                                .then(() => window.location.href = "{{ route('login') }}");
                        } else {
                            Swal.fire("Error", "No se pudo reestablecer la contraseña.", "error");
                        }
                    });
                }
            });
        });
    </script>

    <script src="{{ asset('plugins/sweetalert2.all.min.js') }}"></script>

    @if (($mensaje = Session::get('mensaje')) && ($icono = Session::get('icono')))
        <script>
            Swal.fire({
                icon: "{{ $icono }}",
                title: "{{ $mensaje }}",
                showConfirmButton: false,
                timer: 4000
            });
        </script>
    @endif
@stop

@section('auth_header', 'Reestablecimiento de Contraseña')

@section('auth_body')

    {{-- CI field --}}
    <form id="ciForm">
        @csrf
        <div class="input-group mb-3">
            <input type="text" name="ci_recover" id="ci_recover" class="form-control" placeholder="Cédula del Usuario"
                required maxlength="8" autocomplete="off" autofocus>
            <div class="input-group-append">
                <div class="input-group-text"><span class="fas fa-id-card"></span></div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary btn-flat btn-block">Verificar Cédula</button>
    </form>

    <form id="preguntasForm" style="display: none;">
        @csrf
        <div class="mb-3">
            <label>Pregunta #1:</label>
            <input type="text" id="pregunta_uno" class="form-control" disabled>
            <input type="text" id="respuesta_uno" name="respuesta_uno" class="form-control mt-2"
                placeholder="Respuesta #1" required autocomplete="off" autofocus>
        </div>
        <div class="mb-3">
            <label>Pregunta #2:</label>
            <input type="text" id="pregunta_dos" class="form-control" disabled>
            <input type="text" id="respuesta_dos" name="respuesta_dos" class="form-control mt-2"
                placeholder="Respuesta #2" required autocomplete="off">
        </div>
        <button type="submit" class="btn btn-primary btn-flat btn-block">Verificar Respuestas</button>
    </form>

    <form id="resetForm" style="display: none;">
        @csrf
        <div class="mb-3">
            <input type="password" name="password" id="password" class="form-control" placeholder="Nueva Contraseña"
                required autofocus>
        </div>
        <div class="mb-3">
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control"
                placeholder="Confirmar Contraseña" required>
        </div>
        <button type="submit" class="btn btn-primary btn-flat btn-block">Restablecer Contraseña</button>
    </form>

    <a href="{{ route('login') }}" class="btn btn-secondary btn-flat btn-block mt-2">
        <i class="fas fa-arrow-left"></i>&nbsp;Volver al Login
    </a>
@stop
