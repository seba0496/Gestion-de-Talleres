
<div class="p-8 bg-gray-50 min-h-screen">
    {{-- Encabezado Principal del Dashboard --}}
    <header class="flex items-center justify-between pb-6 border-b border-gray-200 mb-8">
        <h1 class="text-4xl font-extrabold text-gray-900">Gestión de Talleres</h1>
        <div class="flex items-center space-x-4">
            <span class="text-lg font-medium text-gray-700">Hola, {{ Auth::user()->nombre ?? 'Administrador' }}!</span>
            <img class="h-10 w-10 rounded-full object-cover border-2 border-indigo-400 shadow" src="https://via.placeholder.com/150/5B21B6/FFFFFF?text=AD" alt="Avatar">
        </div>
    </header>

    {{-- Mensajes flash (ej. taller creado exitosamente) --}}
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative mb-6 shadow-md" role="alert">
            <strong class="font-bold">¡Éxito!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3 cursor-pointer" onclick="this.closest('.bg-green-100').remove();">
                <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.103l-2.651 3.746a1.2 1.2 0 1 1-1.697-1.697l3.746-2.651-3.746-2.651a1.2 1.2 0 1 1 1.697-1.697l2.651 3.746 2.651-3.746a1.2 1.2 0 0 1 1.697 1.697l-3.746 2.651 3.746 2.651a1.2 1.2 0 0 1 0 1.697z"/></svg>
            </span>
        </div>
    @endif

    {{-- Sección de Métricas para Talleres (Ahora con 1 columna en todas las pantallas) --}}
    <div class="grid grid-cols-1 gap-6 mb-10 max-w-lg mx-auto"> {{-- Añadido max-w-lg mx-auto para centrar la tarjeta --}}
        {{-- Tarjeta: Total de Talleres --}}
        <div class="bg-gradient-to-br from-indigo-600 to-purple-700 p-6 rounded-2xl shadow-xl transform hover:scale-105 transition duration-300 ease-in-out flex items-center justify-between">
            <div>
                <p class="text-white text-lg font-semibold opacity-90 mb-1">Total de Talleres</p>
                <p class="text-6xl font-extrabold text-white leading-tight">{{ $totalTalleres }}</p>
            </div>
            <svg class="h-20 w-20 text-indigo-300 opacity-30" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
            </svg>
        </div>
    </div>

    {{-- Sección de Talleres Más Populares (Tabla) --}}
    <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-200 mb-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Talleres Más Populares</h2>
        @if($talleresPopulares->isEmpty())
            <p class="text-gray-600 text-center py-4">No hay talleres populares para mostrar en este momento.</p>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Taller
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Instructor
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Inscripciones
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Capacidad
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($talleresPopulares as $taller)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $taller->nombre }}</div>
                                    <div class="text-sm text-gray-500">{{ Str::limit($taller->descripcion, 50) }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                    {{ $taller->instructor->nombre ?? 'N/A' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 font-semibold">
                                    {{ $taller->inscripciones_count }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                    {{ $taller->capacidad_maxima }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    {{-- Botones de Acción Globales para Talleres --}}
    <div class="mt-8 flex justify-center space-x-4">
        <a href="{{ route('talleres.create') }}" class="inline-flex items-center px-8 py-3 border border-transparent text-base font-medium rounded-full shadow-lg text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-300 ease-in-out">
            <svg class="-ml-1 mr-3 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
            </svg>
            Crear Nuevo Taller
        </a>
        <a href="{{ route('talleres.index') }}" class="inline-flex items-center px-8 py-3 border border-gray-300 text-base font-medium rounded-full text-gray-700 bg-white hover:bg-gray-50 shadow-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-300 ease-in-out">
             <svg class="-ml-1 mr-3 h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7z" />
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0V8a1 1 0 112 0v6zm3-1a1 1 0 100-2v-2a1 1 0 100 2v2z" clip-rule="evenodd" />
            </svg>
            Ver Todos los Talleres
        </a>
    </div>

    {{-- Pie de página --}}
    <footer class="mt-12 text-center text-gray-500 text-sm border-t border-gray-200 pt-6">
        <p>&copy; {{ date('Y') }} Tu Empresa/Proyecto. Todos los derechos reservados.</p>
    </footer>
</div