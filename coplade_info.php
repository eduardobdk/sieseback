<!DOCTYPE html>
<html lang="es-MX">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COPLADE | SIESE - Gobierno de Chiapas</title>
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
        }

        body { 
            background-color: #fcfcfc; 
            font-family: 'Inter', sans-serif;
            color: var(--slate-800);
        }

        /* Fondo de Grecas Institucional */
        .bg-grecas {
            background-color: var(--fondo-grecas);
            background-image: url('https://www.transparenttextures.com/patterns/cubes.png'); 
            background-blend-mode: overlay;
        }

        .header-institucional {
            background-color: var(--gris-evaluacion);
            color: white;
            text-align: center;
            padding: 18px;
            font-size: 20px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        /* Estilos de la nueva navegación */
        .nav-link-siese {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #64748b;
            transition: all 0.3s ease;
            position: relative;
        }

        .nav-link-siese:hover {
            color: var(--guinda-chiapas);
        }

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

        .nav-link-siese:hover::after {
            width: 100%;
        }

        /* Overlay de Bienvenida */
        #welcome-overlay {
            position: fixed;
            inset: 0;
            z-index: 100;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(15, 23, 42, 0.8);
            backdrop-filter: blur(8px);
            transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .welcome-card {
            background: white;
            border-radius: 2.5rem;
            width: 90%;
            max-width: 700px;
            overflow: hidden;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        }

        /* Tabs de años */
        .year-tab {
            transition: all 0.3s ease;
            position: relative;
            padding: 10px 20px;
            cursor: pointer;
        }
        .year-tab.active {
            color: var(--guinda-chiapas);
            font-weight: 800;
        }
        .year-tab.active::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 50%;
            transform: translateX(-50%);
            width: 25px;
            height: 3px;
            background: var(--oro-institucional);
            border-radius: 10px;
        }

        .card-sesion {
            background: white;
            border-radius: 1.5rem;
            padding: 20px;
            display: flex;
            align-items: center;
            gap: 20px;
            border: 1px solid transparent;
            transition: all 0.3s ease;
        }
        .card-sesion:hover {
            border-color: var(--guinda-chiapas);
            box-shadow: 0 10px 25px rgba(0,0,0,0.05);
            transform: translateY(-2px);
        }

        .video-preview {
            width: 120px;
            height: 80px;
            background: var(--slate-800);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .exit-animation {
            opacity: 0;
            visibility: hidden;
            transform: scale(0.95);
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(15px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade { animation: fadeIn 0.6s ease-out forwards; }
    </style>
</head>
<body class="antialiased">

    <div id="welcome-overlay">
        <div class="welcome-card animate-fade">
            <div class="h-2 bg-gradient-to-r from-[#8D192F] to-[#B88B4A]"></div>
            <div class="p-8 md:p-12">
                <div class="flex items-center gap-6 mb-8">
                    <div class="bg-[#8D192F] w-16 h-16 rounded-2xl flex items-center justify-center text-white shadow-lg">
                        <i class="fas fa-landmark text-3xl"></i>
                    </div>
                    <div>
                        <h1 class="text-3xl font-black text-slate-900 tracking-tighter uppercase">COPLADE</h1>
                        <p class="text-[10px] font-bold text-amber-600 uppercase tracking-[0.3em]">Gobierno de Chiapas</p>
                    </div>
                </div>

                <div class="space-y-6 mb-10">
                    <div class="flex gap-4">
                        <div class="w-1 bg-slate-200 rounded-full"></div>
                        <p class="text-slate-600 leading-relaxed italic text-lg font-medium">
                            "Comité de Planeación para el Desarrollo, órgano colegiado responsable de promover la participación de los sectores público, social y privado en el desarrollo integral del Estado."
                        </p>
                    </div>
                </div>

                <div class="flex justify-end">
                    <button onclick="entrarAlSistema()" class="px-10 py-4 bg-slate-900 text-white rounded-xl font-bold text-[11px] uppercase tracking-widest hover:bg-[#8D192F] transition-all shadow-xl active:scale-95">
                        Ingresar al Sistema <i class="fas fa-chevron-right ml-2"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <header class="bg-white/90 backdrop-blur-md sticky top-0 z-50 border-b border-slate-200">
        <div class="container mx-auto px-6 py-4 flex flex-col lg:flex-row justify-between items-center gap-6">
            <div class="flex items-center gap-3">
                <div class="w-1.5 bg-[#8D192F] h-6 rounded-full"></div>
                <h1 class="text-lg font-extrabold tracking-tight">SIESE <span class="font-normal text-slate-400">| COPLADE</span></h1>
            </div>

            <nav class="flex flex-wrap justify-center items-center gap-x-8 gap-y-2">
                <a href="#" class="nav-link-siese">Actividades</a>
                <a href="#" class="nav-link-siese">Evaluación PED-Chiapas</a>
                <a href="#" class="nav-link-siese">Formatos PRED-Chiapas</a>
                <a href="#" class="nav-link-siese">Evaluación Programa Sectorial</a>
                <a href="#" class="nav-link-siese">Visores del CONEVAL</a>
            </nav>

            <a href="index.php" class="group flex items-center gap-2 text-[10px] font-black uppercase tracking-widest text-slate-400 hover:text-red-800 transition-colors">
                <i class="fas fa-home transition-transform group-hover:-translate-y-0.5"></i> 
                Inicio
            </a>
        </div>
    </header>

    <main class="container mx-auto max-w-6xl px-6 py-12">
        
        <header class="mb-12 text-center animate-fade">
            <h2 class="text-5xl md:text-6xl font-black text-slate-900 mb-8 tracking-tighter uppercase">
                COPLADE
            </h2>
            <div class="max-w-5xl mx-auto bg-white p-10 md:p-12 rounded-[2.5rem] border border-slate-100 shadow-sm">
                <p class="text-slate-600 text-sm md:text-base leading-relaxed text-justify font-medium">
                    Planeación estratégica para el fortalecimiento del desarrollo integral de Chiapas. El Comité de Planeación para el Desarrollo es el órgano responsable de coordinar los esfuerzos entre los distintos órdenes de gobierno y la sociedad civil para garantizar un crecimiento ordenado y sostenible en la entidad.
                </p>
            </div>
        </header>

        <section class="animate-fade shadow-2xl rounded-[2.5rem] overflow-hidden border border-slate-200">
            <div class="header-institucional">
                Acervo de Sesiones
            </div>

            <div class="bg-grecas p-6 md:p-12">
                <div class="flex flex-wrap justify-center gap-6 mb-10 border-b border-slate-300 pb-4">
                    <?php foreach(['2021', '2022', '2023', '2024', '2025'] as $year): ?>
                        <button onclick="selectYear(this)" class="year-tab text-[12px] font-bold uppercase tracking-tighter text-slate-500 hover:text-red-800 <?= $year == '2024' ? 'active' : '' ?>">
                            <?= $year ?>
                        </button>
                    <?php endforeach; ?>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="card-sesion group cursor-pointer">
                        <div class="video-preview shrink-0 shadow-lg">
                            <i class="fas fa-play text-white text-xl group-hover:scale-125 transition-transform"></i>
                        </div>
                        <div>
                            <span class="text-[8px] font-black text-amber-600 uppercase tracking-widest mb-1 block">Comisión Permanente</span>
                            <h4 class="font-bold text-slate-800 text-[14px] leading-tight group-hover:text-red-800 transition-colors">Sesión Ordinaria</h4>
                            <div class="mt-3 flex items-center gap-3">
                                <span class="text-[9px] bg-slate-100 px-2 py-1 rounded font-bold text-slate-500 uppercase tracking-tighter">Ejercicio 2024</span>
                            </div>
                        </div>
                    </div>

                    <div class="card-sesion group cursor-pointer">
                        <div class="video-preview shrink-0 shadow-lg">
                            <i class="fas fa-play text-white text-xl group-hover:scale-125 transition-transform"></i>
                        </div>
                        <div>
                            <span class="text-[8px] font-black text-amber-600 uppercase tracking-widest mb-1 block">Subcomité Especial</span>
                            <h4 class="font-bold text-slate-800 text-[14px] leading-tight group-hover:text-red-800 transition-colors">Sesión Extraordinaria</h4>
                            <div class="mt-3 flex items-center gap-3">
                                <span class="text-[9px] bg-red-50 px-2 py-1 rounded font-bold text-red-800 uppercase tracking-tighter">Reciente</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-16 text-center py-16 bg-white/40 border-2 border-dashed border-slate-300 rounded-[2rem] backdrop-blur-sm">
                    <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mx-auto mb-4 shadow-sm">
                        <i class="fas fa-folder-open text-slate-300 text-2xl"></i>
                    </div>
                    <p class="text-slate-400 font-bold text-[10px] uppercase tracking-[0.2em]">Esperando información actualizada...</p>
                </div>
            </div>

            <div class="bg-white px-8 py-6 border-t border-slate-100 flex justify-between items-center">
                <p class="text-[9px] text-slate-400 font-bold uppercase tracking-[0.2em]">Secretaría de Hacienda | Chiapas 2026</p>
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/cf/Coat_of_arms_of_Chiapas.svg/1200px-Coat_of_arms_of_Chiapas.svg.png" class="h-8 opacity-20 grayscale" alt="Escudo">
            </div>
        </section>
    </main>

    <script>
        function entrarAlSistema() {
            const overlay = document.getElementById('welcome-overlay');
            overlay.classList.add('exit-animation');
            setTimeout(() => {
                overlay.style.display = 'none';
            }, 600);
        }

        function selectYear(element) {
            document.querySelectorAll('.year-tab').forEach(tab => tab.classList.remove('active'));
            element.classList.add('active');
        }
    </script>
</body>
</html>