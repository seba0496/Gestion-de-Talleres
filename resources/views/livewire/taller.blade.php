{{-- NO debe usar @extends ni @section aquí. --}}

<div class="bg-white shadow-md rounded-lg p-6 max-w-4xl w-full text-center mx-auto">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Panel de Administración de Talleres</h1>

    {{-- Mostrar datos del controlador --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <div class="bg-blue-100 p-4 rounded-lg shadow-sm">
            <p class="text-lg font-semibold text-blue-800">Total Talleres:</p>
            <p class="text-2xl text-blue-900">{{ $totalTalleres }}</p>
        </div>
        <div class="bg-green-100 p-4 rounded-lg shadow-sm">
            <p class="text-lg font-semibold text-green-800">Total Usuarios:</p>
            <p class="text-2xl text-green-900">{{ $totalUsuarios }}</p>
        </div>
        <div class="bg-yellow-100 p-4 rounded-lg shadow-sm">
            <p class="text-lg font-semibold text-yellow-800">Total Inscripciones:</p>
            <p class="text-2xl text-yellow-900">{{ $totalInscripciones }}</p>
        </div>
        <div class="bg-purple-100 p-4 rounded-lg shadow-sm">
            <p class="text-lg font-semibold text-purple-800">Total Instructores:</p>
            <p class="text-2xl text-purple-900">{{ $totalInstructores }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
        <div>
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Talleres Más Populares</h2>
            @if($talleresPopulares->isEmpty())
                <p class="text-gray-600">No hay talleres populares para mostrar.</p>
            @else
                <ul class="list-disc list-inside text-left mx-auto max-w-sm">
                    @foreach($talleresPopulares as $taller)
                        <li class="text-gray-700 mb-1">{{ $taller->nombre }} ({{ $taller->inscripciones_count }} inscripciones)</li>
                    @endforeach
                </ul>
            @endif
        </div>
        <div>
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Instructores Activos</h2>
            @if($instructoresActivos->isEmpty())
                <p class="text-gray-600">No hay instructores activos para mostrar.</p>
            @else
                <ul class="list-disc list-inside text-left mx-auto max-w-sm">
                    @foreach($instructoresActivos as $instructor)
                        <li class="text-gray-700 mb-1">{{ $instructor->nombre }} ({{ $instructor->talleres_count }} talleres)</li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>

    <div class="mt-8">
        <a href="{{ route('users.index') }}" class="inline-block bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded transition duration-200 mr-4">
            Ver Usuarios
        </a>
        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
           class="inline-block bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded transition duration-200">
            Cerrar Sesión
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
</div>
