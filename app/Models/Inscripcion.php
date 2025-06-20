<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inscripcion extends Model
{
    use HasFactory;

    protected $table = 'inscripciones';

    protected $fillable = [
        'usuario_id',
        'taller_id',
        'fecha_inscripcion',
        'estado',
    ];

    // Cast de la fecha de inscripción a tipo DateTime
    protected $casts = [
        'fecha_inscripcion' => 'datetime',
    ];

    /**
     * Relación: Una inscripción pertenece a un usuario (muchos a uno).
     */
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    /**
     * Relación: Una inscripción pertenece a un taller (muchos a uno).
     */
    public function taller()
    {
        return $this->belongsTo(Taller::class, 'taller_id');
    }
}
