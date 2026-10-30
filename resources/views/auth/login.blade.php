@extends('layouts.app')

@section('contenido')
<div class="row justify-content-center mt-5">
    <div class="col-md-5">
        <div class="card card-custom p-4">
            <h3 class="text-center mb-4 font-weight-bold">Iniciar Sesión</h3>
            
            <form action="{{ route('login.post') }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label for="email" class="form-label">Correo Electrónico</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary w-100 mt-2">Ingresar</button>
            </form>

            <div class="text-center mt-3">
                <p class="small">¿No tienes cuenta? <a href="{{ route('register') }}">Regístrate aquí</a></p>
            </div>
        </div>
    </div>
</div>
@endsection