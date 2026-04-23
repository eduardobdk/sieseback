<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Documento; // Asegúrate de tener el modelo creado

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
     * Nuevo método para alimentar la interfaz informativa (JSON)
     */
   public function getPorSeccion(Request $request) {
    $seccion = $request->query('seccion');
    $documentos = Documento::where('seccion', $seccion)->orderBy('created_at', 'desc')->get();
    return response()->json($documentos);
}
    public function store(Request $request)
    {
        $request->validate([
            'titulo'    => 'required|string|max:255',
            // He actualizado las mimes para que acepte Word y Excel como pide tu Blade
            'archivo'   => 'required|mimes:pdf,doc,docx,xls,xlsx|max:10000',
            'seccion'   => 'required'
        ]);

        if ($request->hasFile('archivo')) {
            $archivo = $request->file('archivo');
            $nombreArchivo = time() . '_' . $archivo->getClientOriginalName();
            $archivo->storeAs('public/documentos', $nombreArchivo);
            
            // Usamos el modelo para insertar, es más limpio
            Documento::create([
                'titulo'    => $request->titulo,
                'archivo'   => $nombreArchivo,
                'extension' => $archivo->getClientOriginalExtension(),
                'seccion'   => $request->seccion,
                'anio'      => $request->anio,
                'categoria' => $request->categoria,
            ]);
        }

        return back()->with('success', 'Documento guardado correctamente.');
    }

    public function destroy($id)
    {
        $documento = Documento::find($id);
        
        if ($documento) {
            Storage::delete('public/documentos/' . $documento->archivo);
            $documento->delete();
        }

        return back()->with('success', 'Documento eliminado.');
    }
}