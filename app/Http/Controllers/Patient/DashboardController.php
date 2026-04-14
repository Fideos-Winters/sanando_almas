<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    /**
     * Muestra el tablero principal del paciente consumiendo la API Admin.
     */
    public function index()
    {
        // Recuperamos el token de la sesión forjada tras el login con Google
        $token = session('api_token');

        if (!$token) {
            return redirect()->route('login')->with('error', 'Sesión expirada.');
        }

        /**
         * Petición al Servidor Admin
         * 1. withToken: Adjunta el Bearer Token.
         * 2. acceptJson: Fuerza al Admin a responder JSON (evita el error 500 de redirección).
         */
        $response = Http::withToken($token)
            ->acceptJson()
            ->get('https://admin.umbrellastella.com/api/dashboard');

        if ($response->failed()) {
            // Registramos el error en los logs para el guardián
            Log::error("Falla en Dashboard: " . $response->status(), ['body' => $response->body()]);
            
            return view('errors.api_error', [
                'code' => $response->status(),
                'message' => 'No se pudo recuperar la información del santuario.'
            ]);
        }

        $responseData = $response->json();
        $data = $responseData['data'] ?? null;

        if (!$data) {
            return abort(500, 'Estructura de datos corrupta.');
        }

        return view('patient.dashboard', [
            'paciente'   => $data['perfil'],
            'citas'      => $data['proximas_citas'],
            'ejercicios' => $data['ejercicios']
        ]);
    }
}