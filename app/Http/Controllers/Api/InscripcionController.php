<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Inscripcion;
use App\Models\Taller; // Necesitamos el modelo Taller para la lógica de cupos
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class InscripcionController extends Controller
{
    /**
     * Muestra una lista de todas las inscripciones.
     */
    public function index()
    {
        $inscripciones = Inscripcion::with(['usuario', 'taller'])->get();
        return response()->json($inscripciones, 200);
    }

    /**
     * Almacena una nueva inscripción.
     */
    public function store(Request $request)
    {
        $request->validate([
            'usuario_id' => 'required|exists:usuarios,id',
            'taller_id' => 'required|exists:talleres,id',
            'estado' => ['nullable', Rule::in(['pendiente', 'confirmada', 'cancelada'])],
        ]);

        // Lógica de validación de cupo
        $taller = Taller::find($request->taller_id);
        if (!$taller) {
            return response()->json(['message' => 'Taller no encontrado.'], 404);
        }

        if ($taller->inscripciones()->where('estado', 'confirmada')->count() >= $taller->cupo_maximo) {
            return response()->json(['message' => 'El taller ha alcanzado su cupo máximo.'], 409); // 409 Conflict
        }

        // Prevenir doble inscripción del mismo usuario en el mismo taller
        $existingInscription = Inscripcion::where('usuario_id', $request->usuario_id)
                                          ->where('taller_id', $request->taller_id)
                                          ->first();
        if ($existingInscription) {
            return response()->json(['message' => 'El usuario ya está inscrito en este taller.'], 409);
        }

        $inscripcion = Inscripcion::create([
            'usuario_id' => $request->usuario_id,
            'taller_id' => $request->taller_id,
            'fecha_inscripcion' => now(), // Usar la fecha actual
            'estado' => $request->estado ?? 'pendiente', // Por defecto 'pendiente'
        ]);

        return response()->json($inscripcion, 201);
    }

    /**
     * Muestra una inscripción específica.
     */
    public function show(Inscripcion $inscripcion)
    {
        $inscripcion->load('usuario', 'taller');
        return response()->json($inscripcion, 200);
    }

    /**
     * Actualiza una inscripción existente.
     */
    public function update(Request $request, Inscripcion $inscripcion)
    {
        $request->validate([
            'estado' => ['required', Rule::in(['pendiente', 'confirmada', 'cancelada'])], // El estado es lo más común a actualizar
        ]);

        $inscripcion->update($request->all());

        return response()->json($inscripcion, 200);
    }

    /**
     * Elimina una inscripción.
     */
    public function destroy(Inscripcion $inscripcion)
    {
        $inscripcion->delete();
        return response()->json(null, 204);
    }
}
