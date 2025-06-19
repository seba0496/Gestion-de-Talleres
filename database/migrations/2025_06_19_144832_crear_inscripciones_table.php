<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('inscripciones', function (Blueprint $table) {
            $table->id();
            // Clave foránea para el usuario que se inscribe (estudiante)
            $table->foreignId('usuario_id')
                  ->constrained('usuarios')
                  ->onDelete('cascade'); // Si el usuario se elimina, sus inscripciones también
            // Clave foránea para el taller
            $table->foreignId('taller_id')
                  ->constrained('talleres')
                  ->onDelete('cascade'); // Si el taller se elimina, sus inscripciones también

            $table->dateTime('fecha_inscripcion')->useCurrent(); // Usar la fecha y hora actual por defecto
            $table->enum('estado', ['pendiente', 'confirmada', 'cancelada'])->default('pendiente');
            $table->timestamps();

            // Esto asegura que un mismo usuario solo pueda inscribirse una vez en un taller específico
            $table->unique(['usuario_id', 'taller_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inscripciones');
    }
};
