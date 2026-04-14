<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Patient\AuthController;
use App\Http\Controllers\Patient\DashboardController;
use App\Http\Controllers\Patient\CalendarController;
use App\Http\Controllers\Patient\EjerciciosController;
use App\Http\Controllers\Patient\GoogleAuthController;

/*
|--------------------------------------------------------------------------
| Rutas Públicas de Acceso (Libres de Middleware)
|--------------------------------------------------------------------------
*/

// Redirigir al login si entran a la raíz
Route::get('/', function () {
    return redirect()->route('home');
});
Route::get('/home', function () {
    return view('public.home');
})->name('home');

// Página de Login
Route::get('/login', [AuthController::class, 'showLogin'])->name('patient.login');

/**
 * EL RITUAL DE GOOGLE (FUERA DE TODO MIDDLEWARE)
 * Esta ruta es el puente hacia el Admin (8000).
 * Importante: La URL debe coincidir con donde pusiste las rutas en el Admin.
 */
Route::get('/auth/google', function() {
    return redirect('http://127.0.0.1:8000/auth/google/redirect');
})->name('google.redirect');

// Recibe el token desde el Admin
Route::get('/auth/callback', [GoogleAuthController::class, 'handleAdminCallback'])->name('auth.callback');
// Aviso de privacidad
Route::get('/aviso-de-privacidad', function () {
    return view('patient.privacy');
})->name('patient.privacy');


/*
|--------------------------------------------------------------------------
| Portal del Paciente (Protegido)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth.patient'])->prefix('portal')->group(function () {
    
    // Dashboard Principal
    Route::get('/', [DashboardController::class, 'index'])->name('patient.dashboard');
    
    // Gestión de Citas
    Route::get('/citas', [CalendarController::class, 'index'])->name('patient.citas');
    Route::post('/sincronizar', [CalendarController::class, 'sincronizar'])->name('patient.sincronizar');
    
    // Lista de Ejercicios
    Route::get('/ejercicios', [EjerciciosController::class, 'index'])->name('patient.ejercicios');

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('patient.logout');
});

/*
|--------------------------------------------------------------------------
| Utilidades de Diagnóstico
|--------------------------------------------------------------------------
*/

Route::get('/test-session', function() {
    session(['test' => 'Hoguera prendida']);
    return redirect('/check-session');
});

Route::get('/check-session', function() {
    return "Estado: " . session('test', 'Fuego apagado');
});