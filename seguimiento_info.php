<!DOCTYPE html>
<html lang="es-MX">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seguimiento | SIESE - Gobierno de Chiapas</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap');
        
        :root {
            --guinda-chiapas: #8D192F;
            --guinda-hover: #6b1224;
            --fondo: #f8fafc;
        }

        body { 
            background-color: var(--fondo); 
            font-family: 'Inter', sans-serif;
            color: #1e293b;
        }

        .title-gradient {
            background: linear-gradient(to right, var(--guinda-chiapas), #bc1931);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .card-modern {
            background: white;
            border: 1px solid #e2e8f0;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .card-modern:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.05);
            border-color: var(--guinda-chiapas);
        }

        .btn-gov {
            background-color: var(--guinda-chiapas);
            transition: all 0.2s;
        }

        .btn-gov:hover {
            background-color: var(--guinda-hover);
        }

        .fade-up {
            animation: fadeUp 0.6s ease-out forwards;
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="antialiased">

    <header class="bg-white/80 backdrop-blur-md sticky top-0 z-50 border-b border-slate-200">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <div class="w-1 bg-red-800 h-8"></div>
                <h1 class="text-xl font-extrabold tracking-tighter text-slate-800">SIESE <span class="font-light text-slate-400">| SEGUIMIENTO</span></h1>
            </div>
            <a href="index.php" class="group flex items-center gap-2 text-[10px] font-black uppercase tracking-widest text-slate-400 hover:text-red-800 transition-colors">
                <i class="fas fa-home transition-transform group-hover:-translate-y-0.5"></i> 
                Inicio
            </a>
        </div>
    </header>

    <main class="container mx-auto max-w-5xl px-6 py-12">
        
        <section class="mb-16 fade-up">
            <h2 class="text-4xl md:text-5xl font-black text-slate-900 mb-8 tracking-tight text-center">
                Sistema de <span class="title-gradient">Seguimiento</span>
            </h2>
            
            <div class="max-w-4xl mx-auto bg-white p-8 md:p-12 rounded-3xl border border-slate-100 shadow-sm">
                <p class="text-slate-600 text-sm md:text-base leading-relaxed text-justify">
                    Proceso estratégico de recopilación y análisis de datos para asegurar que los programas avancen según las metas e indicadores establecidos en los planes de gobierno. Esta herramienta permite monitorear en tiempo real el cumplimiento de los compromisos institucionales, garantizando la eficiencia en la ejecución de las políticas públicas estatales.
                </p>
            </div>
        </section>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 fade-up" style="animation-delay: 0.2s;">
            
            <?php
            $secciones = [
                [
                    'titulo' => 'Monitor de Indicadores PED',
                    'icon' => 'fa-desktop',
                    'desc' => 'Visualización de avances de los indicadores del Plan Estatal de Desarrollo.',
                    'tipo' => 'ver',
                    'badge' => 'Plan Estatal'
                ],
                [
                    'titulo' => 'Presupuesto Ciudadano',
                    'icon' => 'fa-hand-holding-dollar',
                    'desc' => 'Transparencia en el ejercicio de los recursos públicos estatales para la ciudadanía.',
                    'tipo' => 'descargar',
                    'badge' => 'Finanzas'
                ],
                [
                    'titulo' => 'Financiamiento a los ODS',
                    'icon' => 'fa-globe-americas',
                    'desc' => 'Seguimiento a la inversión para los Objetivos de Desarrollo Sostenible en Chiapas.',
                    'tipo' => 'descargar',
                    'badge' => 'Sostenibilidad'
                ],
                [
                    'titulo' => 'Indicadores de Pobreza (CONEVAL)',
                    'icon' => 'fa-chart-pie',
                    'desc' => 'Resultados del Rezago Social y Carencias Sociales según los criterios de CONEVAL.',
                    'tipo' => 'ver',
                    'badge' => 'Social'
                ]
            ];

            foreach ($secciones as $index => $s): ?>
                <article class="card-modern rounded-3xl p-8 flex flex-col h-full fade-up" style="animation-delay: <?= 0.2 + ($index * 0.1) ?>s">
                    <div class="flex items-start justify-between mb-8">
                        <div class="p-4 bg-slate-50 rounded-2xl">
                            <i class="fas <?= $s['icon'] ?> text-3xl text-red-800"></i>
                        </div>
                        <span class="text-[9px] font-bold px-3 py-1 bg-red-50 text-red-800 rounded-full uppercase tracking-tighter"><?= $s['badge'] ?></span>
                    </div>
                    
                    <h3 class="text-xl font-bold text-slate-800 mb-2 uppercase tracking-tight"><?= $s['titulo'] ?></h3>
                    <p class="text-xs text-slate-400 leading-relaxed mb-8 flex-grow">
                        <?= $s['desc'] ?>
                    </p>

                    <div class="mt-auto">
                        <div class="bg-slate-50 border border-dashed border-slate-200 rounded-2xl p-6 text-center group">
                            <p class="text-[10px] font-bold text-slate-400 uppercase mb-4 tracking-wide italic text-center">Esperando carga de datos...</p>
                            
                            <button class="btn-gov w-full text-white text-[11px] font-bold py-4 rounded-xl shadow-lg shadow-red-900/20 uppercase tracking-widest flex items-center justify-center gap-3">
                                <?php if ($s['tipo'] === 'ver'): ?>
                                    <i class="fas fa-eye"></i> Ver Panel General
                                <?php else: ?>
                                    <i class="fas fa-file-pdf"></i> Descargar Documento
                                <?php endif; ?>
                            </button>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>

        </div>

        <footer class="mt-24 pt-8 border-t border-slate-200 flex flex-col md:flex-row justify-between items-center gap-4">
            <p class="text-[10px] font-bold text-slate-300 uppercase tracking-[0.4em]">SIESE v3.0 | Chiapas 2026</p>
            <div class="flex gap-6 text-slate-200">
                <i class="fab fa-facebook hover:text-red-800 transition-colors cursor-pointer"></i>
                <i class="fab fa-twitter hover:text-red-800 transition-colors cursor-pointer"></i>
                <i class="fas fa-globe hover:text-red-800 transition-colors cursor-pointer"></i>
            </div>
        </footer>

    </main>

</body>
</html>