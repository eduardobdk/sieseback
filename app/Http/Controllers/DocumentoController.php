<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DocumentoController extends Controller
{
    /**
     * Muestra el panel de administración de FAIS
     */
    public function index()
{
    // 1. Obtenemos las comunicaciones relevantes
    $comunicaciones = \App\Models\Documento::where('seccion', 'fais_comunicaciones')
        ->orderBy('created_at', 'desc')
        ->get();

    // 2. Obtenemos la normateca y la agrupamos por año
    // Usamos sortKeys() para que los años aparezcan de menor a mayor (2025, 2026...)
    $normatecaPorAnio = \App\Models\Documento::where('seccion', 'fais_normateca')
        ->get()
        ->groupBy('anio')
        ->sortKeys(); 

    // 3. Enviamos AMBAS variables a la vista
    return view('fais', compact('comunicaciones', 'normatecaPorAnio'));
}

    public function store(Request $request)
    {
        $request->validate([
            'titulo'    => 'required|string|max:255',
            'archivo'   => 'required|mimes:pdf|max:10000',
            'seccion'   => 'required'
        ]);

        if ($request->hasFile('archivo')) {
            $archivo = $request->file('archivo');
            $nombreArchivo = time() . '_' . $archivo->getClientOriginalName();
            $archivo->storeAs('public/documentos', $nombreArchivo);
        }

        DB::table('documentos')->insert([
            'titulo'    => $request->titulo,
            'archivo'   => $nombreArchivo,
            'extension' => $archivo->getClientOriginalExtension(),
            'seccion'   => $request->seccion,
            'anio'      => $request->anio,      // Se guarda el año para el filtrado
            'categoria' => $request->categoria, // Se guarda la categoría para el grupo
            'created_at'=> now(),
            'updated_at'=> now(),
        ]);

        return back()->with('success', 'Documento guardado correctamente.');
    }

    public function destroy($id)
    {
        $documento = DB::table('documentos')->where('id', $id)->first();
        
        if ($documento) {
            Storage::delete('public/documentos/' . $documento->archivo);
            DB::table('documentos')->where('id', $id)->delete();
        }

        return back()->with('success', 'Documento eliminado.');
    }
}