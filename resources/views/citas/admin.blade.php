@extends('layouts.app')

@section('contenido')
<thead class="table-dark">
    <tr>
        <th>ID</th>
        <th>Cliente</th>
        <th>Servicio</th>
        <th>Fecha</th>
        <th>Hora</th>
        <th>Acciones</th>
    </tr>
</thead>
<tbody>
    @forelse($citas as $cita)
        <tr>
            <td>{{ $cita->id }}</td>
            <!-- Muestra el nombre del usuario o 'Cliente' si no existe -->
            <td>{{ $cita->usuario->name ?? $cita->usuario->nombre ?? 'Cliente #' . $cita->usuario_id }}</td>
            <!-- Muestra el nombre del servicio -->
            <td>{{ $cita->servicio->nombre ?? 'Servicio #' . $cita->servicio_id }}</td>
            <td>{{ $cita->fecha }}</td>
            <td>{{ $cita->hora }}</td>
           <td>
                <div class="d-flex align-items-center gap-2">
                    <span class="badge bg-success">Confirmada</span>
                    
                    <!-- Formulario para eliminar/cancelar cita -->
                    <form action="{{ route('citas.destruir', $cita->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de cancelar esta cita?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill">
                            Cancelar
                        </button>
                    </form>
                </div>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="6" class="text-center text-muted py-4">No hay citas registradas en el sistema todavía.</td>
        </tr>
    @endforelse
</tbody>
</div>
@endsection