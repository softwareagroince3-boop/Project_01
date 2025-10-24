<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\PuestoController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\ProyectoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $empleados = \App\Models\Empleado::count();
    $departamentos = \App\Models\Departamento::count();
    $puestos = \App\Models\Puesto::count();
    $proyectos = \App\Models\Proyecto::count();

    return view('welcome', compact('empleados', 'departamentos', 'puestos', 'proyectos'));
});

/*
|--------------------------------------------------------------------------
| CRUD Routes - Sistema de Gestión de Empleados
|--------------------------------------------------------------------------
*/

// Rutas para Departamentos
Route::resource('departamentos', DepartamentoController::class);

// Rutas para Puestos
Route::resource('puestos', PuestoController::class);

// Rutas para Empleados
Route::resource('empleados', EmpleadoController::class);

// Rutas para Proyectos
Route::resource('proyectos', ProyectoController::class);
