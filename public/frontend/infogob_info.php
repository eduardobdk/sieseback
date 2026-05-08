<?php
require __DIR__.'/../../vendor/autoload.php';
$app = require_once __DIR__.'/../../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(Illuminate\Http\Request::capture());

// Asumo que usas los modelos correspondientes
use App\Models\InformesInfo; 
use App\Models\Informe; // El que guarda los títulos y los 3 PDFs

$info = InformesInfo::first();
$informes = Informe::latest()->get();
?>
<!DOCTYPE html>
<html lang="es-MX">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informes de Gobierno | SIESE - Chiapas</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');
        
        :root {
            --guinda-chiapas: #8D192F;
            --oro-institucional: #B88B4A;
            --gris-admin: #999999;
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
            font-size: 11px; font-weight: 700; text-transform: uppercase;
            letter-spacing: 0.05em; color: #64748b; transition: all 0.3s ease;
            position: relative;
        }

        .nav-link-siese:hover { color: var(--guinda-chiapas); }
        .nav-link-siese::after {
            content: ''; position: absolute; bottom: -4px; left: 0;
            width: 0; height: 2px; background-color: var(--guinda-chiapas);
            transition: width 0.3s ease;
        }
        .nav-link-siese:hover::after { width: 100%; }

        .header-grey-admin {
            background-color: var(--gris-admin); color: white;
            text-align: center; padding: 20px; font-size: 16px;
            font-weight: 800; text-transform: uppercase; letter-spacing: 2px;
        }

        .btn-doc-download {
            background-color: white; border: 1px solid var(--slate-200);
            color: #475569; padding: 14px 20px; border-radius: 12px;
            font-size: 11px; font-weight: 700; text-transform: uppercase;
            display: inline-flex; align-items: center; gap: 12px;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1); width: 100%;
        }

        .btn-doc-download:hover {
            border-color: var(--guinda-chiapas); color: var(--guinda-chiapas);
            background-color: #fff1f2; transform: translateX(5px);
            box-shadow: 0 4px 12px rgba(141, 25, 47, 0.08);
        }

        .border-l-guinda { border-left: 5px solid var(--guinda-chiapas); }

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
                <h1 class="text-lg font-extrabold tracking-tight">SIESE <span class="font-normal text-slate-400">| INFORMES</span></h1>
            </div>
            <a href="index.php" class="group flex items-center gap-2 text-[10px] font-black uppercase tracking-widest text-slate-400 hover:text-red-800 transition-colors">
                <i class="fas fa-home transition-transform group-hover:-translate-y-0.5"></i> Inicio
            </a>
        </div>
    </header>

    <main class="container mx-auto max-w-6xl px-6 py-12 md:py-16">
        
        <header class="mb-16 text-center animate-fade">
            <h2 class="text-5xl md:text-6xl font-black text-slate-900 mb-8 tracking-tighter uppercase">
                INFORMES DE <span style="color: var(--guinda-chiapas);">GOBIERNO</span>
            </h2>
            <div class="max-w-5xl mx-auto bg-white p-10 md:p-14 rounded-[2.5rem] border border-slate-100 shadow-sm">
                <p class="text-slate-600 text-sm md:text-base leading-relaxed text-justify font-medium">
                    <?php echo $info->descripcion; ?>
                </p>
            </div>
        </header>

        <section class="animate-fade shadow-2xl rounded-[2.5rem] overflow-hidden border border-slate-200 bg-white" style="animation-delay: 0.2s;">
            <div class="header-grey-admin">Acervo Documental Institucional</div>

            <div class="bg-grecas p-6 md:p-12 space-y-8">
                
                <?php foreach($informes as $informe): ?>
                <div class="bg-white/95 backdrop-blur-sm rounded-[2rem] p-8 md:p-10 border border-white shadow-sm">
                    <div class="flex flex-col md:flex-row gap-12 items-start">
                        
                        <div class="flex gap-4 shrink-0 mx-auto md:mx-0">
                            <div class="w-32 h-40 bg-slate-50 rounded-2xl flex flex-col items-center justify-center p-4 border border-slate-100 shadow-inner relative overflow-hidden group">
                                <?php if($informe->portada): ?>
                                    <img src="<?= asset('image/informes/'.$informe->portada) ?>" class="absolute inset-0 w-full h-full object-cover opacity-40 group-hover:opacity-100 transition-opacity">
                                <?php endif; ?>
                                <span class="text-[8px] font-black text-red-800 uppercase mb-2 tracking-tighter relative z-10">Informe</span>
                                <i class="fas fa-file-invoice text-4xl text-slate-200 group-hover:text-red-800/20 transition-colors relative z-10"></i>
                                <div class="absolute bottom-0 left-0 w-full h-1.5 bg-red-800 z-10"></div>
                            </div>
                        </div>

                        <div class="flex-1 w-full text-center md:text-left">
                            <h3 class="text-2xl font-black text-slate-800 mb-8 border-l-guinda pl-6 inline-block md:block uppercase tracking-tight">
                                <?= e($informe->titulo) ?>
                            </h3>
                            
                            <div class="space-y-8">
                                <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] mb-4">Documentación Disponible</h4>
                                
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <?php if($informe->pdf_contexto): ?>
                                   <a href="/storage/documentos/<?= $informe->pdf_contexto ?>" target="_blank" class="btn-doc-download">
                                        <i class="fas fa-file-pdf text-red-700 text-lg"></i> <span>Contexto Estatal</span>
                                    </a>
                                    <?php endif; ?>

                                    <?php if($informe->pdf_anexo1): ?>
                                    <a href="/storage/documentos/<?= $informe->pdf_anexo1 ?>" target="_blank" class="btn-doc-download">
                                        <i class="fas fa-chart-line text-blue-700 text-lg"></i> <span>Anexo I: Indicadores PED</span>
                                    </a>
                                    <?php endif; ?>

                                    <?php if($informe->pdf_anexo2): ?>
                                    <a href="/storage/documentos/<?= $informe->pdf_anexo2 ?>" target="_blank" class="btn-doc-download">
                                        <i class="fas fa-coins text-amber-600 text-lg"></i> <span>Anexo II: Financiamiento</span>
                                    </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>

                <?php if($informes->isEmpty()): ?>
                <div class="mt-12 text-center py-12 bg-white/40 border-2 border-dashed border-slate-300 rounded-[2rem] backdrop-blur-sm">
                    <i class="fas fa-history text-slate-300 text-4xl mb-4"></i>
                    <p class="text-slate-400 font-black text-[10px] uppercase tracking-[0.3em]">No hay informes registrados</p>
                </div>
                <?php endif; ?>

            </div>
            
            <div class="bg-white px-10 py-6 border-t border-slate-100 flex justify-between items-center">
                <p class="text-[9px] text-slate-400 font-bold uppercase tracking-[0.5em]">Secretaría de Hacienda | Gobierno de Chiapas 2026</p>
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/cf/Coat_of_arms_of_Chiapas.svg/1200px-Coat_of_arms_of_Chiapas.svg.png" class="h-10 opacity-20 grayscale" alt="Escudo">
            </div>
        </section>

        <footer class="mt-20 py-10 text-center border-t border-slate-100">
            <p class="text-[10px] font-black text-slate-300 uppercase tracking-[0.6em]">SIESE v3.0 | Sistema Estatal de Seguimiento y Evaluación</p>
        </footer>
    </main>
    <?php include 'footer_publico.php'; ?>
</body>
</html>