<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Taller extends Model
{
    use HasFactory;

    // Especifica el nombre de la tabla si no sigue la convención de pluralización de Eloquent
    protected $table = 'talleres';

    // Define los atributos que pueden ser asignados masivamente (mass assignable)
    protected $fillable = [
        'nombre',
        'descripcion',
        'horario',
        'cupo_maximo',
        'costo',
        'instructor_id',
    ];

    // Si tu clave primaria no se llama 'id', DESCOMENTA Y AJUSTA esta línea:
    // protected $primaryKey = 'nombre_de_tu_clave_primaria';

    // Si tu tabla NO tiene las columnas 'created_at' y 'updated_at', DESCOMENTA esta línea:
    // public $timestamps = false;


    /**
     * Relación: Un taller pertenece a un instructor (muchos a uno).
     */
    public function instructor()
    {
        return $this->belongsTo(Instructor::class, 'instructor_id');
    }

    /**
     * Relación: Un taller tiene muchas inscripciones (uno a muchos).
     */
    public function inscripciones()
    {
        return $this->hasMany(Inscripcion::class, 'taller_id');
    }

    /**
     * Relación: Un taller puede tener muchos estudiantes inscritos (muchos a muchos).
     * Se realiza a través de la tabla pivote 'inscripciones'.
     */
    public function estudiantesInscritos()
    {
        return $this->belongsToMany(Usuario::class, 'inscripciones', 'taller_id', 'usuario_id')
                    ->withPivot('fecha_inscripcion', 'estado')
                    ->withTimestamps();
    }
}
