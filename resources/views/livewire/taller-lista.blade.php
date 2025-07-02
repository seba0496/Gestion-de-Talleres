<div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4">Lista de Talleres</h2>
    <div class="overflow-x-auto">
        <table class="min-w-full border">
            <thead>
                <tr class="bg-gray-100">
                    <th class="py-2 px-4 border">Nombre</th>
                    <th class="py-2 px-4 border">Descripción</th>
                    <th class="py-2 px-4 border">Instructor</th>
                    <th class="py-2 px-4 border">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($talleres as $taller)
                    <tr>
                        <td class="py-2 px-4 border">{{ $taller->nombre }}</td>
                        <td class="py-2 px-4 border">{{ $taller->descripcion }}</td>
                        <td class="py-2 px-4 border">{{ $taller->instructor->nombre ?? '-' }}</td>
                        <td class="py-2 px-4 border">
                            <button wire:click="eliminar({{ $taller->id }})" class="text-red-600 hover:underline" onclick="return confirm('¿Eliminar este taller?')">Eliminar</button>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="text-center py-4">No hay talleres registrados.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if (session()->has('success'))
        <div class="fixed bottom-4 right-4 bg-green-600 text-white px-6 py-3 rounded shadow-lg z-50 animate-bounce">
            {{ session('success') }}
        </div>
    @endif
</div>
