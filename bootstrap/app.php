<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
// Importamos la clase real que vimos en tu carpeta Middleware
use App\Http\Middleware\PatientAuthenticate; 

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        
        // 1. Registramos el alias con el nombre CORRECTO de la clase
        $middleware->alias([
            'auth.patient' => PatientAuthenticate::class,
        ]);
    $middleware->statefulApi();

    $middleware->validateCsrfTokens(except: [
        'auth/callback',
    ]);

        // 2. Protegemos el regreso del token de errores de sesión/CSRF
        $middleware->validateCsrfTokens(except: [
            'auth/callback',
            'auth/google',   
        ]);

        // 3. Aseguramos que el estado de la sesión se mantenga entre puertos
        $middleware->statefulApi();
        
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();