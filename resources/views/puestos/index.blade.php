@extends('layouts.app')

@section('title', 'Puestos')

@section('content')
<div class="card">
    <div class="card-header">
        <h2 class="card-title">💼 Puestos de Trabajo</h2>
        <a href="{{ route('puestos.create') }}" class="btn btn-primary">➕ Nuevo Puesto</a>
    </div>

    @if($puestos->count() > 0)
        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre del Puesto</th>
                        <th>Descripción</th>
                        <th>Salario Base</th>
                        <th>Empleados</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($puestos as $puesto)
                    <tr>
                        <td><strong>#{{ $puesto->id }}</strong></td>
                        <td>{{ $puesto->nombre }}</td>
                        <td>{{ Str::limit($puesto->descripcion ?? 'N/A', 50) }}</td>
                        <td class="text-success"><strong>${{ number_format($puesto->salario_base, 2) }}</strong></td>
                        <td>
                            <span class="badge badge-primary">{{ $puesto->empleados_count }}</span>
                        </td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('puestos.show', $puesto) }}" class="btn btn-secondary btn-sm">👁️ Ver</a>
                                <a href="{{ route('puestos.edit', $puesto) }}" class="btn btn-primary btn-sm">✏️ Editar</a>
                                <form action="{{ route('puestos.destroy', $puesto) }}" method="POST"
                                      onsubmit="return confirm('¿Eliminar este puesto?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">🗑️</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="text-center" style="padding: 3rem;">
            <p style="font-size: 1.2rem; color: var(--gray-500);">📭 No hay puestos registrados.</p>
            <a href="{{ route('puestos.create') }}" class="btn btn-primary mt-2">Crear el primer puesto</a>
        </div>
    @endif
</div>
@endsection
