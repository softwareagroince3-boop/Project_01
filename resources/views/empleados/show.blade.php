@extends('layouts.app')

@section('title', 'Detalles del Empleado')

@section('content')
<div class="card">
    <div class="card-header">
        <h2 class="card-title">👤 Detalles del Empleado</h2>
        <div class="btn-group">
            <a href="{{ route('empleados.index') }}" class="btn btn-secondary">
                ← Volver
            </a>
            <a href="{{ route('empleados.edit', $empleado) }}" class="btn btn-primary">
                ✏️ Editar
            </a>
        </div>
    </div>

    <ul class="detail-list">
        <li class="detail-item">
            <span class="detail-label">ID:</span>
            <span class="detail-value"><strong>#{{ $empleado->id }}</strong></span>
        </li>

        <li class="detail-item">
            <span class="detail-label">Nombre Completo:</span>
            <span class="detail-value">{{ $empleado->nombre }} {{ $empleado->apellido }}</span>
        </li>

        <li class="detail-item">
            <span class="detail-label">Email:</span>
            <span class="detail-value">
                <a href="mailto:{{ $empleado->email }}" style="color: var(--primary);">
                    {{ $empleado->email }}
                </a>
            </span>
        </li>

        <li class="detail-item">
            <span class="detail-label">Teléfono:</span>
            <span class="detail-value">{{ $empleado->telefono ?? 'No especificado' }}</span>
        </li>

        <li class="detail-item">
            <span class="detail-label">Fecha de Ingreso:</span>
            <span class="detail-value">{{ $empleado->fecha_ingreso->format('d/m/Y') }}</span>
        </li>

        <li class="detail-item">
            <span class="detail-label">Salario:</span>
            <span class="detail-value text-success">
                <strong>${{ number_format($empleado->salario, 2) }}</strong>
            </span>
        </li>

        <li class="detail-item">
            <span class="detail-label">Departamento:</span>
            <span class="detail-value">
                <span class="badge badge-primary">{{ $empleado->departamento->nombre }}</span>
            </span>
        </li>

        <li class="detail-item">
            <span class="detail-label">Puesto:</span>
            <span class="detail-value">
                <span class="badge badge-success">{{ $empleado->puesto->nombre }}</span>
            </span>
        </li>

        <li class="detail-item">
            <span class="detail-label">Proyectos Asignados:</span>
            <span class="detail-value">
                @if($empleado->proyectos->count() > 0)
                    @foreach($empleado->proyectos as $proyecto)
                        <span class="badge badge-warning" style="margin-right: 0.5rem;">
                            {{ $proyecto->nombre }}
                        </span>
                    @endforeach
                @else
                    <span class="text-muted">Sin proyectos asignados</span>
                @endif
            </span>
        </li>

        <li class="detail-item">
            <span class="detail-label">Fecha de Registro:</span>
            <span class="detail-value text-muted">{{ $empleado->created_at->format('d/m/Y H:i') }}</span>
        </li>

        <li class="detail-item">
            <span class="detail-label">Última Actualización:</span>
            <span class="detail-value text-muted">{{ $empleado->updated_at->format('d/m/Y H:i') }}</span>
        </li>
    </ul>

    <!-- Botón de eliminar -->
    <div style="margin-top: 2rem; padding-top: 2rem; border-top: 2px solid var(--gray-200);">
        <form action="{{ route('empleados.destroy', $empleado) }}" method="POST"
              onsubmit="return confirm('¿Está seguro de eliminar este empleado? Esta acción no se puede deshacer.')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">
                🗑️ Eliminar Empleado
            </button>
        </form>
    </div>
</div>
@endsection
