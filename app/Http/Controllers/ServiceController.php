<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Servicio;

class ServiceController extends Controller
{
    public function index()
    {
        // Traer los servicios de la base de datos que metimos con el seeder
        $servicios = Servicio::all();

        // Por ahora retornaremos un mensaje o vista simple para probar
        return view('services.index', compact('servicios'));
    }
}

 
{
    //
}
