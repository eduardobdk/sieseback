@extends('layouts.app')

@section('title', 'COPLADE')

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
        <h2>1. Editar Mensaje de Bienvenida</h2>
        <hr class="linea-divisoria">
        <form action="{{ route('coplade.bienvenida.update') }}" method="POST" class="formulario-gob">
            @csrf
            <div class="grupo-input">
                <label>Título Principal:</label>
                <input type="text" name="titulo" class="input-control" value="{{ $bienvenida->titulo ?? '' }}" required>
            </div>
            <div class="grupo-input">
                <label>Subtítulo:</label>
                <input type="text" name="subtitulo" class="input-control" value="{{ $bienvenida->subtitulo ?? '' }}" required>
            </div>
            <div class="grupo-input">
                <label>Descripción:</label>
                <textarea name="descripcion" class="input-form area-texto" rows="3" required>{{ $bienvenida->descripcion ?? '' }}</textarea>
            </div>
            <div class="caja-botones mt-3">
                <button type="submit" class="btn-gob btn-guardar"><i class="bi bi-floppy"></i> Actualizar Bienvenida</button>
            </div>
        </form>
    </div>

    <div class="card-bienvenida mb-4">
        <h2>2. Agregar Nueva Sesión</h2>
        <hr class="linea-divisoria">
        
        <form action="{{ route('coplade.sesion.store') }}" method="POST" enctype="multipart/form-data" style="background: #f9f9f9; padding: 20px; border-radius: 8px; border: 1px solid #ddd;">
            @csrf
            <div style="display: flex; gap: 15px; flex-wrap: wrap;">
                <div class="grupo-input" style="flex: 1; min-width: 150px;">
                    <label>Año de la Sesión:</label>
                    <input type="number" name="anio" class="input-control" value="{{ date('Y') }}" required>
                </div>
                <div class="grupo-input" style="flex: 2; min-width: 250px;">
                    <label>Apartado (Categoría):</label>
                    <input type="text" name="apartado" class="input-control" placeholder="Ej. Sesiones ordinarias..." required>
                </div>
            </div>
            
            <div style="display: flex; gap: 15px; flex-wrap: wrap; margin-top: 15px;">
                <div class="grupo-input" style="flex: 2; min-width: 250px;">
                    <label>Título de la Sesión:</label>
                    <input type="text" name="titulo" class="input-control" required placeholder="Ej. 1a Sesión Ordinaria...">
                </div>
                <div class="grupo-input" style="flex: 1; min-width: 200px;">
                    <label>Imagen (Opcional):</label>
                    <input type="file" name="imagen" class="input-control" accept="image/*">
                </div>
            </div>

            <div class="grupo-input" style="margin-top: 15px;">
                <label>Detalles / Descripción de la Sesión (Opcional):</label>
                <textarea name="detalle_sesion" id="editor-nueva-sesion" class="input-control" rows="4"></textarea>
            </div>

            <button type="submit" class="btn-gob mt-3" style="background: var(--gob-verde); color:white;"><i class="bi bi-plus-lg"></i> Guardar Sesión</button>
        </form>
    </div>

    <div class="card-bienvenida">
        <h2>3. Sesiones Registradas</h2>
        <p class="texto-ayuda">Aquí puede visualizar y eliminar las sesiones agrupadas por año.</p>
        <hr class="linea-divisoria">

        @if($sesionesPorAnio && $sesionesPorAnio->count() > 0)
            <div class="tabs-anios">
                @foreach($sesionesPorAnio as $anio => $sesiones)
                    <button class="tab-anio {{ $loop->first ? 'activo' : '' }}" onclick="abrirAnio(event, 'anio-{{ $anio }}')">{{ $anio }}</button>
                @endforeach
            </div>

            @foreach($sesionesPorAnio as $anio => $sesiones)
                <div id="anio-{{ $anio }}" class="contenido-anio {{ $loop->first ? 'activo' : '' }}">
                    
                    @foreach($sesiones->groupBy('apartado') as $apartado => $items)
                        <div class="bloque-sesiones mt-4">
                            <div class="encabezado-bloque" style="border-bottom: 2px solid var(--gob-azul); padding-bottom: 10px; margin-bottom: 15px;">
                                <h3>{{ $apartado }}</h3>
                            </div>
                            
                            <div class="lista-registros">
                                @foreach($items as $item)
                                    <div class="registro-item">
                                        <div class="registro-img" style="overflow: hidden;">
                                            @if($item->imagen)
                                                <img src="{{ asset('image/coplade/'.$item->imagen) }}" style="width:100%; height:100%; object-fit:cover;">
                                            @else
                                                <i class="bi bi-image text-muted"></i>
                                            @endif
                                        </div>
                                        <div class="registro-texto"><p style="font-weight: 600; margin:0;">{{ $item->titulo }}</p></div>
                                        <div class="registro-acciones">
                                            <form action="{{ route('coplade.sesion.destroy', $item->id) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar esta sesión?');">
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
            <p style="text-align: center; color: #888;">No hay sesiones registradas.</p>
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.22.1/ckeditor.js"></script>
    <script>
        // Le decimos que espere a que cargue la página y luego aplique el editor
        window.addEventListener('load', function() {
            if(typeof CKEDITOR !== 'undefined') {
                CKEDITOR.replace('editor-nueva-sesion');
            }
        });
    </script>
@endsection