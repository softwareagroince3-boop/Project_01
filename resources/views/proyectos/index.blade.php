@extends('layouts.app')

@section('title', 'Proyectos')

@section('content')
<div class="card">
    <div class="card-header">
        <h2 class="card-title">📁 Proyectos</h2>
        <a href="{{ route('proyectos.create') }}" class="btn btn-primary">➕ Nuevo Proyecto</a>
    </div>

    @if($proyectos->count() > 0)
        <div class="grid grid-2">
            @foreach($proyectos as $proyecto)
                <div class="card">
                    <h3 style="font-size: 1.25rem; margin-bottom: 0.5rem; color: var(--secondary);">
                        {{ $proyecto->nombre }}
                    </h3>
                    <p class="text-muted" style="margin-bottom: 1rem; min-height: 60px;">
                        {{ Str::limit($proyecto->descripcion ?? 'Sin descripción', 100) }}
                    </p>
                    <div style="display: flex; gap: 1rem; margin-bottom: 1rem; flex-wrap: wrap;">
                        <div>
                            <small class="text-muted">Inicio:</small><br>
                            <strong>{{ $proyecto->fecha_inicio->format('d/m/Y') }}</strong>
                        </div>
                        @if($proyecto->fecha_fin)
                            <div>
                                <small class="text-muted">Fin:</small><br>
                                <strong>{{ $proyecto->fecha_fin->format('d/m/Y') }}</strong>
                            </div>
                        @endif
                        @if($proyecto->presupuesto)
                            <div>
                                <small class="text-muted">Presupuesto:</small><br>
                                <strong class="text-success">${{ number_format($proyecto->presupuesto, 2) }}</strong>
                            </div>
                        @endif
                    </div>
                    <div style="margin-bottom: 1rem;">
                        <span class="badge badge-primary">
                            {{ $proyecto->empleados_count }} empleado(s)
                        </span>
                    </div>
                    <div class="btn-group">
                        <a href="{{ route('proyectos.show', $proyecto) }}" class="btn btn-secondary btn-sm">👁️ Ver</a>
                        <a href="{{ route('proyectos.edit', $proyecto) }}" class="btn btn-primary btn-sm">✏️ Editar</a>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center" style="padding: 3rem;">
            <p style="font-size: 1.2rem; color: var(--gray-500);">📭 No hay proyectos registrados.</p>
            <a href="{{ route('proyectos.create') }}" class="btn btn-primary mt-2">Crear el primer proyecto</a>
        </div>
    @endif
</div>
@endsection
