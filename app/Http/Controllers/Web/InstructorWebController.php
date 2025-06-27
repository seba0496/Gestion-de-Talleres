<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

class InstructorWebController extends Controller
{
    protected $apiBaseUrl;

    public function __construct()
    {
        $this->apiBaseUrl = config('app.url') . '/api';
    }

    private function getApiToken()
    {
        return session('api_token');
    }

    public function index()
    {
        $token = $this->getApiToken();
        if (!$token) { /* ...manejar sin token... */ }

        try {
            $response = Http::withToken($token)->get("{$this->apiBaseUrl}/instructores");
            if ($response->successful()) {
                $instructores = $response->json();
            } else {
                $instructores = [];
                session()->flash('error', 'No se pudieron cargar los instructores: ' . $response->json('message', 'Error desconocido.'));
            }
        } catch (\Exception $e) {
            session()->flash('error', 'Error de conexión con la API de instructores: ' . $e->getMessage());
            $instructores = [];
        }

        return view('instructores.index', compact('instructores'));
    }

    public function create()
    {
        return view('instructores.create');
    }
    // ... store, edit, update, show, destroy para instructores también harían peticiones a la API
}
