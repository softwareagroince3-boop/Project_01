@extends('layouts.app')

@section('title', 'Crear Puesto')

@section('content')
<div class="card">
    <div class="card-header">
        <h2 class="card-title">➕ Crear Puesto</h2>
        <a href="{{ route('puestos.index') }}" class="btn btn-secondary">← Volver</a>
    </div>

    <form action="{{ route('puestos.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="nombre" class="form-label required">Nombre del Puesto</label>
            <input type="text" id="nombre" name="nombre" class="form-control"
                   value="{{ old('nombre') }}" required>
        </div>

        <div class="form-group">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea id="descripcion" name="descripcion" class="form-control">{{ old('descripcion') }}</textarea>
        </div>

        <div class="form-group">
            <label for="salario_base" class="form-label required">Salario Base</label>
            <input type="number" id="salario_base" name="salario_base" class="form-control"
                   step="0.01" min="0" value="{{ old('salario_base') }}" required>
        </div>

        <div class="btn-group" style="justify-content: flex-end;">
            <a href="{{ route('puestos.index') }}" class="btn btn-secondary">Cancelar</a>
            <button type="submit" class="btn btn-success">✓ Guardar</button>
        </div>
    </form>
</div>
@endsection
