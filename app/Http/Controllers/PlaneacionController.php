<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PlaneacionInfo;
use App\Models\PlaneacionDocumento;
use Illuminate\Support\Facades\Storage;

class PlaneacionController extends Controller
{
    public function index()
    {
        $info = PlaneacionInfo::firstOrCreate([], [
            'descripcion' => 'El Plan Estatal de Desarrollo (PED) es un documento rector...'
        ]);

        $documentos = PlaneacionDocumento::latest()->get();

        return view('planeacion', compact('info', 'documentos'));
    }

    public function updateInfo(Request $request)
    {
        $info = PlaneacionInfo::first();
        $info->descripcion = $request->descripcion;
        $info->save();

        return back()->with('success', 'Texto introductorio actualizado.');
    }

    public function storeDocumento(Request $request)
    {
        $request->validate([
            'titulo' => 'required',
            'portada' => 'nullable|image',
            'archivo' => 'nullable|file|mimes:pdf'
        ]);

        $doc = new PlaneacionDocumento();
        $doc->titulo = $request->titulo;

        // 1. Guardar la imagen (Portada) en la carpeta public/image/planeacion
        if ($request->hasFile('portada')) {
            $nombrePortada = time() . '_portada_' . $request->portada->getClientOriginalName();
            $request->portada->move(public_path('image/planeacion'), $nombrePortada);
            $doc->portada = $nombrePortada;
        }

        // 2. Guardar el PDF en la bóveda secreta storage/app/public/documentos
        if ($request->hasFile('archivo')) {
            $file = $request->file('archivo');
            $nombreArchivo = time() . '_pdf_' . str_replace(' ', '_', $file->getClientOriginalName());
            $file->storeAs('public/documentos', $nombreArchivo);
            $doc->archivo = $nombreArchivo;
        }

        $doc->save();
        return back()->with('success', 'Documento de planeación agregado con éxito.');
    }

    public function destroyDocumento($id)
    {
        $doc = PlaneacionDocumento::findOrFail($id);
        
        // Borrar portada física
        if ($doc->portada && file_exists(public_path('image/planeacion/' . $doc->portada))) {
            unlink(public_path('image/planeacion/' . $doc->portada));
        }
        
        // Borrar PDF físico
        if ($doc->archivo && Storage::exists('public/documentos/' . $doc->archivo)) {
            Storage::delete('public/documentos/' . $doc->archivo);
        }

        $doc->delete();
        return back()->with('success', 'Documento eliminado.');
    }
}