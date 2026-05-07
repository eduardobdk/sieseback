<?php
// Conexión con el núcleo de Laravel (3 niveles arriba)
require __DIR__.'/../../vendor/autoload.php';
$app = require_once __DIR__.'/../../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(Illuminate\Http\Request::capture());

use App\Models\EvaluacionInfo;
use App\Models\EvaluacionDocumento;

// Obtenemos los datos de la BD
$info = EvaluacionInfo::first();
$documentos = EvaluacionDocumento::latest()->get();
?>
<!DOCTYPE html>
<html lang="es-MX">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evaluación | SIESE - Gobierno de Chiapas</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');
        
        :root {
            --guinda-chiapas: #8D192F;
            --oro-institucional: #B88B4A;
            --gris-evaluacion: #999999;
            --fondo-grecas: #E9E9E9;
            --slate-800: #1e293b;
            --slate-200: #e2e8f0;
        }

        body { 
            background-color: #fcfcfc; 
            font-family: 'Inter', sans-serif;
            color: var(--slate-800);
        }

        .bg-grecas {
            background-color: var(--fondo-grecas);
            background-image: url('https://www.transparenttextures.com/patterns/cubes.png'); 
            background-blend-mode: overlay;
        }

        .nav-link-siese {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #64748b;
            transition: all 0.3s ease;
            position: relative;
        }

        .nav-link-siese:hover { color: var(--guinda-chiapas); }

        .nav-link-siese::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 0;
            height: 2px;
            background-color: var(--guinda-chiapas);
            transition: width 0.3s ease;
        }

        .nav-link-siese:hover::after { width: 100%; }

        .card-modern {
            background: white;
            border: 1px solid var(--slate-200);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .card-modern:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.05);
            border-color: var(--guinda-chiapas);
        }

        .btn-gov {
            background-color: var(--slate-800);
            transition: all 0.2s;
        }

        .btn-gov:hover {
            background-color: var(--guinda-chiapas);
            transform: scale(1.02);
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(15px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade { animation: fadeIn 0.6s ease-out forwards; }
    </style>
</head>
<body class="antialiased">

    <header class="bg-white/90 backdrop-blur-md sticky top-0 z-50 border-b border-slate-200">
        <div class="container mx-auto px-6 py-4 flex flex-col lg:flex-row justify-between items-center gap-6">
            <div class="flex items-center gap-3">
                <div class="w-1.5 bg-[#8D192F] h-6 rounded-full"></div>
                <h1 class="text-lg font-extrabold tracking-tight">SIESE <span class="font-normal text-slate-400">| EVALUACIÓN</span></h1>
            </div>
            <a href="index.php" class="group flex items-center gap-2 text-[10px] font-black uppercase tracking-widest text-slate-400 hover:text-red-800 transition-colors">
                <i class="fas fa-home transition-transform group-hover:-translate-y-0.5"></i> 
                Inicio
            </a>
        </div>
    </header>

    <main class="container mx-auto max-w-6xl px-6 py-12">
        
        <header class="mb-16 text-center animate-fade">
            <h2 class="text-5xl md:text-6xl font-black text-slate-900 mb-8 tracking-tighter uppercase">
                SISTEMA DE <span style="color: var(--guinda-chiapas);">EVALUACIÓN</span>
            </h2>
            <div class="max-w-5xl mx-auto bg-white p-10 md:p-12 rounded-[2.5rem] border border-slate-100 shadow-sm">
                <p class="text-slate-600 text-sm md:text-base leading-relaxed text-justify font-medium">
                    <?= $info ? e($info->descripcion) : 'Valorar y orientar la gestión pública; fortalece el proceso de toma de decisiones para avanzar con certidumbre en la atención de políticas públicas y su implementación de programas.' ?>
                </p>
            </div>
        </header>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 animate-fade" style="animation-delay: 0.2s;">
            
            <?php foreach($documentos as $doc): ?>
            <article class="card-modern rounded-[2rem] p-10 flex flex-col h-full bg-white">
                <div class="flex items-start justify-between mb-8">
                    <div class="w-14 h-14 bg-slate-50 rounded-2xl flex items-center justify-center">
                        <i class="fas fa-file-signature text-3xl text-red-800"></i>
                    </div>
                    <span class="text-[9px] font-bold px-3 py-1 bg-red-50 text-red-800 rounded-full uppercase tracking-widest">Documento</span>
                </div>
                
                <h3 class="text-xl font-bold text-slate-800 mb-2 uppercase tracking-tight"><?= e($doc->titulo) ?></h3>
                <p class="text-[11px] text-slate-400 leading-relaxed mb-8 flex-grow font-medium uppercase tracking-tight">
                    Documento oficial disponible para su consulta y descarga.
                </p>

                <div class="bg-grecas rounded-2xl p-6 text-center border border-slate-100">
                    <a href="<?= '/storage/documentos/'.$doc->archivo ?>" target="_blank" class="btn-gov w-full text-white text-[11px] font-bold py-4 rounded-xl shadow-lg uppercase tracking-widest flex items-center justify-center gap-3 decoration-none">
                        <i class="fas fa-file-pdf"></i> Descargar Documento
                    </a>
                </div>
            </article>
            <?php endforeach; ?>

            <?php if($documentos->isEmpty()): ?>
                 <article class="card-modern rounded-[2rem] p-10 flex flex-col h-full bg-white opacity-50">
                    <p class="text-center text-slate-400 italic">No hay documentos cargados aún.</p>
                 </article>
            <?php endif; ?>

        </div>

        <footer class="mt-24 pt-10 border-t border-slate-200 text-center">
            <div class="flex justify-center items-center gap-8 mb-4">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/cf/Coat_of_arms_of_Chiapas.svg/1200px-Coat_of_arms_of_Chiapas.svg.png" class="h-8 opacity-30 grayscale" alt="Escudo">
            </div>
            <p class="text-[10px] font-bold text-slate-300 uppercase tracking-[0.5em]">Secretaría de Hacienda | Gobierno de Chiapas 2026</p>
        </footer>

    </main>
    <?php include 'footer_publico.php'; ?>
</body>
</html>