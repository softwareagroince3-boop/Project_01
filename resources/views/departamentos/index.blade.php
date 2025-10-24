@extends('layouts.app')

@section('title', 'Departamentos')

@section('content')
<div class="card">
    <div class="card-header">
        <h2 class="card-title">🏢 Departamentos</h2>
        <a href="{{ route('departamentos.create') }}" class="btn btn-primary">
            ➕ Nuevo Departamento
        </a>
    </div>

    @if($departamentos->count() > 0)
        <div class="grid grid-3">
            @foreach($departamentos as $departamento)
                <div class="card">
                    <h3 style="font-size: 1.25rem; margin-bottom: 0.5rem; color: var(--primary);">
                        {{ $departamento->nombre }}
                    </h3>
                    <p class="text-muted" style="margin-bottom: 1rem;">
                        {{ $departamento->descripcion ?? 'Sin descripción' }}
                    </p>
                    <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1rem;">
                        <span class="badge badge-primary">
                            {{ $departamento->empleados_count }} empleado(s)
                        </span>
                    </div>
                    <div class="btn-group">
                        <a href="{{ route('departamentos.show', $departamento) }}" class="btn btn-secondary btn-sm">
                            👁️ Ver
                        </a>
                        <a href="{{ route('departamentos.edit', $departamento) }}" class="btn btn-primary btn-sm">
                            ✏️ Editar
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center" style="padding: 3rem;">
            <p style="font-size: 1.2rem; color: var(--gray-500);">
                📭 No hay departamentos registrados.
            </p>
            <a href="{{ route('departamentos.create') }}" class="btn btn-primary mt-2">
                Crear el primer departamento
            </a>
        </div>
    @endif
</div>
@endsection
