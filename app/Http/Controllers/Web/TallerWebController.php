<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Taller;
use App\Models\Instructor;

class TallerWebController extends Controller
{
   public function index()
{
    return view('talleres.index');
}

public function create()
{
    return view('talleres.create');
}

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'instructor_id' => 'required|exists:instructores,id',
        ]);
        Taller::create($validated);
        return redirect()->route('talleres.index')->with('success', 'Taller creado exitosamente.');
    }

    public function destroy($id)
    {
        $taller = Taller::findOrFail($id);
        $taller->delete();
        return redirect()->route('talleres.index')->with('success', 'Taller eliminado exitosamente.');
    }
}
