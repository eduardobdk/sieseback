@extends('layouts.app')

@section('title', 'Monitores SITEC')

@section('content')
    <div class="card-bienvenida mb-4">
        <h2>1. Controles del Tablero SITEC</h2>
        <p class="texto-ayuda">Modifique los valores aquí para ver cómo cambian en la vista previa de abajo.</p>
        <hr class="linea-divisoria">

        <div class="formulario-gob">
            <div style="display: flex; gap: 20px; flex-wrap: wrap;">
                <div class="grupo-input" style="flex: 1; min-width: 200px;">
                    <label>Año de Ejercicio:</label>
                    <select class="input-control" id="admin-anio">
                        <option>2023</option>
                        <option selected>2022</option>
                        <option>2021</option>
                    </select>
                </div>
                <div class="grupo-input" style="flex: 1; min-width: 200px;">
                    <label>Nivel de Cumplimiento (0 - 100):</label>
                    <input type="number" step="0.01" class="input-control" id="admin-valor" value="87.63">
                </div>
            </div>
            <div class="caja-botones mt-3">
                <button class="btn-gob btn-guardar" onclick="actualizarVelocimetro()"><i class="bi bi-arrow-repeat"></i> Actualizar Vista Previa</button>
            </div>
        </div>
    </div>

    <div class="card-bienvenida">
        <h2 style="color: var(--gob-negro); margin-bottom: 15px;"><i class="bi bi-display"></i> Vista Previa: Monitor SITEC</h2>
        <hr class="linea-divisoria" style="margin-bottom: 20px;">
        
        <div style="border: 2px solid #eee; border-radius: 12px; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.05);">
            
            <div style="background-color: var(--gob-negro); color: white; text-align: center; padding: 15px; font-size: 1.1rem; font-weight: bold; border-bottom: 4px solid var(--gob-guinda);">
                Monitor del Sistema Integral del Tablero Estratégico de Control (SITEC)
            </div>

            <div style="background-color: #f8f9fa; padding: 15px 20px; border-bottom: 1px solid #ddd;">
                <div class="tabs-anios" style="margin: 0; border: none; padding: 0;">
                    <button class="tab-anio">2019</button>
                    <button class="tab-anio">2020</button>
                    <button class="tab-anio">2021</button>
                    <button class="tab-anio activo">2022</button>
                    <button class="tab-anio">2023</button>
                    <button class="tab-anio">2024</button>
                    <button class="tab-anio">2025</button>
                </div>
            </div>

            <div style="display: flex; background: white; border-bottom: 2px solid #eee; text-align: center;">
                <div style="flex: 1; padding: 15px 5px; border-right: 1px dashed #ddd; color: var(--gob-oro); font-weight: 800; font-size: 0.75rem;">EJE 1.<br>GOBIERNO<br>EFICAZ Y<br>HONESTO</div>
                <div style="flex: 1; padding: 15px 5px; border-right: 1px dashed #ddd; color: var(--gob-negro); font-weight: 800; font-size: 0.75rem;">EJE 2.<br>BIENESTAR<br>SOCIAL</div>
                <div style="flex: 1; padding: 15px 5px; border-right: 1px dashed #ddd; color: var(--gob-guinda); font-weight: 800; font-size: 0.75rem;">EJE 3.<br>EDUCACIÓN,<br>CIENCIA Y<br>CULTURA</div>
                <div style="flex: 1; padding: 15px 5px; border-right: 1px dashed #ddd; color: var(--gob-guinda); font-weight: 800; font-size: 0.75rem;">EJE 4.<br>DESARROLLO<br>ECONÓMICO</div>
                <div style="flex: 1; padding: 15px 5px; color: var(--gob-guinda); font-weight: 800; font-size: 0.75rem;">EJE 5.<br>BIODIVERSIDAD<br>Y DESARROLLO</div>
            </div>

            <div style="display: flex; padding: 25px; gap: 25px; background-color: #fafafa;">
                
                <div style="flex: 1;">
                    <h3 style="font-size: 1rem; color: var(--gob-negro); margin-top: 0; margin-bottom: 15px; border-bottom: 2px solid var(--gob-oro); padding-bottom: 8px;">Políticas Públicas</h3>
                    
                    <div class="lista-registros">
                        <div class="registro-item" style="padding: 12px; border-left: 4px solid var(--gob-oro);"><div class="registro-texto"><p style="margin:0; font-size:0.85rem; font-weight: 600;">1.1.1. Gobernabilidad y gobernanza</p></div></div>
                        <div class="registro-item" style="padding: 12px; border-left: 4px solid var(--gob-oro);"><div class="registro-texto"><p style="margin:0; font-size:0.85rem; font-weight: 600;">1.1.2. Resiliencia y gestión de riesgos</p></div></div>
                        <div class="registro-item" style="padding: 12px; border-left: 4px solid var(--gob-oro);"><div class="registro-texto"><p style="margin:0; font-size:0.85rem; font-weight: 600;">1.2.1. Finanzas públicas responsables y austeras</p></div></div>
                        <div class="registro-item" style="padding: 12px; border-left: 4px solid var(--gob-oro);"><div class="registro-texto"><p style="margin:0; font-size:0.85rem; font-weight: 600;">1.2.2. Gestión pública transparente</p></div></div>
                        <div class="registro-item" style="padding: 12px; border-left: 4px solid var(--gob-oro);"><div class="registro-texto"><p style="margin:0; font-size:0.85rem; font-weight: 600;">1.3.1. Seguridad ciudadana</p></div></div>
                    </div>
                </div>

                <div style="flex: 1.5; display: flex; flex-direction: column; gap: 20px;">
                    
                    <div style="background: white; border: 1px solid #eee; border-radius: 10px; padding: 20px; box-shadow: 0 2px 8px rgba(0,0,0,0.03);">
                        <h3 style="font-size: 1rem; color: var(--gob-negro); margin-top: 0; margin-bottom: 15px; border-bottom: 2px solid var(--gob-verde); padding-bottom: 8px;">Resumen del Plan Estatal de Desarrollo</h3>
                        
                        <div style="display: flex; align-items: flex-start; margin-bottom: 15px; gap: 12px;">
                            <i class="bi bi-circle-fill" style="color: var(--gob-verde); font-size: 1.2rem; margin-top: 2px;"></i>
                            <div style="font-size: 0.9rem; color: #555; line-height: 1.4;">Nivel de cumplimiento <strong style="color: var(--gob-negro); font-size: 1rem;">87.63</strong> del <strong>Plan Estatal</strong>; avance sexenal de 78.27</div>
                        </div>
                        <div style="display: flex; align-items: flex-start; gap: 12px;">
                            <i class="bi bi-circle-fill" style="color: #ccc; font-size: 1.2rem; margin-top: 2px;"></i>
                            <div style="font-size: 0.9rem; color: #555; line-height: 1.4;">Financiamiento a través del Presupuesto de las 44 políticas; de un devengado de <strong style="color: var(--gob-negro); font-size: 1rem;">$112,995,922,218.00</strong> a través del financiamiento de 2,165 proyectos.</div>
                        </div>
                    </div>

                    <div style="background: white; border: 1px solid #eee; border-radius: 10px; padding: 20px; box-shadow: 0 2px 8px rgba(0,0,0,0.03); flex-grow: 1;">
                        <h3 style="font-size: 1rem; color: var(--gob-negro); margin-top: 0; margin-bottom: 15px; border-bottom: 2px solid var(--gob-azul); padding-bottom: 8px;">Nivel de Cumplimiento</h3>
                        
                        <div id="container-velocimetro" style="height: 250px; width: 100%;"></div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/highcharts-more.js"></script>
    <script src="https://code.highcharts.com/modules/solid-gauge.js"></script>

    <script>
        let chartVelocimetro;

        document.addEventListener('DOMContentLoaded', function () {
            // Configuración del velocímetro estilo SIESE
            chartVelocimetro = Highcharts.chart('container-velocimetro', {
                chart: { type: 'gauge', plotBackgroundColor: null, plotBackgroundImage: null, plotBorderWidth: 0, plotShadow: false },
                title: { text: null },
                pane: {
                    startAngle: -90, endAngle: 90,
                    background: [{ backgroundColor: '#f4f4f4', innerRadius: '60%', outerRadius: '100%', shape: 'arc', borderWidth: 0 }]
                },
                tooltip: { enabled: false },
                yAxis: {
                    min: 0, max: 100,
                    tickPixelInterval: 10, tickPosition: 'inside', tickColor: '#333', tickLength: 20, tickWidth: 2,
                    minorTickInterval: null,
                    labels: { distance: 15, style: { fontSize: '12px', fontFamily: 'Montserrat, sans-serif' } },
                    plotBands: [
                        { from: 0, to: 60, color: '#dc3545' }, // Rojo Bootstrap
                        { from: 60, to: 80, color: '#ffc107' }, // Amarillo Bootstrap
                        { from: 80, to: 100, color: '#28a745' } // Verde Bootstrap
                    ]
                },
                series: [{
                    name: 'Cumplimiento',
                    data: [87.63],
                    dataLabels: {
                        format: '<div style="text-align:center"><span style="font-size:24px;color:#1A1A1A;font-weight:bold;font-family:Montserrat">{y}</span><br/><span style="font-size:12px;color:#888;font-family:Montserrat">NdC</span></div>',
                        y: 30, borderWidth: 0
                    },
                    dial: { radius: '80%', backgroundColor: '#1A1A1A', baseWidth: 12, topWidth: 1, baseLength: '0%', rearLength: '0%' },
                    pivot: { backgroundColor: '#1A1A1A', radius: 6 }
                }],
                credits: { enabled: false }
            });
        });

        // Función para que el botón de administrador mueva la aguja
        function actualizarVelocimetro() {
            let nuevoValor = parseFloat(document.getElementById('admin-valor').value);
            if(chartVelocimetro && !isNaN(nuevoValor)) {
                let point = chartVelocimetro.series[0].points[0];
                point.update(nuevoValor);
            }
        }
    </script>
@endsection