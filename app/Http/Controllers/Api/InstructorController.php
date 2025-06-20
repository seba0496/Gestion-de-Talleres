<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Instructor;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash; // Asegúrate de importar Hash si manejas contraseña
use Illuminate\Support\Facades\Log; // Para los logs de depuración // Asegúrate de que esta línea esté descomentada si el Route Model Binding ya te funciona para show.
use App\Models\Taller;     // ¡Necesitas importar el modelo Taller para poder consultarlo!
 // Para depuración
class InstructorController extends Controller
{
    /**
     * Muestra una lista de todos los instructores.
     */
    public function index()
    {
        $instructores = Instructor::with('usuario')->get(); // Carga el usuario asociado
        return response()->json($instructores, 200);
    }

    /**
     * Almacena un nuevo instructor.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:instructores',
            'biografia' => 'nullable|string',
            'usuario_id' => 'required|exists:usuarios,id|unique:instructores,usuario_id', // Debe existir en 'usuarios' y ser único en 'instructores'
        ]);

        $instructor = Instructor::create($request->all());

        return response()->json($instructor, 201);
    }

    /**
     * Muestra un instructor específico.
     */
    public function show(Instructor $instructor)
    {
        $instructor->load('usuario', 'talleres'); // Carga el usuario y los talleres que imparte
        return response()->json($instructor, 200);
    }

    /**
     * Actualiza un instructor existente.
     */
     public function update(Request $request, $id) // CAMBIO AQUÍ: Ahora recibe $id en lugar de Instructor $instructor
    {
        // Forzamos el ID a entero por si acaso.
        $id = (int) $id;

        // Búsqueda manual del instructor, bypassando el Route Model Binding
        $instructor = \App\Models\Instructor::find($id); // O usa ->where('id', $id)->first(); si find() falla

        // Verificación si el instructor fue encontrado.
        if (!$instructor) {
            return response()->json(['message' => 'Instructor no encontrado.'], 404);
        }

        // --- Mantenemos los logs de depuración temporalmente ---
        Log::info('Método update llamado para el ID del Instructor: ' . $instructor->id);
        Log::info('Estado de existencia del Instructor: ' . ($instructor->exists ? 'true' : 'false'));
        // --- Fin de logs de depuración ---

        $request->validate([
            'nombre' => 'sometimes|string|max:255',
            'email' => ['sometimes', 'string', 'email', 'max:255', Rule::unique('instructores')->ignore($instructor->id)],
            'password' => 'sometimes|string|min:8',
            'especialidad' => 'sometimes|string|max:255',
            // ... otros campos que quieras permitir actualizar
        ]);

        $instructor->fill($request->except('password'));

        if ($request->has('password')) {
            $instructor->password = Hash::make($request->password);
        }

        $instructor->save();

        return response()->json($instructor, 200);
    }

    /**
     * Elimina un instructor.
     */
 // Si el Route Model Binding para Instructor te funciona.
    // Si el Route Model Binding NO te funciona (sigue dando "Instructor no encontrado" para destroy,
    // entonces deberías usar: public function destroy($id) y buscarlo manualmente como en el update:
 public function destroy($id) {
        $instructor = \App\Models\Instructor::find((int) $id);
        if (!$instructor) {
           return response()->json(['message' => 'Instructor no encontrado.'], 404);
        }

    {
        // 1. Contar los talleres que este instructor tiene asignados.
        $talleresAsociados = Taller::where('instructor_id', $instructor->id)->count();

        // 2. Si tiene talleres, no permitir la eliminación y retornar un error.
        if ($talleresAsociados > 0) {
            Log::warning("Intento de eliminar instructor {$instructor->id} fallido: tiene {$talleresAsociados} talleres asociados.");
            return response()->json([
                'message' => 'No se puede eliminar al instructor porque tiene ' . $talleresAsociados . ' talleres asociados. Elimine los talleres del instructor primero.'
            ], 409); // 409 Conflict - Indica un conflicto con el estado actual del recurso
        }

        // 3. Si no tiene talleres asociados, proceder con la eliminación.
        try {
            $instructor->delete();
            Log::info("Instructor {$instructor->id} eliminado exitosamente.");
            return response()->json(null, 204); // 204 No Content - Indica que la solicitud fue exitosa pero no hay contenido que devolver.
        } catch (\Exception $e) {
            Log::error("Error al eliminar instructor {$instructor->id}: " . $e->getMessage());
            return response()->json(['message' => 'Error interno al intentar eliminar el instructor.'], 500);
        }
    }
}
}
