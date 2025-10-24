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
        Schema::create('proyectos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre'); // Nombre del proyecto
            $table->text('descripcion')->nullable(); // Descripción del proyecto (opcional)
            $table->date('fecha_inicio'); // Fecha de inicio
            $table->date('fecha_fin')->nullable(); // Fecha de fin (opcional)
            $table->decimal('presupuesto', 12, 2)->nullable(); // Presupuesto del proyecto
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proyectos');
    }
};
