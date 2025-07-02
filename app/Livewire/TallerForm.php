<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Taller;
use App\Models\Instructor;

class TallerForm extends Component
{
    public $nombre;
    public $descripcion;
    public $cupo_maximo;
    public $instructor_id;

    protected $rules = [
        'nombre' => 'required|string|max:255',
        'descripcion' => 'required|string',
        'cupo_maximo' => 'required|integer|min:1',
        'instructor_id' => 'required|exists:instructores,id',
    ];

    public function submit()
    {
        $this->validate();
        Taller::create([
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'cupo_maximo' => $this->cupo_maximo,
            'instructor_id' => $this->instructor_id,
        ]);
        $this->reset(['nombre', 'descripcion', 'cupo_maximo', 'instructor_id']);
        $this->dispatch('tallerCreado');
        session()->flash('success', 'Taller creado exitosamente.');
    }

    public function render()
    {
        $instructores = Instructor::all();
        return view('livewire.taller-form', compact('instructores'));
    }
}
