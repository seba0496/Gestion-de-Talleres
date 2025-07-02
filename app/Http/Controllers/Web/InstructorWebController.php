<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Instructor;
use App\Models\Usuario;

class InstructorWebController extends Controller
{
    public function index()
    {
        $instructores = Instructor::all();
        $usuarios = Usuario::where('rol', 'instructor')->get();
        return view('instructores.index', compact('instructores', 'usuarios'));
    }

    public function create()
    {
        return view('instructores.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'especialidad' => 'nullable|string|max:255',
            'usuario_id' => 'required|exists:usuarios,id',
        ]);
        Instructor::create($validated);
        return redirect()->route('instructores.index')->with('success', 'Instructor creado exitosamente.');
    }

    public function destroy($id)
    {
        $instructor = Instructor::findOrFail($id);
        $instructor->delete();
        return redirect()->route('instructores.index')->with('success', 'Instructor eliminado exitosamente.');
    }
}
