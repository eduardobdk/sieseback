<?php
// 1. Conexión al núcleo de Laravel
require __DIR__.'/../../vendor/autoload.php';
$app = require_once __DIR__.'/../../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(Illuminate\Http\Request::capture());

use App\Models\SeguimientoInfo;
use App\Models\SeguimientoRegistro;

// 2. Consulta de datos
$info = SeguimientoInfo::first() ?? (object)['descripcion' => 'Información de seguimiento no disponible.'];
$registros = SeguimientoRegistro::orderBy('created_at', 'desc')->get();
?>

<!DOCTYPE html>
<html lang="es-MX">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seguimiento | SIESE - Gobierno de Chiapas</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');
        :root {
            --guinda-chiapas: #8D192F;
            --fondo-grecas: #E9E9E9;
            --slate-800: #1e293b;
            --slate-200: #e2e8f0;
        }
        body { background-color: #fcfcfc; font-family: 'Inter', sans-serif; color: var(--slate-800); }
        .bg-grecas { background-color: var(--fondo-grecas); background-image: url('https://www.transparenttextures.com/patterns/cubes.png'); background-blend-mode: overlay; }
        .card-modern { background: white; border: 1px solid var(--slate-200); transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
        .card-modern:hover { transform: translateY(-5px); box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.05); border-color: var(--guinda-chiapas); }
        .btn-gov { background-color: var(--slate-800); transition: all 0.2s; text-decoration: none; display: flex; align-items: center; justify-content: center; gap: 3px; }
        .btn-gov:hover { background-color: var(--guinda-chiapas); transform: scale(1.02); }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(15px); } to { opacity: 1; transform: translateY(0); } }
        .animate-fade { animation: fadeIn 0.6s ease-out forwards; }
    </style>
</head>
<body class="antialiased">

    <header class="bg-white/90 backdrop-blur-md sticky top-0 z-50 border-b border-slate-200">
        <div class="container mx-auto px-6 py-4 flex flex-col lg:flex-row justify-between items-center gap-6">
            <div class="flex items-center gap-3">
                <div class="w-1.5 bg-[#8D192F] h-6 rounded-full"></div>
                <h1 class="text-lg font-extrabold tracking-tight">SIESE <span class="font-normal text-slate-400">| SEGUIMIENTO</span></h1>
            </div>
            <a href="index.php" class="text-[10px] font-black uppercase tracking-widest text-slate-400 hover:text-red-800 transition-colors">
                <i class="fas fa-home"></i> Inicio
            </a>
        </div>
    </header>

    <main class="container mx-auto max-w-6xl px-6 py-12">
        
        <header class="mb-16 text-center animate-fade">
            <h2 class="text-5xl md:text-6xl font-black text-slate-900 mb-8 tracking-tighter uppercase">
                SISTEMA DE <span style="color: var(--guinda-chiapas);">SEGUIMIENTO</span>
            </h2>
            <div class="max-w-5xl mx-auto bg-white p-10 md:p-12 rounded-[2.5rem] border border-slate-100 shadow-sm">
                <p class="text-slate-600 text-sm md:text-base leading-relaxed text-justify font-medium">
                    <?php echo nl2br(htmlspecialchars($info->descripcion)); ?>
                </p>
            </div>
        </header>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 animate-fade">
            
            <?php if($registros->isEmpty()): ?>
                <div class="col-span-full text-center py-10 text-slate-400">
                    <p>No hay indicadores o documentos registrados.</p>
                </div>
            <?php else: ?>
                <?php foreach ($registros as $reg): ?>
                <article class="card-modern rounded-[2rem] p-10 flex flex-col h-full bg-white">
                    <div class="flex items-start justify-between mb-8">
                        <div class="w-14 h-14 bg-slate-50 rounded-2xl flex items-center justify-center">
                            <?php if($reg->extension == 'link'): ?>
                                <i class="fas fa-desktop text-3xl text-red-800"></i>
                            <?php else: ?>
                                <i class="fas fa-file-pdf text-3xl text-red-800"></i>
                            <?php endif; ?>
                        </div>
                        <span class="text-[9px] font-bold px-3 py-1 bg-red-50 text-red-800 rounded-full uppercase tracking-widest">
                            <?php echo ($reg->extension == 'link') ? 'Portal Web' : 'Documento'; ?>
                        </span>
                    </div>
                    
                    <h3 class="text-xl font-bold text-slate-800 mb-2 uppercase tracking-tight"><?php echo htmlspecialchars($reg->titulo); ?></h3>
                    <p class="text-[11px] text-slate-400 leading-relaxed mb-8 flex-grow font-medium uppercase tracking-tight">
                        Información oficial correspondiente al ciclo de seguimiento 2026.
                    </p>

                    <div class="bg-grecas rounded-2xl p-6 text-center border border-slate-100">
                        <?php 
                            $url = ($reg->extension == 'link') ? $reg->archivo : '../storage/documentos/'.$reg->archivo;
                        ?>
                        <a href="<?php echo $url; ?>" target="_blank" class="btn-gov w-full text-white text-[11px] font-bold py-4 rounded-xl shadow-lg uppercase tracking-widest">
                            <?php if($reg->extension == 'link'): ?>
                                <i class="fas fa-eye"></i> Ver Panel General
                            <?php else: ?>
                                <i class="fas fa-file-pdf"></i> Descargar Documento
                            <?php endif; ?>
                        </a>
                    </div>
                </article>
                <?php endforeach; ?>
            <?php endif; ?>

        </div>
    </main>
    <?php include 'footer_publico.php'; ?>
</body>
</html>