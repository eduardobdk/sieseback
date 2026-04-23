<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Actividad;
use Illuminate\Support\Facades\Storage;

class ActividadController extends Controller
{
    // Cargar la página de inicio con las noticias de la DB
    public function index() {
    $actividades = Actividad::latest()->get(); // Trae las más recientes primero
    return view('inicio', compact('actividades'));
}

    // Guardar una nueva noticia
    public function store(Request $request) {
        $request->validate([
            'titulo' => 'required',
            'imagen' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $actividad = new Actividad();
        $actividad->titulo = $request->titulo;

        if ($request->hasFile('imagen')) {
            $nombreImagen = time().'.'.$request->imagen->extension();
            $request->imagen->move(public_path('image/actividades'), $nombreImagen);
            $actividad->imagen = $nombreImagen;
        }

        $actividad->save();
        return back()->with('success', 'Actividad actualizada con éxito');
    }
}