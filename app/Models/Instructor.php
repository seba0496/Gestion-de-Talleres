<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instructor extends Model
{
    use HasFactory;

    protected $table = 'instructores';

    protected $fillable = [
        'nombre',
        'email',
        'biografia',
        'usuario_id',
    ];

    /**
     * Relación: Un instructor pertenece a un usuario (uno a uno inversa).
     */
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    /**
     * Relación: Un instructor imparte muchos talleres (uno a muchos).
     */
    public function talleres()
    {
        return $this->hasMany(Taller::class, 'instructor_id');
    }
}
