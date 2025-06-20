<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UsuarioController;
use App\Http\Controllers\Api\InstructorController;
use App\Http\Controllers\Api\TallerController;
use App\Http\Controllers\Api\InscripcionController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Rutas API para tus recursos
Route::apiResource('usuarios', UsuarioController::class);
Route::apiResource('instructores', InstructorController::class);
Route::apiResource('talleres', TallerController::class);
Route::apiResource('inscripciones', InscripcionController::class);
