<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller; // Extiende del controlador base de Laravel
use Illuminate\Http\Request;
use App\Models\Usuario; // ¡IMPORTANTE! Asegúrate de que este sea el nombre correcto de tu modelo de usuario
use Illuminate\Support\Facades\Hash; // Para encriptar contraseñas
use Illuminate\Validation\ValidationException; // Para manejar errores de validación

class UserController extends Controller
{
    /**
     * Muestra una lista de todos los usuarios.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Obtiene todos los usuarios de la base de datos
        $usuarios = Usuario::all();

        // Retorna la vista con los usuarios (cambiado de 'users.index' a 'usuarios.index')
        return view('usuarios.index', compact('usuarios'));
    }

    /**
     * Muestra el formulario para crear un nuevo usuario.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // Retorna la vista para crear usuario (cambiado de 'users.create' a 'usuarios.create')
        return view('usuarios.create');
    }

    /**
     * Almacena un nuevo usuario en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Valida los datos del formulario de creación
        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:usuarios', // 'unique:usuarios' asume tu tabla es 'usuarios'
            'password' => 'required|string|min:8|confirmed',
            'rol' => ['required', 'string', 'in:administrador,instructor,estudiante'],
        ]);

        // Crea el nuevo usuario
        Usuario::create([
            'nombre' => $request->nombre,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'rol' => $request->rol,
        ]);

        // Redirige a la lista de usuarios con un mensaje de éxito
        return redirect()->route('users.index')->with('success', 'Usuario creado exitosamente.');
    }

    /**
     * Muestra los detalles de un usuario específico.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\View\View
     */
    public function show(Usuario $usuario)
    {
        // Se inyecta automáticamente el modelo Usuario por su ID en la ruta
        // Retorna la vista para mostrar usuario (cambiado de 'users.show' a 'usuarios.show')
        return view('usuarios.show', compact('usuario'));
    }

    /**
     * Muestra el formulario para editar un usuario existente.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\View\View
     */
    public function edit(Usuario $usuario)
    {
        // Se inyecta automáticamente el modelo Usuario
        // Retorna la vista para editar usuario (cambiado de 'users.edit' a 'usuarios.edit')
        return view('usuarios.edit', compact('usuario'));
    }

    /**
     * Actualiza un usuario existente en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Usuario $usuario)
    {
        // Valida los datos del formulario de edición
        $rules = [
            'nombre' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:usuarios,email,' . $usuario->id, // Excluye el email actual del usuario
            'rol' => ['required', 'string', 'in:administrador,instructor,estudiante'],
        ];

        // Solo valida la contraseña si se ha proporcionado una nueva
        if ($request->filled('password')) {
            $rules['password'] = 'string|min:8|confirmed';
        }

        $request->validate($rules);

        // Actualiza el usuario
        $usuario->nombre = $request->nombre;
        $usuario->email = $request->email;
        $usuario->rol = $request->rol;

        if ($request->filled('password')) {
            $usuario->password = Hash::make($request->password);
        }
        $usuario->save();

        // Redirige a la lista de usuarios con un mensaje de éxito
        return redirect()->route('users.index')->with('success', 'Usuario actualizado exitosamente.');
    }

    /**
     * Elimina un usuario de la base de datos.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Usuario $usuario)
    {
        // Elimina el usuario
        $usuario->delete();

        // Redirige a la lista de usuarios con un mensaje de éxito
        return redirect()->route('users.index')->with('success', 'Usuario eliminado exitosamente.');
    }
}
