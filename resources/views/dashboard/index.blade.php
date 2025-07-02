
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración - Gestión de Talleres</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
        /* Colores personalizados si necesitas ir más allá de los defaults de Tailwind */
        :root {
            --primary-color: #4f46e5; /* indigo-600 */
            --secondary-color: #6366f1; /* indigo-500 */
            --text-dark: #1f2937; /* gray-900 */
            --text-light: #4b5563; /* gray-600 */
            --bg-light: #f9fafb; /* gray-50 */
            --bg-medium: #e5e7eb; /* gray-200 */
        }
        /* Estilos para el scrollbar (opcional, para un toque extra) */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        ::-webkit-scrollbar-thumb {
            background-color: #cbd5e1; /* gray-400 */
            border-radius: 4px;
        }
        ::-webkit-scrollbar-track {
            background-color: #f1f5f9; /* gray-100 */
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800">

    <div class="flex h-screen">
        <aside class="w-64 bg-gray-800 text-white flex flex-col p-6 shadow-xl z-10">
            <div class="flex items-center mb-10">
                <svg class="h-8 w-8 text-indigo-400 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0v-9l2-2 2 2v9h-2z" />
                </svg>
                <h2 class="text-2xl font-semibold text-white">AdminPanel</h2>
            </div>
            <nav class="flex-grow">
                <ul>
                    <li class="mb-4">
                        <a href="{{ route('dashboard') }}" class="flex items-center p-3 rounded-lg text-indigo-300 bg-gray-700 font-medium hover:bg-gray-700 hover:text-white transition duration-200">
                            <svg class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0v-9l2-2 2 2v9h-2z" /></svg>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="mb-4">
                        <a href="{{ route('users.index') }}" class="flex items-center p-3 rounded-lg text-gray-300 hover:bg-gray-700 hover:text-white transition duration-200">
                             <svg class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.653-.106-1.282-.303-1.858M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.653.106-1.282.303-1.858m0 0A7.962 7.962 0 0112 10.5a7.962 7.962 0 014.697 1.642M12 10.5a5 5 0 110-10 5 5 0 010 10z" /></svg>
                            <span>Usuarios</span>
                        </a>
                    </li>
                  <li class="mb-2"> {{-- Ajuste de mb-4 a mb-2 para un espaciado más compacto en menús --}}
    <a href="{{ route('talleres.index') }}" 
       class="flex items-center p-3 rounded-lg transition duration-200 
              {{ request()->routeIs('talleres.index') ? 'bg-gray-700 text-white shadow-md' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
        <svg class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z" />
        </svg>
        <span>Talleres</span>
    </a>
</li>
                    <li class="mb-4">
                        <a href="#" class="flex items-center p-3 rounded-lg text-gray-300 hover:bg-gray-700 hover:text-white transition duration-200">
                            <svg class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" /></svg>
                            <span>Inscripciones</span>
                        </a>
                    </li>
                </ul>
            </nav>
            <div class="mt-auto">
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                   class="flex items-center p-3 rounded-lg text-red-300 hover:bg-red-700 hover:text-white transition duration-200">
                    <svg class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
                    <span>Cerrar Sesión</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                </form>
            </div>
        </aside>

        <main class="flex-1 p-8 overflow-y-auto bg-gray-50">
            <header class="flex items-center justify-between pb-6 border-b border-gray-200 mb-8">
                <h1 class="text-4xl font-extrabold text-gray-900">Bienvenido al Dashboard</h1>
                <div class="flex items-center">
                    <span class="text-lg font-medium text-gray-700 mr-2">Hola, {{ Auth::user()->nombre ?? 'Administrador' }}!</span>
                    <img class="h-10 w-10 rounded-full object-cover border-2 border-indigo-400" src="https://via.placeholder.com/150/5B21B6/FFFFFF?text=AD" alt="Avatar">
                </div>
            </header>

            {{-- Mensajes flash (ej. de registro exitoso) --}}
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
                    <strong class="font-bold">¡Éxito!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                    <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                        <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.103l-2.651 3.746a1.2 1.2 0 1 1-1.697-1.697l3.746-2.651-3.746-2.651a1.2 1.2 0 1 1 1.697-1.697l2.651 3.746 2.651-3.746a1.2 1.2 0 0 1 1.697 1.697l-3.746 2.651 3.746 2.651a1.2 1.2 0 0 1 0 1.697z"/></svg>
                    </span>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-gradient-to-br from-indigo-500 to-indigo-600 p-6 rounded-xl shadow-lg transform hover:scale-105 transition duration-300">
                    <div class="flex items-center justify-between mb-4">
                        <p class="text-white text-lg font-semibold">Total Talleres</p>
                        <svg class="h-8 w-8 text-indigo-200 opacity-75" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" /></svg>
                    </div>
                    <p class="text-5xl font-extrabold text-white">{{ $totalTalleres }}</p>
                    <p class="text-indigo-200 text-sm mt-2">Talleres disponibles actualmente</p>
                </div>

                <div class="bg-gradient-to-br from-green-500 to-green-600 p-6 rounded-xl shadow-lg transform hover:scale-105 transition duration-300">
                    <div class="flex items-center justify-between mb-4">
                        <p class="text-white text-lg font-semibold">Total Usuarios</p>
                        <svg class="h-8 w-8 text-green-200 opacity-75" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M12 20v-9.5H5.5L4 13.5M12 20a8 8 0 008-8M12 20a8 8 0 01-8-8M12 20v-9.5H18.5L20 13.5M12 10a4 4 0 00-4 4v2m4-2v2m4-2v2M8 16h8" /></svg>
                    </div>
                    <p class="text-5xl font-extrabold text-white">{{ $totalUsuarios }}</p>
                    <p class="text-green-200 text-sm mt-2">Usuarios registrados</p>
                </div>

                <div class="bg-gradient-to-br from-yellow-500 to-yellow-600 p-6 rounded-xl shadow-lg transform hover:scale-105 transition duration-300">
                    <div class="flex items-center justify-between mb-4">
                        <p class="text-white text-lg font-semibold">Total Inscripciones</p>
                        <svg class="h-8 w-8 text-yellow-200 opacity-75" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" /></svg>
                    </div>
                    <p class="text-5xl font-extrabold text-white">{{ $totalInscripciones }}</p>
                    <p class="text-yellow-200 text-sm mt-2">Inscripciones activas</p>
                </div>

                <div class="bg-gradient-to-br from-purple-500 to-purple-600 p-6 rounded-xl shadow-lg transform hover:scale-105 transition duration-300">
                    <div class="flex items-center justify-between mb-4">
                        <p class="text-white text-lg font-semibold">Total Instructores</p>
                        <svg class="h-8 w-8 text-purple-200 opacity-75" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.523 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5S19.832 5.477 21 6.253v13C19.832 18.523 18.246 18 16.5 18S13.168 18.523 12 19.253" /></svg>
                    </div>
                    <p class="text-5xl font-extrabold text-white">{{ $totalInstructores }}</p>
                    <p class="text-purple-200 text-sm mt-2">Instructores registrados</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-200">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Talleres Más Populares</h2>
                    @if($talleresPopulares->isEmpty())
                        <p class="text-gray-600">No hay talleres populares para mostrar.</p>
                    @else
                        <ul class="divide-y divide-gray-200">
                            @foreach($talleresPopulares as $taller)
                                <li class="py-3 flex justify-between items-center">
                                    <span class="text-gray-700 font-medium">{{ $taller->nombre }}</span>
                                    <span class="px-3 py-1 bg-indigo-100 text-indigo-700 rounded-full text-sm font-semibold">{{ $taller->inscripciones_count }} inscripciones</span>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>

                <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-200">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Instructores Activos</h2>
                    @if($instructoresActivos->isEmpty())
                        <p class="text-gray-600">No hay instructores activos para mostrar.</p>
                    @else
                        <ul class="divide-y divide-gray-200">
                            @foreach($instructoresActivos as $instructor)
                                <li class="py-3 flex justify-between items-center">
                                    <span class="text-gray-700 font-medium">{{ $instructor->nombre }}</span>
                                    <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm font-semibold">{{ $instructor->talleres_count }} talleres</span>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
            
            <footer class="mt-10 text-center text-gray-600 text-sm">
                <p>&copy; {{ date('Y') }} Tu Empresa/Proyecto. Todos los derechos reservados.</p>
            </footer>

        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const successAlert = document.querySelector('.bg-green-100 .absolute');
            if (successAlert) {
                successAlert.addEventListener('click', function() {
                    this.closest('.bg-green-100').remove();
                });
            }
        });
    </script>
</body>
</html>