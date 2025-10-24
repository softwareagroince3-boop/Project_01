@extends('layouts.app')

@section('title', 'Departamento: ' . $departamento->nombre)

@section('content')
<div class="card">
    <div class="card-header">
        <h2 class="card-title">🏢 {{ $departamento->nombre }}</h2>
        <div class="btn-group">
            <a href="{{ route('departamentos.index') }}" class="btn btn-secondary">← Volver</a>
            <a href="{{ route('departamentos.edit', $departamento) }}" class="btn btn-primary">✏️ Editar</a>
        </div>
    </div>

    <ul class="detail-list">
        <li class="detail-item">
            <span class="detail-label">Nombre:</span>
            <span class="detail-value">{{ $departamento->nombre }}</span>
        </li>
        <li class="detail-item">
            <span class="detail-label">Descripción:</span>
            <span class="detail-value">{{ $departamento->descripcion ?? 'Sin descripción' }}</span>
        </li>
        <li class="detail-item">
            <span class="detail-label">Total de Empleados:</span>
            <span class="detail-value">
                <span class="badge badge-primary">{{ $departamento->empleados->count() }}</span>
            </span>
        </li>
    </ul>

    @if($departamento->empleados->count() > 0)
        <div style="margin-top: 2rem;">
            <h3 style="font-size: 1.25rem; margin-bottom: 1rem;">👥 Empleados en este Departamento</h3>
            <div class="table-container">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Puesto</th>
                            <th>Email</th>
                            <th>Salario</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($departamento->empleados as $empleado)
                        <tr>
                            <td>
                                <a href="{{ route('empleados.show', $empleado) }}" style="color: var(--primary);">
                                    {{ $empleado->nombre }} {{ $empleado->apellido }}
                                </a>
                            </td>
                            <td>{{ $empleado->puesto->nombre }}</td>
                            <td>{{ $empleado->email }}</td>
                            <td>${{ number_format($empleado->salario, 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif

    <div style="margin-top: 2rem; padding-top: 2rem; border-top: 2px solid var(--gray-200);">
        <form action="{{ route('departamentos.destroy', $departamento) }}" method="POST"
              onsubmit="return confirm('¿Está seguro de eliminar este departamento?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">🗑️ Eliminar Departamento</button>
        </form>
    </div>
</div>
@endsection
