<?php

namespace App\Http\Controllers;

use App\Models\Puesto;
use Illuminate\Http\Request;

class PuestoController extends Controller
{
    /**
     * INDEX - Muestra la lista de todos los puestos
     */
    public function index()
    {
        $puestos = Puesto::withCount('empleados')->get();

        return view('puestos.index', compact('puestos'));
    }

    /**
     * CREATE - Muestra el formulario para crear un nuevo puesto
     */
    public function create()
    {
        return view('puestos.create');
    }

    /**
     * STORE - Guarda un nuevo puesto en la base de datos
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255|unique:puestos',
            'descripcion' => 'nullable|string',
            'salario_base' => 'required|numeric|min:0'
        ]);

        Puesto::create($validated);

        return redirect()->route('puestos.index')
            ->with('success', 'Puesto creado exitosamente.');
    }

    /**
     * SHOW - Muestra los detalles de un puesto específico
     */
    public function show(Puesto $puesto)
    {
        $puesto->load('empleados.departamento');

        return view('puestos.show', compact('puesto'));
    }

    /**
     * EDIT - Muestra el formulario para editar un puesto
     */
    public function edit(Puesto $puesto)
    {
        return view('puestos.edit', compact('puesto'));
    }

    /**
     * UPDATE - Actualiza un puesto en la base de datos
     */
    public function update(Request $request, Puesto $puesto)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255|unique:puestos,nombre,' . $puesto->id,
            'descripcion' => 'nullable|string',
            'salario_base' => 'required|numeric|min:0'
        ]);

        $puesto->update($validated);

        return redirect()->route('puestos.index')
            ->with('success', 'Puesto actualizado exitosamente.');
    }

    /**
     * DESTROY - Elimina un puesto de la base de datos
     */
    public function destroy(Puesto $puesto)
    {
        if ($puesto->empleados()->count() > 0) {
            return redirect()->route('puestos.index')
                ->with('error', 'No se puede eliminar un puesto con empleados asignados.');
        }

        $puesto->delete();

        return redirect()->route('puestos.index')
            ->with('success', 'Puesto eliminado exitosamente.');
    }
}
