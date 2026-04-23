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
        
        /* Skeleton loader para cuando carga */
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
            <h2 class="text-white font-bold text-2xl tracking-tight">Nuestras Actividades</h2>
        </div>

        <div class="main-container p-6 md:p-10 -mt-1">
            
            <div id="contenedor-actividades" class="space-y-2 transition-all duration-500">
                <div class="p-4 text-center text-gray-500">
                    <div class="loader w-full"></div>
                    <div class="loader w-3/4 mx-auto"></div>
                    Cargando actividades...
                </div>
            </div>

            <div id="btn-container" class="mt-10 flex justify-center hidden">
                <button onclick="activarScroll()" class="bg-gray-100 hover:bg-gray-200 text-gray-600 px-6 py-2 rounded-lg border border-gray-300 text-sm font-bold transition-all shadow-sm">
                    Ver más actividades
                </button>
            </div>
        </div>
    </main>

    <footer class="py-8 text-center">
        <p class="text-[10px] text-gray-400 font-black uppercase tracking-[0.4em]">Secretaría de Hacienda | Chiapas 2026</p>
    </footer>

    <script>
        // 1. Cargar datos desde la API de Laravel
        async function cargarActividades() {
            const contenedor = document.getElementById('contenedor-actividades');
            const btnContainer = document.getElementById('btn-container');

            try {
                // Ajusta la URL si tu proyecto corre en otra carpeta o puerto
                const response = await fetch('/api/actividades');
                const actividades = await response.json();

                if (actividades.length === 0) {
                    contenedor.innerHTML = '<p class="text-center py-10 text-gray-400">No hay actividades publicadas actualmente.</p>';
                    return;
                }

                // Generar el HTML dinámicamente
                contenedor.innerHTML = actividades.map(act => `
                    <div class="activity-row flex items-center p-4 gap-6">
                        <div class="w-32 h-20 flex-shrink-0 rounded-lg overflow-hidden border border-gray-200 shadow-sm bg-gray-50">
                            <img src="/image/actividades/${act.imagen}" 
                                 alt="${act.titulo}" 
                                 class="w-full h-full object-cover"
                                 onerror="this.src='https://via.placeholder.com/150?text=SIESE'">
                        </div>
                        <div class="flex-1">
                            <h4 class="text-gray-700 font-semibold text-base">${act.titulo}</h4>
                            <p class="text-xs text-gray-400 uppercase tracking-tighter">${new Date(act.created_at).toLocaleDateString()}</p>
                        </div>
                        <a href="#" class="text-guinda hover:scale-110 transition-transform">
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    </div>
                `).join('');

                // Mostrar botón "Ver más" solo si hay muchas actividades (ej. más de 4)
                if (actividades.length > 4) {
                    btnContainer.classList.remove('hidden');
                }

            } catch (error) {
                console.error("Error cargando actividades:", error);
                contenedor.innerHTML = '<p class="text-center py-10 text-red-400">Error al conectar con el servidor.</p>';
            }
        }

        function activarScroll() {
            const contenedor = document.getElementById('contenedor-actividades');
            const boton = document.getElementById('btn-container');
            
            contenedor.classList.add('scroll-enabled');
            boton.style.display = 'none';
        }

        // Ejecutar al cargar la página
        document.addEventListener('DOMContentLoaded', cargarActividades);
    </script>
</body>
</html>