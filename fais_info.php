<!DOCTYPE html>
<html lang="es-MX">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAIS | SIESE - Gobierno de Chiapas</title>
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

        /* Fondo de Grecas Institucional */
        .bg-grecas {
            background-color: var(--fondo-grecas);
            background-image: url('https://www.transparenttextures.com/patterns/cubes.png'); 
            background-blend-mode: overlay;
        }

        .header-evaluacion {
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

        /* Tarjetas de Comunicaciones */
        .card-comunicacion {
            background: white;
            border-radius: 1rem;
            border: 1px solid var(--slate-200);
            transition: all 0.3s ease;
        }
        .card-comunicacion:hover {
            border-color: var(--guinda-chiapas);
            box-shadow: 0 10px 20px -5px rgba(141, 25, 47, 0.05);
            transform: translateY(-2px);
        }

        /* Tarjetas de Descarga */
        .card-descarga {
            background: white;
            border-radius: 1.5rem;
            padding: 24px;
            display: flex;
            align-items: center;
            gap: 24px;
            border: 1px solid transparent;
            transition: all 0.3s ease;
        }
        .card-descarga:hover {
            border-color: var(--slate-200);
            box-shadow: 0 8px 30px rgba(0,0,0,0.04);
        }

        .doc-preview {
            width: 70px;
            height: 90px;
            background: #f8fafc;
            border: 1px solid #f1f5f9;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            position: relative;
            border-radius: 12px;
        }
        .doc-preview::after {
            content: '';
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 4px;
            background: var(--guinda-chiapas);
            border-radius: 0 0 12px 12px;
        }

        /* Tabs de Años */
        .year-tab {
            transition: all 0.3s ease;
            position: relative;
            padding: 8px 16px;
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
            width: 20px;
            height: 3px;
            background: var(--oro-institucional);
            border-radius: 10px;
        }

        .btn-descargar {
            background: var(--slate-800);
            color: white;
            padding: 8px 20px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        .btn-descargar:hover { background: var(--guinda-chiapas); transform: scale(1.02); }

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
                <h1 class="text-lg font-extrabold tracking-tight">SIESE <span class="font-normal text-slate-400">| FAIS</span></h1>
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
        
        <header class="mb-16 text-center animate-fade">
            <h2 class="text-5xl md:text-6xl font-black text-slate-900 mb-8 tracking-tighter uppercase">
                FAIS / FISE / FISMDF
            </h2>
            <div class="max-w-5xl mx-auto bg-white p-10 md:p-12 rounded-[2.5rem] border border-slate-100 shadow-sm">
                <p class="text-slate-600 text-sm md:text-base leading-relaxed text-justify font-medium">
                    Información estratégica para la planeación y consulta técnica del Fondo de Aportaciones para la Infraestructura Social. Fortalece el proceso de transparencia y rendición de cuentas, permitiendo conocer el marco jurídico y técnico que rige la ejecución de los recursos federales destinados al estado y sus municipios.
                </p>
            </div>
        </header>

        <section class="mb-20 animate-fade">
            <div class="flex items-center gap-3 mb-8">
                <div class="w-2 h-2 bg-red-800 rounded-full"></div>
                <h3 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Comunicaciones Relevantes</h3>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                <?php 
                $comms = [
                    ['icon' => 'fa-envelope-open-text', 'title' => 'Oficios Circulares', 'desc' => 'Lineamientos oficiales de Hacienda.'],
                    ['icon' => 'fa-info-circle', 'title' => 'Avisos Generales', 'desc' => 'Notificaciones para entes ejecutores.'],
                    ['icon' => 'fa-calendar-check', 'title' => 'Calendario FAIS', 'desc' => 'Periodos de carga y validación.'],
                    ['icon' => 'fa-signature', 'title' => 'Minutas y Acuerdos', 'desc' => 'Registros de sesiones oficiales.']
                ];
                foreach($comms as $c): ?>
                <div class="card-comunicacion p-6 cursor-pointer group">
                    <div class="w-10 h-10 rounded-xl bg-slate-50 flex items-center justify-center mb-4 text-slate-400 group-hover:text-red-800 transition-colors">
                        <i class="fas <?= $c['icon'] ?> text-sm"></i>
                    </div>
                    <h4 class="text-[11px] font-bold text-slate-800 uppercase mb-2"><?= $c['title'] ?></h4>
                    <p class="text-[10px] text-slate-500 leading-relaxed"><?= $c['desc'] ?></p>
                </div>
                <?php endforeach; ?>
            </div>
        </section>

        <section class="animate-fade shadow-2xl rounded-[2rem] overflow-hidden border border-slate-200">
            <div class="header-evaluacion">
                Normateca FAIS
            </div>

            <div class="bg-grecas p-6 md:p-12">
                <div class="flex flex-wrap justify-center gap-4 mb-10 bg-white/50 backdrop-blur-sm p-2 rounded-2xl w-fit mx-auto border border-white">
                    <?php foreach(['2022', '2023', '2024', '2025', '2026'] as $year): ?>
                        <button onclick="selectYear(this)" class="year-tab text-[11px] font-bold uppercase tracking-widest text-slate-400 hover:text-slate-800 <?= $year == '2026' ? 'active' : '' ?>">
                            <?= $year ?>
                        </button>
                    <?php endforeach; ?>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div class="card-descarga">
                        <div class="doc-preview shrink-0">
                            <span class="text-[7px] font-black text-red-800 mb-1">PDF</span>
                            <i class="fas fa-file-pdf text-xl text-slate-300"></i>
                        </div>
                        <div>
                            <h5 class="font-bold text-slate-800 text-xs mb-3 uppercase tracking-tight">Instrumentos Normativos</h5>
                            <button class="btn-descargar"><i class="fas fa-download"></i> Descargar</button>
                        </div>
                    </div>
                    <div class="card-descarga">
                        <div class="doc-preview shrink-0">
                            <span class="text-[7px] font-black text-red-800 mb-1">GUÍA</span>
                            <i class="fas fa-chalkboard text-xl text-slate-300"></i>
                        </div>
                        <div>
                            <h5 class="font-bold text-slate-800 text-xs mb-3 uppercase tracking-tight">Capacitación Técnica</h5>
                            <button class="btn-descargar"><i class="fas fa-download"></i> Descargar</button>
                        </div>
                    </div>
                    <div class="card-descarga">
                        <div class="doc-preview shrink-0">
                            <span class="text-[7px] font-black text-red-800 mb-1">ZIP</span>
                            <i class="fas fa-folder-open text-xl text-slate-300"></i>
                        </div>
                        <div>
                            <h5 class="font-bold text-slate-800 text-xs mb-3 uppercase tracking-tight">Manuales y Anexos</h5>
                            <button class="btn-descargar"><i class="fas fa-download"></i> Descargar</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="bg-white px-8 py-4 border-t border-slate-100 flex justify-between items-center">
                <p class="text-[9px] text-slate-400 font-bold uppercase tracking-[0.2em]">Sincronizado con el Ciclo Operativo 2026</p>
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/cf/Coat_of_arms_of_Chiapas.svg/1200px-Coat_of_arms_of_Chiapas.svg.png" class="h-6 opacity-20 grayscale" alt="Escudo">
            </div>
        </section>

        <footer class="mt-20 py-8 text-center text-slate-300 text-[10px] font-bold uppercase tracking-widest border-t border-slate-100">
            Secretaría de Hacienda | Gobierno de Chiapas 2026
        </footer>
    </main>

    <script>
        function selectYear(element) {
            document.querySelectorAll('.year-tab').forEach(tab => tab.classList.remove('active'));
            element.classList.add('active');
            console.log("Filtrando año: " + element.innerText.trim());
        }
    </script>
</body>
</html>