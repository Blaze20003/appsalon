<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('citasServicios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('citaId')->nullable()->constrained('citas')->cascadeOnDelete();
            $table->foreignId('servicioId')->nullable()->constrained('servicios')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('citas_servicios');
    }
};
