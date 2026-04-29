<!DOCTYPE html>
<html lang="es-MX">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evaluación Programada Sectorial | SIESE</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;900&display=swap');
        
        :root { 
            --gob-guinda: #8D192F; 
            --gob-guinda-soft: #f4e8ea;
        }

        body { background-color: #f8fafc; font-family: 'Inter', sans-serif; }
        
        .main-container {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(5px);
            border-radius: 2rem; 
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            overflow: hidden;
        }

        /* Estilo de Cuadrícula */
        .grid-docs-sectorial {
            max-height: 700px;
            overflow-y: auto;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 25px;
            padding: 10px;
        }

        .grid-docs-sectorial::-webkit-scrollbar { width: 6px; }
        .grid-docs-sectorial::-webkit-scrollbar-track { background: #f1f1f1; border-radius: 10px; }
        .grid-docs-sectorial::-webkit-scrollbar-thumb { background: var(--gob-guinda); border-radius: 10px; }

        .sectorial-card {
            border: 1px solid #eef2f6;
            border-radius: 1.25rem;
            background: white;
            padding: 24px;
            display: flex;
            flex-direction: column;
            height: 100%;
            transition: all 0.3s ease;
            position: relative;
        }

        .sectorial-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 20px -5px rgba(0,0,0,0.08);
            border-color: var(--gob-guinda);
        }

        .icon-badge {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--gob-guinda-soft);
            color: var(--gob-guinda);
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
        }
    </style>
</head>
<body class="text-gray-800 antialiased">

    <header class="bg-white/80 backdrop-blur-md border-b border-gray-200 py-4 sticky top-0 z-50">
        <div class="container mx-auto px-6 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <div class="w-1 bg-[#8D192F] h-6 rounded-full"></div>
                <h1 class="text-xl font-black tracking-tighter text-gray-800">
                    SIESE <span class="font-light text-gray-400">| Evaluación Sectorial</span>
                </h1>
            </div>
            <a href="index.php" class="text-[10px] font-black uppercase tracking-widest text-gray-400 hover:text-[#8D192F] transition-colors">
                <i class="fas fa-home mr-1"></i> Inicio
            </a>
        </div>
    </header>

    <main class="container mx-auto max-w-6xl px-4 py-10">
        
        <div class="main-container">
            <div class="bg-[#F2F2F2] px-8 py-5 flex items-center justify-between border-b border-gray-200">
                <div class="flex items-center gap-4">
                    <div class="text-3xl text-[#8D192F]">
                        <i class="fas fa-chart-pie"></i>
                    </div>
                    <div class="h-10 w-0.5 bg-gray-300 rounded-full"></div>
                    <h2 class="text-gray-900 font-extrabold text-2xl tracking-tighter">Evaluación Programada Sectorial</h2>
                </div>
                <div class="hidden md:block text-right">
                    <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Periodo Vigente</span>
                    <p class="text-xs font-bold text-black">Sistemas de Monitoreo</p>
                </div>
            </div>

            <div class="p-6 md:p-10">
                <div class="mb-10 flex items-center justify-between">
                    <div>
                        <p class="text-sm font-semibold text-gray-500 uppercase tracking-widest">Documentos de Seguimiento Sectorial</p>
                        <div class="h-1 w-20 bg-[#8D192F] mt-2 rounded-full"></div>
                    </div>
                </div>

                <div id="grid-evaluacion-sectorial" class="grid-docs-sectorial">
                    <div class="col-span-full text-center py-20">
                        <i class="fas fa-circle-notch animate-spin text-3xl text-[#8D192F]"></i>
                        <p class="mt-4 text-gray-400 font-medium">Cargando base de datos sectorial...</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-gray-50 px-10 py-5 border-t border-gray-100 flex justify-between items-center">
                <p class="text-[9px] text-gray-400 font-bold uppercase tracking-[0.5em]">Gobierno del Estado de Chiapas</p>
                <p class="text-[9px] text-gray-400 font-bold uppercase tracking-[0.5em]">Hacienda 2026</p>
            </div>
        </div>

    </main>

    <script>
        async function cargarEvaluacionesSectoriales() {
            const contenedor = document.getElementById('grid-evaluacion-sectorial');
            try {
                const response = await fetch('http://127.0.0.1:8000/api/documentos?seccion=evaluacion_sectorial');
                const documentos = await response.json();

                if (documentos.length === 0) {
                    contenedor.innerHTML = `
                        <div class="col-span-full text-center py-20 bg-gray-50 rounded-3xl border-2 border-dashed border-gray-200">
                            <i class="fas fa-folder-open text-gray-200 text-6xl mb-4"></i>
                            <p class="text-gray-400 font-bold">No se encontraron documentos sectoriales publicados.</p>
                        </div>`;
                    return;
                }

                contenedor.innerHTML = documentos.map(doc => `
                    <div class="sectorial-card">
                        <div class="flex-grow">
                            <div class="icon-badge">
                                <i class="fas fa-file-invoice"></i>
                            </div>
                            <h3 class="font-bold text-gray-800 text-base leading-tight mb-4 min-h-[3rem]">
                                ${doc.titulo}
                            </h3>
                        </div>
                        
                        <div class="mt-6">
                            <div class="flex justify-between items-center mb-4 text-[10px] text-gray-400 font-bold uppercase">
                                <span><i class="far fa-calendar-alt mr-1"></i> ${new Date(doc.created_at).toLocaleDateString('es-MX')}</span>
                                <span class="text-[#8D192F]">${doc.extension.toUpperCase()}</span>
                            </div>
                            
                            <a href="http://127.0.0.1:8000/storage/documentos/${doc.archivo}" 
                            target="_blank" 
                            class="flex items-center justify-center gap-2 w-full bg-slate-800 hover:bg-[#8D192F] text-white text-xs font-bold py-3 rounded-xl transition-all shadow-md active:scale-95">
                                <i class="fas fa-external-link-alt"></i> Consultar Documento
                            </a>
                        </div>
                    </div>
                `).join('');

            } catch (error) {
                contenedor.innerHTML = `<p class="col-span-full text-center text-red-500 font-bold">Error: No se pudo establecer conexión con el servidor SIESE.</p>`;
            }
        }

        document.addEventListener('DOMContentLoaded', cargarEvaluacionesSectoriales);
    </script>
</body>
</html>