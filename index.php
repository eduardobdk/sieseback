<!DOCTYPE html>
<html lang="es-MX">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIESE - Gobierno de Chiapas</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;900&display=swap');
        
        :root {
            --guinda-chiapas: #8D192F;
            --rojo-chiapas: #BC1931;
            --gris-fondo: #F4F4F4;
        }
        
        body { 
            background-color: var(--gris-fondo); 
            font-family: 'Inter', sans-serif; 
        }

        .glass { 
            background: rgba(255, 255, 255, 0.9); 
            backdrop-filter: blur(10px); 
        }

        .nav-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .nav-card:hover { 
            transform: translateY(-8px); 
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
            border-color: var(--guinda-chiapas);
        }

        .bg-guinda { background-color: var(--guinda-chiapas); }
        .text-guinda { color: var(--guinda-chiapas); }
        
        .fade-in-up {
            animation: fadeInUp 0.6s ease-out forwards;
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="text-gray-800">

    <header class="bg-white border-b border-gray-200 py-6 shadow-sm relative z-30">
        <div class="flex flex-col items-center justify-center text-center">
            <h1 class="text-5xl font-black text-guinda tracking-tighter mb-0" style="letter-spacing: -0.05em;">SIESE</h1>
            <p class="text-[11px] text-gray-500 uppercase tracking-[0.3em] font-bold mt-1">Sistema Estatal de Seguimiento y Evaluación</p>
            <div class="w-full h-1.5 mt-4 bg-gradient-to-r from-transparent via-red-800/20 to-transparent"></div>
        </div>
    </header>

    <section class="relative h-[320px] overflow-hidden bg-guinda shadow-inner">
        <div class="absolute inset-0">
            <img src="https://siese.chiapas.gob.mx/wp-content/uploads/2024/12/imagen_banner5.png" class="w-full h-full object-cover opacity-90">
            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
        </div>
    </section>

    <nav class="container mx-auto -mt-10 px-4 relative z-40">
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-8 gap-4">
            <?php
            $modulos = [
                ['nombre' => 'Inicio', 'tipo' => 'icon', 'valor' => 'fa-home', 'color' => 'bg-red-700'],
                ['nombre' => 'Coplade', 'tipo' => 'icon', 'valor' => 'fa-users-gear', 'color' => 'bg-blue-800'],
                ['nombre' => 'FAIS', 'tipo' => 'img', 'valor' => 'imagenes/FAIS.png', 'color' => 'transparent'],
                ['nombre' => 'Planeación', 'tipo' => 'icon', 'valor' => 'fa-chart-line', 'color' => 'bg-purple-700'],
                ['nombre' => 'Seguimiento', 'tipo' => 'img', 'valor' => 'imagenes/Seguimiento.png', 'color' => 'transparent'],
                ['nombre' => 'Evaluación', 'tipo' => 'icon', 'valor' => 'fa-file-signature', 'color' => 'bg-blue-600'],
                ['nombre' => 'Informes de Gobierno', 'tipo' => 'icon', 'valor' => 'fa-book-open', 'color' => 'bg-rose-800'],
                ['nombre' => 'Monitor SITECC', 'tipo' => 'icon', 'valor' => 'fa-desktop', 'color' => 'bg-indigo-900'],
            ];

            foreach ($modulos as $index => $m): 
                $href = 'index.php';
                if ($m['nombre'] === 'Coplade') $href = 'coplade_info.php';
                if ($m['nombre'] === 'FAIS') $href = 'fais_info.php';
                if ($m['nombre'] === 'Planeación') $href = 'planeacion_info.php';
                if ($m['nombre'] === 'Seguimiento') $href = 'seguimiento_info.php';
                if ($m['nombre'] === 'Evaluación') $href = 'evaluacion_info.php';
                if ($m['nombre'] === 'Informes de Gobierno') $href = 'infogob_info.php';
                if ($m['nombre'] === 'Monitor SITECC') $href = 'sitecc_info.php';
            ?>
                <a href="<?= $href ?>" class="nav-card glass p-4 rounded-2xl shadow-xl text-center flex flex-col items-center justify-center border border-white/50 h-40 fade-in-up" style="animation-delay: <?= $index * 0.05 ?>s">
                    <div class="w-16 h-16 flex items-center justify-center mb-3">
                        <?php if ($m['tipo'] === 'icon'): ?>
                            <div class="<?= $m['color'] ?> w-14 h-14 rounded-2xl flex items-center justify-center text-white shadow-lg transform rotate-3">
                                <i class="fas <?= $m['valor'] ?> text-2xl"></i>
                            </div>
                        <?php else: ?>
                            <img src="<?= $m['valor'] ?>" alt="<?= $m['nombre'] ?>" class="w-full h-full object-contain drop-shadow-md">
                        <?php endif; ?>
                    </div>
                    <span class="text-[10px] font-black text-gray-700 uppercase leading-tight tracking-tighter"><?= $m['nombre'] ?></span>
                </a>
            <?php endforeach; ?>
        </div>
    </nav>

    <div class="container mx-auto mt-10 px-4">
        <div class="bg-white rounded-xl shadow-sm p-4 flex flex-wrap items-center gap-x-8 gap-y-4 text-[11px] font-bold text-gray-500 border-l-8 border-guinda uppercase tracking-wider">
            <a href="actividades_info.php" class="hover:text-guinda transition-colors flex items-center gap-2">
                <i class="fas fa-cog text-xs text-guinda"></i> Actividades
            </a>
            <span class="text-gray-200 hidden md:block">|</span>
            
            <a href="evaluacion_ped_info.php" class="hover:text-guinda transition-colors flex items-center gap-2">
                <i class="fas fa-book text-xs text-guinda"></i> Evaluación Ped-Chiapas
            </a>
            <span class="text-gray-200 hidden md:block">|</span>
            
            <a href="#" class="hover:text-guinda transition-colors flex items-center gap-2">
                <i class="fas fa-folder-open text-xs text-guinda"></i> Formatos Ped-Chiapas
            </a>
            <span class="text-gray-200 hidden md:block">|</span>

            <a href="#" class="hover:text-guinda transition-colors flex items-center gap-2">
                <i class="fas fa-chart-pie text-xs text-guinda"></i> Evaluación Programa Sectorial
            </a>
            <span class="text-gray-200 hidden md:block">|</span>

            <a href="#" class="hover:text-guinda transition-colors flex items-center gap-2">
                <i class="fas fa-eye text-xs text-guinda"></i> Visores del CONEVAL
            </a>

            <div class="ml-auto flex items-center bg-gray-50 px-4 py-2 rounded-full border border-gray-100 w-full md:w-auto">
                <input type="text" placeholder="Buscar..." class="bg-transparent border-none focus:ring-0 text-xs w-full md:w-32">
                <i class="fas fa-search text-gray-400"></i>
            </div>
        </div>
    </div>

    <main class="container mx-auto mt-12 px-4 pb-24">
        <div class="flex items-center gap-4 mb-8">
            <h3 class="text-2xl font-black text-gray-800 uppercase tracking-tighter">Actividades Recientes</h3>
            <div class="h-1 flex-1 bg-gray-200 rounded-full"></div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-white rounded-2xl shadow-md border-b-4 border-guinda overflow-hidden group hover:shadow-2xl transition-all">
                <div class="h-48 overflow-hidden bg-gray-100 relative">
                    <img src="https://siese.chiapas.gob.mx/wp-content/uploads/2024/12/primer_informe.png" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute top-4 left-4 bg-guinda text-white text-[9px] font-bold px-3 py-1 rounded-full">NUEVO</div>
                </div>
                <div class="bg-zinc-800 p-4 text-center min-h-[70px] flex items-center justify-center">
                    <h4 class="text-white text-[11px] font-bold uppercase tracking-widest leading-snug">Primer Informe de Gobierno</h4>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-md border-b-4 border-guinda overflow-hidden group">
                <div class="h-48 overflow-hidden bg-gray-100">
                    <img src="https://via.placeholder.com/400x300?text=Reuniones+de+Trabajo" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                </div>
                <div class="bg-zinc-800 p-4 text-center min-h-[70px] flex items-center justify-center">
                    <h4 class="text-white text-[11px] font-bold uppercase tracking-widest leading-snug">Reuniones de Trabajo</h4>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-md border-b-4 border-guinda overflow-hidden group">
                <div class="h-48 overflow-hidden bg-gray-100">
                    <img src="https://via.placeholder.com/400x300?text=Inicio+de+Trabajos" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                </div>
                <div class="bg-zinc-800 p-4 text-center min-h-[70px] flex items-center justify-center">
                    <h4 class="text-white text-[11px] font-bold uppercase tracking-widest leading-snug">Inicio de Trabajos del Primer Informe</h4>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-md border-b-4 border-guinda overflow-hidden group flex flex-col">
                <div class="h-48 flex flex-col items-center justify-center p-6 text-center bg-gray-50">
                    <div class="w-16 h-1 bg-guinda mb-4"></div>
                    <p class="text-guinda font-black text-xl uppercase leading-none italic">Plan Estatal</p>
                    <p class="text-guinda font-black text-sm uppercase tracking-widest">de Desarrollo</p>
                    <p class="text-gray-400 font-bold text-[10px] mt-2 border-t pt-2 border-gray-200">2025 - 2030</p>
                </div>
                <div class="bg-zinc-800 p-4 text-center min-h-[70px] flex items-center justify-center">
                    <h4 class="text-white text-[11px] font-bold uppercase tracking-widest leading-snug">Plan Estatal de Desarrollo 2025-2030</h4>
                </div>
            </div>
        </div>
    </main>

    <footer class="bg-zinc-900 text-gray-400 pt-16 pb-10 border-t-8 border-guinda">
        <div class="container mx-auto px-4 grid grid-cols-1 md:grid-cols-3 gap-16 text-center md:text-left">
            <div>
                <h5 class="text-white font-black mb-6 uppercase text-[10px] tracking-[0.2em] border-b border-zinc-800 pb-3">Contactos</h5>
                <div class="space-y-2">
                    <p class="text-[10px] font-bold uppercase tracking-tighter hover:text-white transition-colors cursor-default">Manuel Francisco Antonio Pariente Gavito</p>
                    <p class="text-[10px] font-bold uppercase tracking-tighter hover:text-white transition-colors cursor-default">José Antonio Zenteno Santiago</p>
                </div>
            </div>
            <div>
                <h5 class="text-white font-black mb-6 uppercase text-[10px] tracking-[0.2em] border-b border-zinc-800 pb-3">Visítanos</h5>
                <p class="text-[10px] font-medium leading-relaxed uppercase">Torre Chiapas, Nivel 10. Blvd. Andrés Serra Rojas. Gutiérrez, C.P. 29045.</p>
            </div>
            <div class="flex flex-col items-center md:items-end">
                <h5 class="text-white font-black mb-6 uppercase text-[10px] tracking-[0.2em] border-b border-zinc-800 pb-3 w-full text-center md:text-right">Sistema</h5>
                <p class="text-[10px] uppercase tracking-[0.3em] font-black text-zinc-600">© 2026 SIESE Chiapas</p>
                <div class="mt-4 flex gap-4 text-zinc-700">
                    <i class="fab fa-facebook-f"></i>
                    <i class="fab fa-twitter"></i>
                    <i class="fas fa-globe"></i>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>