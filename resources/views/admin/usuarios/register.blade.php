@extends ('adminlte::page')

@section('title', 'Registro')

@section('content_header')
    <h1>Registro</h1>
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

    <p>Registro de usuario</p>

    <form action="{{url('admin/usuarios/register')}}" method="post">
        @csrf

        {{-- Name field --}}
        <div class="input-group mb-3">
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name') }}" placeholder="Nombre de Usuario" required autofocus>

            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-user {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>

            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Nombre field --}}
        <div class="input-group mb-3">
            <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror"
                value="{{ old('nombre') }}" placeholder="Nombre" required>

            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-id-card {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>

            @error('nombre')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Apellido field --}}
        <div class="input-group mb-3">
            <input type="text" name="apellido" class="form-control @error('apellido') is-invalid @enderror"
                value="{{ old('apellido') }}" placeholder="Apellido" required>

            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-id-card {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>

            @error('apellido')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- CI User field --}}
        <div class="input-group mb-3">
            <input type="number" name="ci_us" class="form-control @error('ci_us') is-invalid @enderror"
                value="{{ old('ci_us') }}" placeholder="Cédula de Identidad" required>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-id-card {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>
            @error('ci_us')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Email field --}}
        <div class="input-group mb-3">
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                value="{{ old('email') }}" placeholder="{{ __('adminlte::adminlte.email') }}" required>

            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Password field --}}
        <div class="input-group mb-3">
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                placeholder="{{ __('adminlte::adminlte.password') }}">

            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Confirm password field --}}
        <div class="input-group mb-3">
            <input type="password" name="password_confirmation"
                class="form-control @error('password_confirmation') is-invalid @enderror"
                placeholder="{{ __('adminlte::adminlte.retype_password') }}">

            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>

            @error('password_confirmation')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Register button --}}
        <a href="{{url('/admin/usuarios')}}" class="btn btn-secondary">Volver</a>
        <button type="submit" class="btn btn-primary">Registrar</button>
    </form>
@stop

@section('css')
@stop

@section('js')
@stop