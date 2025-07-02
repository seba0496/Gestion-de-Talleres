<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Usuario; // Asegúrate de que este modelo existe y es correcto
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Muestra el formulario de inicio de sesión.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login'); // Asegúrate de que tienes una vista en 'resources/views/auth/login.blade.php'
    }

    /**
     * Muestra el formulario de registro.
     *
     * @return \Illuminate\View\View
     */
    public function showRegisterForm()
    {
        return view('auth.register'); // Asegúrate de que tienes una vista en 'resources/views/auth/register.blade.php'
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required', 

        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // REDIRECCIÓN AL DASHBOARD
            return redirect()->intended(route('dashboard')); // Usamos la ruta nombrada 'dashboard'
        }

        throw ValidationException::withMessages([
            'email' => ['Las credenciales proporcionadas son incorrectas.'],
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/'); // Redirige a la página de inicio o a donde desees después del logout
    }

    public function register(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:usuarios',
             // 'unique:usuarios' asume tu tabla de usuarios se llama 'usuarios'
            'password' => 'required|string|min:8|confirmed',
            'rol' => ['required', 'string', 'in:administrador,instructor,estudiante'],
        ]);

        $usuario = Usuario::create([
            'nombre' => $request->nombre,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'rol' => $request->rol,
        ]);

        Auth::login($usuario);

        // REDIRECCIÓN AL DASHBOARD DESPUÉS DEL REGISTRO
        return redirect(route('dashboard'))->with('success', '¡Registro exitoso!');
    }
}
