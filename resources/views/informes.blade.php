@extends('layouts.app')

@section('title', 'Informes')

@section('content')
    @if(session('success'))
        <div style="background: #d4edda; color: #155724; padding: 15px; border-radius: 8px; margin-bottom: 20px; font-weight: bold;">
            <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
        </div>
    @endif

    <div class="card-bienvenida mb-4">
        <h2>1. Editar Descripción de Informes</h2>
        <hr class="linea-divisoria">
        <form action="{{ route('informes.info.update') }}" method="POST" class="formulario-gob">
            @csrf
            <div class="grupo-input">
                <label>Contenido del bloque (Texto de introducción):</label>
                <textarea name="descripcion" class="input-form area-texto" rows="5" required>{{ $info->descripcion ?? '' }}</textarea>
            </div>
            <div class="caja-botones">
                <button type="submit" class="btn-gob btn-guardar"><i class="bi bi-floppy"></i> Guardar Texto</button>
            </div>
        </form>
    </div>

    <div class="card-bienvenida">
        <div class="encabezado-bloque" style="border-bottom: 1px solid #ddd; padding-bottom: 15px; margin-bottom: 20px;">
            <h2 style="margin: 0;">2. Gestión de Informes</h2>
            <p class="texto-ayuda" style="margin-top: 5px;">Cree un informe nuevo y gestione sus documentos adjuntos (Anexos).</p>
        </div>

        <form action="{{ route('informes.store') }}" method="POST" enctype="multipart/form-data" style="background: #f9f9f9; padding: 20px; border-radius: 8px; border: 1px solid #ddd; margin-bottom: 25px;">
            @csrf
            <h4 style="margin-top: 0; color: var(--gob-verde);"><i class="bi bi-cloud-plus"></i> Registrar Nuevo Informe</h4>
            
            <div style="display: flex; gap: 15px; flex-wrap: wrap; margin-bottom: 15px;">
                <div class="grupo-input" style="flex: 2; min-width: 250px;">
                    <label>Título del Informe:</label>
                    <input type="text" name="titulo" class="input-control" required placeholder="Ej. Primer Informe de Gobierno 2025...">
                </div>
                <div class="grupo-input" style="flex: 1; min-width: 200px;">
                    <label>Portada (Imagen):</label>
                    <input type="file" name="portada" class="input-control" accept="image/*">
                </div>
            </div>

            <div style="display: flex; gap: 15px; flex-wrap: wrap; background: #fff; padding: 15px; border-radius: 5px; border: 1px dashed #ccc;">
                <div class="grupo-input" style="flex: 1; min-width: 200px; margin: 0;">
                    <label style="font-size: 0.85rem;"><i class="bi bi-file-pdf text-danger"></i> Contexto Estatal:</label>
                    <input type="file" name="pdf_contexto" class="input-control" accept=".pdf">
                </div>
                <div class="grupo-input" style="flex: 1; min-width: 200px; margin: 0;">
                    <label style="font-size: 0.85rem;"><i class="bi bi-file-pdf text-danger"></i> Anexo 1:</label>
                    <input type="file" name="pdf_anexo1" class="input-control" accept=".pdf">
                </div>
                <div class="grupo-input" style="flex: 1; min-width: 200px; margin: 0;">
                    <label style="font-size: 0.85rem;"><i class="bi bi-file-pdf text-danger"></i> Anexo 2:</label>
                    <input type="file" name="pdf_anexo2" class="input-control" accept=".pdf">
                </div>
            </div>

            <button type="submit" class="btn-gob mt-3" style="background-color: var(--gob-verde); color: white;"><i class="bi bi-check-circle"></i> Guardar Informe Completo</button>
        </form>

        <div class="lista-registros">
            @forelse($informes as $informe)
                <div class="registro-item">
                    <div class="registro-img" style="height: 80px; width: 65px; background-color: #f1f1f1; border: 1px solid #ddd; overflow: hidden; display: flex; align-items: center; justify-content: center;">
                        @if($informe->portada)
                            <img src="{{ asset('image/informes/'.$informe->portada) }}" style="width: 100%; height: 100%; object-fit: cover;" alt="Portada">
                        @else
                            <i class="bi bi-journal-text text-muted" style="font-size: 2rem;"></i>
                        @endif
                    </div>
                    
                    <div class="registro-texto">
                        <p style="font-size: 1.05rem; color: var(--gob-verde); font-weight: bold; margin: 0 0 5px 0;">{{ $informe->titulo }}</p>
                        
                        <div style="display: flex; gap: 10px; font-size: 0.8rem;">
                            @if($informe->pdf_contexto)
                                <a href="{{ asset('storage/documentos/'.$informe->pdf_contexto) }}" target="_blank" style="color: #0d6efd; text-decoration: none;"><i class="bi bi-paperclip"></i> Contexto</a>
                            @endif
                            @if($informe->pdf_anexo1)
                                <a href="{{ asset('storage/documentos/'.$informe->pdf_anexo1) }}" target="_blank" style="color: #0d6efd; text-decoration: none;"><i class="bi bi-paperclip"></i> Anexo 1</a>
                            @endif
                            @if($informe->pdf_anexo2)
                                <a href="{{ asset('storage/documentos/'.$informe->pdf_anexo2) }}" target="_blank" style="color: #0d6efd; text-decoration: none;"><i class="bi bi-paperclip"></i> Anexo 2</a>
                            @endif
                        </div>
                    </div>

                    <div class="registro-acciones">
                        <form action="{{ route('informes.destroy', $informe->id) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar TODO el informe y sus PDFs?');">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn-icono btn-eliminar"><i class="bi bi-trash3-fill"></i></button>
                        </form>
                    </div>
                </div>
            @empty
                <p style="text-align: center; color: #888;">No hay informes registrados aún.</p>
            @endforelse
        </div>
    </div>
@endsection