@extends('adminlte::page')

@section('content_header')
@section('content_header')
    <div class="row">
        <h1 class="ml-4 mt-2"><b>Bienvenido, {{ Auth::user()->name }} ({{ Auth::user()->email }})</b></h1>
    </div>
    <hr>
@stop
@stop

@section('content')
<div class="row ml-4 mb-4">
    <h3><b>Estadísticas y Datos</b></h3>
</div>
<div class="row justify-content-center">
    <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2 mb-4">
        <div class="small-box bg-primary">
            <div class="inner">
                @php $usernumber=0; @endphp
                @foreach ($users as $user)
                    @php $usernumber++; @endphp
                @endforeach
                <h3>{{ $usernumber }}</h3>
                <p>Total de Usuarios</p>
            </div>
            <div class="icon">
                <i class="fas fa-users"></i>
            </div>
            <a href="{{ route('admin.usuarios.index') }}" class="small-box-footer">Más información <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2 mb-4">
        <div class="small-box bg-info">
            <div class="inner">
                @php $rolenumber=0; @endphp
                @foreach ($roles as $role)
                    @php $rolenumber++; @endphp
                @endforeach
                <h3>{{ $rolenumber }}</h3>
                <p>Total de Roles</p>
            </div>
            <div class="icon">
                <i class="fas fa-address-book"></i>
            </div>
            <a href="{{ route('admin.roles.index') }}" class="small-box-footer">Más información <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2 mb-4">
        <div class="small-box bg-success">
            <div class="inner">
                @php $fichanumber=0; @endphp
                @foreach ($fichas as $ficha)
                    @php $fichanumber++; @endphp
                @endforeach
                <h3>{{ $fichanumber }}</h3>
                <p>Total de Fichas</p>
            </div>
            <div class="icon">
                <i class="fas fa-book"></i>
            </div>
            <a href="{{ route('admin.fichas.index') }}" class="small-box-footer">Más información <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2 mb-4">
        <div class="small-box bg-warning">
            <div class="inner">
                @php $carreranumber=0; @endphp
                @foreach ($carreras as $carrera)
                    @php $carreranumber++; @endphp
                @endforeach
                <h3>{{ $carreranumber }}</h3>
                <p>Total de Carreras</p>
            </div>
            <div class="icon">
                <i class="fas fa-graduation-cap"></i>
            </div>
            <a href="{{ route('admin.carreras.index') }}" class="small-box-footer">Más información <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2 mb-4">
        <div class="small-box bg-secondary">
            <div class="inner">
                @php $autoresnumber=0; @endphp
                @foreach ($autores as $autor)
                    @php $autoresnumber++; @endphp
                @endforeach
                <h3>{{ $autoresnumber }}</h3>
                <p>Total de Autores</p>
            </div>
            <div class="icon">
                <i class="fas fa-pen-nib"></i>
            </div>
            <a href="{{ route('admin.autores.index') }}" class="small-box-footer">Más información <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Trabajos por Carrera:</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-angle-down"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="chart-container" style="position: relative; height: 0; padding-bottom: 50%;">
                    <canvas id="fichasPorCarrera"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Trabajos por Año:</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-angle-down"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="chart-container" style="position: relative; height: 0; padding-bottom: 50%;">
                <canvas id="fichasPorYear"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')

@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('fichasPorCarrera').getContext('2d');
    var carreras = [
        @foreach ($carreras as $carrera)
            '{{ $carrera->nombre }}',
        @endforeach
    ];
    var fichasCount = [
        @foreach ($hascarreras as $hascarrera)
            {{ $hascarrera->ficha_count }},
        @endforeach
    ];

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: carreras,
            datasets: [{
                label: 'Cantidad de Trabajos',
                data: fichasCount,
                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0,
                    }
                },
            }
        }
    });
</script>

<script>
    const ctxYear = document.getElementById('fichasPorYear').getContext('2d');
    const years = [
        @foreach ($fichasPorYear as $item)
            '{{ $item->year }}',
        @endforeach
    ];
    const counts = [
        @foreach ($fichasPorYear as $item)
            {{ $item->cantidad }},
        @endforeach
    ];

    new Chart(ctxYear, {
        type: 'bar',
        data: {
            labels: years,
            datasets: [{
                label: 'Trabajos por Año',
                data: counts,
                backgroundColor: 'rgba(0, 255, 255, 0.3)',
                borderColor: 'rgba(0, 200, 200, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            aspectRatio: 2,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0
                    }
                }
            }
        }
    });
</script>

@stop
