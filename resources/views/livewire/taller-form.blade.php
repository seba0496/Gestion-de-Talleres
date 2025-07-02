<div class="max-w-2xl mx-auto mb-8">
    @if (session()->has('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-xl font-bold mb-4">Agregar Taller</h2>
        <form wire:submit.prevent="submit" class="space-y-4">
            <div>
                <label class="block font-medium mb-1">Nombre del Taller</label>
                <input type="text" wire:model.defer="nombre" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring" required>
                @error('nombre') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block font-medium mb-1">Descripción</label>
                <textarea wire:model.defer="descripcion" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring"></textarea>
                @error('descripcion') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block font-medium mb-1">Cupo Máximo</label>
                <input type="number" wire:model.defer="cupo_maximo" min="1" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring" required>
                @error('cupo_maximo') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block font-medium mb-1">Instructor</label>
                <select wire:model.defer="instructor_id" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring" required>
                    <option value="">Seleccione un instructor</option>
                    @foreach($instructores as $instructor)
                        <option value="{{ $instructor->id }}">{{ $instructor->nombre }}</option>
                    @endforeach
                </select>
                @error('instructor_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Agregar Taller</button>
        </form>
    </div>
</div>
