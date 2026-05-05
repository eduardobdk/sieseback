<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    // Mostrar la vista con la lista de usuarios
    public function index()
    {
        $usuarios = User::all(); 
        return view('usuarios', compact('usuarios'));
    }

    // Guardar un nuevo usuario
    public function store(Request $request)
    {
        // Validamos que llenen los campos y que el correo no se repita
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ], [
            'email.unique' => 'Este correo ya está registrado en el sistema.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.'
        ]);

        // Creamos el usuario en la BD
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            // Hash::make encripta la contraseña para que sea segura
            'password' => Hash::make($request->password),
        ]);

        return back()->with('success', 'Usuario agregado correctamente.');
    }

    // Eliminar un usuario
    public function destroy($id)
    {
        // Evitamos que el usuario activo se borre a sí mismo
        if (auth()->id() == $id) {
            return back()->with('error', 'Por seguridad, no puedes eliminar tu propia cuenta mientras estás conectado.');
        }

        $usuario = User::find($id);
        if ($usuario) {
            $usuario->delete();
        }

        return back()->with('success', 'Usuario eliminado del sistema.');
    }
}