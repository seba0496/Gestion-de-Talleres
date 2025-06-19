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
        Schema::create('talleres', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->text('descripcion')->nullable();
            $table->string('horario')->nullable();
            $table->integer('cupo_maximo');
            // `decimal` para valores monetarios: 8 dígitos en total, 2 después del punto decimal
            $table->decimal('costo', 8, 2)->default(0.00);
            // Clave foránea que referencia `id` en la tabla `instructors`
            $table->foreignId('instructor_id')
                  ->constrained('instructores') // Referencia a la tabla 'instructors'
                  ->onDelete('restrict'); // No permite borrar el instructor si tiene talleres asignados
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('talleres');
    }
};
