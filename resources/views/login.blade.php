<!DOCTYPE html>
<html lang="es-MX">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso Administrativo | SIESE</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <style>
        :root {
            --oficial-rojo: #AE192D;
            --oficial-rosa: #C90166;
            --oficial-verde: #009887;
            --complem-beige: #D3C2B4;
            --complem-negro: #000000;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0; padding: 0; height: 100vh;
            font-family: 'Montserrat', sans-serif;
            overflow: hidden; display: flex;
            align-items: center; justify-content: center;
        }

        .contenedor-fondo {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            z-index: -1; object-fit: cover;
        }

        .login-card {
            position: relative; background: rgba(255, 255, 255, 0.96);
            width: 90%; max-width: 480px; padding: 40px;
            border-radius: 12px; box-shadow: 0 20px 60px rgba(0,0,0,0.15);
            border-top: 5px solid var(--oficial-rojo);
            backdrop-filter: blur(5px);
        }

        .card-header { text-align: center; margin-bottom: 30px; }
        .brand-logo { max-width: 150px; width: 100%; height: auto; margin-bottom: 10px; }

        .system-badge {
            background-color: #f4f4f4; color: var(--oficial-rojo);
            padding: 5px 12px; border-radius: 4px; font-size: 0.75rem;
            font-weight: 700; text-transform: uppercase; letter-spacing: 1px;
            border: 1px solid var(--complem-beige);
        }

        .input-group { position: relative; margin-bottom: 25px; }

        .input-label {
            display: block; font-size: 0.8rem; font-weight: 700;
            color: var(--oficial-rojo); margin-bottom: 8px; text-transform: uppercase;
        }

        .custom-input {
            width: 100%; padding: 14px 45px 14px 45px;
            border: 1px solid #ddd; border-radius: 6px;
            background-color: #fdfdfd; font-size: 1rem;
            outline: none; transition: 0.3s; color: var(--complem-negro);
        }

        .input-icon {
            position: absolute; left: 15px; bottom: 14px;
            color: var(--oficial-verde); font-size: 1.2rem;
        }

        .toggle-password {
            position: absolute; right: 15px; bottom: 14px;
            color: #888; font-size: 1.2rem; cursor: pointer; transition: 0.3s;
        }
        .toggle-password:hover { color: var(--oficial-rojo); }

        .custom-input:focus {
            border-color: var(--oficial-rojo);
            background-color: #fff;
            box-shadow: 0 0 0 4px rgba(174, 25, 45, 0.1); 
        }

        .btn-submit {
            width: 100%; padding: 16px;
            background: linear-gradient(to right, var(--oficial-rojo), var(--oficial-rosa));
            color: white; border: none; border-radius: 6px;
            font-size: 1rem; font-weight: 600; text-transform: uppercase;
            cursor: pointer; transition: 0.3s; margin-top: 10px;
        }
        .btn-submit:hover { 
            box-shadow: 0 5px 15px rgba(174, 25, 45, 0.4); 
            transform: translateY(-2px); 
            background: linear-gradient(to right, var(--oficial-rosa), var(--oficial-rojo));
        }

        .footer-link { text-align: center; margin-top: 25px; font-size: 0.8rem; }
        .footer-link a { color: #888; text-decoration: none; transition: 0.3s; }
        .footer-link a:hover { color: var(--oficial-verde); }
    </style>
</head>
<body>

    <img src="{{ asset('image/Trama_1.png') }}" alt="Fondo" class="contenedor-fondo">

    <div class="login-card">
        <div class="card-header">
            <img src="{{ asset('image/logo gobierno de chiapas-05.png') }}" alt="Gobierno de Chiapas" class="brand-logo">
            <br>
            <span class="system-badge">Administración SIESE</span>
        </div>

        <form action="{{ route('login.post') }}" method="POST">
            @csrf
            <div class="input-group">
                <label class="input-label">Usuario</label>
                <i class="bi bi-person-fill input-icon"></i>
                <input type="text" name="email" class="custom-input" placeholder="admin@siese.com" required value="{{ old('email') }}">
            </div>

            <div class="input-group">
                <label class="input-label">Contraseña</label>
                <i class="bi bi-key-fill input-icon"></i>
                <input type="password" name="password" id="password" class="custom-input" placeholder="••••••••" required>
                <i class="bi bi-eye-slash toggle-password" id="togglePassword"></i>
            </div>

            @if ($errors->any())
                <div style="color: #AE192D; font-size: 0.8rem; margin-bottom: 15px; text-align: center; font-weight: bold;">
                    Las credenciales no son correctas.
                </div>
            @endif

            <button type="submit" class="btn-submit">Ingresar</button>
        </form>

        <div class="footer-link">
            <a href="https://siese.chiapas.gob.mx"><i class="bi bi-arrow-left"></i> Volver al Portal</a>
        </div>
    </div>

    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');

        togglePassword.addEventListener('click', function () {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            this.classList.toggle('bi-eye');
            this.classList.toggle('bi-eye-slash');
        });
    </script>
</body>
</html>