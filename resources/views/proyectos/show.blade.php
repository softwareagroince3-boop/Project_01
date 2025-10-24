@extends('layouts.app')

@section('title', 'Proyecto: ' . $proyecto->nombre)

@section('content')
<div class="card">
    <div class="card-header">
        <h2 class="card-title">📁 {{ $proyecto->nombre }}</h2>
        <div class="btn-group">
            <a href="{{ route('proyectos.index') }}" class="btn btn-secondary">← Volver</a>
            <a href="{{ route('proyectos.edit', $proyecto) }}" class="btn btn-primary">✏️ Editar</a>
        </div>
    </div>

    <ul class="detail-list">
        <li class="detail-item">
            <span class="detail-label">Nombre:</span>
            <span class="detail-value">{{ $proyecto->nombre }}</span>
        </li>
        <li class="detail-item">
            <span class="detail-label">Descripción:</span>
            <span class="detail-value">{{ $proyecto->descripcion ?? 'Sin descripción' }}</span>
        </li>
        <li class="detail-item">
            <span class="detail-label">Fecha de Inicio:</span>
            <span class="detail-value">{{ $proyecto->fecha_inicio->format('d/m/Y') }}</span>
        </li>
        <li class="detail-item">
            <span class="detail-label">Fecha de Fin:</span>
            <span class="detail-value">{{ $proyecto->fecha_fin?->format('d/m/Y') ?? 'Sin definir' }}</span>
        </li>
        <li class="detail-item">
            <span class="detail-label">Presupuesto:</span>
            <span class="detail-value text-success">
                @if($proyecto->presupuesto)
                    <strong>${{ number_format($proyecto->presupuesto, 2) }}</strong>
                @else
                    <span class="text-muted">No especificado</span>
                @endif
            </span>
        </li>
        <li class="detail-item">
            <span class="detail-label">Total de Empleados:</span>
            <span class="detail-value">
                <span class="badge badge-primary">{{ $proyecto->empleados->count() }}</span>
            </span>
        </li>
    </ul>

    @if($proyecto->empleados->count() > 0)
        <div style="margin-top: 2rem;">
            <h3 style="font-size: 1.25rem; margin-bottom: 1rem;">👥 Equipo del Proyecto</h3>
            <div class="table-container">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Departamento</th>
                            <th>Puesto</th>
                            <th>Email</th>
                            <th>Salario</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($proyecto->empleados as $empleado)
                        <tr>
                            <td>
                                <a href="{{ route('empleados.show', $empleado) }}" style="color: var(--primary);">
                                    {{ $empleado->nombre }} {{ $empleado->apellido }}
                                </a>
                            </td>
                            <td>{{ $empleado->departamento->nombre }}</td>
                            <td>{{ $empleado->puesto->nombre }}</td>
                            <td>{{ $empleado->email }}</td>
                            <td>${{ number_format($empleado->salario, 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if($proyecto->presupuesto)
                <div style="margin-top: 1rem; padding: 1rem; background-color: var(--gray-50); border-radius: var(--radius);">
                    <strong>Costo Total del Equipo:</strong>
                    <span class="text-success" style="font-size: 1.2rem;">
                        ${{ number_format($proyecto->empleados->sum('salario'), 2) }}
                    </span>
                    <span class="text-muted">/ ${{ number_format($proyecto->presupuesto, 2) }} presupuestado</span>
                </div>
            @endif
        </div>
    @endif

    <div style="margin-top: 2rem; padding-top: 2rem; border-top: 2px solid var(--gray-200);">
        <form action="{{ route('proyectos.destroy', $proyecto) }}" method="POST"
              onsubmit="return confirm('¿Está seguro de eliminar este proyecto?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">🗑️ Eliminar Proyecto</button>
        </form>
    </div>
</div>
@endsection
