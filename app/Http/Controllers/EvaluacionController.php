<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EvaluacionInfo;
use App\Models\EvaluacionDocumento;
use Illuminate\Support\Facades\Storage;

class EvaluacionController extends Controller
{
    public function index() {
        $info = EvaluacionInfo::firstOrCreate([], ['descripcion' => 'Descripción de evaluación predeterminada...']);
        $documentos = EvaluacionDocumento::latest()->get();
        return view('evaluacion', compact('info', 'documentos'));
    }

    public function updateInfo(Request $request) {
        $info = EvaluacionInfo::first();
        $info->update(['descripcion' => $request->descripcion]);
        return back()->with('success', 'Descripción actualizada correctamente.');
    }

    public function storeDocumento(Request $request) {
    $request->validate([
        'titulo' => 'required',
        'archivo' => 'required|mimes:pdf|max:10000'
    ]);

    $doc = new EvaluacionDocumento();
    $doc->titulo = $request->titulo;

    // Guardar PDF en storage/app/public/documentos
    if ($request->hasFile('archivo')) {
        $nombrePdf = time().'_'.$request->file('archivo')->getClientOriginalName();
        $request->file('archivo')->storeAs('documentos', $nombrePdf, 'public');
        $doc->archivo = $nombrePdf;
    }
    
    $doc->save();
    return back()->with('success', 'Documento listo.');
}

    public function destroyDocumento($id) {
        $doc = EvaluacionDocumento::findOrFail($id);
        // Opcional: Eliminar archivos físicos aquí
        $doc->delete();
        return back()->with('success', 'Documento eliminado.');
    }
}
