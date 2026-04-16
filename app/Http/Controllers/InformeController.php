<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InformeInfo;
use App\Models\Informe;
use Illuminate\Support\Facades\Storage;

class InformeController extends Controller
{
    public function index()
    {
        $info = InformeInfo::firstOrCreate([], [
            'descripcion' => 'Documentos que dice el estado que guarda la Administración Pública Estatal...'
        ]);

        $informes = Informe::latest()->get();

        return view('informes', compact('info', 'informes'));
    }

    public function updateInfo(Request $request)
    {
        $info = InformeInfo::first();
        $info->descripcion = $request->descripcion;
        $info->save();

        return back()->with('success', 'Descripción actualizada.');
    }

    public function store(Request $request)
    {
        $request->validate(['titulo' => 'required']);

        $informe = new Informe();
        $informe->titulo = $request->titulo;

        // Guardar Portada
        if ($request->hasFile('portada')) {
            $nombre = time() . '_portada_' . $request->portada->getClientOriginalName();
            $request->portada->move(public_path('image/informes'), $nombre);
            $informe->portada = $nombre;
        }

        // Función rápida para guardar PDFs en la bóveda
        $guardarPdf = function($archivo, $prefijo) {
            $nombre = time() . '_' . $prefijo . '_' . str_replace(' ', '_', $archivo->getClientOriginalName());
            $archivo->storeAs('public/documentos', $nombre);
            return $nombre;
        };

        // Guardar los 3 PDFs si existen
        if ($request->hasFile('pdf_contexto')) $informe->pdf_contexto = $guardarPdf($request->file('pdf_contexto'), 'contexto');
        if ($request->hasFile('pdf_anexo1')) $informe->pdf_anexo1 = $guardarPdf($request->file('pdf_anexo1'), 'anexo1');
        if ($request->hasFile('pdf_anexo2')) $informe->pdf_anexo2 = $guardarPdf($request->file('pdf_anexo2'), 'anexo2');

        $informe->save();
        return back()->with('success', 'Informe creado con éxito.');
    }

    public function destroy($id)
    {
        $informe = Informe::findOrFail($id);
        
        // Borrar foto física
        if ($informe->portada && file_exists(public_path('image/informes/' . $informe->portada))) {
            unlink(public_path('image/informes/' . $informe->portada));
        }
        
        // Borrar PDFs físicos
        $pdfs = [$informe->pdf_contexto, $informe->pdf_anexo1, $informe->pdf_anexo2];
        foreach($pdfs as $pdf) {
            if ($pdf && Storage::exists('public/documentos/' . $pdf)) {
                Storage::delete('public/documentos/' . $pdf);
            }
        }

        $informe->delete();
        return back()->with('success', 'Informe eliminado completamente.');
    }
}