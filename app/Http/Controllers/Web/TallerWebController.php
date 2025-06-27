<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http; // Importar el cliente HTTP
use Illuminate\Support\Facades\Auth; // Para acceder al usuario autenticado

class TallerWebController extends Controller
{
    // Define la URL base de tu API
    protected $apiBaseUrl;

    public function __construct()
    {
        // Asegúrate de que APP_URL en tu .env esté configurado correctamente,
        // por ejemplo: APP_URL=http://localhost:8000
        $this->apiBaseUrl = config('app.url') . '/api';
    }

    private function getApiToken()
    {
        // Obtener el token de Sanctum guardado en la sesión
        return session('api_token');
    }

    public function index()
    {
        $token = $this->getApiToken();

        if (!$token) {
            // Manejar caso donde no hay token (ej. redirigir a login o mostrar error)
            return redirect()->route('login')->with('error', 'Token de API no disponible. Por favor, inicia sesión de nuevo.');
        }

        try {
            // Hacer la petición GET a tu API de talleres
            $response = Http::withToken($token)->get("{$this->apiBaseUrl}/talleres");

            // Verificar si la petición fue exitosa (código 2xx)
            if ($response->successful()) {
                $talleres = $response->json(); // Obtener los datos como array asociativo
            } else {
                // Manejar errores de la API (ej. 401 Unauthorized, 404 Not Found, 500 Server Error)
                // dd($response->status(), $response->body()); // Para depurar
                $talleres = []; // O manejar de otra forma el error
                session()->flash('error', 'No se pudieron cargar los talleres: ' . $response->json('message', 'Error desconocido.'));
            }
        } catch (\Exception $e) {
            // Manejar errores de conexión de red
            session()->flash('error', 'Error de conexión con la API de talleres: ' . $e->getMessage());
            $talleres = [];
        }

        return view('talleres.index', compact('talleres'));
    }

    public function create()
    {
        $token = $this->getApiToken();
        if (!$token) { /* ...manejar sin token... */ }

        try {
            // Obtener la lista de instructores desde la API para el dropdown
            $response = Http::withToken($token)->get("{$this->apiBaseUrl}/instructores");
            if ($response->successful()) {
                $instructores = $response->json();
            } else {
                $instructores = [];
                session()->flash('error', 'No se pudieron cargar los instructores para el formulario.');
            }
        } catch (\Exception $e) {
            session()->flash('error', 'Error de conexión al cargar instructores: ' . $e->getMessage());
            $instructores = [];
        }

        return view('talleres.create', compact('instructores'));
    }

    // Para el método store, tendrías que enviar una petición POST a la API
    // Para el método edit, tendrías que hacer un GET a la API para el taller específico y los instructores
    // Para el método show, similar al edit
    // ...

    // Ejemplo de cómo manejar la lógica de envío de formularios con el cliente HTTP de Laravel
    public function store(Request $request)
    {
        $token = $this->getApiToken();
        if (!$token) { /* ...manejar sin token... */ }

        try {
            $response = Http::withToken($token)->post("{$this->apiBaseUrl}/talleres", $request->all());

            if ($response->successful()) {
                return redirect()->route('talleres.index')->with('success', 'Taller creado exitosamente desde la API.');
            } else {
                // Si hay errores de validación (422), los reenvías a la vista
                if ($response->status() === 422) {
                    return redirect()->back()->withErrors($response->json('errors'))->withInput();
                }
                session()->flash('error', 'Error al crear taller: ' . $response->json('message', 'Error desconocido.'));
                return redirect()->back()->withInput();
            }
        } catch (\Exception $e) {
            session()->flash('error', 'Error de conexión al crear taller: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    // Ejemplo para DELETE (si lo hicieras desde el controlador web en lugar de AJAX directo)
    // public function destroy(Taller $taller) // Esto ya no es Route Model Binding con la API
    public function destroy($id)
    {
        $token = $this->getApiToken();
        if (!$token) { /* ...manejar sin token... */ }

        try {
            $response = Http::withToken($token)->delete("{$this->apiBaseUrl}/talleres/{$id}");

            if ($response->successful() || $response->status() === 204) {
                return redirect()->route('talleres.index')->with('success', 'Taller eliminado exitosamente desde la API.');
            } else if ($response->status() === 409) {
                return redirect()->back()->with('error', $response->json('message', 'No se puede eliminar el taller por conflictos.'));
            } else {
                session()->flash('error', 'Error al eliminar taller: ' . $response->json('message', 'Error desconocido.'));
                return redirect()->back();
            }
        } catch (\Exception $e) {
            session()->flash('error', 'Error de conexión al eliminar taller: ' . $e->getMessage());
            return redirect()->back();
        }
    }
}
