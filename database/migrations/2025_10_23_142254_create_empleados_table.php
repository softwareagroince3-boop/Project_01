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
        Schema::create('empleados', function (Blueprint $table) {
            $table->id();
            $table->string('nombre'); // Nombre del empleado
            $table->string('apellido'); // Apellido del empleado
            $table->string('email')->unique(); // Email único (no se puede repetir)
            $table->string('telefono'); // Teléfono de contacto
            $table->date('fecha_ingreso'); // Fecha en que ingresó a la empresa
            $table->decimal('salario', 10, 2); // Salario actual del empleado

            // RELACIONES (Claves Foráneas - Foreign Keys)
            $table->foreignId('departamento_id') // Crea columna 'departamento_id'
                  ->constrained('departamentos') // Se relaciona con tabla 'departamentos'
                  ->onDelete('cascade'); // Si se elimina el departamento, se eliminan sus empleados

            $table->foreignId('puesto_id')
                  ->constrained('puestos')
                  ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empleados');
    }
};
