@extends('layouts.app')

@section('contenido')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0 p-4 bg-white">
                <h3 class="fw-bold text-dark mb-4">✏️ Editar Cita #{{ $cita->id }}</h3>

                <form action="{{ route('citas.update', $cita->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Cliente (Solo lectura para control) -->
                    <div class="mb-3">
                        <label class="form-label fw-bold">Cliente:</label>
                        <input type="text" class="form-control bg-light" value="{{ $cita->usuario->name ?? $cita->usuario->nombre ?? 'Cliente #' . $cita->usuario_id }}" disabled>
                    </div>

                    <!-- Selector de Servicio -->
                    <div class="mb-3">
                        <label for="servicio_id" class="form-label fw-bold">Servicio:</label>
                        <select name="servicio_id" id="servicio_id" class="form-select" required>
                            @foreach($servicios as $servicio)
                                <option value="{{ $servicio->id }}" {{ $cita->servicio_id == $servicio->id ? 'selected' : '' }}>
                                    {{ $servicio->nombre }} (${{ number_format($servicio->precio, 0) }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Fecha -->
                    <div class="mb-3">
                        <label for="fecha" class="form-label fw-bold">Fecha de la Cita:</label>
                        <input type="date" name="fecha" id="fecha" class="form-control" value="{{ $cita->fecha }}" required>
                    </div>

                    <!-- Hora -->
                    <div class="mb-3">
                        <label for="hora" class="form-label fw-bold">Hora de la Cita:</label>
                        <input type="time" name="hora" id="hora" class="form-control" value="{{ $cita->hora }}" required>
                    </div>

                    <!-- Estado -->
                    <div class="mb-4">
                        <label for="estado" class="form-label fw-bold">Estado de la Cita:</label>
                        <select name="estado" id="estado" class="form-select fw-bold" required>
                            <option value="Confirmada" {{ $cita->estado == 'Confirmada' ? 'selected' : '' }}>🟢 Confirmada</option>
                            <option value="Pendiente" {{ $cita->estado == 'Pendiente' ? 'selected' : '' }}>🟡 Pendiente</option>
                            <option value="Completada" {{ $cita->estado == 'Completada' ? 'selected' : '' }}>🔵 Completada</option>
                            <option value="Cancelada" {{ $cita->estado == 'Cancelada' ? 'selected' : '' }}>🔴 Cancelada</option>
                        </select>
                    </div>

                    <!-- Botones de Acción -->
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="{{ route('citas.admin') }}" class="btn btn-outline-secondary rounded-pill px-4">Cancelar</a>
                        <button type="submit" class="btn btn-dark rounded-pill px-4">Guardar Cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection