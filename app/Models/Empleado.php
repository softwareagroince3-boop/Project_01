<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;

    /**
     * Los atributos que se pueden asignar masivamente.
     */
    protected $fillable = [
        'nombre',
        'apellido',
        'email',
        'telefono',
        'fecha_ingreso',
        'salario',
        'departamento_id',
        'puesto_id'
    ];

    /**
     * Los atributos que deben ser convertidos a tipos nativos.
     * fecha_ingreso se convertirá automáticamente a un objeto Carbon (manejo de fechas)
     */
    protected $casts = [
        'fecha_ingreso' => 'date',
        'salario' => 'decimal:2'
    ];

    /**
     * RELACIÓN: Un empleado pertenece a un departamento
     *
     * Esto permite hacer:
     * $empleado->departamento → Obtiene el departamento del empleado
     */
    public function departamento()
    {
        return $this->belongsTo(Departamento::class);
    }

    /**
     * RELACIÓN: Un empleado pertenece a un puesto
     *
     * Esto permite hacer:
     * $empleado->puesto → Obtiene el puesto del empleado
     */
    public function puesto()
    {
        return $this->belongsTo(Puesto::class);
    }

    /**
     * RELACIÓN MUCHOS A MUCHOS: Un empleado puede estar en varios proyectos
     *
     * Esto permite hacer:
     * $empleado->proyectos → Obtiene todos los proyectos del empleado
     * $empleado->proyectos()->attach($proyectoId) → Asignar empleado a proyecto
     * $empleado->proyectos()->detach($proyectoId) → Quitar empleado de proyecto
     */
    public function proyectos()
    {
        return $this->belongsToMany(Proyecto::class, 'empleado_proyecto');
    }
}
