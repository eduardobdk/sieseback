<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // 1. Validamos que el usuario mande los datos
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 2. Intentamos iniciar sesión con la DB
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return "¡Bienvenido! Usuario y contraseña correctos.";
        }

        // 3. Si falla, regresamos al login con error
        return back()->withErrors([
            'email' => 'Las credenciales no coinciden con nuestros registros.',
        ]);
    }
}