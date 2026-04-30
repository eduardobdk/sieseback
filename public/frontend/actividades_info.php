<!DOCTYPE html>
<html lang="es-MX">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuestras Actividades | SIESE</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;900&display=swap');
        
        :root { 
            --guinda-chiapas: #8D192F; 
            --gris-claro: #F4F4F4;
        }

        body { 
            background-color: var(--gris-claro);
            font-family: 'Inter', sans-serif; 
        }

        .bg-guinda { background-color: var(--guinda-chiapas); }
        .text-guinda { color: var(--guinda-chiapas); }
        
        .main-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(5px);
            border-radius: 2rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .activity-row {
            transition: all 0.2s ease;
            border-bottom: 1px solid #f0f0f0;
            cursor: pointer;
        }

        .activity-row:hover {
            background-color: #f9fafb;
            transform: translateX(5px);
        }

        .scroll-enabled {
            max-height: 500px;
            overflow-y: auto;
            padding-right: 10px;
        }

        .scroll-enabled::-webkit-scrollbar { width: 6px; }
        .scroll-enabled::-webkit-scrollbar-track { background: #f1f1f1; border-radius: 10px; }
        .scroll-enabled::-webkit-scrollbar-thumb { background: #8D192F; border-radius: 10px; }

        /* Estilos específicos para el Modal */
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #e5e7eb; border-radius: 10px; }
        
        .loader {
            height: 20px;
            background: #ececec;
            border-radius: 4px;
            margin: 10px 0;
            animation: pulse 1.5s infinite;
        }
        @keyframes pulse { 0% { opacity: 0.5; } 50% { opacity: 1; } 100% { opacity: 0.5; } }
    </style>
</head>
<body class="text-gray-800 antialiased">

    <header class="bg-white/80 backdrop-blur-md border-b border-gray-200 py-4 sticky top-0 z-50">
        <div class="container mx-auto px-6 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <div class="w-1 bg-guinda h-6 rounded-full"></div>
                <h1 class="text-xl font-black tracking-tighter text-gray-800">SIESE <span class="font-light text-gray-400">| ACTIVIDADES</span></h1>
            </div>
            <a href="index.php" class="text-[10px] font-black uppercase tracking-widest text-gray-400 hover:text-guinda transition-colors">
                <i class="fas fa-home mr-1"></i> Inicio
            </a>
        </div>
    </header>

    <main class="container mx-auto max-w-5xl px-4 py-10">
        <div class="bg-zinc-800 rounded-t-2xl py-4 text-center shadow-lg">
            <h2 class="text-white font-bold text-2xl tracking-tight">Listado Histórico</h2>
        </div>

        <div class="main-container p-6 md:p-10 -mt-1">
            <div id="contenedor-actividades" class="space-y-2 transition-all duration-500">
                <!-- Se carga vía JS -->
            </div>

            <div id="btn-container" class="mt-10 flex justify-center hidden">
                <button onclick="activarScroll()" class="bg-gray-100 hover:bg-gray-200 text-gray-600 px-6 py-2 rounded-lg border border-gray-300 text-sm font-bold transition-all shadow-sm">
                    Ver más actividades
                </button>
            </div>
        </div>
    </main>

    <!-- VENTANA EMERGENTE (MODAL EXTRA GRANDE Y EQUILIBRADO) -->
    <div id="modal-actividad" class="fixed inset-0 z-[100] hidden flex items-center justify-center p-4 md:p-8">
        <div class="absolute inset-0 bg-black/85 backdrop-blur-sm" onclick="cerrarModal()"></div>
        
        <div class="bg-white w-full max-w-7xl rounded-[2.5rem] overflow-hidden shadow-2xl relative z-10 flex flex-col md:flex-row h-auto max-h-[92vh]">
            
            <!-- Lado Imagen (60%) con padding simétrico -->
            <div class="w-full md:w-[60%] bg-white flex items-center justify-center p-6 md:p-10 border-r border-gray-50">
                <div class="w-full h-full flex items-center justify-center bg-zinc-50 rounded-2xl overflow-hidden shadow-inner">
                    <img id="modal-imagen" src="" class="max-w-full max-h-full object-contain block mx-auto" alt="Actividad">
                </div>
            </div>
            
            <!-- Lado Texto (40%) -->
            <div class="w-full md:w-[40%] p-8 md:p-12 md:pl-6 flex flex-col bg-white">
                <div class="flex justify-between items-start mb-6">
                    <span class="bg-guinda text-white text-[10px] font-black px-4 py-1.5 rounded-full uppercase tracking-widest">
                        Comunicado Oficial
                    </span>
                    <button onclick="cerrarModal()" class="text-gray-400 hover:text-guinda transition-all">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
                
                <h2 id="modal-titulo" class="text-2xl md:text-3xl font-black text-gray-800 uppercase tracking-tighter mb-6 leading-tight"></h2>
                
                <div id="modal-contenido" class="text-gray-600 leading-relaxed text-base text-justify overflow-y-auto pr-6 custom-scrollbar" style="text-justify: inter-word;">
                    <!-- Contenido dinámico -->
                </div>
                
                <div class="mt-auto pt-8 flex justify-between items-center border-t border-gray-50">
                    <div>
                        <p class="text-[10px] font-black text-guinda uppercase tracking-widest">SIESE</p>
                        <p class="text-[9px] font-bold text-gray-400 uppercase">Chiapas 2026</p>
                    </div>
                    <button onclick="cerrarModal()" class="bg-zinc-900 hover:bg-black text-white px-8 py-3 rounded-xl font-bold text-xs uppercase tracking-widest transition-all">
                        Cerrar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <footer class="py-8 text-center">
        <p class="text-[10px] text-gray-400 font-black uppercase tracking-[0.4em]">Secretaría de Hacienda | Chiapas 2026</p>
    </footer>

    <script>
        let actividadesGlobal = [];

        async function cargarActividades() {
            const contenedor = document.getElementById('contenedor-actividades');
            const btnContainer = document.getElementById('btn-container');

            try {
                const response = await fetch('/api/actividades');
                actividadesGlobal = await response.json();

                if (actividadesGlobal.length === 0) {
                    contenedor.innerHTML = '<p class="text-center py-10 text-gray-400">No hay actividades publicadas actualmente.</p>';
                    return;
                }

                contenedor.innerHTML = actividadesGlobal.map((act, index) => `
                    <div onclick="abrirModal(${index})" class="activity-row flex items-center p-4 gap-6">
                        <div class="w-32 h-20 flex-shrink-0 rounded-lg overflow-hidden border border-gray-200 shadow-sm bg-gray-50">
                            <img src="/image/actividades/${act.imagen}" 
                                 class="w-full h-full object-cover"
                                 onerror="this.src='https://via.placeholder.com/150?text=SIESE'">
                        </div>
                        <div class="flex-1">
                            <h4 class="text-gray-700 font-semibold text-base">${act.titulo}</h4>
                            <p class="text-xs text-gray-400 uppercase tracking-tighter">${new Date(act.created_at).toLocaleDateString('es-MX', { day: 'numeric', month: 'long', year: 'numeric' })}</p>
                        </div>
                        <div class="text-guinda opacity-30 hover:opacity-100 transition-opacity">
                            <i class="fas fa-expand-alt"></i>
                        </div>
                    </div>
                `).join('');

                if (actividadesGlobal.length > 4) {
                    btnContainer.classList.remove('hidden');
                }

            } catch (error) {
                contenedor.innerHTML = '<p class="text-center py-10 text-red-400">Error al conectar con el servidor.</p>';
            }
        }

        function abrirModal(index) {
            const act = actividadesGlobal[index];
            document.getElementById('modal-titulo').innerText = act.titulo;
            document.getElementById('modal-contenido').innerText = act.contenido || 'Sin descripción disponible.';
            document.getElementById('modal-imagen').src = `/image/actividades/${act.imagen}`;
            document.getElementById('modal-imagen').onerror = function() { this.src = 'https://via.placeholder.com/800?text=Imagen+no+disponible'; };
            
            document.getElementById('modal-actividad').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function cerrarModal() {
            document.getElementById('modal-actividad').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        function activarScroll() {
            document.getElementById('contenedor-actividades').classList.add('scroll-enabled');
            document.getElementById('btn-container').style.display = 'none';
        }

        document.addEventListener('DOMContentLoaded', cargarActividades);
    </script>
</body>
</html>