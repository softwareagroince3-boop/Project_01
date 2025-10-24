@extends('layouts.app')

@section('title', 'Crear Departamento')

@section('content')
<div class="card">
    <div class="card-header">
        <h2 class="card-title">➕ Crear Departamento</h2>
        <a href="{{ route('departamentos.index') }}" class="btn btn-secondary">← Volver</a>
    </div>

    <form action="{{ route('departamentos.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="nombre" class="form-label required">Nombre del Departamento</label>
            <input type="text" id="nombre" name="nombre" class="form-control"
                   value="{{ old('nombre') }}" required>
        </div>

        <div class="form-group">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea id="descripcion" name="descripcion" class="form-control">{{ old('descripcion') }}</textarea>
        </div>

        <div class="btn-group" style="justify-content: flex-end;">
            <a href="{{ route('departamentos.index') }}" class="btn btn-secondary">Cancelar</a>
            <button type="submit" class="btn btn-success">✓ Guardar</button>
        </div>
    </form>
</div>
@endsection
