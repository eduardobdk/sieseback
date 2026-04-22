@extends('layouts.app')

@section('title', 'FAIS')

@section('content')
    <style>
        .contenido-anio { display: none; animation: fadeIn 0.4s; }
        .contenido-anio.activo { display: block; }
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
    </style>

    @if(session('success'))
        <div style="background: #d4edda; color: #155724; padding: 15px; border-radius: 8px; margin-bottom: 20px; font-weight: bold;">
            <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
        </div>
    @endif

    <div class="card-bienvenida mb-4">
        <h2>1. Comunicaciones Relevantes</h2>
        <p class="texto-ayuda">Gestione los oficios y avisos importantes.</p>
        <hr class="linea-divisoria">
        
        <form action="{{ route('documento.store') }}" method="POST" enctype="multipart/form-data" style="background: #f9f9f9; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #ddd; display: flex; gap: 10px; align-items: flex-end;">
            @csrf
            <input type="hidden" name="seccion" value="fais_comunicaciones">
            <div class="grupo-input" style="margin:0; flex: 2;">
                <label>Título del Comunicado/Oficio:</label>
                <input type="text" name="titulo" class="input-control" required placeholder="Ej. Oficio Circular SH/07/2022...">
            </div>
            <div class="grupo-input" style="margin:0; flex: 1;">
                <label>Archivo PDF:</label>
                <input type="file" name="archivo" class="input-control" required accept=".pdf">
            </div>
            <button type="submit" class="btn-gob" style="background: var(--gob-rosa); color:white; height: 45px;"><i class="bi bi-plus-lg"></i> Agregar Comunicado</button>
        </form>

        <div class="lista-registros">
            @forelse($comunicaciones as $comunicado)
                <div class="registro-item">
                    <div class="registro-img">
                        <i class="bi bi-filetype-pdf text-muted" style="font-size: 1.8rem; color: #dc3545 !important;"></i>
                    </div>
                    <div class="registro-texto">
                        <p style="font-weight: 600;">{{ $comunicado->titulo }}</p>
                        <a href="{{ asset('storage/documentos/'.$comunicado->archivo) }}" target="_blank" style="font-size: 0.8rem; color: #0d6efd; text-decoration: none;">Ver PDF</a>
                    </div>
                    <div class="registro-acciones">
                        <form action="{{ route('documento.destroy', $comunicado->id) }}" method="POST" onsubmit="return confirm('¿Borrar este comunicado?');">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn-icono btn-eliminar" title="Eliminar"><i class="bi bi-trash3-fill"></i></button>
                        </form>
                    </div>
                </div>
            @empty
                <p style="text-align: center; color: #888;">No hay comunicaciones registradas.</p>
            @endforelse
        </div>
    </div>

    <div class="card-bienvenida">
        <h2>2. Normateca FAIS</h2>
        <p class="texto-ayuda">Gestione las categorías y documentos PDF por año.</p>
        <hr class="linea-divisoria">

        <form action="{{ route('documento.store') }}" method="POST" enctype="multipart/form-data" style="background: #f9f9f9; padding: 20px; border-radius: 8px; border: 1px solid #ddd; margin-bottom: 30px;">
            @csrf
            <input type="hidden" name="seccion" value="fais_normateca">
            <h4 style="margin-top: 0; color: var(--gob-rosa);"><i class="bi bi-cloud-arrow-up-fill"></i> Subir Documento a Normateca</h4>
            <div style="display: flex; gap: 15px; flex-wrap: wrap;">
                <div class="grupo-input" style="flex: 1; min-width: 150px;">
                    <label>Año:</label>
                    <input type="number" name="anio" class="input-control" value="{{ date('Y') }}" required>
                </div>
                <div class="grupo-input" style="flex: 2; min-width: 250px;">
                    <label>Categoría (Ej. Instrumentos Normativos):</label>
                    <input type="text" name="categoria" class="input-control" required placeholder="Nombre de la categoría...">
                </div>
            </div>
            <div style="display: flex; gap: 15px; flex-wrap: wrap; margin-top: 15px;">
                <div class="grupo-input" style="flex: 2; min-width: 250px;">
                    <label>Título del Documento:</label>
                    <input type="text" name="titulo" class="input-control" required placeholder="Ej. Declaratoria de las zonas...">
                </div>
                <div class="grupo-input" style="flex: 1; min-width: 200px;">
                    <label>Archivo PDF:</label>
                    <input type="file" name="archivo" class="input-control" required accept=".pdf">
                </div>
            </div>
            <button type="submit" class="btn-gob mt-3" style="background: #dc3545; color:white;"><i class="bi bi-file-earmark-pdf"></i> Guardar Documento</button>
        </form>

        @if($normatecaPorAnio->count() > 0)
            <div class="tabs-anios">
                {{-- Ordenamos las llaves (años) de menor a mayor antes de iterar --}}
                @foreach($normatecaPorAnio->sortKeys() as $anio => $documentos)
                    <button class="tab-anio {{ $loop->first ? 'activo' : '' }}" onclick="abrirAnio(event, 'anio-{{ $anio }}')">{{ $anio }}</button>
                @endforeach
            </div>

            @foreach($normatecaPorAnio->sortKeys() as $anio => $documentos)
                <div id="anio-{{ $anio }}" class="contenido-anio {{ $loop->first ? 'activo' : '' }}">
                    
                    @foreach($documentos->groupBy('categoria') as $categoria => $items)
                        <div class="bloque-sesiones mt-4">
                            <div class="encabezado-bloque">
                                <div class="titulo-y-acciones">
                                    <h3>{{ $categoria }}</h3>
                                </div>
                            </div>
                            
                            <div class="lista-registros">
                                @foreach($items as $item)
                                    <div class="registro-item">
                                        <div class="registro-img" style="background-color: transparent; width: 40px;">
                                            <i class="bi bi-filetype-pdf" style="font-size: 2rem; color: #dc3545;"></i>
                                        </div>
                                        <div class="registro-texto">
                                            <p style="margin: 0; font-weight: 600;">{{ $item->titulo }}</p>
                                            <a href="{{ asset('storage/documentos/'.$item->archivo) }}" target="_blank" style="font-size: 0.8rem; color: #0d6efd; text-decoration: none;">Abrir PDF</a>
                                        </div>
                                        <div class="registro-acciones">
                                            <form action="{{ route('documento.destroy', $item->id) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar este documento?');">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn-icono btn-eliminar"><i class="bi bi-trash3-fill"></i></button>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        @else
            <p style="text-align: center; color: #888; padding: 20px;">No hay documentos en la Normateca aún.</p>
        @endif
    </div>

    <script>
        function abrirAnio(evento, idAnio) {
            let contenidos = document.getElementsByClassName("contenido-anio");
            for (let i = 0; i < contenidos.length; i++) { contenidos[i].classList.remove("activo"); }
            
            let botones = document.getElementsByClassName("tab-anio");
            for (let i = 0; i < botones.length; i++) { botones[i].classList.remove("activo"); }
            
            document.getElementById(idAnio).classList.add("activo");
            evento.currentTarget.classList.add("activo");
        }
    </script>
@endsection