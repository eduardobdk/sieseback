<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

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

// --- RUTA FAIS (NUEVA) ---
Route::get('/fais-data', function () {
    // 1. Obtenemos las comunicaciones (Sección 1)
    // Filtramos por la sección que definiste en tu blade: 'fais_comunicaciones'
    $comunicaciones = DB::table('documentos')
                        ->where('seccion', 'fais_comunicaciones')
                        ->orderBy('created_at', 'desc')
                        ->get();

    // 2. Obtenemos la Normateca (Sección 2)
    // Agrupamos primero por 'anio' y luego por 'categoria'
    $normateca = DB::table('documentos')
                    ->where('seccion', 'fais_normateca')
                    ->orderBy('anio', 'desc')
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