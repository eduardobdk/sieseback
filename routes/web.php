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
    // Ahora el inicio lo controla ActividadController para mostrar las noticias de la DB
    Route::get('/inicio', [ActividadController::class, 'index'])->name('panel.inicio');
    
    // Ruta para guardar las nuevas noticias/actividades
    Route::post('/actividad-guardar', [ActividadController::class, 'store'])->name('actividad.store');


    // --- DEMÁS SECCIONES DEL PANEL ---
    Route::get('/coplade', [CopladeController::class, 'index'])->name('panel.coplade');
    Route::post('/coplade/bienvenida', [CopladeController::class, 'updateBienvenida'])->name('coplade.bienvenida.update');
    Route::post('/coplade/sesion', [CopladeController::class, 'storeSesion'])->name('coplade.sesion.store');
    Route::delete('/coplade/sesion/{id}', [CopladeController::class, 'destroySesion'])->name('coplade.sesion.destroy');


   Route::get('/fais', [FaisController::class, 'index'])->name('panel.fais');

    Route::get('/planeacion', [PlaneacionController::class, 'index'])->name('panel.planeacion');
    Route::post('/planeacion/info', [PlaneacionController::class, 'updateInfo'])->name('planeacion.info.update');
    Route::post('/planeacion/documento', [PlaneacionController::class, 'storeDocumento'])->name('planeacion.documento.store');
    Route::delete('/planeacion/documento/{id}', [PlaneacionController::class, 'destroyDocumento'])->name('planeacion.documento.destroy');

   Route::get('/seguimiento', [SeguimientoController::class, 'index'])->name('panel.seguimiento');
    Route::post('/seguimiento/info', [SeguimientoController::class, 'updateInfo'])->name('seguimiento.info.update');
    Route::post('/seguimiento/registro', [SeguimientoController::class, 'storeRegistro'])->name('seguimiento.registro.store');
    // Para borrar reciclamos la de DocumentoController que ya existe:
    // Route::delete('/documento-eliminar/{id}', ...)

    Route::get('/evaluacion', [EvaluacionController::class, 'index'])->name('panel.evaluacion');
    Route::post('/evaluacion/info', [EvaluacionController::class, 'updateInfo'])->name('evaluacion.info.update');
    Route::post('/evaluacion/documento', [EvaluacionController::class, 'storeDocumento'])->name('evaluacion.documento.store');
    Route::delete('/evaluacion/documento/{id}', [EvaluacionController::class, 'destroyDocumento'])->name('evaluacion.documento.destroy');
    
    Route::get('/informes', [InformeController::class, 'index'])->name('panel.informes');
    Route::post('/informes/info', [InformeController::class, 'updateInfo'])->name('informes.info.update');
    Route::post('/informes/guardar', [InformeController::class, 'store'])->name('informes.store');
    Route::delete('/informes/eliminar/{id}', [InformeController::class, 'destroy'])->name('informes.destroy');
    Route::get('/herramientas', function () { 
    // Traemos los documentos separados por sección desde la Base de Datos
    $eval_ped = \App\Models\Documento::where('seccion', 'evaluacion_ped')->get();
    $formatos = \App\Models\Documento::where('seccion', 'formatos_ped')->get();
    $eval_sectorial = \App\Models\Documento::where('seccion', 'evaluacion_sectorial')->get();
    
    // Le mandamos esas variables a la vista
    return view('herramientas', compact('eval_ped', 'formatos', 'eval_sectorial')); 
})->name('panel.herramientas');
    Route::get('/monitores', function () { 
        return view('monitores'); 
    })->name('panel.monitores');

    Route::post('/documento-guardar', [DocumentoController::class, 'store'])->name('documento.store');
    Route::delete('/documento-eliminar/{id}', [DocumentoController::class, 'destroy'])->name('documento.destroy');

});