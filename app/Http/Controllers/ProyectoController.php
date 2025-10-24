<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use App\Models\Empleado;
use Illuminate\Http\Request;

class ProyectoController extends Controller
{
    /**
     * INDEX - Muestra la lista de todos los proyectos
     */
    public function index()
    {
        $proyectos = Proyecto::withCount('empleados')->get();
        
        return view('proyectos.index', compact('proyectos'));
    }

    /**
     * CREATE - Muestra el formulario para crear un nuevo proyecto
     */
    public function create()
    {
        $empleados = Empleado::all();
        
        return view('proyectos.create', compact('empleados'));
    }

    /**
     * STORE - Guarda un nuevo proyecto en la base de datos
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255|unique:proyectos',
            'descripcion' => 'nullable|string',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',
            'presupuesto' => 'nullable|numeric|min:0',
            'empleados' => 'nullable|array',
            'empleados.*' => 'exists:empleados,id'
        ]);

        // Separar empleados
        $empleados = $validated['empleados'] ?? [];
        unset($validated['empleados']);

        // Crear el proyecto
        $proyecto = Proyecto::create($validated);

        // Asignar empleados
        if (!empty($empleados)) {
            $proyecto->empleados()->attach($empleados);
        }

        return redirect()->route('proyectos.index')
            ->with('success', 'Proyecto creado exitosamente.');
    }

    /**
     * SHOW - Muestra los detalles de un proyecto específico
     */
    public function show(Proyecto $proyecto)
    {
        // Cargar empleados con sus departamentos y puestos
        $proyecto->load(['empleados.departamento', 'empleados.puesto']);
        
        return view('proyectos.show', compact('proyecto'));
    }

    /**
     * EDIT - Muestra el formulario para editar un proyecto
     */
    public function edit(Proyecto $proyecto)
    {
        $empleados = Empleado::all();
        $proyecto->load('empleados');
        
        return view('proyectos.edit', compact('proyecto', 'empleados'));
    }

    /**
     * UPDATE - Actualiza un proyecto en la base de datos
     */
    public function update(Request $request, Proyecto $proyecto)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255|unique:proyectos,nombre,' . $proyecto->id,
            'descripcion' => 'nullable|string',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',
            'presupuesto' => 'nullable|numeric|min:0',
            'empleados' => 'nullable|array',
            'empleados.*' => 'exists:empleados,id'
        ]);

        // Separar empleados
        $empleados = $validated['empleados'] ?? [];
        unset($validated['empleados']);

        // Actualizar proyecto
        $proyecto->update($validated);

        // Sincronizar empleados
        $proyecto->empleados()->sync($empleados);

        return redirect()->route('proyectos.index')
            ->with('success', 'Proyecto actualizado exitosamente.');
    }

    /**
     * DESTROY - Elimina un proyecto de la base de datos
     */
    public function destroy(Proyecto $proyecto)
    {
        // Los empleados se desvinculan automáticamente
        $proyecto->delete();

        return redirect()->route('proyectos.index')
            ->with('success', 'Proyecto eliminado exitosamente.');
    }
}
