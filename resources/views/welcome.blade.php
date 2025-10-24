@extends('layouts.app')

@section('title', 'Dashboard - Sistema de Gestión')

@section('content')

<!-- Hero Section -->
<div class="card" style="background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%); color: white; margin-bottom: 2rem;">
    <div style="text-align: center; padding: 2rem;">
        <h1 style="font-size: 2.5rem; margin-bottom: 0.5rem; color: white;">
            📊 Sistema de Gestión de Empleados
        </h1>
        <p style="font-size: 1.1rem; opacity: 0.9;">
            Administra empleados, departamentos, puestos y proyectos de forma eficiente
        </p>
    </div>
</div>

<!-- Stats Cards -->
<div class="grid grid-2" style="margin-bottom: 2rem;">
    <a href="{{ route('empleados.index') }}" style="text-decoration: none;">
        <div class="stat-card">
            <div class="stat-header">
                <span class="stat-icon">👥</span>
                <span class="badge badge-primary">Ver todos</span>
            </div>
            <div class="stat-value" style="color: var(--primary);">{{ $empleados }}</div>
            <div class="stat-label">Empleados Registrados</div>
        </div>
    </a>

    <a href="{{ route('departamentos.index') }}" style="text-decoration: none;">
        <div class="stat-card">
            <div class="stat-header">
                <span class="stat-icon">🏢</span>
                <span class="badge badge-success">Ver todos</span>
            </div>
            <div class="stat-value" style="color: var(--success);">{{ $departamentos }}</div>
            <div class="stat-label">Departamentos Activos</div>
        </div>
    </a>

    <a href="{{ route('puestos.index') }}" style="text-decoration: none;">
        <div class="stat-card">
            <div class="stat-header">
                <span class="stat-icon">💼</span>
                <span class="badge badge-warning">Ver todos</span>
            </div>
            <div class="stat-value" style="color: var(--warning);">{{ $puestos }}</div>
            <div class="stat-label">Puestos de Trabajo</div>
        </div>
    </a>

    <a href="{{ route('proyectos.index') }}" style="text-decoration: none;">
        <div class="stat-card">
            <div class="stat-header">
                <span class="stat-icon">📁</span>
                <span class="badge badge-primary">Ver todos</span>
            </div>
            <div class="stat-value" style="color: var(--secondary);">{{ $proyectos }}</div>
            <div class="stat-label">Proyectos en Curso</div>
        </div>
    </a>
</div>

<!-- Quick Actions -->
<div class="card">
    <h2 style="font-size: 1.5rem; margin-bottom: 1.5rem; color: var(--gray-800);">
        ⚡ Acciones Rápidas
    </h2>
    <div class="grid grid-2">
        <a href="{{ route('empleados.create') }}" class="card" style="text-decoration: none; border: 2px solid var(--primary); background: linear-gradient(135deg, rgba(59, 130, 246, 0.1) 0%, rgba(139, 92, 246, 0.1) 100%);">
            <div style="display: flex; align-items: center; gap: 1rem;">
                <div style="font-size: 2.5rem;">➕</div>
                <div>
                    <h3 style="font-size: 1.1rem; color: var(--primary); margin-bottom: 0.25rem;">Nuevo Empleado</h3>
                    <p style="color: var(--gray-600); margin: 0; font-size: 0.9rem;">Registrar un nuevo empleado en el sistema</p>
                </div>
            </div>
        </a>

        <a href="{{ route('departamentos.create') }}" class="card" style="text-decoration: none; border: 2px solid var(--success); background: linear-gradient(135deg, rgba(16, 185, 129, 0.1) 0%, rgba(5, 150, 105, 0.1) 100%);">
            <div style="display: flex; align-items: center; gap: 1rem;">
                <div style="font-size: 2.5rem;">🏢</div>
                <div>
                    <h3 style="font-size: 1.1rem; color: var(--success); margin-bottom: 0.25rem;">Nuevo Departamento</h3>
                    <p style="color: var(--gray-600); margin: 0; font-size: 0.9rem;">Crear un departamento de la empresa</p>
                </div>
            </div>
        </a>

        <a href="{{ route('puestos.create') }}" class="card" style="text-decoration: none; border: 2px solid var(--warning); background: linear-gradient(135deg, rgba(245, 158, 11, 0.1) 0%, rgba(217, 119, 6, 0.1) 100%);">
            <div style="display: flex; align-items: center; gap: 1rem;">
                <div style="font-size: 2.5rem;">💼</div>
                <div>
                    <h3 style="font-size: 1.1rem; color: var(--warning); margin-bottom: 0.25rem;">Nuevo Puesto</h3>
                    <p style="color: var(--gray-600); margin: 0; font-size: 0.9rem;">Definir un nuevo puesto de trabajo</p>
                </div>
            </div>
        </a>

        <a href="{{ route('proyectos.create') }}" class="card" style="text-decoration: none; border: 2px solid var(--secondary); background: linear-gradient(135deg, rgba(139, 92, 246, 0.1) 0%, rgba(124, 58, 237, 0.1) 100%);">
            <div style="display: flex; align-items: center; gap: 1rem;">
                <div style="font-size: 2.5rem;">📁</div>
                <div>
                    <h3 style="font-size: 1.1rem; color: var(--secondary); margin-bottom: 0.25rem;">Nuevo Proyecto</h3>
                    <p style="color: var(--gray-600); margin: 0; font-size: 0.9rem;">Iniciar un proyecto y asignar equipo</p>
                </div>
            </div>
        </a>
    </div>
</div>

<!-- Features Info -->
<div class="card" style="margin-top: 2rem; background: var(--gray-50);">
    <h3 style="font-size: 1.25rem; margin-bottom: 1rem; color: var(--gray-800);">
        ✨ Características del Sistema
    </h3>
    <div class="grid grid-3">
        <div style="text-align: center; padding: 1rem;">
            <div style="font-size: 2rem; margin-bottom: 0.5rem;">🔄</div>
            <h4 style="font-size: 1rem; margin-bottom: 0.5rem; color: var(--gray-700);">CRUD Completo</h4>
            <p style="font-size: 0.875rem; color: var(--gray-600); margin: 0;">Crear, leer, actualizar y eliminar registros</p>
        </div>

        <div style="text-align: center; padding: 1rem;">
            <div style="font-size: 2rem; margin-bottom: 0.5rem;">🔗</div>
            <h4 style="font-size: 1rem; margin-bottom: 0.5rem; color: var(--gray-700);">Relaciones</h4>
            <p style="font-size: 0.875rem; color: var(--gray-600); margin: 0;">Gestión de relaciones entre entidades</p>
        </div>

        <div style="text-align: center; padding: 1rem;">
            <div style="font-size: 2rem; margin-bottom: 0.5rem;">✅</div>
            <h4 style="font-size: 1rem; margin-bottom: 0.5rem; color: var(--gray-700);">Validación</h4>
            <p style="font-size: 0.875rem; color: var(--gray-600); margin: 0;">Validación de datos en tiempo real</p>
        </div>
    </div>
</div>

@endsection
