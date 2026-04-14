<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
public function index()
{
    $token = session('api_token');

    // DEBUG: Si el token ni siquiera llega aquí, el problema es la sesión del 8002
    if (!$token) {
        return "Error: No hay token en la sesión del Cliente (8002).";
    }

    $response = Http::withToken($token)
        ->get('http://admin.umbrellastella.com/api/dashboard');

    // DEBUG: Si la petición falla, vamos a ver QUÉ dijo el 8000
    if ($response->failed()) {
        dd([
            'Mensaje' => 'La petición al Admin (8000) falló',
            'Status_Code' => $response->status(),
            'Cuerpo_Error' => $response->json(),
            'Token_Enviado' => $token
        ]);
    }

    $data = $response->json()['data'];

    return view('patient.dashboard', [
        'paciente'   => $data['perfil'],
        'citas'      => $data['proximas_citas'],
        'ejercicios' => $data['ejercicios']
    ]);
}
}