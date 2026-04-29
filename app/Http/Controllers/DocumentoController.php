<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Documento; 

class DocumentoController extends Controller
{
    /**
     * Muestra el panel de administración de FAIS (Vista Blade)
     */
    public function index()
    {
        $comunicaciones = Documento::where('seccion', 'fais_comunicaciones')
            ->orderBy('created_at', 'desc')
            ->get();

        $normatecaPorAnio = Documento::where('seccion', 'fais_normateca')
            ->get()
            ->groupBy('anio')
            ->sortKeys(); 

        return view('fais', compact('comunicaciones', 'normatecaPorAnio'));
    }

    /**
     * Método para alimentar la interfaz informativa (JSON)
     */
    public function getPorSeccion(Request $request) {
        $seccion = $request->query('seccion');
        $documentos = Documento::where('seccion', $seccion)->orderBy('created_at', 'desc')->get();
        return response()->json($documentos);
    }

    /**
     * Método UNIVERSAL para guardar (PDFs, Excels, Imágenes o URLs)
     */
    public function store(Request $request)
    {
        // 1. Quitamos la regla "mimes" estricta para dejar pasar imágenes y textos
        $request->validate([
            'titulo'    => 'required|string|max:255',
            'seccion'   => 'required',
            'archivo'   => 'required' // Puede ser un archivo físico o un texto
        ]);

        // Variables por defecto (asumiendo que es un Enlace URL)
        $nombreArchivo = $request->archivo; 
        $extension = 'url'; 

        // 2. ¿Es un archivo físico? (PDF, Excel, Imagen, etc.)
        if ($request->hasFile('archivo')) {
            $archivo = $request->file('archivo');
            // Limpiamos los espacios del nombre del archivo para evitar errores 
            $nombreArchivo = time() . '_' . preg_replace('/\s+/', '_', $archivo->getClientOriginalName());
            $archivo->storeAs('public/documentos', $nombreArchivo);
            
            $extension = $archivo->getClientOriginalExtension();
        }

        // 3. Guardamos en la Base de Datos usando tu estructura original
        Documento::create([
            'titulo'    => $request->titulo,
            'archivo'   => $nombreArchivo,
            'extension' => $extension,
            'seccion'   => $request->seccion,
            'anio'      => $request->anio,      // Conservamos tu lógica de FAIS
            'categoria' => $request->categoria, // Conservamos tu lógica de FAIS
        ]);

        return back()->with('success', 'Registro guardado correctamente.');
    }

    /**
     * Elimina el registro y el archivo (si aplica)
     */
    public function destroy($id)
    {
        $documento = Documento::find($id);
        
        if ($documento) {
            // Solo borramos de la carpeta "storage" si es un archivo físico (no una URL)
            if ($documento->extension !== 'url') {
                Storage::delete('public/documentos/' . $documento->archivo);
            }
            $documento->delete();
        }

        return back()->with('success', 'Registro eliminado exitosamente.');
    }
}