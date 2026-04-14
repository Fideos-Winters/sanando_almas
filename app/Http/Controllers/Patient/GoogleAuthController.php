<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request; // Importante para que Request funcione
use Illuminate\Support\Facades\Http;

class GoogleAuthController extends Controller
{
    public function redirectToAdmin()
    {
        return redirect('http://admin.umbrellastella.com/api/auth/google/redirect');
    }

    public function handleAdminCallback(Request $request)
    {   
        // Atrapamos las dos llaves que nos manda el Admin
        $token = $request->query('token');
        $googleToken = $request->query('google_token'); // ¡Aquí está la magia!

        if ($token) {
            // Guardamos ambas llaves en la memoria (sesión) del Cliente
            session([
                'api_token' => $token,
                'google_token' => $googleToken
            ]);
            
            return redirect()->route('patient.dashboard');
        }

        return redirect()->route('login')->withErrors('Error al autenticar con Google.');
    }
}