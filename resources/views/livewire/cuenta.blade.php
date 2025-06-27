 {{-- resources/views/livewire/cuenta.blade.php --}}
    {{-- Esta vista es para el componente Livewire y DEBE tener solo un elemento raíz. --}}
    {{-- NO debe usar @extends ni @section aquí. --}}

    <div class="min-h-screen bg-gray-100 flex items-center justify-center p-4 sm:p-6 lg:p-8">
        <div class="bg-white shadow-xl rounded-lg p-6 sm:p-8 md:p-10 w-full max-w-2xl transform transition-all duration-300 hover:scale-[1.01]">
            <div class="flex items-center justify-between mb-6">
                <h1 class="text-3xl font-extrabold text-gray-900 leading-tight">Mi Cuenta</h1>
                {{-- Puedes añadir un icono de perfil aquí si lo deseas (Ejemplo con un SVG básico) --}}
                <svg class="h-10 w-10 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>

            <div class="space-y-4">
                @if ($user) {{-- Verifica si hay un usuario cargado desde el componente Livewire --}}
                    <div class="bg-indigo-50 p-4 rounded-md shadow-sm border border-indigo-100">
                        <p class="text-gray-700 mb-2">
                            <strong class="font-semibold text-indigo-800">Nombre:</strong> <span class="text-gray-900">{{ $user->nombre ?? 'N/A' }}</span> {{-- Usamos ?? 'N/A' como fallback --}}
                        </p>
                        <p class="text-gray-700 mb-2">
                            <strong class="font-semibold text-indigo-800">Email:</strong> <span class="text-gray-900">{{ $user->email }}</span>
                        </p>
                        <p class="text-gray-700">
                            <strong class="font-semibold text-indigo-800">ID de Usuario:</strong> <span class="text-gray-900">{{ $user->id }}</span>
                        </p>
                        {{-- Si tu tabla 'users' tiene un campo 'direccion', por ejemplo: --}}
                        {{-- <p class="text-gray-700"><strong class="font-semibold text-indigo-800">Dirección:</strong> <span class="text-gray-900">{{ $user->direccion }}</span></p> --}}
                    </div>

                    {{-- Opcional: Sección para acciones o edición --}}
                    <div class="mt-8 pt-6 border-t border-gray-200 flex justify-end">
                        <button class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-full shadow-lg transition duration-200 ease-in-out transform hover:-translate-y-1">
                            Editar Perfil
                        </button>
                    </div>

                @else
                    {{-- Mensaje de alerta si el usuario no está autenticado o no se encontró --}}
                    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <strong class="font-bold">¡Lo siento!</strong>
                        <span class="block sm:inline">No se ha encontrado información de usuario. Por favor, intenta iniciar sesión de nuevo.</span>
                    </div>
                @endif
            </div>
        </div>
    </div>
