<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo', 'Gestor de Talleres')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles {{-- **IMPORTANTE:** Para que los estilos de Livewire funcionen --}}
</head>
<body class="bg-gray-100">

    {{-- BARRA DE NAVEGACIÓN SUPERIOR (SIMPLIFICADA) --}}
    <nav class="bg-gray-800 text-white p-4 flex justify-between items-center">
        <a href="#" class="text-xl font-semibold">Gestor de Talleres</a>
        <div>
            {{-- Botón de "Cuenta" --}}
            <a href="{{ route('cuenta') }}" class="py-2 px-4 rounded hover:bg-gray-700">
                Cuenta
            </a>
            <a href="{{ route('talleres') }}" class="py-2 px-4 rounded hover:bg-gray-700">
                Talleres
            </a>
            {{-- Puedes añadir más enlaces aquí --}}
            <a href="#" class="py-2 px-4 rounded hover:bg-gray-700">
                Inicio
            </a>
        </div>
    </nav>

    <div class="flex min-h-screen">
        {{-- BARRA LATERAL (SIMPLIFICADA) --}}
        <aside class="w-64 bg-gray-700 text-white p-4">
            <ul class="menu p-0">
                <li class="mb-2">
                    <a href="#" class="block py-2 px-4 rounded hover:bg-gray-600">
                        Inicio
                    </a>
                </li>
                <li class="mb-2">
                    <a href="{{ route('cuenta') }}" class="block py-2 px-4 rounded hover:bg-gray-600">
                        Cuenta
                    </a>
                </li>
                <li class="mb-2">
                    <a href="#" class="block py-2 px-4 rounded hover:bg-gray-600">
                        Calendario
                    </a>
                </li>
                <a href="{{ route('talleres') }}" class="py-2 px-4 rounded hover:bg-gray-700">
                Talleres
            </a>
                </li>
                <li class="mb-2">
                    <a href="#" class="block py-2 px-4 rounded hover:bg-gray-600">
                        Sign Out
                    </a>
                </li>
            </ul>
        </aside>

        {{-- CONTENIDO PRINCIPAL --}}
        <main class="flex-grow p-4">
            {{--
                ¡IMPORTANTE!
                Aquí cargamos directamente el componente Livewire 'cuenta'.
                Esto significa que esta plantilla (app.blade.php) ahora está dedicada a mostrar
                el contenido de la página de la cuenta.
                Ya no se usa @yield('contenido') aquí para otros propósitos.
            --}}

            @livewire('talleres')
        </main>
    </div>

    {{-- PIE DE PÁGINA (SIMPLIFICADO) --}}
    <footer class="bg-gray-800 text-white p-4 mt-4">
        <p class="text-center">&copy; {{ date('Y') }} Gestor de Talleres</p>
    </footer>

    @livewireScripts {{-- **IMPORTANTE:** Para que los scripts de Livewire funcionen --}}
</body>
</html>
