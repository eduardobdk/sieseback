<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Documento; 

class FaisController extends Controller
{
    public function index()
    {
        $comunicaciones = Documento::where('seccion', 'fais_comunicaciones')
                            ->orderBy('created_at', 'desc')
                            ->get();

        $normatecaPorAnio = Documento::where('seccion', 'fais_normateca')
                            ->orderBy('anio', 'desc')
                            ->get()
                            ->groupBy('anio');

        return view('fais', compact('comunicaciones', 'normatecaPorAnio'));
    }
}