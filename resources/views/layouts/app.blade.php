<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Administrativo SIESE | @yield('title', 'Inicio')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800;900&display=swap" rel="stylesheet">
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-header">
            <img src="{{ asset('image/Logo Gobierno de Chiapas-05.png') }}" alt="Logo Oficial" class="logo-oficial">
        </div>
        <nav>
            <a href="{{ url('/inicio') }}" class="nav-item"><div class="icon-circle bg-guinda"><i class="bi bi-house-door-fill"></i></div> INICIO</a>
            <a href="{{ url('/coplade') }}" class="nav-item"><div class="icon-circle bg-verde"><i class="bi bi-people-fill"></i></div> COPLADE</a>
            <a href="{{ url('/fais') }}" class="nav-item"><div class="icon-circle bg-rosa"><i class="bi bi-chat-quote-fill"></i></div> FAIS</a>
            <a href="{{ url('/planeacion') }}" class="nav-item"><div class="icon-circle bg-oro"><i class="bi bi-graph-up-arrow"></i></div> PLANEACIÓN</a>
            <a href="{{ url('/seguimiento') }}" class="nav-item"><div class="icon-circle bg-azul"><i class="bi bi-search"></i></div> SEGUIMIENTO</a>
            <a href="{{ url('/evaluacion') }}" class="nav-item"><div class="icon-circle bg-guinda"><i class="bi bi-clipboard-check-fill"></i></div> EVALUACIÓN</a>
            <a href="{{ url('/informes') }}" class="nav-item"><div class="icon-circle bg-verde"><i class="bi bi-file-earmark-bar-graph-fill"></i></div> INFORMES</a>
            <a href="{{ url('/herramientas') }}" class="nav-item"><div class="icon-circle bg-negro"><i class="bi bi-tools"></i></div> HERRAMIENTAS</a>
            <a href="{{ url('/monitores') }}" class="nav-item"><div class="icon-circle bg-rosa"><i class="bi bi-speedometer2"></i></div> MONITORES</a>
            <a href="{{ route('panel.usuarios') }}" class="nav-item"><div class="icon-circle" style="background-color: #6f42c1;"><i class="bi bi-person-fill"></i></div> USUARIOS</a>
            <a href="{{ route('footer.index') }}" class="nav-item"><div class="icon-circle" style="background-color: #343a40;"><i class="bi bi-layout-text-window-reverse"></i></div> PIE DE PÁGINA</a>
</li>
        </nav>
    </div>
    <div class="main-content">
        <header class="navbar-solida" style="display: flex; justify-content: space-between; align-items: center;">
            <span>Administración SIESE | Gobierno de Chiapas</span>
            <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                @csrf
                <button type="submit" class="btn-gob" style="background-color: transparent; color: white; border: 1px solid white; padding: 5px 15px; font-size: 0.85rem; cursor: pointer;">
                    <i class="bi bi-box-arrow-right"></i> Salir
                </button>
            </form>
        </header>
        <div class="container-central">
            @yield('content')
        </div>
    </div>
</body>
</html>