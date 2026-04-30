@extends('layouts.app')
@section('title', 'Inicio')

@section('content')
    <style>
        .grid-noticias { display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 20px; margin-top: 20px; }
        .card-noticia { background: #fff; border: 1px solid #ddd; border-radius: 10px; overflow: hidden; position: relative; box-shadow: 0 4px 6px rgba(0,0,0,0.05); display: flex; flex-direction: column;}
        .imagen-noticia { height: 200px; background: #eee; display: flex; align-items: center; justify-content: center; }
        .imagen-noticia img { width: 100%; height: 100%; object-fit: cover; }
        .texto-noticia { padding: 15px; display: flex; flex-direction: column; flex-grow: 1; }
        
        /* Magia para que el texto largo se corte a 3 líneas con puntos suspensivos (...) */
        .line-clamp-3 { display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis; }
        
        /* Botón de eliminar rojo estilo flotante */
        .btn-eliminar-act { position: absolute; top: 10px; right: 10px; background: #dc3545; color: white; border: none; width: 35px; height: 35px; border-radius: 50%; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: 0.3s; box-shadow: 0 2px 4px rgba(0,0,0,0.2); z-index: 10; }
        .btn-eliminar-act:hover { background: #b02a37; transform: scale(1.1); }
    </style>

    <div class="card-bienvenida">
        <h1>Panel de Control</h1>

        @if(session('success'))
            <div style="background: #d4edda; color: #155724; padding: 15px; border-radius: 8px; margin-bottom: 15px; font-weight: bold;">
                <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
            </div>
        @endif

        <div style="background: #f9f9f9; padding: 25px; border-radius: 12px; border: 1px solid #ddd; margin-bottom: 30px;">
            <h3 style="margin-top:0; border-bottom: 2px solid #ddd; padding-bottom: 10px; margin-bottom: 20px;">
                <i class="bi bi-pencil-square"></i> Redactar Nueva Publicación
            </h3>
            
            <form action="{{ route('actividad.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <!-- 1. Título de la noticia -->
                <div style="margin-bottom: 15px;">
                    <label style="font-weight:bold; font-size: 0.9rem;">Título de la publicación:</label>
                    <input type="text" name="titulo" class="input-control" required placeholder="Ej. Primera reunión de trabajo con los Sectores..." style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; margin-top: 5px; font-size: 1rem;">
                </div>

                <!-- 2. Contenido (La caja de texto grande) -->
                <div style="margin-bottom: 15px;">
                    <label style="font-weight:bold; font-size: 0.9rem;">Cuerpo de la noticia:</label>
                    <textarea name="contenido" class="input-control" required rows="5" placeholder="Como parte de las actividades del Comité de Planeación..." style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; margin-top: 5px; resize: vertical; font-family: inherit; font-size: 0.95rem;"></textarea>
                </div>

                <!-- 3. Imagen y Botón de Enviar -->
                <div style="display: flex; gap: 15px; align-items: flex-end;">
                    <div style="flex: 1;">
                        <label style="font-weight:bold; font-size: 0.9rem;">Imagen de portada (JPG/PNG):</label>
                        <input type="file" name="imagen" class="input-control" style="width: 100%; margin-top: 5px; padding: 6px; background: white; border: 1px solid #ccc; border-radius: 4px;">
                    </div>
                    <button type="submit" class="btn-gob" style="background: var(--gob-verde, #198754); color:white; padding: 10px 30px; border: none; border-radius: 4px; cursor: pointer; font-weight: bold; font-size: 1rem;">
                        <i class="bi bi-send-fill"></i> Publicar Artículo
                    </button>
                </div>
            </form>
        </div>

        <!-- SECCIÓN DE VISTA PREVIA -->
        <div class="seccion-actividades">
            <h3 class="titulo-seccion" style="border-bottom: 2px solid #ddd; padding-bottom: 10px;">VISTA PREVIA DE PUBLICACIONES</h3>
            <div class="grid-noticias">
                @forelse($actividades as $act)
                    <div class="card-noticia">
                        
                        <!-- BOTÓN ELIMINAR -->
                        <form action="{{ route('actividad.destroy', $act->id) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar esta publicación?');" style="margin: 0;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-eliminar-act" title="Eliminar publicación">
                                <i class="bi bi-trash3-fill"></i>
                            </button>
                        </form>

                        <!-- IMAGEN -->
                        <div class="imagen-noticia">
                            @if($act->imagen)
                                <img src="{{ asset('image/actividades/'.$act->imagen) }}" alt="Actividad">
                            @else
                                <i class="bi bi-image" style="font-size: 3rem; color: #ccc;"></i>
                            @endif
                        </div>

                        <!-- TEXTOS (Título y Contenido recortado) -->
                        <div class="texto-noticia">
                            <h4 style="margin: 0 0 10px 0; font-size: 1.05rem; color: #1f2937; line-height: 1.3;">{{ $act->titulo }}</h4>
                            
                            <p class="line-clamp-3" style="margin: 0; font-size: 0.9rem; color: #4b5563; line-height: 1.5; flex-grow: 1;">
                                {{ $act->contenido ?? 'Sin contenido...' }}
                            </p>
                            
                            <p style="margin: 15px 0 0 0; font-size: 0.75rem; color: #9ca3af; text-align: right;">
                                Publicado: {{ $act->created_at->format('d/m/Y') }}
                            </p>
                        </div>
                    </div>
                @empty
                    <p style="text-align: center; color: #888; grid-column: 1 / -1; padding: 30px; background: #fff; border-radius: 8px; border: 1px dashed #ccc;">
                        Aún no hay publicaciones en el portal. Empieza redactando una arriba.
                    </p>
                @endforelse
            </div>
        </div>
    </div>
@endsection