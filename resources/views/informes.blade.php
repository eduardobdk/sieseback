@extends('layouts.app')

@section('title', 'Informes')

@section('content')
    <div class="card-bienvenida mb-4">
        <h2>1. Editar Descripción de Informes</h2>
        <hr class="linea-divisoria">
        <div class="formulario-gob">
            <div class="grupo-input">
                <label>Contenido del bloque:</label>
                <textarea class="input-form area-texto" rows="5">Documentos que dice el estado que guarda la Administración Pública Estatal, conformados por tres tipos de documentos, Contexto estatal; se compone de ejes, alineados con el Plan Estatal de Desarrollo; así mismo el Anexo 1, Indicadores del Plan Estatal de Desarrollo que presenta la evolución de los indicadores y el grado de cumplimiento de las metas sexenales de manera cuantitativa, cualitativa y gráfica; el Anexo 2, Resumen de financiamiento, muestra los recursos encauzados a los ejes rectores del plan...</textarea>
            </div>
            <div class="caja-botones">
                <button class="btn-gob btn-guardar"><i class="bi bi-floppy"></i> Guardar Texto</button>
            </div>
        </div>
    </div>

    <div class="card-bienvenida">
        <div class="encabezado-bloque" style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #ddd; padding-bottom: 15px; margin-bottom: 20px;">
            <div>
                <h2 style="margin: 0; border: none; padding: 0;">2. Gestión de Informes</h2>
                <p class="texto-ayuda" style="margin-top: 5px;">Cree un informe nuevo y gestione sus documentos adjuntos (Anexos).</p>
            </div>
            <button class="btn-gob" style="background-color: var(--gob-verde); color: white;"><i class="bi bi-plus-lg"></i> Nuevo Informe</button>
        </div>

        <div class="lista-registros">
            <div class="registro-item">
                <div class="registro-img" style="height: 70px; width: 80px; background-color: #f1f1f1; border: 1px solid #ddd;"><i class="bi bi-journal-text text-muted" style="font-size: 2rem;"></i></div>
                <div class="registro-texto">
                    <p style="font-size: 1.05rem; color: var(--gob-verde); font-weight: bold;">Primer Informe de Gobierno 2025</p>
                    <span style="font-size: 0.8rem; color: #888; font-weight: normal;">
                        <i class="bi bi-paperclip"></i> Contiene 3 archivos: Contexto estatal, Anexo I y Anexo II
                    </span>
                </div>
                <div class="registro-acciones">
                    <button class="btn-icono btn-editar"><i class="bi bi-pencil-square"></i></button>
                    <button class="btn-icono btn-eliminar"><i class="bi bi-trash3-fill"></i></button>
                </div>
            </div>
        </div>
    </div>
@endsection