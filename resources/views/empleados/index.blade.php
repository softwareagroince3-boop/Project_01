@extends('layouts.app')

@section('title', 'Lista de Empleados')

@section('content')
<div class="card">
    <div class="card-header">
        <h2 class="card-title">👥 Lista de Empleados</h2>
        <a href="{{ route('empleados.create') }}" class="btn btn-primary">
            ➕ Nuevo Empleado
        </a>
    </div>

    @if($empleados->count() > 0)
        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre Completo</th>
                        <th>Email</th>
                        <th>Teléfono</th>
                        <th>Departamento</th>
                        <th>Puesto</th>
                        <th>Salario</th>
                        <th>Fecha Ingreso</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($empleados as $empleado)
                    <tr>
                        <td><strong>#{{ $empleado->id }}</strong></td>
                        <td>{{ $empleado->nombre }} {{ $empleado->apellido }}</td>
                        <td>{{ $empleado->email }}</td>
                        <td>{{ $empleado->telefono ?? 'N/A' }}</td>
                        <td>
                            <span class="badge badge-primary">
                                {{ $empleado->departamento->nombre }}
                            </span>
                        </td>
                        <td>
                            <span class="badge badge-success">
                                {{ $empleado->puesto->nombre }}
                            </span>
                        </td>
                        <td>${{ number_format($empleado->salario, 2) }}</td>
                        <td>{{ $empleado->fecha_ingreso->format('d/m/Y') }}</td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('empleados.show', $empleado) }}" class="btn btn-secondary btn-sm">
                                    👁️ Ver
                                </a>
                                <a href="{{ route('empleados.edit', $empleado) }}" class="btn btn-primary btn-sm">
                                    ✏️ Editar
                                </a>
                                <form action="{{ route('empleados.destroy', $empleado) }}" method="POST"
                                      onsubmit="return confirm('¿Está seguro de eliminar este empleado?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        🗑️ Eliminar
                                    </button>
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
            <p style="font-size: 1.2rem; color: var(--gray-500);">
                📭 No hay empleados registrados todavía.
            </p>
            <a href="{{ route('empleados.create') }}" class="btn btn-primary mt-2">
                Crear el primer empleado
            </a>
        </div>
    @endif
</div>
@endsection
