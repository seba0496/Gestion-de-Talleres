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
        Schema::create('instructores', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('email')->unique();
            $table->text('especialidad')->nullable(); // `nullable()` permite que sea nulo
            // Clave foránea que referencia `id` en la tabla `users`
            $table->foreignId('usuario_id')
                  ->unique() // Un usuario puede ser instructor una sola vez
                  ->constrained('usuarios') // Referencia a la tabla 'users'
                  ->onDelete('cascade'); // Si el usuario es eliminado, el instructor también
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instructores');
    }
};
