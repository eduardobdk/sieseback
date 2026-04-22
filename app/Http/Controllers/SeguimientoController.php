<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SeguimientoInfo;
use App\Models\SeguimientoRegistro;
use Illuminate\Support\Facades\Storage;

class SeguimientoController extends Controller
{
    public function index()
{
    // Obtiene el primer registro o crea uno por defecto si no existe
    $info = \App\Models\SeguimientoInfo::firstOrCreate([], [
        'descripcion' => 'Descripción inicial de seguimiento...'
    ]);

    $registros = \App\Models\SeguimientoRegistro::latest()->get();

    // Es vital que el nombre en compact coincida con las variables del blade
    return view('seguimiento', compact('info', 'registros'));
}

    public function updateInfo(Request $request)
    {
        $info = SeguimientoInfo::first();
        $info->update(['descripcion' => $request->descripcion]);
        return back()->with('success', 'Descripción de seguimiento actualizada.');
    }

    public function storeRegistro(Request $request)
    {
        $request->validate([
            'titulo' => 'required',
            'tipo' => 'required'
        ]);

        $reg = new SeguimientoRegistro();
        $reg->titulo = $request->titulo;
        $reg->extension = $request->tipo; // Guardamos 'pdf' o 'link'

        if ($request->tipo === 'pdf' && $request->hasFile('archivo')) {
            $nombre = time() . '_' . $request->file('archivo')->getClientOriginalName();
            $request->file('archivo')->storeAs('public/documentos', $nombre);
            $reg->archivo = $nombre;
        } else {
            $reg->archivo = $request->url; // Si es link, guardamos la URL directamente
        }

        $reg->save();
        return back()->with('success', 'Registro de seguimiento creado.');
    }
}