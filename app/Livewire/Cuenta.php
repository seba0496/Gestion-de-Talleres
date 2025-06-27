<?php

namespace App\Livewire;

use Livewire\Component;// Asegúrate de importar el modelo User
use Illuminate\Support\Facades\Auth; // Importa la fachada Auth
use App\Models\Usuario;
class Cuenta extends Component
{
    public $user; // Declara una propiedad pública para almacenar los datos del usuario

    public function mount()
    {
        // El método mount se ejecuta una vez cuando el componente es inicializado
        // Obtiene el usuario autenticado
        $this->user = Auth::user();

        // Si quieres cargar un usuario específico por ID, por ejemplo:
        // $this->user = User::find(1);
    }

    public function render()
    {
        return view('livewire.cuenta');
    }
}
