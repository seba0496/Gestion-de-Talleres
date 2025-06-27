<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Gestión de Actividades Extracurriculares')</title>

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Font Awesome para íconos (opcional, pero útil para el dashboard) --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    {{-- Meta CSRF Token (IMPORTANTE para formularios POST/PUT/DELETE y AJAX) --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Estilos de Livewire (¡Esenciales si usas Livewire!) --}}
    @livewireStyles

    {{-- Espacio para estilos CSS específicos de cada vista --}}
    @stack('styles')
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark"> {{-- Usando bg-dark para un tema oscuro --}}
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/') }}">Gestión Actividades</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    {{-- Elementos de navegación que siempre deben estar --}}
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('talleres.index') }}">Talleres</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('instructores.index') }}">Instructores</a>
                    </li>
                    {{-- Aquí puedes añadir más enlaces a otras secciones, ej. Inscripciones, Usuarios --}}

                    {{-- Menú para perfiles de desarrolladores --}}
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Desarrolladores
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ route('developers.perfil1') }}">Perfil Desarrollador 1</a></li>
                            <li><a class="dropdown-item" href="{{ route('developers.perfil2') }}">Perfil Desarrollador 2</a></li>
                            {{-- Agrega más perfiles si los tienes --}}
                        </ul>
                    </li>
                </ul>

                <ul class="navbar-nav ms-auto">
                    @auth {{-- Si el usuario está autenticado --}}
                        <li class="nav-item">
                            <span class="nav-link text-white">Bienvenido, {{ Auth::user()->nombre }}</span>
                        </li>
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-link nav-link text-white-50">Cerrar Sesión</button>
                            </form>
                        </li>
                    @else {{-- Si el usuario no está autenticado --}}
                        <li class="nav-item">
                            <a class="nav-link text-white-50" href="{{ route('login') }}">Iniciar Sesión</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white-50" href="{{ route('register') }}">Registrarse</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        {{-- Mensajes de flash (ej. éxito/error después de una acción) --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @yield('content') {{-- Aquí se inyectará el contenido específico de cada vista --}}
    </div>

    {{-- Bootstrap JavaScript --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    {{-- Scripts de Livewire (¡Esenciales si usas Livewire!) --}}
    @livewireScripts

    {{-- Espacio para JavaScript específico de cada vista --}}
    @stack('scripts')
</body>
</html>
