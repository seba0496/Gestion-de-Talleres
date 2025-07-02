<?php
namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Taller;

class TallerLista extends Component
{
    public $talleres;
    protected $listeners = ['tallerCreado' => 'actualizarTalleres'];

    public function mount()
    {
        $this->actualizarTalleres();
    }

    public function actualizarTalleres()
    {
        $this->talleres = Taller::with('instructor')->get();
    }

    public function eliminar($id)
    {
        $taller = Taller::findOrFail($id);
        $taller->delete();
        $this->actualizarTalleres();
        session()->flash('success', 'Taller eliminado exitosamente.');
    }

    public function render()
    {
        return view('livewire.taller-lista');
    }
}
