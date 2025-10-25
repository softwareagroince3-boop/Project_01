<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    use HasFactory;

    /**
     * Usar Departamento::create(['nombre' => 'Ventas'])
     */
    protected $fillable = [
        'nombre',
        'descripcion'
    ];

    /**
     * RELACIÓN: Un departamento tiene muchos empleados
     *
     * Esto permite hacer:
     * $departamento->empleados → Obtiene todos los empleados de este departamento
     */
    public function empleados()
    {
        return $this->hasMany(Empleado::class);
    }
}
