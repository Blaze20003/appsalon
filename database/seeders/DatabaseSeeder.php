<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuario;
use App\Models\Servicio;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Crear usuarios de prueba (1 Administrador y 1 Cliente)
        Usuario::create([
            'nombre' => 'Administrador',
            'apellido' => 'General',
            'email' => 'admin@appsalon.com',
            'password' => Hash::make('123456'), // Contraseña hasheada obligatoria
            'telefono' => '3001234567',
            'admin' => 1,
            'confirmado' => 1,
            'token' => ''
        ]);

        Usuario::create([
            'nombre' => 'Yefry',
            'apellido' => 'Arboleda',
            'email' => 'cliente@appsalon.com',
            'password' => Hash::make('123456'),
            'telefono' => '3009876543',
            'admin' => 0,
            'confirmado' => 1,
            'token' => ''
        ]);

        // Crear servicios de prueba
        Servicio::create([
            'nombre' => 'Corte de Cabello Caballero',
            'precio' => 25000.00,
            'descripcion' => 'Corte clásico o moderno con acabado profesional.',
            'duracion' => 30,
            'activo' => 1
        ]);

        Servicio::create([
            'nombre' => 'Corte y Barbería Completa',
            'precio' => 30000.00,
            'descripcion' => 'Corte de cabello y arreglo de barba con toallas calientes.',
            'duracion' => 45,
            'activo' => 1
        ]);

        Servicio::create([
            'nombre' => 'Manicure Spa',
            'precio' => 30000.00,
            'descripcion' => 'Limpieza profunda, exfoliación, hidratación y esmaltado.',
            'duracion' => 45,
            'activo' => 1
        ]);

        Servicio::create([
            'nombre' => 'Pedicure Clínico y Estético',
            'precio' => 35000.00,
            'descripcion' => 'Cuidado completo para pies, tratamiento de durezas.',
            'duracion' => 60,
            'activo' => 1
        ]);

        Servicio::create([
            'nombre' => 'Tintura y Coloración Capilar',
            'precio' => 70000.00,
            'descripcion' => 'Aplicación de tinte profesional con productos de alta calidad.',
            'duracion' => 90,
            'activo' => 1
        ]);
    }
}
