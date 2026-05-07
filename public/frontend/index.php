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
            
            <a href="formatoPED-CHIS_info.php" class="hover:text-guinda transition-colors flex items-center gap-2">
                <i class="fas fa-folder-open text-xs text-guinda"></i> Formatos Ped-Chiapas
            </a>
            <span class="text-gray-200 hidden md:block">|</span>

            <a href="evaprogsec_info.php" class="hover:text-guinda transition-colors flex items-center gap-2">
                <i class="fas fa-chart-pie text-xs text-guinda"></i> Evaluación Programa Sectorial
            </a>
            <span class="text-gray-200 hidden md:block">|</span>

            <a href="visoresCONEVAL_info.php" class="hover:text-guinda transition-colors flex items-center gap-2">
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
        
        <div id="contenedor-actividades-recientes" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <p class="col-span-full text-center py-10 text-gray-400 animate-pulse">Cargando actividades recientes...</p>
        </div>
    </main>

   <footer style="background-color: #1a1a1a; color: #fff; padding: 40px 20px; font-family: 'Inter', sans-serif;">
    <div style="max-width: 1200px; margin: 0 auto; display: flex; flex-wrap: wrap; justify-content: space-between; gap: 30px;">
        
        <div style="flex: 1; min-width: 250px;">
            <h4 style="font-size: 11px; letter-spacing: 2px; text-transform: uppercase; margin-bottom: 20px; border-bottom: 1px solid #333; padding-bottom: 10px;">Contactos</h4>
            <p id="dinamico-contacto-1" style="font-size: 11px; color: #aaa; margin-bottom: 8px;">Cargando...</p>
            <p id="dinamico-contacto-2" style="font-size: 11px; color: #aaa;">Cargando...</p>
        </div>

        <div style="flex: 1; min-width: 250px;">
            <h4 style="font-size: 11px; letter-spacing: 2px; text-transform: uppercase; margin-bottom: 20px; border-bottom: 1px solid #333; padding-bottom: 10px;">Visítanos</h4>
            <p id="dinamico-direccion" style="font-size: 11px; color: #aaa; line-height: 1.6;">Cargando...</p>
        </div>

        <div style="flex: 1; min-width: 250px; text-align: right;">
            <h4 style="font-size: 11px; letter-spacing: 2px; text-transform: uppercase; margin-bottom: 20px; border-bottom: 1px solid #333; padding-bottom: 10px;">Sistema</h4>
            <p id="dinamico-copyright" style="font-size: 11px; color: #aaa; margin-bottom: 15px; letter-spacing: 2px;">Cargando...</p>
            
            <div style="display: flex; gap: 15px; justify-content: flex-end;">
                <a id="dinamico-fb" href="#" target="_blank" style="color: #666; display: none;"><i class="fab fa-facebook-f"></i></a>
                <a id="dinamico-tw" href="#" target="_blank" style="color: #666; display: none;"><i class="fab fa-twitter"></i></a>
                <a id="dinamico-web" href="#" target="_blank" style="color: #666; display: none;"><i class="fas fa-globe"></i></a>
            </div>
        </div>

    </div>
</footer>

<script>
    fetch('http://localhost:8000/api/footer-data')
        .then(response => response.json())
        .then(data => {
            if(data) {
                // Remplaza los textos con lo que escribiste en el panel
                document.getElementById('dinamico-contacto-1').innerText = data.contacto_1 || '';
                document.getElementById('dinamico-contacto-2').innerText = data.contacto_2 || '';
                document.getElementById('dinamico-direccion').innerText = data.direccion || '';
                document.getElementById('dinamico-copyright').innerText = data.copyright || '';
                
                // Pone los links de redes sociales
                if(data.url_facebook) { document.getElementById('dinamico-fb').href = data.url_facebook; document.getElementById('dinamico-fb').style.display = 'inline-block'; }
                if(data.url_twitter)  { document.getElementById('dinamico-tw').href = data.url_twitter; document.getElementById('dinamico-tw').style.display = 'inline-block'; }
                if(data.url_web)      { document.getElementById('dinamico-web').href = data.url_web; document.getElementById('dinamico-web').style.display = 'inline-block'; }
            }
        })
        .catch(error => console.error('Error al conectar con el panel de admin:', error));
</script>

    <script>
    let actividadesData = []; // Para guardar los datos globalmente

    async function cargarActividades() {
        const contenedor = document.getElementById('contenedor-actividades-recientes');
        try {
            const response = await fetch('/api/actividades');
            actividadesData = await response.json();

            if (actividadesData.length === 0) {
                contenedor.innerHTML = '<p class="col-span-full text-center py-10 text-gray-400">No hay actividades recientes.</p>';
                return;
            }

            const ultimasActividades = actividadesData.slice(0, 4);

            contenedor.innerHTML = ultimasActividades.map((act, index) => `
                <div onclick="abrirModal(${index})" class="cursor-pointer bg-white rounded-2xl shadow-md border-b-4 border-guinda overflow-hidden group hover:shadow-2xl transition-all fade-in-up" style="animation-delay: ${index * 0.1}s">
                    <div class="h-48 overflow-hidden bg-gray-100 relative">
                        <img src="/image/actividades/${act.imagen}" 
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                             onerror="this.src='https://via.placeholder.com/400x300?text=SIESE'">
                        ${index === 0 ? '<div class="absolute top-4 left-4 bg-guinda text-white text-[9px] font-bold px-3 py-1 rounded-full shadow-lg">NUEVO</div>' : ''}
                    </div>
                    <div class="bg-zinc-800 p-4 text-center min-h-[70px] flex items-center justify-center group-hover:bg-guinda transition-colors">
                        <h4 class="text-white text-[11px] font-bold uppercase tracking-widest leading-snug">${act.titulo}</h4>
                    </div>
                </div>
            `).join('');
        } catch (error) {
            console.error("Error al cargar actividades:", error);
            contenedor.innerHTML = '<p class="col-span-full text-center py-10 text-red-500 font-bold">Error al conectar con el servidor.</p>';
        }
    }

    function abrirModal(index) {
        const act = actividadesData[index];
        const modal = document.getElementById('modal-actividad');
        
        document.getElementById('modal-titulo').innerText = act.titulo;
        document.getElementById('modal-contenido').innerText = act.contenido || 'Sin descripción disponible.';
        document.getElementById('modal-imagen').src = `/image/actividades/${act.imagen}`;
        document.getElementById('modal-imagen').onerror = function() { this.src = 'https://via.placeholder.com/400x300?text=SIESE'; };

        // Mostrar modal con animación sencilla
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden'; // Bloquear scroll del fondo
    }

    function cerrarModal() {
        const modal = document.getElementById('modal-actividad');
        modal.classList.add('hidden');
        document.body.style.overflow = 'auto'; // Reactivar scroll
    }

    document.addEventListener('DOMContentLoaded', cargarActividades);
</script>

    <!-- Modal con Espacios Simétricos -->
<div id="modal-actividad" class="fixed inset-0 z-[100] hidden flex items-center justify-center p-4 md:p-8">
    <div class="absolute inset-0 bg-black/85 backdrop-blur-sm" onclick="cerrarModal()"></div>
    
    <!-- Contenedor Principal -->
    <div class="bg-white w-full max-w-7xl rounded-[2.5rem] overflow-hidden shadow-2xl relative z-10 flex flex-col md:flex-row h-auto max-h-[92vh]">
        
        <!-- Columna de Imagen (60%): Añadimos padding para que no pegue al borde izquierdo -->
        <div class="w-full md:w-[60%] bg-white flex items-center justify-center p-6 md:p-10">
            <div class="w-full h-full flex items-center justify-center bg-zinc-50 rounded-2xl overflow-hidden">
                <img id="modal-imagen" 
                     src="" 
                     class="max-w-full max-h-full object-contain shadow-sm" 
                     alt="Actividad">
            </div>
        </div>
        
        <!-- Columna de Texto (40%): Padding simétrico -->
        <div class="w-full md:w-[40%] p-8 md:p-12 md:pl-4 flex flex-col bg-white">
            <div class="flex justify-between items-start mb-6">
                <span class="bg-guinda text-white text-[10px] font-black px-4 py-1.5 rounded-full uppercase tracking-widest">
                    Comunicado Oficial
                </span>
                <button onclick="cerrarModal()" class="text-gray-400 hover:text-guinda transition-all">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            
            <h2 id="modal-titulo" class="text-2xl md:text-3xl font-black text-gray-800 uppercase tracking-tighter mb-6 leading-tight">
                <!-- Título -->
            </h2>
            
            <div id="modal-contenido" class="text-gray-600 leading-relaxed text-base text-justify overflow-y-auto pr-6 custom-scrollbar">
                <!-- Contenido -->
            </div>
            
            <div class="mt-auto pt-8 flex justify-between items-center border-t border-gray-50">
                <div>
                    <p class="text-[10px] font-black text-guinda uppercase tracking-widest">SIESE</p>
                    <p class="text-[9px] font-bold text-gray-400 uppercase">Gobierno de Chiapas</p>
                </div>
                <button onclick="cerrarModal()" class="bg-zinc-900 hover:bg-black text-white px-8 py-3 rounded-xl font-bold text-xs uppercase tracking-widest transition-all">
                    Cerrar ventana
                </button>
            </div>
        </div>
    </div>
</div>

<style>
    #modal-contenido {
    text-justify: inter-word;
}
/* Estilo del scroll para que no ocupe mucho espacio */
.custom-scrollbar::-webkit-scrollbar {
    width: 4px;
}
.custom-scrollbar::-webkit-scrollbar-thumb {
    background: #e5e7eb;
    border-radius: 10px;
}
    
</style>
<?php include 'footer_publico.php'; ?>
</body>
</html>