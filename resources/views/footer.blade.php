@extends('layouts.app')

@section('title', 'Pie de Página')

@section('content')

    @if(session('success'))
        <div style="background: #d4edda; color: #155724; padding: 15px; border-radius: 8px; margin-bottom: 20px; font-weight: bold;">
            <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
        </div>
    @endif

    <div class="card-bienvenida mb-4">
        <h2><i class="bi bi-layout-text-window-reverse"></i> Configuración del Pie de Página (Footer)</h2>
        <p class="texto-ayuda">Edite la información de contactos, dirección y enlaces que aparecen en la parte inferior del sitio público.</p>
        <hr class="linea-divisoria">

        <form action="{{ route('footer.update') }}" method="POST" class="formulario-gob">
            @csrf
            
            <!-- SECCIÓN 1: CONTACTOS -->
            <h4 style="color: var(--gob-verde); margin-top: 15px; border-bottom: 1px solid #eee; padding-bottom: 5px;">
                <i class="bi bi-person-lines-fill"></i> CONTACTOS
            </h4>
            <div style="display: flex; gap: 15px; flex-wrap: wrap; margin-bottom: 20px; margin-top: 15px;">
                <div class="grupo-input" style="flex: 1; min-width: 250px; margin: 0;">
                    <label>Nombre del Contacto 1:</label>
                    <input type="text" name="contacto_1" class="input-control" value="{{ $footer->contacto_1 ?? 'MANUEL FRANCISCO ANTONIO PARIENTE GAVITO' }}" required>
                </div>
                <div class="grupo-input" style="flex: 1; min-width: 250px; margin: 0;">
                    <label>Nombre del Contacto 2:</label>
                    <input type="text" name="contacto_2" class="input-control" value="{{ $footer->contacto_2 ?? 'JOSÉ ANTONIO ZENTENO SANTIAGO' }}">
                </div>
            </div>

            <!-- SECCIÓN 2: VISÍTANOS -->
            <h4 style="color: var(--gob-verde); margin-top: 15px; border-bottom: 1px solid #eee; padding-bottom: 5px;">
                <i class="bi bi-geo-alt-fill"></i> VISÍTANOS
            </h4>
            <div class="grupo-input" style="margin-top: 15px; margin-bottom: 20px;">
                <label>Dirección Física / Ubicación:</label>
                <input type="text" name="direccion" class="input-control" value="{{ $footer->direccion ?? 'TORRE CHIAPAS, NIVEL 10. BLVD. ANDRÉS SERRA ROJAS. GUTIÉRREZ, C.P. 29045.' }}" required>
            </div>

            <!-- SECCIÓN 3: SISTEMA Y REDES -->
            <h4 style="color: var(--gob-verde); margin-top: 15px; border-bottom: 1px solid #eee; padding-bottom: 5px;">
                <i class="bi bi-globe"></i> SISTEMA Y REDES
            </h4>
            <div style="display: flex; gap: 15px; flex-wrap: wrap; margin-top: 15px;">
                <div class="grupo-input" style="flex: 2; min-width: 200px; margin: 0;">
                    <label>Texto de Copyright:</label>
                    <input type="text" name="copyright" class="input-control" value="{{ $footer->copyright ?? '© 2026 SIESE CHIAPAS' }}" required>
                </div>
                
                <div class="grupo-input" style="flex: 1; min-width: 150px; margin: 0;">
                    <label><i class="bi bi-facebook text-primary"></i> Enlace Facebook:</label>
                    <input type="url" name="url_facebook" class="input-control" value="{{ $footer->url_facebook ?? '' }}" placeholder="https://facebook.com/...">
                </div>
                <div class="grupo-input" style="flex: 1; min-width: 150px; margin: 0;">
                    <label><i class="bi bi-twitter-x"></i> Enlace Twitter (X):</label>
                    <input type="url" name="url_twitter" class="input-control" value="{{ $footer->url_twitter ?? '' }}" placeholder="https://twitter.com/...">
                </div>
                <div class="grupo-input" style="flex: 1; min-width: 150px; margin: 0;">
                    <label><i class="bi bi-globe2 text-secondary"></i> Enlace Sitio Web:</label>
                    <input type="url" name="url_web" class="input-control" value="{{ $footer->url_web ?? '' }}" placeholder="https://...">
                </div>
            </div>

            <div class="caja-botones" style="margin-top: 25px; text-align: right;">
                <button type="submit" class="btn-gob btn-guardar" style="background-color: var(--gob-verde); color: white; padding: 12px 24px; border-radius: 6px; font-weight: bold; border: none; cursor: pointer;">
                    <i class="bi bi-floppy-fill"></i> Actualizar Footer
                </button>
            </div>
        </form>
    </div>
@endsection