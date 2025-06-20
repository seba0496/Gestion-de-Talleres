<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens; // Asegúrate de tener esto si usas Sanctum

class Usuario extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    // Nombre de la tabla en la base de datos (por si no sigue la convención de pluralización en inglés)
    protected $table = 'usuarios';

    // Atributos que se pueden asignar masivamente (mass assignable)
    protected $fillable = [
        'nombre',
        'email',
        'password',
        'rol',
    ];

    // Atributos que deben ser ocultados al serializar (ej. en respuestas JSON)
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Casts de atributos a tipos nativos de PHP
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed', // Laravel 9+ automáticamente hashea
    ];

    /**
     * Relación: Un usuario puede ser un instructor (una a uno).
     */
    public function instructor()
    {
        return $this->hasOne(Instructor::class, 'usuario_id');
    }

    /**
     * Relación: Un usuario tiene muchas inscripciones (uno a muchos).
     */
    public function inscripciones()
    {
        return $this->hasMany(Inscripcion::class, 'usuario_id');
    }

    /**
     * Relación: Un usuario puede estar inscrito en muchos talleres (muchos a muchos a través de inscripciones).
     */
    public function talleresInscritos()
    {
        // El tercer argumento es el nombre de la clave foránea en la tabla pivote que se refiere a este modelo (usuario_id)
        // El cuarto argumento es el nombre de la clave foránea en la tabla pivote que se refiere al modelo relacionado (taller_id)
        return $this->belongsToMany(Taller::class, 'inscripciones', 'usuario_id', 'taller_id')
                    ->withPivot('fecha_inscripcion', 'estado') // Incluye columnas adicionales de la tabla pivote
                    ->withTimestamps(); // Si tu tabla pivote tiene created_at y updated_at
    }
}
