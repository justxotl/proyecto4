@extends('adminlte::auth.auth-page', ['authType' => 'login'])

@section('adminlte_css_pre')
    <link rel="stylesheet" href="{{ asset('vendor/icheck-bootstrap/icheck-bootstrap.min.css') }}">
@stop

@section('adminlte_js')
@stack('js')
@yield('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if( (($mensaje = Session::get('mensaje')) && ($icono = Session::get('icono'))) )
    
        <script>
            
            Swal.fire({
                icon: "{{$icono}}",
                title: "{{$mensaje}}",
                showConfirmButton: false,
                timer: 4000
            });
        </script>
    @endif
@stop

@section('auth_header', 'Recuperación de Contraseña')

@section('auth_body')
    <form action="{{ url('admin/usuarios/recover') }}" method="post">
        @csrf

        {{-- CI field --}}
        <div class="input-group mb-3">
            <input type="text" name="ci_recover" class="form-control @error('ci_recover') is-invalid @enderror"
                value="{{ old('ci_recover') }}" placeholder="Cédula del Usuario" autofocus required autocomplete="off" maxlength="8">

            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-user {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>

            @error('ci_recover')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Login field --}}
        <div class="row">
            <div class="col-12">
                <button type=submit class="btn btn-block {{ config('adminlte.classes_auth_btn', 'btn-flat btn-primary') }}">
                    <span class="fas fa-sign-in-alt"></span>
                    {{ __('adminlte::adminlte.sign_in') }}
                </button>
            </div>
        </div>
    </form>
@stop

