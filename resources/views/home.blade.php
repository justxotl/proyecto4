@extends('adminlte::page')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('usermenu_body')
    
<a href="#" class="btn btn-default btn-flat btn-block">
    <i class="fa fa-user"></i> Perfil
</a>
<a href="#" class="btn btn-default btn-flat btn-block">
    <i class="fa fa-lock"></i> Cambiar contraseña
</a>
@stop

@section('content')
    Bueno, a ver (dijo el ciego)
@stop

@section('css')
<style>
    .btn-block {
        display: block;
        width: 100%;
        margin-bottom: 10px;
        transition: background-color 0.3s;
    }
    .btn-block:hover {
        background-color: #e0e0e0;
    }
</style>
@stop

@section('js')    
@stop
