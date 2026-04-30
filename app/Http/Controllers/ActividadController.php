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
        // 1. Agregamos 'contenido' a las validaciones
        $request->validate([
            'titulo' => 'required',
            'contenido' => 'required', // <-- NUEVO: Exigimos que traiga texto
            'imagen' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $actividad = new Actividad();
        $actividad->titulo = $request->titulo;
        $actividad->contenido = $request->contenido; // <-- NUEVO: Lo guardamos en la base de datos

        if ($request->hasFile('imagen')) {
            $nombreImagen = time().'.'.$request->imagen->extension();
            // Guardas la imagen en la carpeta public/image/actividades
            $request->imagen->move(public_path('image/actividades'), $nombreImagen);
            $actividad->imagen = $nombreImagen;
        }

        $actividad->save();
        return back()->with('success', 'Actividad actualizada con éxito');
    }

    // NUEVO MÉTODO: Eliminar noticia e imagen
    public function destroy($id)
    {
        $actividad = Actividad::find($id);

        if ($actividad) {
            // 1. Verificamos si tiene una imagen guardada
            if ($actividad->imagen) {
                // Buscamos la ruta exacta donde la guardaste
                $rutaImagen = public_path('image/actividades/' . $actividad->imagen);
                
                // Si el archivo existe físicamente, lo destruimos
                if (file_exists($rutaImagen) && is_file($rutaImagen)) {
                    unlink($rutaImagen);
                }
            }

            // 2. Eliminamos el registro de la base de datos
            $actividad->delete();
        }

        return back()->with('success', 'Actividad eliminada correctamente.');
    }
}