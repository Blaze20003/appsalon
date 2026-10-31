@extends('layouts.app')

@section('contenido')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-custom p-4 bg-white">
                <h3 class="fw-bold text-dark mb-2">✂️ Agendar Cita en AppSalon</h3>
                <p class="text-muted mb-4">Selecciona tu fecha y horario preferido para el servicio seleccionado.</p>

                @if(session('exito'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('exito') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @isset($servicio)
                    <div class="alert alert-light border mb-4">
                        <h5 class="fw-bold text-primary mb-1">Servicio: {{ $servicio->nombre }}</h5>
                        <p class="mb-0 text-muted small">Precio: $ {{ number_format($servicio->precio, 0, ',', '.') }} COP | Duración: {{ $servicio->duracion }} minutos</p>
                    </div>
                @endisset

                <form action="{{ route('citas.guardar') }}" method="POST">
                    @csrf

                    <input type="hidden" name="servicio_id" value="{{ $servicio->id ?? 1 }}">

                    <div class="mb-3">
                        <label for="fecha" class="form-label fw-bold">Fecha de la Cita</label>
                        <input type="date" class="form-control" id="fecha" name="fecha" min="{{ date('Y-m-d') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="hora" class="form-label fw-bold">Horario de Disponibilidad</label>
                        <select class="form-select" id="hora" name="hora" required>
                            <option value="" selected disabled>-- Selecciona una hora disponible --</option>
                            <option value="09:00">09:00 AM - 10:00 AM</option>
                            <option value="10:00">10:00 AM - 11:00 AM</option>
                            <option value="11:00">11:00 AM - 12:00 PM</option>
                            <option value="14:00">02:00 PM - 03:00 PM</option>
                            <option value="15:00">03:00 PM - 04:00 PM</option>
                            <option value="16:00">04:00 PM - 05:00 PM</option>
                        </select>
                        <div class="form-text">Los horarios se muestran según la disponibilidad operativa del salón.</div>
                    </div>

                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" class="btn btn-dark py-2 rounded-pill fw-bold">Confirmar Reserva de Cita</button>
                        <a href="{{ url('/') }}" class="btn btn-outline-secondary py-2 rounded-pill">Volver al Catálogo</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection