<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Taller; // Necesitas el modelo Taller
use App\Models\Usuario; // Necesitas el modelo Usuario
use App\Models\Inscripcion; // Necesitas el modelo Inscripcion (si lo usas para estadísticas)
use App\Models\Instructor; // Necesitas el modelo Instructor

class DashboardController extends Controller
{
    public function index()
    {
        // Obtener datos del backend para mostrar en el dashboard
        $totalTalleres = Taller::count();
        $totalUsuarios = Usuario::count();
        $totalInscripciones = Inscripcion::count(); // Si tienes un modelo Inscripcion
        $totalInstructores = Instructor::count();

        // Talleres más populares (ejemplo: con más inscripciones)
        // Asegúrate de que tu modelo Taller tenga la relación 'inscripciones' definida
        $talleresPopulares = Taller::withCount('inscripciones')
                                    ->orderByDesc('inscripciones_count')
                                    ->take(5)
                                    ->get();

        // Instructores con más talleres
        $instructoresActivos = Instructor::has('talleres') // Solo instructores que tienen talleres
                                        ->withCount('talleres')
                                        ->orderByDesc('talleres_count')
                                        ->take(5)
                                        ->get();


        // Puedes pasar todos estos datos a la vista
        return view('dashboard.index', compact(
            'totalTalleres',
            'totalUsuarios',
            'totalInscripciones',
            'totalInstructores',
            'talleresPopulares',
            'instructoresActivos'
        ));
    }
}
