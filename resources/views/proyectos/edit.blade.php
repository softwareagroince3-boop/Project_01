@extends('layouts.app')

@section('title', 'Editar Proyecto')

@section('content')
<div class="card">
    <div class="card-header">
        <h2 class="card-title">✏️ Editar Proyecto</h2>
        <a href="{{ route('proyectos.index') }}" class="btn btn-secondary">← Volver</a>
    </div>

    <form action="{{ route('proyectos.update', $proyecto) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nombre" class="form-label required">Nombre del Proyecto</label>
            <input type="text" id="nombre" name="nombre" class="form-control"
                   value="{{ old('nombre', $proyecto->nombre) }}" required>
        </div>

        <div class="form-group">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea id="descripcion" name="descripcion" class="form-control">{{ old('descripcion', $proyecto->descripcion) }}</textarea>
        </div>

        <div class="grid grid-2">
            <div class="form-group">
                <label for="fecha_inicio" class="form-label required">Fecha de Inicio</label>
                <input type="date" id="fecha_inicio" name="fecha_inicio" class="form-control"
                       value="{{ old('fecha_inicio', $proyecto->fecha_inicio->format('Y-m-d')) }}" required>
            </div>

            <div class="form-group">
                <label for="fecha_fin" class="form-label">Fecha de Fin</label>
                <input type="date" id="fecha_fin" name="fecha_fin" class="form-control"
                       value="{{ old('fecha_fin', $proyecto->fecha_fin?->format('Y-m-d')) }}">
            </div>
        </div>

        <div class="form-group">
            <label for="presupuesto" class="form-label">Presupuesto</label>
            <input type="number" id="presupuesto" name="presupuesto" class="form-control"
                   step="0.01" min="0" value="{{ old('presupuesto', $proyecto->presupuesto) }}">
        </div>

        <div class="form-group">
            <label class="form-label">Empleados Asignados</label>
            <div style="border: 2px solid var(--gray-200); border-radius: var(--radius); padding: 1rem; max-height: 300px; overflow-y: auto;">
                @if($empleados->count() > 0)
                    @foreach($empleados as $empleado)
                        <div class="form-check">
                            <input type="checkbox" id="empleado_{{ $empleado->id }}"
                                   name="empleados[]" value="{{ $empleado->id }}"
                                   {{ in_array($empleado->id, old('empleados', $proyecto->empleados->pluck('id')->toArray())) ? 'checked' : '' }}>
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
            <button type="submit" class="btn btn-success">✓ Actualizar</button>
        </div>
    </form>
</div>
@endsection
