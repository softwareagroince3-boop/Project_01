@extends('layouts.app')

@section('title', 'Crear Proyecto')

@section('content')
<div class="card">
    <div class="card-header">
        <h2 class="card-title">➕ Crear Proyecto</h2>
        <a href="{{ route('proyectos.index') }}" class="btn btn-secondary">← Volver</a>
    </div>

    <form action="{{ route('proyectos.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="nombre" class="form-label required">Nombre del Proyecto</label>
            <input type="text" id="nombre" name="nombre" class="form-control"
                   value="{{ old('nombre') }}" required>
        </div>

        <div class="form-group">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea id="descripcion" name="descripcion" class="form-control">{{ old('descripcion') }}</textarea>
        </div>

        <div class="grid grid-2">
            <div class="form-group">
                <label for="fecha_inicio" class="form-label required">Fecha de Inicio</label>
                <input type="date" id="fecha_inicio" name="fecha_inicio" class="form-control"
                       value="{{ old('fecha_inicio') }}" required>
            </div>

            <div class="form-group">
                <label for="fecha_fin" class="form-label">Fecha de Fin</label>
                <input type="date" id="fecha_fin" name="fecha_fin" class="form-control"
                       value="{{ old('fecha_fin') }}">
            </div>
        </div>

        <div class="form-group">
            <label for="presupuesto" class="form-label">Presupuesto</label>
            <input type="number" id="presupuesto" name="presupuesto" class="form-control"
                   step="0.01" min="0" value="{{ old('presupuesto') }}">
        </div>

        <div class="form-group">
            <label class="form-label">Empleados Asignados</label>
            <div style="border: 2px solid var(--gray-200); border-radius: var(--radius); padding: 1rem; max-height: 300px; overflow-y: auto;">
                @if($empleados->count() > 0)
                    @foreach($empleados as $empleado)
                        <div class="form-check">
                            <input type="checkbox" id="empleado_{{ $empleado->id }}"
                                   name="empleados[]" value="{{ $empleado->id }}"
                                   {{ in_array($empleado->id, old('empleados', [])) ? 'checked' : '' }}>
                            <label for="empleado_{{ $empleado->id }}">
                                {{ $empleado->nombre }} {{ $empleado->apellido }}
                                <span class="text-muted">({{ $empleado->puesto->nombre }})</span>
                            </label>
                        </div>
                    @endforeach
                @else
                    <p class="text-muted">No hay empleados disponibles</p>
                @endif
            </div>
        </div>

        <div class="btn-group" style="justify-content: flex-end;">
            <a href="{{ route('proyectos.index') }}" class="btn btn-secondary">Cancelar</a>
            <button type="submit" class="btn btn-success">✓ Guardar</button>
        </div>
    </form>
</div>
@endsection
