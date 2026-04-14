@extends('layouts.app')

@section('title', 'Planeación')

@section('content')
    @if(session('success'))
        <div style="background: #d4edda; color: #155724; padding: 15px; border-radius: 8px; margin-bottom: 20px; font-weight: bold;">
            <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
        </div>
    @endif

    <div class="card-bienvenida mb-4">
        <h2>1. Editar Texto Introductorio</h2>
        <p class="texto-ayuda">Modifique la información general sobre el Plan Estatal de Desarrollo (PED).</p>
        <hr class="linea-divisoria">
        <form action="{{ route('planeacion.info.update') }}" method="POST" class="formulario-gob">
            @csrf
            <div class="grupo-input">
                <label>Contenido del bloque de texto:</label>
                <textarea name="descripcion" class="input-form area-texto" rows="8" required>{{ $info->descripcion }}</textarea>
            </div>
            <div class="caja-botones">
                <button type="submit" class="btn-gob btn-guardar"><i class="bi bi-floppy"></i> Guardar Texto</button>
            </div>
        </form>
    </div>

    <div class="card-bienvenida">
        <div class="bloque-sesiones" style="background: transparent; border: none; padding: 0;">
            <div class="encabezado-bloque" style="border-bottom: none; margin-bottom: 0;">
                <div class="titulo-y-acciones" style="flex-direction: column; align-items: flex-start;">
                    <h2 style="margin: 0;">2. Documentos de Planeación</h2>
                    <p class="texto-ayuda" style="margin-top: 5px;">Gestione los documentos descargables (Portadas y PDFs).</p>
                </div>
            </div>
            <hr class="linea-divisoria" style="margin-top: 10px;">

            <form action="{{ route('planeacion.documento.store') }}" method="POST" enctype="multipart/form-data" style="background: #f9f9f9; padding: 20px; border-radius: 8px; border: 1px solid #ddd; margin-bottom: 20px;">
                @csrf
                <div style="display: flex; gap: 15px; flex-wrap: wrap;">
                    <div class="grupo-input" style="flex: 2; min-width: 250px;">
                        <label>Título del Documento:</label>
                        <input type="text" name="titulo" class="input-control" required placeholder="Ej. Plan estatal de desarrollo...">
                    </div>
                    <div class="grupo-input" style="flex: 1; min-width: 150px;">
                        <label>Portada (Imagen JPG/PNG):</label>
                        <input type="file" name="portada" class="input-control" accept="image/*">
                    </div>
                    <div class="grupo-input" style="flex: 1; min-width: 150px;">
                        <label>Archivo (PDF):</label>
                        <input type="file" name="archivo" class="input-control" accept=".pdf">
                    </div>
                </div>
                <button type="submit" class="btn-gob mt-2" style="background-color: var(--gob-oro); color: white;"><i class="bi bi-cloud-arrow-up-fill"></i> Subir Documento</button>
            </form>

            <div class="lista-registros">
                @forelse($documentos as $doc)
                    <div class="registro-item">
                        <div class="registro-img" style="height: 70px; width: 55px; background-color: #f1f1f1; border: 1px solid #ddd; overflow: hidden; display: flex; align-items: center; justify-content: center;">
                            @if($doc->portada)
                                <img src="{{ asset('image/planeacion/'.$doc->portada) }}" style="width: 100%; height: 100%; object-fit: cover;" alt="Portada">
                            @else
                                <i class="bi bi-book text-muted" style="font-size: 1.8rem;"></i>
                            @endif
                        </div>
                        <div class="registro-texto">
                            <p style="font-size: 1.05rem; color: var(--gob-guinda); margin: 0; font-weight: bold;">{{ $doc->titulo }}</p>
                            
                            @if($doc->archivo)
                                <a href="{{ asset('storage/documentos/'.$doc->archivo) }}" target="_blank" style="font-size: 0.8rem; color: #0d6efd; text-decoration: none;">
                                    <i class="bi bi-paperclip"></i> Ver PDF adjunto
                                </a>
                            @else
                                <span style="font-size: 0.8rem; color: #888; font-weight: normal;"><i class="bi bi-slash-circle"></i> Sin archivo PDF (Solo visualización)</span>
                            @endif
                        </div>
                        <div class="registro-acciones">
                            <form action="{{ route('planeacion.documento.destroy', $doc->id) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar este documento?');">
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
    </div>
@endsection