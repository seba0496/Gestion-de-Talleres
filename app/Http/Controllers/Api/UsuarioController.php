<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UsuarioController extends Controller
{
    /**
     * Muestra una lista de todos los usuarios.
     */
    public function index()
    {
        $usuarios = Usuario::all(); // Puedes añadir paginación si hay muchos usuarios: Usuario::paginate(10);
        return response()->json($usuarios, 200);
    }

    /**
     * Almacena un nuevo usuario.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:usuarios',
            'password' => 'required|string|min:8',
            'rol' => ['required', Rule::in(['administrador', 'instructor', 'estudiante'])],
        ]);

        $usuario = Usuario::create([
            'nombre' => $request->nombre,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'rol' => $request->rol,
        ]);

        return response()->json($usuario, 201); // 201 Created
    }

    /**
     * Muestra un usuario específico.
     */
    public function show(Usuario $usuario)
    {
        return response()->json($usuario, 200);
    }

    /**
     * Actualiza un usuario existente.
     */
    public function update(Request $request, Usuario $usuario)
    {
        $request->validate([
            'nombre' => 'sometimes|string|max:255',
            'email' => ['sometimes', 'string', 'email', 'max:255', Rule::unique('usuarios')->ignore($usuario->id)],
            'password' => 'sometimes|string|min:8',
            'rol' => ['sometimes', Rule::in(['administrador', 'instructor', 'estudiante'])],
        ]);

        $usuario->fill($request->except('password')); // No sobrescribir password a menos que se cambie explícitamente

        if ($request->has('password')) {
            $usuario->password = Hash::make($request->password);
        }

        $usuario->save();

        return response()->json($usuario, 200);
    }

    /**
     * Elimina un usuario.
     */
    public function destroy(Usuario $usuario)
    {
        $usuario->delete();
        return response()->json(null, 204); // 204 No Content
    }
}
