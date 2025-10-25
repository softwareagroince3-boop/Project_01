<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Correr las migrations.
     */
    public function up(): void
    {
        Schema::create('departamentos', function (Blueprint $table) {
            $table->id(); // Crea columna 'id' autoincremental
            $table->string('nombre'); // Nombre del departamento (máx 255 caracteres)
            $table->text('descripcion')->nullable(); // Descripción (opcional, puede ser NULL)
            $table->timestamps(); // Crea 'created_at' y 'updated_at' automáticamente
        });
    }

    /**
     * Eliminar las migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departamentos');
    }
};
