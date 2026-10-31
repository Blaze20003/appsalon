<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Servicio; // Asegúrate de tener tu modelo de Servicio o ajustarlo a tu estructura
// use App\Models\Cita; // Descomenta cuando crees tu modelo Cita

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

        /* 
           Aquí puedes realizar la inserción a tu base de datos con tu modelo Cita:
           Cita::create([
               'usuario_id' => session('user_id'),
               'servicio_id' => $request->servicio_id,
               'fecha' => $request->fecha,
               'hora' => $request->hora
           ]);
        */

        return redirect()->route('citas.crear', $request->servicio_id)
                         ->with('exito', '¡Cita agendada y horario reservado con éxito!');
    }
}
