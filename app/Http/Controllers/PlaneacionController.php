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
        // Asegura que exista el registro base para evitar errores en la vista
        $info = PlaneacionInfo::firstOrCreate([], [
            'descripcion' => 'El Plan Estatal de Desarrollo (PED) es un documento rector...'
        ]);

        $documentos = PlaneacionDocumento::latest()->get();

        return view('planeacion', compact('info', 'documentos'));
    }

    public function updateInfo(Request $request) {
        $request->validate([
            'descripcion' => 'required|string'
        ]);

        $info = PlaneacionInfo::first();
        $info->descripcion = $request->descripcion;
        $info->save();

        return redirect()->back()->with('success', 'Información actualizada correctamente');
    }

    public function storeDocumento(Request $request)
    {
        $request->validate([
            'titulo' => 'required|max:255',
            'portada' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Limitar a 2MB
            'archivo' => 'nullable|file|mimes:pdf|max:10240' // Limitar a 10MB
        ]);

        $doc = new PlaneacionDocumento();
        $doc->titulo = $request->titulo;

        // 1. Guardar Portada (Acceso público directo)
        if ($request->hasFile('portada')) {
            $nombrePortada = time() . '_portada_' . bin2hex(random_bytes(4)) . '.' . $request->portada->getClientOriginalExtension();
            $request->portada->move(public_path('image/planeacion'), $nombrePortada);
            $doc->portada = $nombrePortada;
        }

        // 2. Guardar PDF (Storage Link)
        if ($request->hasFile('archivo')) {
            $file = $request->file('archivo');
            // Limpiamos el nombre de caracteres especiales
            $nombreArchivo = time() . '_pdf_' . preg_replace('/[^A-Za-z0-9\-._]/', '', $file->getClientOriginalName());
            $file->storeAs('public/documentos', $nombreArchivo);
            $doc->archivo = $nombreArchivo;
        }

        $doc->save();
        return back()->with('success', 'Documento de planeación agregado con éxito.');
    }

    public function destroyDocumento($id)
    {
        $doc = PlaneacionDocumento::findOrFail($id);
        
        // Borrar imagen física
        $rutaPortada = public_path('image/planeacion/' . $doc->portada);
        if ($doc->portada && file_exists($rutaPortada)) {
            unlink($rutaPortada);
        }
        
        // Borrar PDF físico del storage
        if ($doc->archivo && Storage::exists('public/documentos/' . $doc->archivo)) {
            Storage::delete('public/documentos/' . $doc->archivo);
        }

        $doc->delete();
        return back()->with('success', 'Documento eliminado.');
    }
}