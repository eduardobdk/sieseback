@extends('layouts.app')

@section('title', 'Evaluación')

@section('content')
    @if(session('success'))
        <div style="background: #d4edda; color: #155724; padding: 15px; border-radius: 8px; margin-bottom: 20px; font-weight: bold;">
            <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
        </div>
    @endif

    <div class="card-bienvenida mb-4">
        <h2>1. Editar Descripción de Evaluación</h2>
        <hr class="linea-divisoria">
        <form action="{{ route('evaluacion.info.update') }}" method="POST" class="formulario-gob">
            @csrf
            <div class="grupo-input">
                <label>Contenido del bloque:</label>
                <textarea name="descripcion" class="input-form area-texto" rows="5" required>{{ $info->descripcion }}</textarea>
            </div>
            <div class="caja-botones">
                <button type="submit" class="btn-gob btn-guardar"><i class="bi bi-floppy"></i> Guardar Texto</button>
            </div>
        </form>
    </div>

    <div class="card-bienvenida">
        <div class="encabezado-bloque" style="border-bottom: 1px solid #ddd; padding-bottom: 15px; margin-bottom: 20px;">
            <h2 style="margin: 0; border: none; padding: 0;">2. Documentos de Evaluación</h2>
            <p class="texto-ayuda" style="margin-top: 5px;">Gestione los documentos descargables (Portadas y PDFs).</p>
        </div>

        <form action="{{ route('evaluacion.documento.store') }}" method="POST" enctype="multipart/form-data" style="background: #f9f9f9; padding: 20px; border-radius: 8px; border: 1px solid #ddd; margin-bottom: 20px;">
            @csrf
            <div style="display: flex; gap: 15px; flex-wrap: wrap;">
                <div class="grupo-input" style="flex: 2; min-width: 250px;">
                    <label>Título del Documento:</label>
                    <input type="text" name="titulo" class="input-control" required placeholder="Ej. PED-Chiapas...">
                </div>
                <div class="grupo-input" style="flex: 1; min-width: 150px;">
                    <label>Portada (Imagen):</label>
                    <input type="file" name="portada" class="input-control" accept="image/*">
                </div>
                <div class="grupo-input" style="flex: 1; min-width: 150px;">
                    <label>Archivo (PDF):</label>
                    <input type="file" name="archivo" class="input-control" accept=".pdf">
                </div>
            </div>
            <button type="submit" class="btn-gob mt-2" style="background-color: var(--gob-guinda); color: white;"><i class="bi bi-cloud-arrow-up-fill"></i> Subir Documento</button>
        </form>

        <div class="lista-registros">
            @forelse($documentos as $doc)
                <div class="registro-item">
                    <div class="registro-img" style="height: 70px; width: 55px; background-color: #f1f1f1; border: 1px solid #ddd; overflow: hidden; display: flex; align-items: center; justify-content: center;">
                        @if($doc->portada)
                            <img src="{{ asset('image/evaluacion/'.$doc->portada) }}" style="width: 100%; height: 100%; object-fit: cover;" alt="Portada">
                        @else
                            <i class="bi bi-book text-muted" style="font-size: 1.8rem;"></i>
                        @endif
                    </div>
                    <div class="registro-texto">
                        <p style="font-size: 1.05rem; color: var(--gob-guinda); font-weight: bold; margin: 0;">{{ $doc->titulo }}</p>
                        
                        @if($doc->archivo)
                            <a href="{{ asset('storage/documentos/'.$doc->archivo) }}" target="_blank" style="font-size: 0.8rem; color: #0d6efd; text-decoration: none;">
                                <i class="bi bi-paperclip"></i> Ver PDF adjunto
                            </a>
                        @else
                            <span style="font-size: 0.8rem; color: #888; font-weight: normal;"><i class="bi bi-slash-circle"></i> Sin archivo PDF</span>
                        @endif
                    </div>
                    <div class="registro-acciones">
                        <form action="{{ route('evaluacion.documento.destroy', $doc->id) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar este documento?');">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn-icono btn-eliminar"><i class="bi bi-trash3-fill"></i></button>
                        </form>
                    </div>
                </div>
            @empty
                <p style="text-align: center; color: #888;">No hay documentos registrados aún.</p>
            @endforelse
        </div>
    </div>
@endsection