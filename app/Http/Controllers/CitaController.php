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
        $fechaFiltro = $request->get('fecha', date('Y-m-d'));

        // Trae las citas filtradas por la fecha seleccionada (o la de hoy por defecto)
        $citas = Cita::with(['usuario', 'servicio'])
                    ->whereDate('fecha', $fechaFiltro)
                    ->orderBy('hora', 'asc')
                    ->get();

        return view('citas.admin', compact('citas', 'fechaFiltro'));
    }

    // Actualizar estado o fecha/hora de la cita desde el panel de admin
    public function actualizarEstado(Request $request, $id)
    {
        $request->validate([
            'estado' => 'required|in:Confirmada,Pendiente,Completada,Cancelada',
        ]);

        $cita = Cita::findOrFail($id);
        $cita->estado = $request->estado;
        
        // Si el admin decide cambiar la hora o fecha manualmente
        if ($request->has('hora') && !empty($request->hora)) {
            $cita->hora = $request->hora;
        }
        
        $cita->save();

        return redirect()->back()->with('exito', '¡La cita ha sido actualizada correctamente!');
    }

     
}
