<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Taller;
use App\Models\Instructor;
use App\Models\Usuario;
use App\Models\Inscripcion;

class ListarTalleres extends Component
{
    public function render()
    {
        // Talleres más populares: los que tienen más inscripciones
        $talleresPopulares = Taller::withCount('inscripciones')
            ->orderByDesc('inscripciones_count')
            ->take(5)
            ->get();

        // Instructores activos: los que tienen más talleres
        $instructoresActivos = Instructor::withCount('talleres')
            ->orderByDesc('talleres_count')
            ->take(5)
            ->get();

        return view('livewire.listar-talleres', [
            'talleres' => Taller::with('instructor')->get(),
            'totalTalleres' => Taller::count(),
            'totalUsuarios' => Usuario::count(),
            'totalInscripciones' => Inscripcion::count(),
            'totalInstructores' => Instructor::count(),
            'talleresPopulares' => $talleresPopulares,
            'instructoresActivos' => $instructoresActivos,
        ]);
    }
}
