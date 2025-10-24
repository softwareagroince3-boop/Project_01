<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Departamento;
use App\Models\Puesto;
use App\Models\Proyecto;
use Illuminate\Http\Request;

class EmpleadoController extends Controller
{
    /**
     * INDEX - Muestra la lista de todos los empleados
     */
    public function index()
    {
        // Obtiene todos los empleados con sus relaciones
        $empleados = Empleado::with(['departamento', 'puesto'])->get();

        return view('empleados.index', compact('empleados'));
    }

    /**
     * CREATE - Muestra el formulario para crear un nuevo empleado
     */
    public function create()
    {
        // Obtener departamentos y puestos para los selectores del formulario
        $departamentos = Departamento::all();
        $puestos = Puesto::all();
        $proyectos = Proyecto::all();

        return view('empleados.create', compact('departamentos', 'puestos', 'proyectos'));
    }

    /**
     * STORE - Guarda un nuevo empleado en la base de datos
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => 'required|email|unique:empleados',
            'telefono' => 'nullable|string|max:20',
            'fecha_ingreso' => 'required|date',
            'salario' => 'required|numeric|min:0',
            'departamento_id' => 'required|exists:departamentos,id',
            'puesto_id' => 'required|exists:puestos,id',
            'proyectos' => 'nullable|array',
            'proyectos.*' => 'exists:proyectos,id'
        ]);

        // Separar los proyectos de los datos del empleado
        $proyectos = $validated['proyectos'] ?? [];
        unset($validated['proyectos']);

        // Crear el empleado
        $empleado = Empleado::create($validated);

        // Asignar proyectos si se seleccionaron
        if (!empty($proyectos)) {
            $empleado->proyectos()->attach($proyectos);
        }

        return redirect()->route('empleados.index')
            ->with('success', 'Empleado creado exitosamente.');
    }

    /**
     * SHOW - Muestra los detalles de un empleado específico
     */
    public function show(Empleado $empleado)
    {
        // Cargar todas las relaciones
        $empleado->load(['departamento', 'puesto', 'proyectos']);

        return view('empleados.show', compact('empleado'));
    }

    /**
     * EDIT - Muestra el formulario para editar un empleado
     */
    public function edit(Empleado $empleado)
    {
        $departamentos = Departamento::all();
        $puestos = Puesto::all();
        $proyectos = Proyecto::all();

        // Cargar los proyectos actuales del empleado
        $empleado->load('proyectos');

        return view('empleados.edit', compact('empleado', 'departamentos', 'puestos', 'proyectos'));
    }

    /**
     * UPDATE - Actualiza un empleado en la base de datos
     */
    public function update(Request $request, Empleado $empleado)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => 'required|email|unique:empleados,email,' . $empleado->id,
            'telefono' => 'nullable|string|max:20',
            'fecha_ingreso' => 'required|date',
            'salario' => 'required|numeric|min:0',
            'departamento_id' => 'required|exists:departamentos,id',
            'puesto_id' => 'required|exists:puestos,id',
            'proyectos' => 'nullable|array',
            'proyectos.*' => 'exists:proyectos,id'
        ]);

        // Separar los proyectos
        $proyectos = $validated['proyectos'] ?? [];
        unset($validated['proyectos']);

        // Actualizar el empleado
        $empleado->update($validated);

        // Sincronizar proyectos (elimina los antiguos y agrega los nuevos)
        $empleado->proyectos()->sync($proyectos);

        return redirect()->route('empleados.index')
            ->with('success', 'Empleado actualizado exitosamente.');
    }

    /**
     * DESTROY - Elimina un empleado de la base de datos
     */
    public function destroy(Empleado $empleado)
    {
        // Los proyectos se desvinculan automáticamente por la tabla pivote
        $empleado->delete();

        return redirect()->route('empleados.index')
            ->with('success', 'Empleado eliminado exitosamente.');
    }
}
