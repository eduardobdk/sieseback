<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Documento;
use Illuminate\Support\Facades\Storage;

class DocumentoController extends Controller
{
    // Función para subir un nuevo archivo
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required',
            'seccion' => 'required',
            'archivo' => 'required|file|max:10240', // Máximo 10MB
        ]);

        $documento = new Documento();
        $documento->titulo = $request->titulo;
        $documento->seccion = $request->seccion;

        // Lógica para guardar el archivo
        if ($request->hasFile('archivo')) {
            $file = $request->file('archivo');
            $extension = $file->getClientOriginalExtension();
            
            // Creamos un nombre único: tiempo_nombreoriginal.pdf
            $nombreArchivo = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
            
            // Lo guardamos en la bóveda (storage/app/public/documentos)
            $file->storeAs('public/documentos', $nombreArchivo);

            $documento->archivo = $nombreArchivo;
            $documento->extension = strtolower($extension);
        }

        $documento->save();

        return back()->with('success', 'Documento subido correctamente a la sección: ' . $request->seccion);
    }

    // Función para eliminar un archivo
    public function destroy($id)
    {
        $documento = Documento::findOrFail($id);
        
        // Borramos el archivo físico del disco duro
        if (Storage::exists('public/documentos/' . $documento->archivo)) {
            Storage::delete('public/documentos/' . $documento->archivo);
        }
        
        // Borramos el registro de la base de datos
        $documento->delete();

        return back()->with('success', 'Documento eliminado correctamente.');
    }
}