@extends('layouts.app')
@section('title', 'Crear Taller')
@section('content')
    <div class="max-w-2xl mx-auto bg-white p-6 rounded shadow mb-8">
        <h2 class="text-xl font-bold mb-4">Agregar Taller</h2>
        <form method="POST" action="{{ route('talleres.store') }}" class="space-y-4">
            @csrf
            <div>
                <label class="block font-medium mb-1">Nombre del Taller</label>
                <input type="text" name="nombre" value="{{ old('nombre') }}" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring" required>
                @error('nombre') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block font-medium mb-1">Descripción</label>
                <textarea name="descripcion" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring">{{ old('descripcion') }}</textarea>
                @error('descripcion') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block font-medium mb-1">Instructor</label>
                <select name="instructor_id" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring" required>
                    <option value="">Seleccione un instructor</option>
                    @foreach($instructores as $instructor)
                        <option value="{{ $instructor->id }}" @selected(old('instructor_id') == $instructor->id)>{{ $instructor->nombre }}</option>
                    @endforeach
                </select>
                @error('instructor_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Agregar Taller</button>
        </form>
    </div>
    <div class="mt-8">
        @livewire('listar-talleres')
    </div>
@endsection
