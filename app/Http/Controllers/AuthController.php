<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Muestra el formulario de Login
    public function showLogin()
    {
        return view('auth.login');
    }

    // Procesa el inicio de sesión
    public function login(Request $request)
    {
        // 1. Validaciones del lado del servidor (Requerido por la rúbrica)
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ], [
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Ingresa un correo electrónico válido.',
            'password.required' => 'La contraseña es obligatoria.'
        ]);

        // 2. Buscar al usuario por email
        $usuario = Usuario::where('email', $request->email)->first();

        // 3. Verificar si existe y si la contraseña coincide con el hash en BD
        if ($usuario && Hash::check($request->password, $usuario->password)) {
            // Guardar datos en la sesión de Laravel
            session([
                'user_id' => $usuario->id,
                'user_nombre' => $usuario->nombre . ' ' . $usuario->apellido,
                'user_admin' => $usuario->admin
            ]);

            return redirect()->route('servicios.index')->with('exito', '¡Bienvenido de nuevo, ' . $usuario->nombre . '!');
        }

        // Si falla la autenticación
        return back()->withErrors(['email' => 'Las credenciales ingresadas son incorrectas.'])->withInput();
    }

    // Muestra el formulario de Registro
    public function showRegister()
    {
        return view('auth.register');
    }

    // Procesa el registro de un nuevo usuario
    public function register(Request $request)
    {
        // Validaciones rigurosas
        $request->validate([
            'nombre' => 'required|string|max:60',
            'apellido' => 'required|string|max:60',
            'email' => 'required|email|max:50|unique:usuarios,email',
            'password' => 'required|string|min:6|confirmed',
            'telefono' => 'nullable|string|max:10'
        ], [
            'email.unique' => 'Este correo ya se encuentra registrado.',
            'password.min' => 'La contraseña debe tener al menos 6 caracteres.',
            'password.confirmed' => 'Las contraseñas no coinciden.'
        ]);

        // Crear el usuario con password encriptado (bcrypt / Hash::make)
        Usuario::create([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'telefono' => $request->telefono,
            'admin' => 0, // Por defecto rol de cliente
            'confirmado' => 1,
            'token' => ''
        ]);

        return redirect()->route('login')->with('exito', '¡Cuenta creada exitosamente! Puedes iniciar sesión.');
    }

    // Cierra la sesión
    public function logout()
    {
        session()->forget(['user_id', 'user_nombre', 'user_admin']);
        session()->flush();

        return redirect()->route('login')->with('exito', 'Has cerrado sesión correctamente.');
    }
}

abstract class Controller
{
    //
}