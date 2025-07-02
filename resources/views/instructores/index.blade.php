@extends('layouts.app')
@section('title', 'Instructores')
@section('content')
<div class="max-w-2xl mx-auto mt-8">
    <div class="bg-white p-6 rounded shadow mb-8">
        <h2 class="text-xl font-bold mb-4">Agregar Instructor</h2>
        <form method="POST" action="{{ route('instructores.store') }}" class="space-y-4">
            @csrf
            <div>
                <label class="block font-medium mb-1">Nombre</label>
                <input type="text" name="nombre" value="{{ old('nombre') }}" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring" required>
                @error('nombre') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block font-medium mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring" required>
                @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block font-medium mb-1">Especialidad</label>
                <input type="text" name="especialidad" value="{{ old('especialidad') }}" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring">
                @error('especialidad') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block font-medium mb-1">Usuario</label>
                <select name="usuario_id" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring" required>
                    <option value="">Seleccione un usuario</option>
                    @foreach($usuarios as $usuario)
                    <option value="{{ $usuario->id }}">{{ $usuario->nombre }} ({{ $usuario->email }})</option>
                    @endforeach
                </select>
                @error('usuario_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Agregar Instructor</button>
        </form>
    </div>

    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-xl font-bold mb-4">Lista de Instructores</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full border">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="py-2 px-4 border">ID</th>
                        <th class="py-2 px-4 border">Nombre</th>
                        <th class="py-2 px-4 border">Email</th>
                        <th class="py-2 px-4 border">Especialidad</th>
                        <th class="py-2 px-4 border">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($instructores as $instructor)
                    <tr>
                        <td class="py-2 px-4 border">{{ $instructor->id }}</td>
                        <td class="py-2 px-4 border">{{ $instructor->nombre }}</td>
                        <td class="py-2 px-4 border">{{ $instructor->email }}</td>
                        <td class="py-2 px-4 border">{{ $instructor->especialidad }}</td>
                        <td class="py-2 px-4 border">
                            <form action="{{ route('instructores.destroy', $instructor->id) }}" method="POST" onsubmit="return confirm('¿Eliminar este instructor?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-4">No hay instructores registrados.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection