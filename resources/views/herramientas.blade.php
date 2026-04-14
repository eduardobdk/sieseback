@extends('layouts.app')

@section('title', 'Herramientas y Visores')

@section('content')
    <style>
        .tabs-modernas { display: flex; gap: 5px; margin-bottom: 20px; border-bottom: 2px solid #ddd; padding-bottom: 0; }
        .tab-btn { background: transparent; border: none; padding: 12px 20px; font-size: 0.95rem; font-weight: 700; color: #777; cursor: pointer; border-bottom: 4px solid transparent; transition: 0.3s; font-family: 'Montserrat', sans-serif; text-transform: uppercase; }
        .tab-btn:hover { color: var(--gob-guinda); }
        .tab-btn.activo { color: var(--gob-guinda); border-bottom-color: var(--gob-guinda); }
        .contenido-tab { display: none; animation: fadeIn 0.4s; }
        .contenido-tab.activo { display: block; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
        .grid-coneval { display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 20px; }
        .card-coneval { background: white; border: 1px solid #ddd; border-radius: 8px; overflow: hidden; position: relative; }
        .card-coneval img { width: 100%; height: 140px; object-fit: cover; }
        .card-coneval-info { padding: 15px; font-size: 0.85rem; font-weight: 600; text-align: center; background: #333; color: white; min-height: 80px; display: flex; align-items: center; justify-content: center; }
        .card-acciones { position: absolute; top: 10px; right: 10px; display: flex; gap: 5px; }
    </style>

    <div class="card-bienvenida mb-4" style="padding-bottom: 0; background: transparent; box-shadow: none; border: none;">
        <h2>Gestión de Herramientas y Accesos</h2>
        <p class="texto-ayuda">Administre los documentos de evaluación, formatos descargables y accesos a visores externos.</p>
        
        @if(session('success'))
            <div style="background: #d4edda; color: #155724; padding: 15px; border-radius: 8px; margin-top: 15px; font-weight: bold;">
                <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
            </div>
        @endif

        <div class="tabs-modernas mt-4">
            <button class="tab-btn activo" onclick="abrirTab(event, 'tab-eval-ped')"><i class="bi bi-journal-check"></i> Evaluación PED</button>
            <button class="tab-btn" onclick="abrirTab(event, 'tab-formatos')"><i class="bi bi-file-earmark-text"></i> Formatos PED</button>
            <button class="tab-btn" onclick="abrirTab(event, 'tab-eval-sectorial')"><i class="bi bi-journal-richtext"></i> Evaluación Sectorial</button>
            <button class="tab-btn" onclick="abrirTab(event, 'tab-visores')"><i class="bi bi-geo-alt-fill"></i> Visores CONEVAL</button>
        </div>
    </div>

    <div id="tab-eval-ped" class="contenido-tab activo">
        <div class="card-bienvenida">
            <div class="encabezado-bloque" style="border-bottom: 2px solid var(--gob-oro); padding-bottom: 15px; margin-bottom: 20px;">
                <h3 style="margin: 0; color: var(--gob-negro);">Documentos: Evaluación PED-Chiapas</h3>
            </div>
            
            <div style="background: #f9f9f9; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #ddd;">
                <form action="{{ route('documento.store') }}" method="POST" enctype="multipart/form-data" style="display: flex; gap: 10px; align-items: flex-end;">
                    @csrf
                    <input type="hidden" name="seccion" value="evaluacion_ped">
                    <div class="grupo-input" style="margin:0; flex: 2;">
                        <label>Nombre de la Evaluación:</label>
                        <input type="text" name="titulo" class="input-control" required placeholder="Ej. Evaluacion_del_PED_2024...">
                    </div>
                    <div class="grupo-input" style="margin:0; flex: 1;">
                        <label>Archivo PDF:</label>
                        <input type="file" name="archivo" class="input-control" required accept=".pdf,.doc,.docx,.xls,.xlsx">
                    </div>
                    <button type="submit" class="btn-gob" style="background: var(--gob-oro); color:white; height: 45px;"><i class="bi bi-cloud-arrow-up-fill"></i> Subir</button>
                </form>
            </div>

            <div class="lista-registros">
                @forelse($eval_ped as $doc)
                    <div class="registro-item" style="border-left: 4px solid var(--gob-oro);">
                        <div class="registro-img" style="background: transparent;">
                            <i class="bi bi-file-earmark-pdf-fill" style="color: #dc3545; font-size: 1.8rem;"></i>
                        </div>
                        <div class="registro-texto">
                            <p style="font-weight: bold; margin: 0;">{{ $doc->titulo }}</p>
                            <a href="{{ asset('storage/documentos/'.$doc->archivo) }}" target="_blank" style="font-size: 0.8rem; color: #0d6efd; text-decoration: none;"><i class="bi bi-eye-fill"></i> Ver archivo original</a>
                        </div>
                        <div class="registro-acciones">
                            <form action="{{ route('documento.destroy', $doc->id) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar este documento?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-icono btn-eliminar"><i class="bi bi-trash3-fill"></i></button>
                            </form>
                        </div>
                    </div>
                @empty
                    <p style="text-align: center; color: #888;">No hay evaluaciones subidas aún.</p>
                @endforelse
            </div>
        </div>
    </div>

    <div id="tab-formatos" class="contenido-tab">
        <div class="card-bienvenida">
            <div class="encabezado-bloque" style="border-bottom: 2px solid var(--gob-azul); padding-bottom: 15px; margin-bottom: 20px;">
                <h3 style="margin: 0; color: var(--gob-negro);">Metodología y Formatos (2025-2030)</h3>
            </div>
            
            <div style="background: #f9f9f9; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #ddd;">
                <form action="{{ route('documento.store') }}" method="POST" enctype="multipart/form-data" style="display: flex; gap: 10px; align-items: flex-end;">
                    @csrf
                    <input type="hidden" name="seccion" value="formatos_ped">
                    <div class="grupo-input" style="margin:0; flex: 2;">
                        <label>Nombre del Formato:</label>
                        <input type="text" name="titulo" class="input-control" required placeholder="Ej. 01 Formato Acta de Instalación...">
                    </div>
                    <div class="grupo-input" style="margin:0; flex: 1;">
                        <label>Archivo (PDF, Word, Excel):</label>
                        <input type="file" name="archivo" class="input-control" required>
                    </div>
                    <button type="submit" class="btn-gob" style="background: var(--gob-azul); color:white; height: 45px;"><i class="bi bi-cloud-arrow-up-fill"></i> Subir Formato</button>
                </form>
            </div>

            <div class="lista-registros">
                @forelse($formatos as $doc)
                    <div class="registro-item" style="border-left: 4px solid var(--gob-azul);">
                        <div class="registro-img" style="background: transparent;">
                            @if(in_array($doc->extension, ['doc', 'docx']))
                                <i class="bi bi-file-earmark-word-fill" style="color: #0d6efd; font-size: 1.8rem;"></i>
                            @elseif(in_array($doc->extension, ['xls', 'xlsx']))
                                <i class="bi bi-file-earmark-excel-fill" style="color: #198754; font-size: 1.8rem;"></i>
                            @else
                                <i class="bi bi-file-earmark-pdf-fill" style="color: #dc3545; font-size: 1.8rem;"></i>
                            @endif
                        </div>
                        <div class="registro-texto">
                            <p style="font-weight: bold; margin: 0;">{{ $doc->titulo }}</p>
                            <a href="{{ asset('storage/documentos/'.$doc->archivo) }}" target="_blank" style="font-size: 0.8rem; color: #0d6efd; text-decoration: none;"><i class="bi bi-download"></i> Descargar archivo</a>
                        </div>
                        <div class="registro-acciones">
                            <form action="{{ route('documento.destroy', $doc->id) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar este formato?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-icono btn-eliminar"><i class="bi bi-trash3-fill"></i></button>
                            </form>
                        </div>
                    </div>
                @empty
                    <p style="text-align: center; color: #888;">No hay formatos subidos aún.</p>
                @endforelse
            </div>
        </div>
    </div>

    <div id="tab-eval-sectorial" class="contenido-tab">
        <div class="card-bienvenida">
            <div class="encabezado-bloque" style="border-bottom: 2px solid var(--gob-verde); padding-bottom: 15px; margin-bottom: 20px;">
                <h3 style="margin: 0; color: var(--gob-negro);">Documentos: Evaluación Programa Sectorial</h3>
            </div>
            
            <div style="background: #f9f9f9; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #ddd;">
                <form action="{{ route('documento.store') }}" method="POST" enctype="multipart/form-data" style="display: flex; gap: 10px; align-items: flex-end;">
                    @csrf
                    <input type="hidden" name="seccion" value="evaluacion_sectorial">
                    <div class="grupo-input" style="margin:0; flex: 2;">
                        <label>Nombre del Documento:</label>
                        <input type="text" name="titulo" class="input-control" required placeholder="Ej. Programa_Sectorial_2022...">
                    </div>
                    <div class="grupo-input" style="margin:0; flex: 1;">
                        <label>Archivo PDF:</label>
                        <input type="file" name="archivo" class="input-control" required>
                    </div>
                    <button type="submit" class="btn-gob" style="background: var(--gob-verde); color:white; height: 45px;"><i class="bi bi-cloud-arrow-up-fill"></i> Subir Documento</button>
                </form>
            </div>

            <div class="lista-registros">
                @forelse($eval_sectorial as $doc)
                    <div class="registro-item" style="border-left: 4px solid var(--gob-verde);">
                        <div class="registro-img" style="background: transparent;">
                            <i class="bi bi-file-earmark-pdf-fill" style="color: #dc3545; font-size: 1.8rem;"></i>
                        </div>
                        <div class="registro-texto">
                            <p style="font-weight: bold; margin: 0;">{{ $doc->titulo }}</p>
                            <a href="{{ asset('storage/documentos/'.$doc->archivo) }}" target="_blank" style="font-size: 0.8rem; color: #0d6efd; text-decoration: none;"><i class="bi bi-eye-fill"></i> Ver archivo original</a>
                        </div>
                        <div class="registro-acciones">
                            <form action="{{ route('documento.destroy', $doc->id) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar este documento?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-icono btn-eliminar"><i class="bi bi-trash3-fill"></i></button>
                            </form>
                        </div>
                    </div>
                @empty
                    <p style="text-align: center; color: #888;">No hay evaluaciones sectoriales subidas aún.</p>
                @endforelse
            </div>
        </div>
    </div>

    <div id="tab-visores" class="contenido-tab">
        <div class="card-bienvenida mb-4">
            <div class="encabezado-bloque" style="display: flex; justify-content: space-between; align-items: center; border-bottom: 2px solid var(--gob-guinda); padding-bottom: 15px; margin-bottom: 20px;">
                <h3 style="margin: 0; color: var(--gob-negro);">Comunicaciones Relevantes CONEVAL</h3>
                <button class="btn-gob" style="background-color: var(--gob-guinda); color: white;"><i class="bi bi-image"></i> Nueva Comunicación</button>
            </div>
            
            <div class="grid-coneval">
                <div class="card-coneval">
                    <div class="card-acciones">
                        <button class="btn-icono btn-editar" style="background: white;"><i class="bi bi-pencil-square"></i></button>
                        <button class="btn-icono btn-eliminar" style="background: white;"><i class="bi bi-trash3-fill"></i></button>
                    </div>
                    <img src="https://via.placeholder.com/300x150?text=Foto+Diagnostico" alt="Comunicación">
                    <div class="card-coneval-info">Resultados del Diagnóstico del Avance en Monitoreo 2023</div>
                </div>
            </div>
        </div>

        <div class="card-bienvenida">
            <div class="encabezado-bloque" style="display: flex; justify-content: space-between; align-items: center; border-bottom: 2px solid #555; padding-bottom: 15px; margin-bottom: 20px;">
                <h3 style="margin: 0; color: var(--gob-negro);">Enlaces a Visores</h3>
                <button class="btn-gob" style="background-color: #555; color: white;"><i class="bi bi-link-45deg"></i> Nuevo Enlace</button>
            </div>

            <div class="lista-registros">
                <div class="registro-item">
                    <div class="registro-img" style="background: #f1f1f1;"><i class="bi bi-sign-turn-right-fill" style="color: #555; font-size: 1.5rem;"></i></div>
                    <div class="registro-texto">
                        <p style="font-weight: bold; margin: 0;">Grado de accesibilidad a carretera pavimentada (GACP) 2020</p>
                        <span style="font-size: 0.8rem; color: #0d6efd;"><i class="bi bi-link"></i> http://enlace-visor.com/gacp</span>
                    </div>
                    <div class="registro-acciones">
                        <button class="btn-icono btn-editar"><i class="bi bi-pencil-square"></i></button>
                        <button class="btn-icono btn-eliminar"><i class="bi bi-trash3-fill"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function abrirTab(evento, idTab) {
            let pestañas = document.getElementsByClassName("contenido-tab");
            for (let i = 0; i < pestañas.length; i++) { pestañas[i].classList.remove("activo"); }
            
            let botones = document.getElementsByClassName("tab-btn");
            for (let i = 0; i < botones.length; i++) { botones[i].classList.remove("activo"); }
            
            document.getElementById(idTab).classList.add("activo");
            evento.currentTarget.classList.add("activo");
        }
    </script>
@endsection