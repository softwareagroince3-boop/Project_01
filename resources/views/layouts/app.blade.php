<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Sistema de Gestión de Empleados')</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="container">
            <div class="header-content">
                <div class="logo">
                    <h1>📊 Sistema</h1>
                </div>
                <nav class="nav">
                    <a href="{{ route('empleados.index') }}" class="nav-link {{ request()->routeIs('empleados.*') ? 'active' : '' }}">
                        👥 Empleados
                    </a>
                    <a href="{{ route('departamentos.index') }}" class="nav-link {{ request()->routeIs('departamentos.*') ? 'active' : '' }}">
                        🏢 Departamentos
                    </a>
                    <a href="{{ route('puestos.index') }}" class="nav-link {{ request()->routeIs('puestos.*') ? 'active' : '' }}">
                        💼 Puestos
                    </a>
                    <a href="{{ route('proyectos.index') }}" class="nav-link {{ request()->routeIs('proyectos.*') ? 'active' : '' }}">
                        📁 Proyectos
                    </a>
                </nav>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="main-content">
        <div class="container">
            <!-- Mensajes de éxito/error -->
            @if(session('success'))
                <div class="alert alert-success">
                    ✓ {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-error">
                    ✗ {{ session('error') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-error">
                    <strong>¡Errores en el formulario!</strong>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Contenido de la página -->
            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p>&copy; {{ date('Y') }} Sistema de Gestión de Empleados | Desarrollado con Laravel</p>
        </div>
    </footer>

    @yield('scripts')
</body>
</html>
