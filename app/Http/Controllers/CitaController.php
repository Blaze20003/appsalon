<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Servicio;  
use App\Models\Citas;

class CitaController extends Controller
{
    // Muestra el formulario de agendamiento con el servicio seleccionado
    public function crear($id)
    {
        $servicio = Servicio::find($id);
        return view('citas.crear', compact('servicio'));
    }

    // Valida y guarda la cita en la base de datos
    public function guardar(Request $request)
    {
        $request->validate([
            'fecha' => 'required|date',
            'hora' => 'required',
            'servicio_id' => 'required'
        ]);
 

           

        return redirect()->route('citas.crear', $request->servicio_id)
                         ->with('exito', '¡Cita agendada y horario reservado con éxito!');
    }
    public function indexCliente()
{
    // Aquí puedes consultar las citas asociadas al usuario actual de la sesión 
    // $citas = Cita::where('usuario_id', session('user_id'))->get();     
    
    return view('citas.index'); // Una vista que liste las reservas
}
// Muestra todas las citas para el rol de Administrador
    public function indexAdmin()
    {
        // Trae todas las citas junto con los datos del servicio y del usuario
        $citas = Cita::with(['usuario', 'servicio'])->get();

        return view('citas.admin', compact('citas'));
    }

    // Elimina o cancela una cita existente
    public function destruir($id)
    {
        $cita = Cita::findOrFail($id);
        $cita->delete();

        return redirect()->route('citas.admin')
                         ->with('exito', 'La cita ha sido cancelada correctamente.');
    }

     
}
