<!DOCTYPE html>
<html lang="es-MX">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Metodología y Formatos PED | SIESE</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;900&display=swap');
        
        :root { 
            --guinda-chiapas: #8D192F; 
            --azul-institucional: #1e293b; 
        }

        body { background-color: #f8fafc; font-family: 'Inter', sans-serif; }
        
        .main-container {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(5px);
            border-radius: 2rem; 
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            overflow: hidden;
        }

        /* ----- Nuevo Estilo para las Tarjetas en Grid ----- */
        .grid-docs-visor {
            max-height: 700px;
            overflow-y: auto;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
        }

        .grid-docs-visor::-webkit-scrollbar { width: 6px; }
        .grid-docs-visor::-webkit-scrollbar-track { background: #f1f1f1; border-radius: 10px; }
        .grid-docs-visor::-webkit-scrollbar-thumb { background: var(--guinda-chiapas); border-radius: 10px; }

        .format-card {
            border: 1px solid #edf2f7;
            border-radius: 1rem;
            background: white;
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100%;
            transition: all 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            position: relative;
        }

        .format-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 30px -5px rgba(0,0,0,0.1);
            border-color: #e2e8f0;
        }

        /* Detalle sutil arriba para indicar interactividad */
        .format-card::after {
            content: '';
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 0%;
            height: 3px;
            background: var(--guinda-chiapas);
            border-radius: 0 0 4px 4px;
            transition: width 0.3s ease;
        }

        .format-card:hover::after {
            width: 40%;
        }

    </style>
</head>
<body class="text-gray-800 antialiased">

    <header class="bg-white/80 backdrop-blur-md border-b border-gray-200 py-4 sticky top-0 z-50">
        <div class="container mx-auto px-6 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <div class="w-1 bg-[#8D192F] h-6 rounded-full"></div>
                <h1 class="text-xl font-black tracking-tighter text-gray-800">
                    SIESE <span class="font-light text-gray-400">| Formatos PED-Chiapas</span>
                </h1>
            </div>
            <a href="index.php" class="text-[10px] font-black uppercase tracking-widest text-gray-400 hover:text-[#8D192F] transition-colors">
                <i class="fas fa-home mr-1"></i> Inicio
            </a>
        </div>
    </header>

    <main class="container mx-auto max-w-5xl px-4 py-10 md:py-16">
        
        <div class="main-container">
            <div class="bg-[#F2F2F2] px-8 py-4 flex items-center justify-between border-b border-gray-200">
                <div class="flex items-center gap-4">
                    <div class="text-3xl text-gray-800">
                        <i class="fas fa-file-contract"></i>
                    </div>
                    <div class="h-10 w-0.5 bg-gray-300 rounded-full"></div>
                    <h2 class="text-gray-900 font-extrabold text-2xl tracking-tighter">Repositorio de Formatos</h2>
                </div>
            </div>

            <div class="p-6 md:p-10">
                <div class="mb-8 border-b-2 border-gray-100 pb-4">
                    <p class="text-sm font-semibold text-gray-500 uppercase tracking-widest">Descarga de Guías y Formatos Oficiales (Grid)</p>
                </div>

                <div id="contenedor-formatos" class="grid-docs-visor p-1">
                    <p class="text-center col-span-full py-16 text-gray-400 animate-pulse text-sm">Sincronizando formatos con el servidor...</p>
                </div>
            </div>
            
            <div class="bg-white px-10 py-5 border-t border-gray-100 flex justify-between items-center">
                <p class="text-[9px] text-gray-400 font-bold uppercase tracking-[0.5em]">Secretaría de Hacienda | Chiapas 2026</p>
                <span class="text-[9px] text-gray-300 font-bold">SIESE v1.0</span>
            </div>
        </div>

    </main>

    <footer class="py-10 text-center">
        <p class="text-[10px] text-gray-400 font-black uppercase tracking-[0.4em]">SIESE | Gobierno de Chiapas</p>
    </footer>

    <script>
        async function cargarFormatos() {
            const contenedor = document.getElementById('contenedor-formatos');
            try {
                const response = await fetch('http://127.0.0.1:8000/api/documentos?seccion=formatos_ped');
                const documentos = await response.json();

                if (documentos.length === 0) {
                    contenedor.innerHTML = `
                        <div class="col-span-full text-center py-20 text-gray-400">
                            <i class="fas fa-folder-open text-5xl mb-4 text-gray-200"></i>
                            <p class="text-sm font-semibold">No hay formatos disponibles en esta categoría.</p>
                        </div>`;
                    return;
                }

                contenedor.innerHTML = documentos.map(doc => {
                    // Lógica para el icono y color según extensión
                    let iconClass = 'fa-file-pdf text-red-500';
                    if (doc.extension.toLowerCase() === 'docx' || doc.extension.toLowerCase() === 'doc') iconClass = 'fa-file-word text-blue-500';
                    if (doc.extension.toLowerCase() === 'xlsx' || doc.extension.toLowerCase() === 'xls') iconClass = 'fa-file-excel text-green-600';

                    return `
                        <div class="format-card">
                            <div class="flex-grow">
                                <div class="flex items-center justify-between mb-4">
                                    <div class="text-3xl ${iconClass}">
                                        <i class="fas ${iconClass.split(' ')[0]}"></i>
                                    </div>
                                    <span class="text-[9px] font-black uppercase tracking-widest text-gray-300 bg-gray-50 px-2 py-0.5 rounded">
                                        ${doc.extension}
                                    </span>
                                </div>
                                <h3 class="font-bold text-gray-800 text-sm mb-4 leading-snug line-clamp-3" title="${doc.titulo}">
                                    ${doc.titulo}
                                </h3>
                            </div>
                            <div class="border-t border-gray-100 pt-4 flex flex-col gap-3">
                                <div class="text-gray-400 text-[10px] flex items-center gap-2">
                                    <i class="far fa-calendar-alt"></i> 
                                    Actualizado: ${new Date(doc.created_at).toLocaleDateString('es-MX')}
                                </div>
                                <a href="http://127.0.0.1:8000/storage/documentos/${doc.archivo}" 
                                   target="_blank" 
                                   class="w-full text-center bg-slate-800 hover:bg-[#8D192F] text-white text-xs font-bold py-2.5 px-4 rounded-lg transition-all flex items-center justify-center gap-2 shadow-sm active:scale-95">
                                    <i class="fas fa-download"></i> Descargar archivo
                                </a>
                            </div>
                        </div>
                    `;
                }).join('');

            } catch (error) {
                console.error(error);
                contenedor.innerHTML = `<p style="text-align:center; grid-column: 1/-1; color:red; padding: 30px 0;">Error de conexión: No se pudo contactar con el sistema SIESE.</p>`;
            }
        }
        document.addEventListener('DOMContentLoaded', cargarFormatos);
    </script>
</body>
</html>