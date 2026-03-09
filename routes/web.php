<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\AuthController;

Route::get('/login', function () {
    return view('login');
})->name('login');

// Ahora esta ruta llama al controlador
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::get('/', function () {
    return view('login');
});
