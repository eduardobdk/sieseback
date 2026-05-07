<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CopladeBienvenida;
use App\Models\CopladeSesion;

class CopladeController extends Controller
{
    public function index()
    {
        // 1. Buscamos el texto de bienvenida. Si no existe, creamos uno por defecto.
        $bienvenida = CopladeBienvenida::first();
        if (!$bienvenida) {
            $bienvenida = CopladeBienvenida::create([
                'titulo' => '¡Bienvenidos al COPLADE!',
                'subtitulo' => '¿Qué es el COPLADE?',
                'descripcion' => 'Comité de Planeación para el Desarrollo...'
            ]);
        }

        // 2. Traemos todas las sesiones ordenadas por año (del más nuevo al más viejo)
        $sesionesPorAnio = CopladeSesion::orderBy('anio', 'desc')
                            ->orderBy('created_at', 'desc')
                            ->get()
                            ->groupBy('anio');

        return view('coplade', compact('bienvenida', 'sesionesPorAnio'));
    }

    public function updateBienvenida(Request $request)
    {
        $bienvenida = CopladeBienvenida::first();
        $bienvenida->titulo = $request->titulo;
        $bienvenida->subtitulo = $request->subtitulo;
        $bienvenida->descripcion = $request->descripcion;
        $bienvenida->save();

        return back()->with('success', 'Mensaje de bienvenida actualizado.');
    }

    public function storeSesion(Request $request)
    {
        $sesion = new CopladeSesion();
        $sesion->anio = $request->anio;
        $sesion->apartado = $request->apartado;
        $sesion->titulo = $request->titulo;
        
        // AQUÍ ESTÁ LA MAGIA: Le decimos a Laravel que guarde el texto del editor
        $sesion->detalle_sesion = $request->detalle_sesion;

        if ($request->hasFile('imagen')) {
            $nombreImagen = time() . '_' . $request->imagen->getClientOriginalName();
            $request->imagen->move(public_path('image/coplade'), $nombreImagen);
            $sesion->imagen = $nombreImagen;
        }

        $sesion->save();
        return back()->with('success', 'Sesión agregada correctamente.');
    }

    public function destroySesion($id)
    {
        $sesion = CopladeSesion::findOrFail($id);
        if ($sesion->imagen && file_exists(public_path('image/coplade/' . $sesion->imagen))) {
            unlink(public_path('image/coplade/' . $sesion->imagen));
        }
        $sesion->delete();
        return back()->with('success', 'Sesión eliminada.');
    }
}