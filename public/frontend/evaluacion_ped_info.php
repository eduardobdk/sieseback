<!DOCTYPE html>
<html lang="es-MX">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evaluación PED-Chiapas | SIESE</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;900&display=swap');
        
        :root { 
            --guinda-chiapas: #8D192F; 
            --gris-institucional: #636363;
        }

        body { background-color: #f8fafc; font-family: 'Inter', sans-serif; }
        
        .main-container {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(5px);
            border-radius: 2rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            overflow: hidden;
        }

        .doc-row {
            transition: all 0.2s ease;
            border-bottom: 1px solid #f0f0f0;
        }

        .doc-row:hover {
            background-color: #f9fafb;
            transform: translateX(5px);
        }

        .doc-visor {
            max-height: 500px;
            overflow-y: auto;
        }

        .doc-visor::-webkit-scrollbar { width: 6px; }
        .doc-visor::-webkit-scrollbar-track { background: #f1f1f1; border-radius: 10px; }
        .doc-visor::-webkit-scrollbar-thumb { background: #8D192F; border-radius: 10px; }
    </style>
</head>
<body class="text-gray-800 antialiased">

    <header class="bg-white/80 backdrop-blur-md border-b border-gray-200 py-4 sticky top-0 z-50">
        <div class="container mx-auto px-6 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <div class="w-1 bg-[#8D192F] h-6 rounded-full"></div>
                <h1 class="text-xl font-black tracking-tighter text-gray-800">SIESE <span class="font-light text-gray-400">| Evaluación PED-Chiapas</span></h1>
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
                        <i class="fas fa-archive"></i>
                    </div>
                    <div class="h-10 w-0.5 bg-gray-300 rounded-full"></div>
                    <h2 class="text-gray-900 font-extrabold text-2xl tracking-tighter">Evaluación PED-Chiapas</h2>
                </div>
            </div>

            <div class="p-6 md:p-10">
                <div class="mb-8 border-b-2 border-gray-100 pb-4">
                    <p class="text-sm font-semibold text-gray-500 uppercase tracking-widest">Listado de Evaluaciones Disponibles</p>
                </div>

                <div class="doc-visor space-y-1">
                    
                    <div class="doc-row flex items-center p-4 gap-5 rounded-xl">
                        <div class="text-gray-800 text-lg hover:scale-110 hover:text-red-700 transition-all cursor-pointer">
                            <i class="fas fa-download"></i>
                        </div>
                        <div class="flex-1">
                            <a href="#" class="text-red-800 hover:text-[#8D192F] font-medium text-base hover:underline break-words">Evaluacion_del_PED_2024_19_nov_2024.pdf</a>
                        </div>
                        <span class="text-[9px] font-bold text-gray-400 uppercase tracking-widest">Nov 2024</span>
                    </div>

                    <div class="doc-row flex items-center p-4 gap-5 rounded-xl">
                        <div class="text-gray-800 text-lg hover:scale-110 hover:text-red-700 transition-all cursor-pointer">
                            <i class="fas fa-download"></i>
                        </div>
                        <div class="flex-1">
                            <a href="#" class="text-red-800 hover:text-[#8D192F] font-medium text-base hover:underline break-words">Evaluacion_del_PED_2019_2024__2023.pdf</a>
                        </div>
                        <span class="text-[9px] font-bold text-gray-400 uppercase tracking-widest">Ejercicio 2023</span>
                    </div>

                    <div class="doc-row flex items-center p-4 gap-5 rounded-xl">
                        <div class="text-gray-800 text-lg hover:scale-110 hover:text-red-700 transition-all cursor-pointer">
                            <i class="fas fa-download"></i>
                        </div>
                        <div class="flex-1">
                            <a href="#" class="text-red-800 hover:text-[#8D192F] font-medium text-base hover:underline break-words">Evaluacion_del_PED_2019_2024__2022.pdf</a>
                        </div>
                        <span class="text-[9px] font-bold text-gray-400 uppercase tracking-widest">Ejercicio 2022</span>
                    </div>

                    <div class="doc-row flex items-center p-4 gap-5 rounded-xl">
                        <div class="text-gray-800 text-lg hover:scale-110 hover:text-red-700 transition-all cursor-pointer">
                            <i class="fas fa-download"></i>
                        </div>
                        <div class="flex-1">
                            <a href="#" class="text-red-800 hover:text-[#8D192F] font-medium text-base hover:underline break-words">Evaluacion_del_PED_2019_2024__2021.pdf</a>
                        </div>
                        <span class="text-[9px] font-bold text-gray-400 uppercase tracking-widest">Ejercicio 2021</span>
                    </div>

                    <div class="doc-row flex items-center p-4 gap-5 rounded-xl border-none">
                        <div class="text-gray-800 text-lg hover:scale-110 hover:text-red-700 transition-all cursor-pointer">
                            <i class="fas fa-download"></i>
                        </div>
                        <div class="flex-1">
                            <a href="#" class="text-red-800 hover:text-[#8D192F] font-medium text-base hover:underline break-words">Evaluacion_del_PED_2019_2024__2020.pdf</a>
                        </div>
                        <span class="text-[9px] font-bold text-gray-400 uppercase tracking-widest">Ejercicio 2020</span>
                    </div>

                </div>
            </div>
            
            <div class="bg-white px-10 py-5 border-t border-gray-100 flex justify-between items-center">
                <p class="text-[9px] text-gray-400 font-bold uppercase tracking-[0.5em]">Secretaría de Hacienda | Chiapas 2026</p>
            </div>
        </div>

    </main>

    <footer class="py-10 text-center">
        <p class="text-[10px] text-gray-400 font-black uppercase tracking-[0.4em]">SIESE | Gobierno de Chiapas</p>
    </footer>

</body>
</html>