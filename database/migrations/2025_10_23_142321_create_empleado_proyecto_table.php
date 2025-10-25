<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Correr migrations.
     */
    public function up(): void
    {
        Schema::create('empleado_proyecto', function (Blueprint $table) {
            $table->id();

            // RELACIÓN MUCHOS A MUCHOS
            $table->foreignId('empleado_id')
                  ->constrained('empleados') // Se relaciona con 'empleados'
                  ->onDelete('cascade'); // Si se elimina el empleado, se elimina la relación

            $table->foreignId('proyecto_id')
                  ->constrained('proyectos') // Se relaciona con 'proyectos'
                  ->onDelete('cascade');

            $table->string('rol')->nullable(); // Rol del empleado en el proyecto - Opcional
            $table->timestamps();
        });
    }

    /**
     * Eliminar las migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empleado_proyecto');
    }
};
