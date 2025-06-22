<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UsuarioController;
use App\Http\Controllers\Api\InstructorController;
use App\Http\Controllers\Api\TallerController;
use App\Http\Controllers\Api\InscripcionController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\Usuario;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//Ruta pública para el login
Route::post('/login', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $usuario = Usuario::where('email', $request->email)->first();

    if (!$usuario || !Hash::check($request->password, $usuario->password)) {
        throw ValidationException::withMessages([
            'email' => ['Las credenciales proporcionadas son incorrectas.'],
        ]);
    }

    // Eliminar tokens antiguos para limpiar
    $usuario->tokens()->delete();

    // Crear un nuevo token para el usuario
    // Puedes especificar las "abilities" (permisos) si los necesitas
    $token = $usuario->createToken('auth_token')->plainTextToken;

    return response()->json([
        'message' => 'Login exitoso',
        'token' => $token,
        'user' => $usuario // Opcional: retornar los datos del usuario
    ]);
});
Route::post('/register', function (Request $request) {
    $request->validate([
        'nombre' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:usuarios', // Asegurarse que el email sea único
        'password' => 'required|string|min:8|confirmed', // 'confirmed' requiere un campo password_confirmation
        'rol' => ['required', 'string', 'in:administrador,instructor,estudiante'], // Valida los roles permitidos
    ]);

    // Crear el nuevo usuario
    $usuario = Usuario::create([
        'nombre' => $request->nombre,
        'email' => $request->email,
        'password' => Hash::make($request->password), // Asegúrate de hashear la contraseña
        'rol' => $request->rol,
    ]);

    // Opcional: Generar un token para el usuario recién registrado para que inicie sesión automáticamente
    $token = $usuario->createToken('auth_token')->plainTextToken;

    return response()->json([
        'message' => 'Registro exitoso',
        'token' => $token, // Si quieres loguearlo inmediatamente
        'user' => $usuario
    ], 201); // Código 201 Created
});

// Rutas protegidas por Sanctum
Route::middleware('auth:sanctum')->group(function () {
    // Ruta para obtener el usuario autenticado
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Ruta para hacer logout (revocar el token actual)
    Route::post('/logout', function (Request $request) {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logout exitoso']);
    });
    // Rutas API para tus recursos protegidas ya con sanctum
    // para usarlo sin el middleware y crear usuarios solo deben sacar el metodo afuera del middleware


});


 Route::apiResource('instructores', InstructorController::class);
    Route::apiResource('talleres', TallerController::class);
    Route::apiResource('inscripciones', InscripcionController::class);
   Route::apiResource('usuarios', UsuarioController::class);
