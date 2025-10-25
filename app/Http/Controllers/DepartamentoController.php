<?php

namespace App\Http\Controllers;

use App\Models\Departamento;
use Illuminate\Http\Request;

class DepartamentoController extends Controller
{
    /**
     * INDEX - Muestra la lista de todos los departamentos
     * Ruta: GET /departamentos
     */
    public function index()
    {
        // Obtiene todos los departamentos con el conteo de empleados
        $departamentos = Departamento::withCount('empleados')->get();

        return view('departamentos.index', compact('departamentos'));
    }

    /**
     * CREATE - Muestra el formulario para crear un nuevo departamento
     * Ruta: GET /departamentos/create
     */
    public function create()
    {
        return view('departamentos.create');
    }

    /**
     * STORE - Guarda un nuevo departamento en la base de datos
     * Ruta: POST /departamentos
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $validated = $request->validate([
            'nombre' => 'required|string|max:255|unique:departamentos',
            'descripcion' => 'nullable|string'
        ]);

        // Crear el departamento
        Departamento::create($validated);

        // Redireccionar con mensaje de éxito
        return redirect()->route('departamentos.index')
            ->with('success', 'Departamento creado exitosamente.');
    }

    /**
     * SHOW - Muestra los detalles de un departamento específico
     * Ruta: GET /departamentos/{id}
     */
    public function show(Departamento $departamento)
    {
        // Cargar los empleados del departamento
        $departamento->load('empleados.puesto');

        return view('departamentos.show', compact('departamento'));
    }

    /**
     * EDIT - Muestra el formulario para editar un departamento
     * Ruta: GET /departamentos/{id}/edit
     */
    public function edit(Departamento $departamento)
    {
        return view('departamentos.edit', compact('departamento'));
    }

    /**
     * UPDATE - Actualiza un departamento en la base de datos
     * Ruta: PUT/PATCH /departamentos/{id}
     */
    public function update(Request $request, Departamento $departamento)
    {
        // Validar los datos
        $validated = $request->validate([
            'nombre' => 'required|string|max:255|unique:departamentos,nombre,' . $departamento->id,
            'descripcion' => 'nullable|string'
        ]);

        // Actualizar el departamento
        $departamento->update($validated);

        return redirect()->route('departamentos.index')
            ->with('success', 'Departamento actualizado exitosamente.');
    }

    /**
     * DESTROY - Elimina un departamento de la base de datos
     * Ruta: DELETE /departamentos/{id}
     */
    public function destroy(Departamento $departamento)
    {
        $departamento->delete();

        return redirect()->route('departamentos.index')
            ->with('success', 'Departamento eliminado exitosamente.');
    }
}
