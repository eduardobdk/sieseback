@extends('layouts.app')
@section('title', 'Inicio')

@section('content')
    <div class="card-bienvenida">
        <h1>Panel de Control</h1>

        <div style="background: #f9f9f9; padding: 20px; border-radius: 12px; border: 1px solid #ddd; margin-bottom: 30px;">
            <h3 style="margin-top:0"><i class="bi bi-plus-circle"></i> Nueva Actividad Reciente</h3>
            <form action="{{ route('actividad.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div style="display: flex; gap: 15px; align-items: flex-end;">
                    <div style="flex: 2;">
                        <label style="font-weight:bold; font-size: 0.9rem;">Título de la noticia:</label>
                        <input type="text" name="titulo" class="input-control" required placeholder="Ej. Inauguración de foro...">
                    </div>
                    <div style="flex: 1;">
                        <label style="font-weight:bold; font-size: 0.9rem;">Imagen (JPG/PNG):</label>
                        <input type="file" name="imagen" class="input-control">
                    </div>
                    <button type="submit" class="btn-gob" style="background: var(--gob-verde); color:white; padding: 10px 25px;">Publicar</button>
                </div>
            </form>
        </div>

        <div class="seccion-actividades">
            <h3 class="titulo-seccion">VISTA PREVIA EN EL PORTAL</h3>
            <div class="grid-noticias">
                @forelse($actividades as $act)
                    <div class="card-noticia">
                        <div class="imagen-noticia">
                            @if($act->imagen)
                                <img src="{{ asset('image/actividades/'.$act->imagen) }}" style="width:100%; height:100%; object-fit:cover;">
                            @else
                                <i class="bi bi-image text-muted"></i>
                            @endif
                        </div>
                        <div class="texto-noticia">
                            <p>{{ $act->titulo }}</p>
                        </div>
                    </div>
                @empty
                    <p style="text-align: center; color: #888;">Aún no hay actividades publicadas.</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection