<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Gestión de Actividades Extracurriculares')</title>

    {{-- Tailwind CSS CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Meta CSRF Token (IMPORTANTE para formularios POST/PUT/DELETE y AJAX) --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Estilos de Livewire (¡Esenciales si usas Livewire!) --}}
    @livewireStyles

    {{-- Espacio para estilos CSS específicos de cada vista --}}
    @stack('styles')
</head>
<body class="bg-gray-100 min-h-screen">
    <nav class="bg-gray-900 text-white shadow">
        <div class="container mx-auto px-4 py-3 flex flex-wrap items-center justify-between">
            <a class="font-bold text-xl" href="{{ url('/') }}">Gestión Actividades</a>
            <button class="block lg:hidden text-gray-400 focus:outline-none" id="navbar-toggle">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
            </button>
            <div class="w-full lg:flex lg:items-center lg:w-auto hidden" id="navbarNav">
                <ul class="flex flex-col lg:flex-row lg:space-x-6 mt-4 lg:mt-0">
                    {{-- Elementos de navegación que siempre deben estar --}}
                    <li>
                        <a class="block py-2 px-3 rounded hover:bg-gray-800 transition" href="{{ route('dashboard') }}">Dashboard</a>
                    </li>
                    <li>
                        <a class="block py-2 px-3 rounded hover:bg-gray-800 transition" href="{{ route('talleres.index') }}">Talleres</a>
                    </li>
                    <li>
                        <a class="block py-2 px-3 rounded hover:bg-gray-800 transition" href="{{ route('instructores.index') }}">Instructores</a>
                    </li>
                    {{-- Aquí puedes añadir más enlaces a otras secciones, ej. Inscripciones, Usuarios --}}
                    {{-- Menú para perfiles de desarrolladores --}}
                    {{--
                    <li class="relative group">
                        <button class="block py-2 px-3 rounded hover:bg-gray-800 transition flex items-center">
                            Desarrolladores
                            <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <ul class="absolute left-0 mt-2 w-48 bg-white text-gray-900 rounded shadow-lg opacity-0 group-hover:opacity-100 transition pointer-events-none group-hover:pointer-events-auto z-10">
                            <li><a class="block px-4 py-2 hover:bg-gray-100" href="#">Perfil Desarrollador 1</a></li>
                            <li><a class="block px-4 py-2 hover:bg-gray-100" href="#">Perfil Desarrollador 2</a></li>
                        </ul>
                    </li>
                    --}}
                </ul>
                <ul class="flex flex-col lg:flex-row lg:space-x-4 mt-4 lg:mt-0 lg:ml-auto">
                    @auth
                        <li>
                            <span class="block py-2 px-3 text-gray-300">Bienvenido, {{ Auth::user()->nombre }}</span>
                        </li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="block py-2 px-3 rounded hover:bg-gray-800 transition text-gray-400">Cerrar Sesión</button>
                            </form>
                        </li>
                    @else
                        <li>
                            <a class="block py-2 px-3 rounded hover:bg-gray-800 transition text-gray-400" href="{{ route('login') }}">Iniciar Sesión</a>
                        </li>
                        <li>
                            <a class="block py-2 px-3 rounded hover:bg-gray-800 transition text-gray-400" href="{{ route('register') }}">Registrarse</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mx-auto mt-8 px-4">
        {{-- Mensajes de flash (ej. éxito/error después de una acción) --}}
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                {{ session('success') }}
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3 cursor-pointer" onclick="this.parentElement.style.display='none';">&times;</span>
            </div>
        @endif
        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                {{ session('error') }}
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3 cursor-pointer" onclick="this.parentElement.style.display='none';">&times;</span>
            </div>
        @endif

        @yield('content')
    </div>

    {{-- Scripts de Livewire (¡Esenciales si usas Livewire!) --}}
    @livewireScripts

    {{-- Espacio para JavaScript específico de cada vista --}}
    @stack('scripts')

    <script>
        // Navbar toggle para mobile
        document.getElementById('navbar-toggle').addEventListener('click', function() {
            var nav = document.getElementById('navbarNav');
            nav.classList.toggle('hidden');
        });
    </script>
</body>
</html>
