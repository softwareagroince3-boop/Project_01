<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Puesto extends Model
{
    use HasFactory;

    /**
     * Los atributos que se pueden asignar masivamente.
     */
    protected $fillable = [
        'nombre',
        'descripcion',
        'salario_base'
    ];

    /**
     * RELACIÓN: Un puesto tiene muchos empleados
     *
     * Esto permite hacer:
     * $puesto->empleados → Obtiene todos los empleados con este puesto
     */
    public function empleados()
    {
        return $this->hasMany(Empleado::class);
    }
}
