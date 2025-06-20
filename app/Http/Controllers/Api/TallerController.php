<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Taller; // Importa el modelo Taller
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
// No se necesitan importaciones adicionales para logging o excepciones específicas
// si se confía en el manejador de excepciones global de Laravel para API.

class TallerController extends Controller
{
    /**
     * Muestra una lista de todos los talleres.
     * Carga la relación 'instructor'.
     */
    public function index()
    {
        $talleres = Taller::with('instructor')->get();
        return response()->json($talleres, 200);
    }

    /**
     * Almacena un nuevo taller en la base de datos.
     * La validación se maneja automáticamente por Laravel.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'horario' => 'nullable|string|max:255',
            'cupo_maximo' => 'required|integer|min:1',
            'costo' => 'required|numeric|min:0',
            'instructor_id' => 'required|exists:instructores,id',
        ]);

        $taller = Taller::create($request->all());

        return response()->json($taller, 201); // 201 Created
    }

    /**
     * Muestra un taller específico.
     * Carga las relaciones 'instructor' y 'estudiantesInscritos'.
     */
    public function show(Taller $taller)
    {
        // Si el $taller no se encuentra por el Route Model Binding, Laravel lanzará un 404 automáticamente.
        $taller->load('instructor', 'estudiantesInscritos');
        return response()->json($taller, 200);
    }

    /**
     * Actualiza un taller existente.
     * Incluye validación y recarga del modelo.
     */
    public function update(Request $request, $id) // CAMBIO AQUÍ: Ahora recibe $id en lugar de Taller $taller
    {
        // Forzamos el ID a entero por si acaso.
        $id = (int) $id;

        // Búsqueda manual del taller, bypassando el Route Model Binding
        $taller = \App\Models\Taller::find($id); // O usa ->where('id', $id)->first(); si find() falla

        // Verificación si el taller fue encontrado.
        if (!$taller) {
            return response()->json(['message' => 'Taller no encontrado.'], 404);
        }

        // --- Mantenemos los logs de depuración temporalmente ---
        Log::info('Método update llamado para el ID del Taller: ' . $taller->id);
        Log::info('Estado de existencia del Taller: ' . ($taller->exists ? 'true' : 'false'));
        // --- Fin de logs de depuración ---

        $request->validate([
            'nombre' => 'sometimes|string|max:255',
            'descripcion' => 'nullable|string',
            'horario' => 'nullable|string|max:255',
            'cupo_maximo' => 'sometimes|integer|min:1',
            'costo' => 'sometimes|numeric|min:0',
            'instructor_id' => 'sometimes|exists:instructores,id', // Asegúrate de que Instructor exista.
        ]);

        $taller->fill($request->all()); // No hay campos especiales como contraseña aquí.

        $taller->save();

        // Puedes descomentar esta línea si quieres recargar el objeto con los datos más frescos después de guardar
        // $taller->refresh();

        return response()->json($taller, 200);
    }
    /**
     * Elimina un taller de la base de datos.
     * Incluye una verificación para inscripciones activas.
     */
    public function destroy($id) // CAMBIO AQUÍ: Ahora recibe $id en lugar de Taller $taller
    {
        // Forzamos el ID a entero por si acaso.
        $id = (int) $id;

        // Búsqueda manual del taller, bypassando el Route Model Binding
        $taller = \App\Models\Taller::find($id); // O usa ->where('id', $id)->first(); si find() falla

        // Verificación si el taller fue encontrado.
        // Si no se encuentra, Laravel debería lanzar un 404 (ModelNotFoundException) por defecto
        // cuando se usa Route Model Binding. Sin embargo, dado tu problema, esta verificación manual es clave.
        if (!$taller) {
            return response()->json(['message' => 'Taller no encontrado.'], 404);
        }

        // --- Mantenemos los logs de depuración temporalmente ---
        Log::info('Método destroy llamado para el ID del Taller: ' . $taller->id);
        Log::info('Estado de existencia del Taller: ' . ($taller->exists ? 'true' : 'false'));
        // --- Fin de logs de depuración ---

        // Verifica si el taller tiene inscripciones asociadas antes de eliminar.
        if ($taller->inscripciones()->count() > 0) {
            return response()->json([
                'message' => 'No se puede eliminar el taller porque tiene inscripciones asociadas. Elimine las inscripciones primero.'
            ], 409); // 409 Conflict
        }

        $taller->delete();

        return response()->json(null, 204); // 204 No Content
    }
}
