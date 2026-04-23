<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| API Routes - SIESE / FAIS
|--------------------------------------------------------------------------
*/

Route::get('/actividades', function() {
    return \App\Models\Actividad::latest()->get();
});

// --- RUTA COPLADE ---
Route::get('/coplade-data', function () {
    $bienvenida = DB::table('coplade_bienvenidas')->first(); 
    $sesiones = DB::table('coplade_sesions')
                ->orderBy('anio', 'desc')
                ->get()
                ->groupBy('anio');

    return response()->json([
        'bienvenida' => $bienvenida,
        'sesiones' => $sesiones
    ]);
});

// --- RUTA FAIS (CORREGIDA: MENOR A MAYOR) ---
Route::get('/fais-data', function () {
    // Comunicaciones Relevantes
    $comunicaciones = DB::table('documentos')
                        ->where('seccion', 'fais_comunicaciones')
                        ->orderBy('created_at', 'desc')
                        ->get();

    // Normateca con orden Ascendente por Año
    $normateca = DB::table('documentos')
                    ->where('seccion', 'fais_normateca')
                    ->orderBy('anio', 'asc') 
                    ->get()
                    ->groupBy(['anio', 'categoria']);

    return response()->json([
        'comunicaciones' => $comunicaciones,
        'normateca' => $normateca
    ]);
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});