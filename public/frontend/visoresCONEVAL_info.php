<?php
// 1. Cargamos el cargador de clases de Laravel (Ajusta la ruta si es necesario)
// Subimos dos niveles para salir de public/frontend y llegar a la raíz del proyecto
require __DIR__ . '/../../vendor/autoload.php';

// 2. Iniciamos la aplicación Laravel
$app = require_once __DIR__ . '/../../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$kernel->handle(Illuminate\Http\Request::capture());

// 3. Ahora ya podemos usar el modelo de Laravel
use App\Models\Documento;

$coneval_comunicaciones = Documento::where('seccion', 'coneval_comunicacion')->get();
$coneval_visores = Documento::where('seccion', 'coneval_visor')->get();
?>

<!DOCTYPE html>
<html lang="es-MX">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visores CONEVAL | SIESE</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;900&display=swap');
        
        :root { 
            --gob-guinda: #8D192F; 
            --gob-guinda-light: #f4e8ea;
        }

        body { background-color: #f8fafc; font-family: 'Inter', sans-serif; }
        
        .main-container {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(5px);
            border-radius: 2rem; 
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            overflow: hidden;
        }

        /* Estilo de Tarjetas de Comunicaciones */
        .comunicacion-card {
            border-radius: 1.5rem;
            overflow: hidden;
            background: white;
            border: 1px solid #eef2f6;
            transition: all 0.3s ease;
        }

        .comunicacion-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px -10px rgba(141, 25, 47, 0.2);
            border-color: var(--gob-guinda);
        }

        .comunicacion-img {
            width: 100%;
            height: 180px;
            object-fit: cover;
        }

        .comunicacion-footer {
            background: #1e293b; /* Color oscuro profesional */
            color: white;
            padding: 1.25rem;
            min-height: 100px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            font-weight: 600;
            font-size: 0.85rem;
            line-height: 1.4;
        }

        /* Estilo de Enlaces/Visores */
        .visor-link-item {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            padding: 1.25rem;
            background: white;
            border: 1px solid #eef2f6;
            border-radius: 1.25rem;
            transition: all 0.2s ease;
        }

        .visor-link-item:hover {
            background: var(--gob-guinda-light);
            border-color: var(--gob-guinda);
        }

        .visor-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f1f5f9;
            color: #475569;
            font-size: 1.25rem;
            transition: all 0.3s ease;
        }

        .visor-link-item:hover .visor-icon {
            background: var(--gob-guinda);
            color: white;
        }
    </style>
</head>
<body class="text-gray-800 antialiased">

    <header class="bg-white/80 backdrop-blur-md border-b border-gray-200 py-4 sticky top-0 z-50">
        <div class="container mx-auto px-6 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <div class="w-1 bg-[#8D192F] h-6 rounded-full"></div>
                <h1 class="text-xl font-black tracking-tighter text-gray-800">
                    SIESE <span class="font-light text-gray-400">| Visores CONEVAL</span>
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
                        <i class="fas fa-map-marked-alt"></i>
                    </div>
                    <div class="h-10 w-0.5 bg-gray-300 rounded-full"></div>
                    <h2 class="text-gray-900 font-extrabold text-2xl tracking-tighter">Gestión de Herramientas y Accesos</h2>
                </div>
                <div class="text-right">
                    <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Plataformas Externas</span>
                    <p class="text-xs font-bold text-black">CONEVAL México</p>
                </div>
            </div>

            <div class="p-6 md:p-10">
                
                <div class="mb-12">
                    <div class="flex items-center gap-3 mb-8">
                        <span class="bg-[#8D192F] text-white px-3 py-1 rounded-full text-[10px] font-black uppercase">01</span>
                        <h3 class="text-lg font-bold text-gray-800 uppercase tracking-tight">Comunicaciones Relevantes</h3>
                        <div class="flex-grow h-px bg-gray-100"></div>
                    </div>

                    <div id="grid-comunicaciones" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        <?php if(isset($coneval_comunicaciones) && count($coneval_comunicaciones) > 0): ?>
                            <?php foreach($coneval_comunicaciones as $com): ?>
                                <div class="comunicacion-card">
                                    <img src="/storage/documentos/<?php echo $com->archivo; ?>" class="comunicacion-img" alt="<?php echo $com->titulo; ?>">
                                    <div class="comunicacion-footer">
                                        <?php echo $com->titulo; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p class="col-span-full text-center text-gray-400">No hay comunicaciones disponibles por el momento.</p>
                        <?php endif; ?>
                    </div>
                </div>

                <div>
                    <div class="flex items-center gap-3 mb-8">
                        <span class="bg-[#8D192F] text-white px-3 py-1 rounded-full text-[10px] font-black uppercase">02</span>
                        <h3 class="text-lg font-bold text-gray-800 uppercase tracking-tight">Enlaces a Visores</h3>
                        <div class="flex-grow h-px bg-gray-100"></div>
                    </div>

                    <div id="lista-visores" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <?php if(isset($coneval_visores) && count($coneval_visores) > 0): ?>
                            <?php foreach($coneval_visores as $visor): ?>
                                <a href="<?php echo $visor->archivo; ?>" target="_blank" class="visor-link-item group">
                                    <div class="visor-icon">
                                        <i class="fas fa-external-link-alt"></i>
                                    </div>
                                    <div class="flex-grow">
                                        <h4 class="font-bold text-sm text-gray-800 leading-tight"><?php echo $visor->titulo; ?></h4>
                                        <p class="text-[10px] text-gray-400 font-medium mt-1 truncate max-w-[200px]"><?php echo $visor->archivo; ?></p>
                                    </div>
                                    <i class="fas fa-chevron-right text-gray-300 group-hover:text-[#8D192F] transition-colors"></i>
                                </a>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p class="col-span-full text-center text-gray-400">No hay enlaces registrados.</p>
                        <?php endif; ?>
                    </div>
                </div>

            </div>
            
            <div class="bg-gray-50 px-10 py-5 border-t border-gray-100 flex justify-between items-center">
                <p class="text-[9px] text-gray-400 font-bold uppercase tracking-[0.5em]">Secretaría de Hacienda</p>
                <p class="text-[9px] text-gray-400 font-bold uppercase tracking-[0.5em]">Chiapas 2026</p>
            </div>
        </div>

    </main>

    <script>
        // Aquí conectarías con tu API para traer los datos guardados por el administrador
        async function cargarDatosCONEVAL() {
            // Lógica para cargar las imágenes y los links desde tu base de datos
            console.log("Cargando visores y comunicaciones...");
        }

        document.addEventListener('DOMContentLoaded', cargarDatosCONEVAL);
    </script>
    <?php include 'footer_publico.php'; ?>
</body>
</html>