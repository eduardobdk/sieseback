<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ActividadController;
use App\Http\Controllers\DocumentoController;
use App\Http\Controllers\CopladeController;
use App\Http\Controllers\FaisController;
use App\Http\Controllers\PlaneacionController;
use App\Http\Controllers\SeguimientoController;
use App\Http\Controllers\EvaluacionController;
use App\Http\Controllers\InformeController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ==========================================
// RUTAS PÚBLICAS (Login y Autenticación)
// ==========================================

// Ruta raíz: Si no hay sesión, muestra el login
Route::get('/', function () {
    return view('login');
})->name('login');

// Procesar el inicio de sesión
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

// Procesar el cierre de sesión
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// ==========================================
// RUTAS PROTEGIDAS (Solo usuarios logueados)
// ==========================================
Route::middleware('auth')->group(function () {
    
    // --- SECCIÓN INICIO (Dinámica) ---
    Route::get('/inicio', [ActividadController::class, 'index'])->name('inicio');
    Route::post('/actividad/store', [ActividadController::class, 'store'])->name('actividad.store');
    Route::delete('/actividad/eliminar/{id}', [ActividadController::class, 'destroy'])->name('actividad.destroy');


    // --- DEMÁS SECCIONES DEL PANEL ---
    Route::get('/coplade', [CopladeController::class, 'index'])->name('panel.coplade');
    Route::post('/coplade/bienvenida', [CopladeController::class, 'updateBienvenida'])->name('coplade.bienvenida.update');
    Route::post('/coplade/sesion', [CopladeController::class, 'storeSesion'])->name('coplade.sesion.store');
    Route::delete('/coplade/sesion/{id}', [CopladeController::class, 'destroySesion'])->name('coplade.sesion.destroy');


   Route::get('/fais', [DocumentoController::class, 'index'])->name('panel.fais');

    Route::get('/planeacion', [PlaneacionController::class, 'index'])->name('panel.planeacion');
    Route::post('/planeacion/info', [PlaneacionController::class, 'updateInfo'])->name('planeacion.info.update');
    Route::post('/planeacion/documento', [PlaneacionController::class, 'storeDocumento'])->name('planeacion.documento.store');
    Route::delete('/planeacion/documento/{id}', [PlaneacionController::class, 'destroyDocumento'])->name('planeacion.documento.destroy');

    Route::get('/seguimiento', [SeguimientoController::class, 'index'])->name('seguimiento.index');
    Route::post('/seguimiento/info', [SeguimientoController::class, 'updateInfo'])->name('seguimiento.info.update');
    Route::post('/seguimiento/registro', [SeguimientoController::class, 'storeRegistro'])->name('seguimiento.registro.store');

    Route::get('/evaluacion', [EvaluacionController::class, 'index'])->name('panel.evaluacion');
    Route::post('/evaluacion/info', [EvaluacionController::class, 'updateInfo'])->name('evaluacion.info.update');
    Route::post('/evaluacion/documento', [EvaluacionController::class, 'storeDocumento'])->name('evaluacion.documento.store');
    Route::delete('/evaluacion/documento/{id}', [EvaluacionController::class, 'destroyDocumento'])->name('evaluacion.documento.destroy');
    
    Route::get('/informes', [InformeController::class, 'index'])->name('panel.informes');
    Route::get('/informes/info', [DocumentoController::class, 'getPorSeccion']);
    Route::post('/informes/store', [InformeController::class, 'store'])->name('informes.store');
    Route::post('/informes/info', [InformeController::class, 'updateInfo'])->name('informes.info.update');
    Route::delete('/informes/eliminar/{id}', [InformeController::class, 'destroy'])->name('informes.destroy');

    // --- RUTA DE HERRAMIENTAS (CORREGIDA CON CONEVAL) ---
    Route::get('/herramientas', function () { 
        // 1. Traemos los documentos normales
        $eval_ped = \App\Models\Documento::where('seccion', 'evaluacion_ped')->get();
        $formatos = \App\Models\Documento::where('seccion', 'formatos_ped')->get();
        $eval_sectorial = \App\Models\Documento::where('seccion', 'evaluacion_sectorial')->get();
        
        // 2. Traemos las nuevas secciones de CONEVAL (ESTO ES LO QUE FALTABA)
        $coneval_comunicaciones = \App\Models\Documento::where('seccion', 'coneval_comunicacion')->latest()->get();
        $coneval_visores = \App\Models\Documento::where('seccion', 'coneval_visor')->latest()->get();
        
        // 3. Enviamos todas las variables a la vista
        return view('herramientas', compact(
            'eval_ped', 
            'formatos', 
            'eval_sectorial', 
            'coneval_comunicaciones', 
            'coneval_visores'
        )); 
    })->name('panel.herramientas');


    Route::get('/monitores', function () { 
        return view('monitores'); 
    })->name('panel.monitores');


    // Rutas de Documentos
    Route::post('/documentos/store', [DocumentoController::class, 'store'])->name('documento.store');
    Route::delete('/documentos/{id}', [DocumentoController::class, 'destroy'])->name('documento.destroy');
    Route::get('/api/documentos', [DocumentoController::class, 'getPorSeccion']);
});