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
        Schema::create('puestos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre'); // Nombre del puesto 
            $table->text('descripcion')->nullable(); // Descripción del puesto - Opcional
            $table->decimal('salario_base', 10, 2); // Salario (10 dígitos totales MAX, 2 decimales)
            $table->timestamps();
        });
    }

    /**
     * Eliminar las migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('puestos');
    }
};
