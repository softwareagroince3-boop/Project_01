<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    use HasFactory;

    /**
     * Los atributos que se pueden asignar masivamente.
     */
    protected $fillable = [
        'nombre',
        'descripcion',
        'fecha_inicio',
        'fecha_fin',
        'presupuesto'
    ];

    /**
     * Los atributos que deben ser convertidos a tipos nativos.
     */
    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
        'presupuesto' => 'decimal:2'
    ];

    /**
     * RELACIÓN MUCHOS A MUCHOS: Un proyecto puede tener varios empleados
     *
     * Esto te permite hacer:
     * $proyecto->empleados → Obtiene todos los empleados del proyecto
     * $proyecto->empleados()->attach($empleadoId) → Asignar empleado al proyecto
     * $proyecto->empleados()->detach($empleadoId) → Quitar empleado del proyecto
     */
    public function empleados()
    {
        return $this->belongsToMany(Empleado::class, 'empleado_proyecto');
    }
}
