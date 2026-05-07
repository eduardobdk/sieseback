<?php
// PHP queda vacío porque ahora Fetch (JS) hará el trabajo pesado
?>

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
        body { background-color: #fcfcfc; font-family: 'Inter', sans-serif; color: var(--slate-800); }
        .bg-grecas { background-color: var(--fondo-grecas); background-image: url('https://www.transparenttextures.com/patterns/cubes.png'); background-blend-mode: overlay; }
        .header-institucional { background-color: var(--gris-evaluacion); color: white; text-align: center; padding: 18px; font-size: 20px; font-weight: 800; text-transform: uppercase; letter-spacing: 2px; }
        .nav-link-siese { font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; color: #64748b; transition: all 0.3s ease; position: relative; }
        .nav-link-siese:hover { color: var(--guinda-chiapas); }
        #welcome-overlay { position: fixed; inset: 0; z-index: 100; display: flex; align-items: center; justify-content: center; background: rgba(15, 23, 42, 0.8); backdrop-filter: blur(8px); transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1); }
        .welcome-card { background: white; border-radius: 2.5rem; width: 90%; max-width: 700px; overflow: hidden; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5); }
        .year-tab { transition: all 0.3s ease; position: relative; padding: 10px 20px; cursor: pointer; }
        .year-tab.active { color: var(--guinda-chiapas); font-weight: 800; }
        .year-tab.active::after { content: ''; position: absolute; bottom: -2px; left: 50%; transform: translateX(-50%); width: 25px; height: 3px; background: var(--oro-institucional); border-radius: 10px; }
        .card-sesion { background: white; border-radius: 1.5rem; padding: 20px; display: flex; align-items: center; gap: 20px; border: 1px solid transparent; transition: all 0.3s ease; }
        .card-sesion:hover { border-color: var(--guinda-chiapas); transform: translateY(-2px); }
        .video-preview { width: 120px; height: 80px; background: var(--slate-800); border-radius: 12px; display: flex; align-items: center; justify-content: center; overflow: hidden; }
        .exit-animation { opacity: 0; visibility: hidden; transform: scale(0.95); }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(15px); } to { opacity: 1; transform: translateY(0); } }
        .animate-fade { animation: fadeIn 0.6s ease-out forwards; }
        
        /* Estilos para el HTML de CKEditor dentro del Modal */
        #modal-detalle p { margin-bottom: 10px; }
        #modal-detalle ul { list-style-type: disc; margin-left: 20px; margin-bottom: 10px; }
        #modal-detalle ol { list-style-type: decimal; margin-left: 20px; margin-bottom: 10px; }
        #modal-detalle strong, #modal-detalle b { font-weight: bold; color: #fff; }
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
                        <h1 id="dyn-titulo-overlay" class="text-3xl font-black text-slate-900 tracking-tighter uppercase">Cargando...</h1>
                        <p id="dyn-subtitulo" class="text-[10px] font-bold text-amber-600 uppercase tracking-[0.3em]">SIESE</p>
                    </div>
                </div>
                <div class="space-y-6 mb-10">
                    <div class="flex gap-4">
                        <div class="w-1 bg-slate-200 rounded-full"></div>
                        <p id="dyn-descripcion-overlay" class="text-slate-600 leading-relaxed italic text-lg font-medium">...</p>
                    </div>
                </div>
                <div class="flex justify-end">
                    <button onclick="entrarAlSistema()" class="px-10 py-4 bg-slate-900 text-white rounded-xl font-bold text-[11px] uppercase tracking-widest hover:bg-[#8D192F] transition-all shadow-xl">
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
            <a href="index.php" class="text-[10px] font-black uppercase text-slate-400 hover:text-red-800"><i class="fas fa-home"></i> Inicio</a>
        </div>
    </header>

    <main class="container mx-auto max-w-6xl px-6 py-12">
        <header class="mb-12 text-center animate-fade">
            <h2 id="dyn-titulo-main" class="text-5xl md:text-6xl font-black text-slate-900 mb-8 tracking-tighter uppercase">COPLADE</h2>
            <div class="max-w-5xl mx-auto bg-white p-10 rounded-[2.5rem] border border-slate-100 shadow-sm">
                <p id="dyn-descripcion-main" class="text-slate-600 text-sm md:text-base leading-relaxed text-justify font-medium">Cargando información...</p>
            </div>
        </header>

        <section class="animate-fade shadow-2xl rounded-[2.5rem] overflow-hidden border border-slate-200">
            <div class="header-institucional">Acervo de Sesiones</div>
            <div class="bg-grecas p-6 md:p-12">
                
                <div id="dyn-tabs" class="flex flex-wrap justify-center gap-6 mb-10 border-b border-slate-300 pb-4">
                    <p class="text-slate-400 text-[10px] uppercase">Buscando ejercicios...</p>
                </div>

                <div id="dyn-sesiones" class="grid grid-cols-1 md:grid-cols-2 gap-8">
                </div>
            </div>
        </section>
    </main>

    <div id="modal-imagen" class="fixed inset-0 z-[200] hidden items-center justify-center bg-black/60 backdrop-blur-md p-4 transition-all duration-300 opacity-0">
        <button onclick="cerrarModal()" class="absolute top-6 right-6 md:top-10 md:right-10 text-white hover:text-red-500 text-4xl md:text-5xl transition-colors drop-shadow-md">
            <i class="fas fa-times"></i>
        </button>
        
        <div class="max-w-4xl w-full flex flex-col items-center">
            <img id="modal-img-src" src="" alt="Sesión ampliada" class="max-h-[45vh] w-auto object-contain rounded-xl shadow-2xl border-4 border-white/10">
            <h3 id="modal-titulo" class="text-white text-xl md:text-2xl font-bold mt-5 text-center uppercase tracking-wide drop-shadow-lg"></h3>
            
            <div id="modal-detalle" class="text-slate-200 mt-4 max-w-3xl w-full text-justify text-sm md:text-base leading-relaxed bg-black/40 p-6 rounded-xl overflow-y-auto max-h-[30vh] border border-white/10">
                </div>
        </div>
    </div>

    <script>
        const API_URL = 'http://localhost:8000/api/coplade-data';

        async function cargarDatos() {
            try {
                const response = await fetch(API_URL);
                const data = await response.json();
                
                // 1. Llenar Textos
                document.getElementById('dyn-titulo-overlay').innerText = data.bienvenida.titulo;
                document.getElementById('dyn-titulo-main').innerText = data.bienvenida.titulo;
                document.getElementById('dyn-subtitulo').innerText = data.bienvenida.subtitulo;
                document.getElementById('dyn-descripcion-overlay').innerText = `"${data.bienvenida.descripcion}"`;
                document.getElementById('dyn-descripcion-main').innerText = data.bienvenida.descripcion;

                // 2. Manejar Sesiones
                const tabsContainer = document.getElementById('dyn-tabs');
                const sesionesContainer = document.getElementById('dyn-sesiones');
                const anios = Object.keys(data.sesiones);

                if (anios.length === 0) {
                    tabsContainer.innerHTML = '<p class="text-slate-400 text-[10px] uppercase">Sin sesiones registradas</p>';
                    return;
                }

                tabsContainer.innerHTML = '';
                sesionesContainer.innerHTML = '';

                anios.forEach((anio, index) => {
                    const btn = document.createElement('button');
                    btn.className = `year-tab text-[12px] font-bold uppercase tracking-tighter text-slate-500 hover:text-red-800 ${index === 0 ? 'active' : ''}`;
                    btn.innerText = anio;
                    btn.onclick = (e) => selectYear(e.target, anio);
                    tabsContainer.appendChild(btn);

                    data.sesiones[anio].forEach(sesion => {
                        const card = document.createElement('div');
                        card.className = `card-sesion group cursor-pointer sesion-year-${anio}`;
                        card.style.display = index === 0 ? 'flex' : 'none';
                        card.innerHTML = `
                            <div class="video-preview shrink-0 shadow-lg">
                                <img src="../image/coplade/${sesion.imagen}" class="w-full h-full object-cover" onerror="this.src='https://via.placeholder.com/120x80?text=COPLADE'">
                            </div>
                            <div>
                                <span class="text-[8px] font-black text-amber-600 uppercase tracking-widest mb-1 block">${sesion.apartado}</span>
                                <h4 class="font-bold text-slate-800 text-[14px] leading-tight group-hover:text-red-800 transition-colors">${sesion.titulo}</h4>
                                <div class="mt-2 text-[9px] bg-slate-100 px-2 py-1 rounded font-bold text-slate-500 uppercase inline-block">Ejercicio ${anio}</div>
                            </div>
                        `;
                        
                        // EVENTO CLIC ACTUALIZADO (Añadido sesion.detalle_sesion)
                        const rutaImagen = `../image/coplade/${sesion.imagen}`;
                        card.onclick = () => abrirModal(rutaImagen, sesion.titulo, sesion.detalle_sesion);

                        sesionesContainer.appendChild(card);
                    });
                });
            } catch (error) {
                console.error("Error:", error);
            }
        }

        function entrarAlSistema() {
            const overlay = document.getElementById('welcome-overlay');
            overlay.classList.add('exit-animation');
            setTimeout(() => overlay.style.display = 'none', 600);
        }

        function selectYear(element, anio) {
            document.querySelectorAll('.year-tab').forEach(tab => tab.classList.remove('active'));
            element.classList.add('active');
            document.querySelectorAll('.card-sesion').forEach(card => {
                card.style.display = card.classList.contains('sesion-year-' + anio) ? 'flex' : 'none';
            });
        }

        // FUNCIÓN ABRIR MODAL ACTUALIZADA
        function abrirModal(ruta, titulo, detalleHtml) {
            const modal = document.getElementById('modal-imagen');
            document.getElementById('modal-img-src').src = ruta;
            document.getElementById('modal-titulo').innerText = titulo;
            
            // Inyectar el texto con HTML
            const contenedorDetalle = document.getElementById('modal-detalle');
            if (detalleHtml && detalleHtml.trim() !== '') {
                contenedorDetalle.innerHTML = detalleHtml;
                contenedorDetalle.style.display = 'block';
            } else {
                contenedorDetalle.style.display = 'none'; // Se oculta si no escribiste nada en el admin
            }
            
            modal.classList.remove('hidden');
            setTimeout(() => {
                modal.classList.remove('opacity-0');
                modal.classList.add('flex', 'opacity-100');
            }, 10);
        }

        function cerrarModal() {
            const modal = document.getElementById('modal-imagen');
            modal.classList.remove('opacity-100');
            modal.classList.add('opacity-0');
            setTimeout(() => {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }, 300);
        }

        window.onload = cargarDatos;
    </script>
    <?php include 'footer_publico.php'; ?>
</body>
</html>