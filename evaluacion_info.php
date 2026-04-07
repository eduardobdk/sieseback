<!DOCTYPE html>
<html lang="es-MX">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evaluación | SIESE - Gobierno de Chiapas</title>
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
                <h1 class="text-xl font-extrabold tracking-tighter text-slate-800">SIESE <span class="font-light text-slate-400">| EVALUACIÓN</span></h1>
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
                Sistema de <span class="title-gradient">Evaluación</span>
            </h2>
            
            <div class="max-w-4xl mx-auto bg-white p-8 md:p-12 rounded-3xl border border-slate-100 shadow-sm">
                <p class="text-slate-600 text-sm md:text-base leading-relaxed text-justify">
                    Valorar y orientar la gestión pública; así mismo, fortalece el proceso de toma de decisiones para avanzar con certidumbre en la atención de políticas públicas y su implementación de programas que permite conocer los resultados obtenidos en el corto, mediano y largo plazo, con lo cual se abona desde un principio al proceso de transparencia y rendición de cuentas en el ámbito gubernamental.
                </p>
            </div>
        </section>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 fade-up" style="animation-delay: 0.2s;">
            
            <article class="card-modern rounded-3xl p-8 flex flex-col h-full">
                <div class="flex items-start justify-between mb-8">
                    <div class="p-4 bg-slate-50 rounded-2xl">
                        <i class="fas fa-file-signature text-3xl text-red-800"></i>
                    </div>
                    <span class="text-[9px] font-bold px-3 py-1 bg-red-50 text-red-800 rounded-full uppercase tracking-tighter">Plan Estatal</span>
                </div>
                
                <h3 class="text-xl font-bold text-slate-800 mb-2">PED-Chiapas 2025-2030</h3>
                <p class="text-xs text-slate-400 leading-relaxed mb-8 flex-grow">
                    Instrumento de evaluación del Plan Estatal de Desarrollo enfocado en el cumplimiento de los ejes estratégicos institucionales.
                </p>

                <div class="mt-auto">
                    <div class="bg-slate-50 border border-dashed border-slate-200 rounded-2xl p-6 text-center group">
                        <p class="text-[10px] font-bold text-slate-400 uppercase mb-4 tracking-wide italic">Información en proceso de carga</p>
                        <button class="btn-gov w-full text-white text-[11px] font-bold py-4 rounded-xl shadow-lg shadow-red-900/20 uppercase tracking-widest flex items-center justify-center gap-3">
                            <i class="fas fa-file-pdf"></i> Descargar Documento
                        </button>
                    </div>
                </div>
            </article>

            <article class="card-modern rounded-3xl p-8 flex flex-col h-full">
                <div class="flex items-start justify-between mb-8">
                    <div class="p-4 bg-slate-50 rounded-2xl">
                        <i class="fas fa-layer-group text-3xl text-red-800"></i>
                    </div>
                    <span class="text-[9px] font-bold px-3 py-1 bg-slate-100 text-slate-500 rounded-full uppercase tracking-tighter">Sectorial</span>
                </div>
                
                <h3 class="text-xl font-bold text-slate-800 mb-2">Programas Sectoriales</h3>
                <p class="text-xs text-slate-400 leading-relaxed mb-8 flex-grow">
                    Resultados obtenidos en los programas por sector, evaluando el impacto directo en la población y la eficiencia del gasto público.
                </p>

                <div class="mt-auto">
                    <div class="bg-slate-50 border border-dashed border-slate-200 rounded-2xl p-6 text-center group">
                        <p class="text-[10px] font-bold text-slate-400 uppercase mb-4 tracking-wide italic">Esperando archivos del sistema</p>
                        <button class="btn-gov w-full text-white text-[11px] font-bold py-4 rounded-xl shadow-lg shadow-red-900/20 uppercase tracking-widest flex items-center justify-center gap-3">
                            <i class="fas fa-chart-pie"></i> Ver Reporte Detallado
                        </button>
                    </div>
                </div>
            </article>

        </div>

        <footer class="mt-24 pt-8 border-t border-slate-200 flex flex-col md:flex-row justify-between items-center gap-4">
            <p class="text-[10px] font-bold text-slate-300 uppercase tracking-[0.4em]">Gobierno de Chiapas</p>
            <div class="flex gap-6">
                <i class="fab fa-facebook text-slate-200 hover:text-red-800 transition-colors"></i>
                <i class="fab fa-twitter text-slate-200 hover:text-red-800 transition-colors"></i>
                <i class="fas fa-globe text-slate-200 hover:text-red-800 transition-colors"></i>
            </div>
        </footer>

    </main>

</body>
</html>