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

                            <a href="{{ asset('storage/documentos/'.$doc->archivo) }}" target="_blank" style="font-size: 0.8rem; color: #0d6efd; text-decoration: none;">

                                <i class="bi bi-eye-fill"></i> Ver archivo original

                            </a>        

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
        
        <style>
            .card-coneval-modern { background: #fff; border: 1px solid #e5e7eb; border-radius: 8px; border-left: 12px solid #8D192F; margin-bottom: 24px; overflow: hidden; box-shadow: 0 2px 4px rgba(0,0,0,0.05); }
            .card-coneval-header { display: flex; justify-content: space-between; align-items: center; padding: 16px 20px; border-bottom: 1px solid #f3f4f6; }
            .card-coneval-header h3 { margin: 0; font-size: 1.1rem; color: #1f2937; font-weight: 700; }
            .btn-red-c { background: #8D192F; color: white; border: none; padding: 8px 16px; border-radius: 4px; font-size: 0.85rem; font-weight: bold; cursor: pointer; display: inline-flex; align-items: center; gap: 6px; transition: background 0.3s; }
            .btn-red-c:hover { background: #731425; }
            .btn-dark-c { background: #4b5563; color: white; border: none; padding: 8px 16px; border-radius: 4px; font-size: 0.85rem; font-weight: bold; cursor: pointer; display: inline-flex; align-items: center; gap: 6px; transition: background 0.3s; }
            .btn-dark-c:hover { background: #374151; }
            .form-wrapper-c { background: #f9fafb; padding: 20px; display: none; }
            .form-inner-c { background: #fff; border: 1px solid #e5e7eb; border-radius: 6px; padding: 20px; display: flex; flex-direction: column; gap: 15px; }
            .input-c { width: 100%; padding: 10px 12px; border: 1px solid #d1d5db; border-radius: 4px; font-size: 0.9rem; }
            .input-c:focus { outline: none; border-color: #8D192F; box-shadow: 0 0 0 2px rgba(141, 25, 47, 0.2); }
        </style>

        <div class="card-coneval-modern">
            <div class="card-coneval-header">
                <h3>Comunicaciones Relevantes CONEVAL</h3>
                <button class="btn-red-c" onclick="document.getElementById('form-nueva-com').style.display='block'">
                    <i class="bi bi-image"></i> Nueva Comunicación
                </button>
            </div>

            <div id="form-nueva-com" class="form-wrapper-c">
                <form action="{{ route('documento.store') }}" method="POST" enctype="multipart/form-data" class="form-inner-c">
                    @csrf
                    <input type="hidden" name="seccion" value="coneval_comunicacion">
                    <input type="text" name="titulo" class="input-c" placeholder="Título de la imagen" required>
                    <input type="file" name="archivo" class="input-c" style="padding: 6px; cursor: pointer;" required accept="image/*">
                    <div style="display: flex; gap: 10px; margin-top: 5px;">
                        <button type="submit" class="btn-red-c">Guardar Imagen</button>
                        <button type="button" class="btn-dark-c" style="background:#9ca3af;" onclick="document.getElementById('form-nueva-com').style.display='none'">Cancelar</button>
                    </div>
                </form>
            </div>

            <div style="padding: 20px;">
                <div class="grid-coneval">
                    @forelse($coneval_comunicaciones as $com)
                        <div class="card-coneval">
                            <div class="card-acciones">
                                <form action="{{ route('documento.destroy', $com->id) }}" method="POST" onsubmit="return confirm('¿Eliminar esta comunicación?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-icono" style="background: white; border: 1px solid #ddd; padding: 5px; border-radius: 4px; color: red;"><i class="bi bi-trash3-fill"></i></button>
                                </form>
                            </div>
                            <img src="{{ asset('storage/documentos/'.$com->archivo) }}" alt="Comunicación" style="width: 100%; height: 140px; object-fit: cover;">
                            <div class="card-coneval-info">{{ $com->titulo }}</div>
                        </div>
                    @empty
                        <p style="text-align: center; color: #888; width: 100%; padding: 10px;">No hay comunicaciones guardadas aún.</p>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="card-coneval-modern">
            <div class="card-coneval-header">
                <h3>Enlaces a Visores</h3>
                <button class="btn-dark-c" onclick="document.getElementById('form-nuevo-visor').style.display='block'">
                    <i class="bi bi-link-45deg"></i> Nuevo Enlace
                </button>
            </div>

            <div id="form-nuevo-visor" class="form-wrapper-c">
                <form action="{{ route('documento.store') }}" method="POST" class="form-inner-c">
                    @csrf
                    <input type="hidden" name="seccion" value="coneval_visor">
                    <input type="text" name="titulo" class="input-c" placeholder="Nombre del visor" required>
                    <input type="url" name="archivo" class="input-c" placeholder="URL del enlace (Ej: https://www...)" required>
                    <div style="display: flex; gap: 10px; margin-top: 5px;">
                        <button type="submit" class="btn-dark-c" style="background: #8D192F;">Guardar Enlace</button>
                        <button type="button" class="btn-dark-c" style="background:#9ca3af;" onclick="document.getElementById('form-nuevo-visor').style.display='none'">Cancelar</button>
                    </div>
                </form>
            </div>

            <div style="padding: 20px;">
                <div class="lista-registros">
                    @forelse($coneval_visores as $visor)
                        <div class="registro-item" style="border-left: 4px solid #4b5563; background: #fff; border: 1px solid #eee; padding: 12px; margin-bottom: 10px; border-radius: 5px;">
                            <div style="display: flex; align-items: center; gap: 15px; width: 100%;">
                                <div class="registro-img" style="background: #f1f1f1; width: 40px; height: 40px; border-radius: 5px; display: flex; align-items: center; justify-content: center;">
                                    <i class="bi bi-box-arrow-up-right" style="color: #555; font-size: 1.2rem;"></i>
                                </div>
                                <div class="registro-texto" style="flex: 1;">
                                    <p style="font-weight: bold; margin: 0; color: #333;">{{ $visor->titulo }}</p>
                                    <a href="{{ $visor->archivo }}" target="_blank" style="font-size: 0.8rem; color: #0d6efd; text-decoration: none;">Visitar enlace: {{ $visor->archivo }}</a>
                                </div>
                                <div class="registro-acciones">
                                    <form action="{{ route('documento.destroy', $visor->id) }}" method="POST" onsubmit="return confirm('¿Eliminar este enlace?');">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn-icono" style="border:none; background:none; color: #dc3545; font-size: 1.2rem; cursor: pointer;"><i class="bi bi-trash3-fill"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p style="text-align: center; color: #888; padding: 10px;">No hay enlaces guardados aún.</p>
                    @endforelse
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