<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InformesInfo;
use App\Models\Informe;
use Illuminate\Support\Facades\Storage;

class InformeController extends Controller
{
    public function index()
    {
        $info = InformesInfo::firstOrCreate([], [
            'descripcion' => 'Documentos que dice el estado que guarda la Administración Pública Estatal...'
        ]);

        $informes = Informe::latest()->get();

        return view('informes', compact('info', 'informes'));
    }

    public function updateInfo(Request $request)
{
    // updateOrCreate busca un registro, si no lo halla, lo crea
    $info = InformesInfo::firstOrCreate([], [
        'descripcion' => 'Documentos que detallan el estado...'
    ]);

    $info->descripcion = $request->descripcion;
    $info->save();

    return back()->with('success', 'Descripción actualizada correctamente.');
}

    public function store(Request $request)
{
    // 1. Validar los datos
    $request->validate([
        'titulo' => 'required|string|max:255',
        'portada' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        'pdf_contexto' => 'nullable|mimes:pdf|max:20480',
        'pdf_anexo1' => 'nullable|mimes:pdf|max:20480',
        'pdf_anexo2' => 'nullable|mimes:pdf|max:20480',
    ]);

    // 2. Crear la instancia del modelo
    $informe = new Informe();
    $informe->titulo = $request->titulo;

    // --- AQUÍ VA EL CÓDIGO DE LOS ARCHIVOS ---

    // Manejo de la Portada (Imagen)
    if ($request->hasFile('portada')) {
        $file = $request->file('portada');
        $name = time() . '_portada_' . $file->getClientOriginalName();
        $file->move(public_path('image/informes'), $name);
        $informe->portada = $name;
    }

    // Manejo del PDF Contexto Estatal
    if ($request->hasFile('pdf_contexto')) {
        $file = $request->file('pdf_contexto');
        $name = time() . '_contexto_' . $file->getClientOriginalName();
        $file->storeAs('documentos', $name, 'public'); // Se guarda en storage/app/public/documentos
        $informe->pdf_contexto = $name;
    }

    // Manejo del PDF Anexo 1
    if ($request->hasFile('pdf_anexo1')) {
        $file = $request->file('pdf_anexo1');
        $name = time() . '_anexo1_' . $file->getClientOriginalName();
        $file->storeAs('documentos', $name, 'public');
        $informe->pdf_anexo1 = $name;
    }

    // Manejo del PDF Anexo 2
    if ($request->hasFile('pdf_anexo2')) {
        $file = $request->file('pdf_anexo2');
        $name = time() . '_anexo2_' . $file->getClientOriginalName();
        $file->storeAs('documentos', $name, 'public');
        $informe->pdf_anexo2 = $name;
    }

    // 3. Guardar en la base de datos
    $informe->save();

    return redirect()->back()->with('success', 'Informe creado correctamente con sus anexos.');
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