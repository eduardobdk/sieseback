@extends('layouts.app')

@section('title', 'Seguimiento')

@section('content')
    @if(session('success'))
        <div style="background: #d4edda; color: #155724; padding: 15px; border-radius: 8px; margin-bottom: 20px; font-weight: bold;">
            <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
        </div>
    @endif

    <div class="card-bienvenida mb-4">
        <h2>1. Editar Descripción de Seguimiento</h2>
        <hr class="linea-divisoria">
        <form action="{{ route('seguimiento.info.update') }}" method="POST" class="formulario-gob">
            @csrf
            <div class="grupo-input">
                <label>Contenido del bloque:</label>
                <textarea name="descripcion" id="editor-seguimiento" class="input-form area-texto" rows="5" required>{{ $seguimiento->descripcion ?? '' }}</textarea>
            </div>
            <div class="caja-botones">
                <button type="submit" class="btn-gob btn-guardar"><i class="bi bi-floppy"></i> Guardar Texto</button>
            </div>
        </form>
    </div>

    <div class="card-bienvenida">
        <div class="encabezado-bloque" style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #ddd; padding-bottom: 15px; margin-bottom: 20px;">
            <div>
                <h2 style="margin: 0; border: none; padding: 0;">2. Documentos e Indicadores</h2>
                <p class="texto-ayuda" style="margin-top: 5px;">Gestione los accesos al monitor y descargas de PDF.</p>
            </div>
        </div>

        <form action="{{ route('seguimiento.registro.store') }}" method="POST" enctype="multipart/form-data" style="background: #f9f9f9; padding: 20px; border-radius: 8px; border: 1px solid #ddd; margin-bottom: 20px;">
            @csrf
            <div style="display: flex; gap: 15px; flex-wrap: wrap;">
                <div class="grupo-input" style="flex: 2; min-width: 200px;">
                    <label>Título del Registro:</label>
                    <input type="text" name="titulo" class="input-control" required placeholder="Ej. Presupuesto ciudadano...">
                </div>
                
                <div class="grupo-input" style="flex: 1; min-width: 150px;">
                    <label>Tipo de Registro:</label>
                    <select name="tipo" class="input-control" id="tipoSelect" onchange="cambiarTipoInput()" required>
                        <option value="pdf">Archivo PDF</option>
                        <option value="link">Enlace Web (URL)</option>
                    </select>
                </div>
            </div>

            <div style="display: flex; gap: 15px; flex-wrap: wrap; margin-top: 10px;">
                <div class="grupo-input" id="divArchivo" style="flex: 1; min-width: 250px;">
                    <label>Archivo (PDF):</label>
                    <input type="file" name="archivo" class="input-control" accept=".pdf">
                </div>

                <div class="grupo-input" id="divUrl" style="flex: 1; min-width: 250px; display: none;">
                    <label>Enlace (URL):</label>
                    <input type="url" name="url" class="input-control" placeholder="https://...">
                </div>
            </div>

            <button type="submit" class="btn-gob mt-3" style="background-color: var(--gob-azul); color: white;"><i class="bi bi-plus-lg"></i> Guardar Registro</button>
        </form>

        <div class="lista-registros">
            @forelse($registros as $reg)
                <div class="registro-item">
                    <div class="registro-img" style="width: 60px; height: 60px; border-radius: 8px; background-color: #f8f9fa; border: 1px solid #ddd; display: flex; align-items: center; justify-content: center;">
                        @if($reg->extension == 'link')
                            <i class="bi bi-display text-muted" style="font-size: 1.8rem;"></i>
                        @else
                            <i class="bi bi-file-earmark-pdf text-muted" style="font-size: 1.8rem; color: #dc3545 !important;"></i>
                        @endif
                    </div>
                    <div class="registro-texto">
                        <p style="font-size: 1.05rem; color: var(--gob-azul); font-weight: bold; margin: 0;">{{ $reg->titulo }}</p>
                        
                        @if($reg->extension == 'link')
                            <a href="{{ $reg->archivo }}" target="_blank" style="font-size: 0.8rem; color: #888; text-decoration: none;"><i class="bi bi-link-45deg"></i> Ir al enlace web</a>
                        @else
                            <a href="{{ asset('storage/documentos/'.$reg->archivo) }}" target="_blank" style="font-size: 0.8rem; color: #888; text-decoration: none;"><i class="bi bi-paperclip"></i> Ver PDF adjunto</a>
                        @endif
                    </div>
                    <div class="registro-acciones">
                        <form action="{{ route('documento.destroy', $reg->id) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar este registro?');">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn-icono btn-eliminar"><i class="bi bi-trash3-fill"></i></button>
                        </form>
                    </div>
                </div>
            @empty
                <p style="text-align: center; color: #888;">No hay registros de seguimiento aún.</p>
            @endforelse
        </div>
    </div>

    <script>
        function cambiarTipoInput() {
            var tipo = document.getElementById("tipoSelect").value;
            if (tipo === "pdf") {
                document.getElementById("divArchivo").style.display = "block";
                document.getElementById("divUrl").style.display = "none";
            } else {
                document.getElementById("divArchivo").style.display = "none";
                document.getElementById("divUrl").style.display = "block";
            }
        }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.22.1/ckeditor.js"></script>
<script>
    window.addEventListener('load', function() {
        if(typeof CKEDITOR !== 'undefined') {
            CKEDITOR.replace('editor-seguimiento');
        }
    });
</script>
@endsection