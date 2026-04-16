<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EvaluacionInfo;
use App\Models\EvaluacionDocumento;
use Illuminate\Support\Facades\Storage;

class EvaluacionController extends Controller
{
    public function index()
    {
        $info = EvaluacionInfo::firstOrCreate([], [
            'descripcion' => 'Valorar y orientar la gestión pública; así mismo, fortalece el proceso de toma de decisiones...'
        ]);

        $documentos = EvaluacionDocumento::latest()->get();

        return view('evaluacion', compact('info', 'documentos'));
    }

    public function updateInfo(Request $request)
    {
        $info = EvaluacionInfo::first();
        $info->descripcion = $request->descripcion;
        $info->save();

        return back()->with('success', 'Texto de evaluación actualizado.');
    }

    public function storeDocumento(Request $request)
    {
        $request->validate([
            'titulo' => 'required',
            'portada' => 'nullable|image',
            'archivo' => 'nullable|file|mimes:pdf'
        ]);

        $doc = new EvaluacionDocumento();
        $doc->titulo = $request->titulo;

        if ($request->hasFile('portada')) {
            $nombrePortada = time() . '_eval_' . $request->portada->getClientOriginalName();
            $request->portada->move(public_path('image/evaluacion'), $nombrePortada);
            $doc->portada = $nombrePortada;
        }

        if ($request->hasFile('archivo')) {
            $file = $request->file('archivo');
            $nombreArchivo = time() . '_evalpdf_' . str_replace(' ', '_', $file->getClientOriginalName());
            $file->storeAs('public/documentos', $nombreArchivo);
            $doc->archivo = $nombreArchivo;
        }

        $doc->save();
        return back()->with('success', 'Documento agregado con éxito.');
    }

    public function destroyDocumento($id)
    {
        $doc = EvaluacionDocumento::findOrFail($id);
        
        if ($doc->portada && file_exists(public_path('image/evaluacion/' . $doc->portada))) {
            unlink(public_path('image/evaluacion/' . $doc->portada));
        }
        
        if ($doc->archivo && Storage::exists('public/documentos/' . $doc->archivo)) {
            Storage::delete('public/documentos/' . $doc->archivo);
        }

        $doc->delete();
        return back()->with('success', 'Documento eliminado.');
    }
}
