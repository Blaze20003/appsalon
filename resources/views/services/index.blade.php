@extends('layouts.app')

@section('contenido')
<div class="row">
    <div class="col-md-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Catálogo de Servicios - AppSalon</h2>
            
            <!-- Validamos si el usuario es Administrador para mostrar opciones de gestión -->
            @if(session('user_admin') == 1)
                <span class="badge bg-danger p-2">Modo Administrador</span>
            @else
                <span class="badge bg-success p-2">Modo Cliente</span>
            @endif
        </div>
        
        @if(session('exito'))
            <div class="alert alert-success">{{ session('exito') }}</div>
        @endif

        <div class="row">
            @foreach($servicios as $servicio)
                <div class="col-md-4 mb-3">
                    <div class="card h-100 card-custom p-3">
                        <div class="card-body">
                            <h5 class="card-title fw-bold text-primary">{{ $servicio->nombre }}</h5>
                            <p class="card-text text-muted">{{ $servicio->descripcion }}</p>
                            <p class="card-text"><strong>Precio:</strong> $ {{ number_format($servicio->precio, 0, ',', '.') }}</p>
                            <p class="card-text"><small class="text-muted">Duración: {{ $servicio->duracion }} minutos</small></p>
                            
                            <!-- Si es cliente, puede ver un botón de reservar (preparado para el siguiente módulo) -->
                            @if(session('user_admin') == 0)
                                <button class="btn btn-outline-primary btn-sm w-100 mt-2" disabled>Seleccionar Servicio</button>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection