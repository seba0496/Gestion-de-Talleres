<?php

namespace App\Livewire;

use Livewire\Component;
// Importa los modelos necesarios
use App\Models\Taller; // Asumiendo que tienes un modelo Taller
use App\Models\Usuario;   // Asumiendo que tienes un modelo User
use App\Models\Inscripcion; // Asumiendo que tienes un modelo Inscripcion
use App\Models\Instructor; // Asumiendo que tienes un modelo Instructor
use Illuminate\Support\Facades\Log;
class Talleres extends Component
{
    // Propiedades públicas que serán accesibles en la vista Blade
    public $totalTalleres;
    public $totalUsuarios;
    public $totalInscripciones;
    public $totalInstructores;
    public $talleresPopulares;
    public $instructoresActivos;

    /**
     * El método mount se ejecuta una vez cuando el componente es inicializado.
     * Aquí cargamos los datos de la base de datos.
     */
    public function mount()
    {
        try {
            // Obtener el conteo total de talleres
            $this->totalTalleres = Taller::count();

            // Obtener el conteo total de usuarios (puedes ajustar esta lógica si tienes diferentes tipos de usuarios)
            $this->totalUsuarios = Usuario::count();

            // Obtener el conteo total de inscripciones
            $this->totalInscripciones = Inscripcion::count();

            // Obtener el conteo total de instructores
            $this->totalInstructores = Instructor::count();

            // Obtener los talleres más populares (con más inscripciones)
            // Asume que el modelo Taller tiene una relación 'inscripciones'
            $this->talleresPopulares = Taller::withCount('inscripciones')
                                           ->orderByDesc('inscripciones_count')
                                           ->take(3) // Obtener los 3 más populares
                                           ->get();

            // Obtener los instructores activos (con más talleres asignados)
            // Asume que el modelo Instructor tiene una relación 'talleres'
            $this->instructoresActivos = Instructor::withCount('talleres')
                                              ->orderByDesc('talleres_count')
                                              ->take(3) // Obtener los 3 con más talleres
                                              ->get();

        } catch (\Exception $e) {
            // Manejo de errores: Si hay un problema con la base de datos o los modelos.
            // Puedes loggear el error, mostrar un mensaje por defecto o redirigir.
             Log::error("Error al cargar datos en el componente Talleres: " . $e->getMessage());

            // Asigna valores por defecto o vacíos si ocurre un error
            $this->totalTalleres = 0;
            $this->totalUsuarios = 0;
            $this->totalInscripciones = 0;
            $this->totalInstructores = 0;
            $this->talleresPopulares = collect(); // Colección vacía
            $this->instructoresActivos = collect(); // Colección vacía

            // Opcional: Mostrar un mensaje en el frontend si estás depurando
            // session()->flash('error', 'No se pudieron cargar los datos de los talleres. Por favor, intente de nuevo más tarde.');
        }
    }

    /**
     * El método render devuelve la vista Blade que el componente Livewire debe renderizar.
     * Es crucial que esta vista (resources/views/livewire/talleres.blade.php)
     * tenga solo un elemento raíz y NO use @extends ni @section.
     */
    public function render()
    {
        return view('livewire.taller');
    }
}
