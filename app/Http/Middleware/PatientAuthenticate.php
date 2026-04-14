<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PatientAuthenticate
{
public function handle($request, $next) {
    // DEBUG: Si entras aquí y el ID es DIFERENTE al del callback, 
    // es que el navegador tiró la cookie a la basura.
    // dd(session()->getId()); 

    if (!session()->has('api_token')) {
        return redirect()->route('patient.login')->withErrors('La sesión ha expirado.');
    }
    return $next($request);
}
}