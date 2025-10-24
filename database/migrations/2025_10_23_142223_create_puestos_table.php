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
        Schema::create('puestos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre'); // Nombre del puesto (ej: "Desarrollador Senior")
            $table->text('descripcion')->nullable(); // Descripción del puesto
            $table->decimal('salario_base', 10, 2); // Salario (10 dígitos totales, 2 decimales)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('puestos');
    }
};
