<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SeguimientoInfo;
use App\Models\Documento; // El Gestor Universal

class SeguimientoController extends Controller
{
    public function index()
    {
        // 1. Traer la descripción (o crearla por defecto)
        $info = SeguimientoInfo::firstOrCreate([], [
            'descripcion' => 'Proceso que comprende la recopilación y análisis de datos...'
        ]);

        // 2. Traer los registros de seguimiento (PDFs o Links)
        $registros = Documento::where('seccion', 'seguimiento')->latest()->get();

        return view('seguimiento', compact('info', 'registros'));
    }

    public function updateInfo(Request $request)
    {
        $info = SeguimientoInfo::first();
        $info->descripcion = $request->descripcion;
        $info->save();

        return back()->with('success', 'Descripción de seguimiento actualizada.');
    }

    // Usamos esta función para guardar ya sea un PDF o un simple Link
    public function storeRegistro(Request $request)
    {
        $request->validate([
            'titulo' => 'required',
            'tipo' => 'required|in:pdf,link',
            'archivo' => 'required_if:tipo,pdf|file|mimes:pdf',
            'url' => 'required_if:tipo,link|url'
        ]);

        $doc = new Documento();
        $doc->titulo = $request->titulo;
        $doc->seccion = 'seguimiento';

        if ($request->tipo == 'pdf') {
            $file = $request->file('archivo');
            $nombreArchivo = time() . '_seguimiento_' . str_replace(' ', '_', $file->getClientOriginalName());
            $file->storeAs('public/documentos', $nombreArchivo);
            
            $doc->archivo = $nombreArchivo;
            $doc->extension = 'pdf'; // Lo usamos para saber el icono
        } else {
            $doc->archivo = $request->url; // Si es link, guardamos la URL en la columna archivo
            $doc->extension = 'link'; // Lo usamos para saber el icono
        }

        $doc->save();
        return back()->with('success', 'Registro agregado correctamente.');
    }
}