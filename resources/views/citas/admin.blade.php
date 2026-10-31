@extends('layouts.app')

@section('contenido')
<div class="container py-4">
    <div class="row">
        <div class="col-md-12">
            
            <!-- Encabezado y Filtro por Fecha -->
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
                <div>
                    <h3 class="fw-bold text-dark mb-0">✂️ Control y Monitoreo de Citas</h3>
                    <p class="text-muted small mb-0">Administra los horarios, estados y reservas de los clientes.</p>
                </div>
                
                <!-- Buscador / Filtro por Fecha -->
                <form action="{{ route('citas.admin') }}" method="GET" class="d-flex align-items-center gap-2">
                    <label for="fecha" class="fw-bold text-nowrap mb-0">Ver Fecha:</label>
                    <input type="date" id="fecha" name="fecha" class="form-control form-control-sm" value="{{ $fechaFiltro }}" onchange="this.form.submit()">
                </form>
            </div>

            @if(session('exito'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('exito') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card card-custom p-4 bg-white shadow-sm border-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>Horario</th>
                                <th>Cliente</th>
                                <th>Servicio</th>
                                <th>Fecha</th>
                                <th>Estado Actual</th>
                                <th class="text-center">Acciones de Control</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($citas as $cita)
                                <tr>
                                    <td><span class="badge bg-dark fs-6">{{ $cita->hora }}</span></td>
                                    <td class="fw-bold">{{ $cita->usuario->name ?? $cita->usuario->nombre ?? 'Cliente #' . $cita->usuario_id }}</td>
                                    <td>{{ $cita->servicio->nombre ?? 'Servicio #' . $cita->servicio_id }}</td>
                                    <td>{{ $cita->fecha }}</td>
                                    
                                    <!-- Selector para cambiar estado rápidamente -->
                                    <td>
                                        <form action="{{ route('citas.actualizarEstado', $cita->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <select name="estado" class="form-select form-select-sm fw-bold 
                                                {{ ($cita->estado ?? 'Confirmada') == 'Confirmada' ? 'text-success border-success' : '' }}
                                                {{ ($cita->estado ?? '') == 'Completada' ? 'text-primary border-primary' : '' }}
                                                {{ ($cita->estado ?? '') == 'Cancelada' ? 'text-danger border-danger' : '' }}" 
                                                onchange="this.form.submit()">
                                                <option value="Confirmada" {{ ($cita->estado ?? 'Confirmada') == 'Confirmada' ? 'selected' : '' }}>🟢 Confirmada</option>
                                                <option value="Pendiente" {{ ($cita->estado ?? '') == 'Pendiente' ? 'selected' : '' }}>🟡 Pendiente</option>
                                                <option value="Completada" {{ ($cita->estado ?? '') == 'Completada' ? 'selected' : '' }}>🔵 Completada</option>
                                                <option value="Cancelada" {{ ($cita->estado ?? '') == 'Cancelada' ? 'selected' : '' }}>🔴 Cancelada</option>
                                            </select>
                                        </form>
                                    </td>

                                    <!-- Acciones de administración -->
                                    <td class="text-center">
                                        <form action="{{ route('citas.destruir', $cita->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Deseas eliminar permanentemente esta cita del sistema?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill" title="Eliminar Cita">
                                                🗑️ Eliminar
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-5">
                                        <h5>No hay citas agendadas para la fecha: <strong>{{ $fechaFiltro }}</strong></h5>
                                        <p class="small text-muted mb-0">Prueba cambiando la fecha en el filtro superior.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection