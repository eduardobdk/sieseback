@extends('layouts.app')
@section('title', 'Gestión de Usuarios')

@section('content')
    <style>
        .tabla-usuarios { width: 100%; border-collapse: collapse; margin-top: 20px; background: white; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
        .tabla-usuarios th { background: var(--gob-verde, #198754); color: white; padding: 12px 15px; text-align: left; font-weight: bold; }
        .tabla-usuarios td { padding: 12px 15px; border-bottom: 1px solid #ddd; color: #333; }
        .tabla-usuarios tr:hover { background-color: #f1f1f1; }
        
        .btn-eliminar-usr { background: #dc3545; color: white; border: none; padding: 6px 12px; border-radius: 4px; cursor: pointer; transition: 0.3s; font-size: 0.9rem; }
        .btn-eliminar-usr:hover { background: #b02a37; }
    </style>

    <div class="card-bienvenida">
        <h1>Gestión de Accesos y Usuarios</h1>

        <!-- Alertas de Éxito o Error -->
        @if(session('success'))
            <div style="background: #d4edda; color: #155724; padding: 15px; border-radius: 8px; margin-bottom: 15px; font-weight: bold;">
                <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div style="background: #f8d7da; color: #721c24; padding: 15px; border-radius: 8px; margin-bottom: 15px; font-weight: bold;">
                <i class="bi bi-exclamation-triangle-fill"></i> {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div style="background: #f8d7da; color: #721c24; padding: 15px; border-radius: 8px; margin-bottom: 15px;">
                <strong><i class="bi bi-x-circle-fill"></i> Ocurrió un error:</strong>
                <ul style="margin-top: 5px; margin-bottom: 0;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Formulario para agregar nuevo usuario -->
        <div style="background: #f9f9f9; padding: 25px; border-radius: 12px; border: 1px solid #ddd; margin-bottom: 30px;">
            <h3 style="margin-top:0; border-bottom: 2px solid #ddd; padding-bottom: 10px; margin-bottom: 20px;">
                <i class="bi bi-person-plus-fill"></i> Registrar Nuevo Administrador
            </h3>
            
            <form action="{{ route('usuarios.store') }}" method="POST">
                @csrf
                <div style="display: flex; gap: 15px; align-items: flex-end; flex-wrap: wrap;">
                    <div style="flex: 1; min-width: 200px;">
                        <label style="font-weight:bold; font-size: 0.9rem;">Nombre Completo:</label>
                        <input type="text" name="name" class="input-control" required placeholder="Ej. Juan Pérez" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; margin-top: 5px;">
                    </div>

                    <div style="flex: 1; min-width: 200px;">
                        <label style="font-weight:bold; font-size: 0.9rem;">Correo Electrónico:</label>
                        <input type="email" name="email" class="input-control" required placeholder="admin@chiapas.gob.mx" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; margin-top: 5px;">
                    </div>

                    <div style="flex: 1; min-width: 200px;">
                        <label style="font-weight:bold; font-size: 0.9rem;">Contraseña:</label>
                        <input type="password" name="password" class="input-control" required placeholder="Mínimo 8 caracteres" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; margin-top: 5px;">
                    </div>

                    <button type="submit" class="btn-gob" style="background: var(--gob-verde, #198754); color:white; padding: 10px 25px; border: none; border-radius: 4px; cursor: pointer; font-weight: bold; height: 42px;">
                        Registrar
                    </button>
                </div>
            </form>
        </div>

        <!-- Lista de Usuarios -->
        <h3 style="margin-top: 40px; margin-bottom: 10px;">Administradores Registrados</h3>
        <table class="tabla-usuarios">
            <thead>
                <tr>
                    <th># ID</th>
                    <th>Nombre</th>
                    <th>Correo Electrónico</th>
                    <th>Fecha de Registro</th>
                    <th style="text-align: center;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($usuarios as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td style="font-weight: bold;">{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at->format('d/m/Y') }}</td>
                        <td style="text-align: center;">
                            @if(auth()->id() != $user->id)
                                <form action="{{ route('usuarios.destroy', $user->id) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas revocar el acceso a este usuario?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-eliminar-usr" title="Eliminar usuario">
                                        <i class="bi bi-trash-fill"></i> Eliminar
                                    </button>
                                </form>
                            @else
                                <span style="color: #888; font-size: 0.85rem; font-style: italic;">Tu cuenta</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection