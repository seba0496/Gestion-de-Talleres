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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id(); // Crea una columna `id` (UNSIGNED BIGINT AUTO_INCREMENT PRIMARY KEY)
            $table->string('nombre'); // Columna `nombre` (VARCHAR(255))
            $table->string('email')->unique(); // Columna `email` (VARCHAR(255)) única
            $table->timestamp('email_verified_at')->nullable(); // Para verificación de email (opcional)
            $table->string('password'); // Columna `password` (VARCHAR(255))
            // Para el rol, Laravel crea un VARCHAR(255) y valida los valores a nivel de aplicación
            $table->enum('rol', ['administrador', 'instructor', 'estudiante'])->default('estudiante');
            $table->rememberToken(); // Para "recordar mi sesión"
            $table->timestamps(); // Crea las columnas `created_at` y `updated_at` (DATETIME)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuario'); // Elimina la tabla si la migración es revertida
    }
};
