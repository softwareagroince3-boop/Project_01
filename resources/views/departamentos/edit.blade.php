@extends('layouts.app')

@section('title', 'Editar Departamento')

@section('content')
<div class="card">
    <div class="card-header">
        <h2 class="card-title">✏️ Editar Departamento</h2>
        <a href="{{ route('departamentos.index') }}" class="btn btn-secondary">← Volver</a>
    </div>

    <form action="{{ route('departamentos.update', $departamento) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nombre" class="form-label required">Nombre del Departamento</label>
            <input type="text" id="nombre" name="nombre" class="form-control"
                   value="{{ old('nombre', $departamento->nombre) }}" required>
        </div>

        <div class="form-group">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea id="descripcion" name="descripcion" class="form-control">{{ old('descripcion', $departamento->descripcion) }}</textarea>
        </div>

        <div class="btn-group" style="justify-content: flex-end;">
            <a href="{{ route('departamentos.index') }}" class="btn btn-secondary">Cancelar</a>
            <button type="submit" class="btn btn-success">✓ Actualizar</button>
        </div>
    </form>
</div>
@endsection
