@extends('layouts.app')

@section('title', 'Editar Empleado')

@section('content')
<div class="card">
    <div class="card-header">
        <h2 class="card-title">✏️ Editar Empleado</h2>
        <a href="{{ route('empleados.index') }}" class="btn btn-secondary">
            ← Volver
        </a>
    </div>

    <form action="{{ route('empleados.update', $empleado) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="grid grid-2">
            <!-- Nombre -->
            <div class="form-group">
                <label for="nombre" class="form-label required">Nombre</label>
                <input type="text"
                       id="nombre"
                       name="nombre"
                       class="form-control"
                       value="{{ old('nombre', $empleado->nombre) }}"
                       required>
            </div>

            <!-- Apellido -->
            <div class="form-group">
                <label for="apellido" class="form-label required">Apellido</label>
                <input type="text"
                       id="apellido"
                       name="apellido"
                       class="form-control"
                       value="{{ old('apellido', $empleado->apellido) }}"
                       required>
            </div>
        </div>

        <div class="grid grid-2">
            <!-- Email -->
            <div class="form-group">
                <label for="email" class="form-label required">Email</label>
                <input type="email"
                       id="email"
                       name="email"
                       class="form-control"
                       value="{{ old('email', $empleado->email) }}"
                       required>
            </div>

            <!-- Teléfono -->
            <div class="form-group">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="text"
                       id="telefono"
                       name="telefono"
                       class="form-control"
                       value="{{ old('telefono', $empleado->telefono) }}">
            </div>
        </div>

        <div class="grid grid-2">
            <!-- Fecha de Ingreso -->
            <div class="form-group">
                <label for="fecha_ingreso" class="form-label required">Fecha de Ingreso</label>
                <input type="date"
                       id="fecha_ingreso"
                       name="fecha_ingreso"
                       class="form-control"
                       value="{{ old('fecha_ingreso', $empleado->fecha_ingreso->format('Y-m-d')) }}"
                       required>
            </div>

            <!-- Salario -->
            <div class="form-group">
                <label for="salario" class="form-label required">Salario</label>
                <input type="number"
                       id="salario"
                       name="salario"
                       class="form-control"
                       step="0.01"
                       min="0"
                       value="{{ old('salario', $empleado->salario) }}"
                       required>
            </div>
        </div>

        <div class="grid grid-2">
            <!-- Departamento -->
            <div class="form-group">
                <label for="departamento_id" class="form-label required">Departamento</label>
                <select id="departamento_id"
                        name="departamento_id"
                        class="form-control"
                        required>
                    <option value="">-- Seleccionar Departamento --</option>
                    @foreach($departamentos as $departamento)
                        <option value="{{ $departamento->id }}"
                                {{ old('departamento_id', $empleado->departamento_id) == $departamento->id ? 'selected' : '' }}>
                            {{ $departamento->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Puesto -->
            <div class="form-group">
                <label for="puesto_id" class="form-label required">Puesto</label>
                <select id="puesto_id"
                        name="puesto_id"
                        class="form-control"
                        required>
                    <option value="">-- Seleccionar Puesto --</option>
                    @foreach($puestos as $puesto)
                        <option value="{{ $puesto->id }}"
                                {{ old('puesto_id', $empleado->puesto_id) == $puesto->id ? 'selected' : '' }}>
                            {{ $puesto->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Proyectos -->
        <div class="form-group">
            <label class="form-label">Proyectos Asignados</label>
            <div style="border: 2px solid var(--gray-200); border-radius: var(--radius); padding: 1rem;">
                @if($proyectos->count() > 0)
                    @foreach($proyectos as $proyecto)
                        <div class="form-check">
                            <input type="checkbox"
                                   id="proyecto_{{ $proyecto->id }}"
                                   name="proyectos[]"
                                   value="{{ $proyecto->id }}"
                                   {{ in_array($proyecto->id, old('proyectos', $empleado->proyectos->pluck('id')->toArray())) ? 'checked' : '' }}>
                            <label for="proyecto_{{ $proyecto->id }}">
                                {{ $proyecto->nombre }}
                            </label>
                        </div>
                    @endforeach
                @else
                    <p class="text-muted">No hay proyectos disponibles</p>
                @endif
            </div>
        </div>

        <!-- Botones -->
        <div class="btn-group" style="justify-content: flex-end; margin-top: 2rem;">
            <a href="{{ route('empleados.index') }}" class="btn btn-secondary">
                Cancelar
            </a>
            <button type="submit" class="btn btn-success">
                ✓ Actualizar Empleado
            </button>
        </div>
    </form>
</div>
@endsection
