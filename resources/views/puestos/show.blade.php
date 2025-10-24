@extends('layouts.app')

@section('title', 'Puesto: ' . $puesto->nombre)

@section('content')
<div class="card">
    <div class="card-header">
        <h2 class="card-title">💼 {{ $puesto->nombre }}</h2>
        <div class="btn-group">
            <a href="{{ route('puestos.index') }}" class="btn btn-secondary">← Volver</a>
            <a href="{{ route('puestos.edit', $puesto) }}" class="btn btn-primary">✏️ Editar</a>
        </div>
    </div>

    <ul class="detail-list">
        <li class="detail-item">
            <span class="detail-label">Nombre:</span>
            <span class="detail-value">{{ $puesto->nombre }}</span>
        </li>
        <li class="detail-item">
            <span class="detail-label">Descripción:</span>
            <span class="detail-value">{{ $puesto->descripcion ?? 'Sin descripción' }}</span>
        </li>
        <li class="detail-item">
            <span class="detail-label">Salario Base:</span>
            <span class="detail-value text-success">
                <strong>${{ number_format($puesto->salario_base, 2) }}</strong>
            </span>
        </li>
        <li class="detail-item">
            <span class="detail-label">Total de Empleados:</span>
            <span class="detail-value">
                <span class="badge badge-primary">{{ $puesto->empleados->count() }}</span>
            </span>
        </li>
    </ul>

    @if($puesto->empleados->count() > 0)
        <div style="margin-top: 2rem;">
            <h3 style="font-size: 1.25rem; margin-bottom: 1rem;">👥 Empleados con este Puesto</h3>
            <div class="table-container">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Departamento</th>
                            <th>Email</th>
                            <th>Salario</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($puesto->empleados as $empleado)
                        <tr>
                            <td>
                                <a href="{{ route('empleados.show', $empleado) }}" style="color: var(--primary);">
                                    {{ $empleado->nombre }} {{ $empleado->apellido }}
                                </a>
                            </td>
                            <td>{{ $empleado->departamento->nombre }}</td>
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
        <form action="{{ route('puestos.destroy', $puesto) }}" method="POST"
              onsubmit="return confirm('¿Está seguro de eliminar este puesto?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">🗑️ Eliminar Puesto</button>
        </form>
    </div>
</div>
@endsection
