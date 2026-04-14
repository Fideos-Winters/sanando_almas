<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class CalendarController extends Controller
{
    public function index()
    {
        // Pedimos al API Admin las citas del paciente
        $response = Http::withToken(session('api_token'))
        ->get('http://localhost:8000/api/dashboard'); // O un endpoint específico /citas si lo creas

        if ($response->successful()) {
            $data = $response->json()['data'];
            return view('patient.citas', [
                'paciente' => $data['perfil'],
                'citas'    => $data['proximas_citas']
            ]);
        }

        return redirect()->route('login');
    }

public function sincronizar()
    {
        // Rescatamos ambos tokens de la sesión del Cliente (8002)
        $apiToken = session('api_token');
        $googleToken = session('google_token'); 
        
        // Si el cliente olvidó el token de Google, detenemos el viaje aquí mismo
        if (!$googleToken) {
            return back()->withErrors(['error' => 'No hay sesión de Google activa. Vuelve a iniciar sesión.']);
        }

        // Enviamos la petición POST adjuntando el token de Google en el cuerpo
        $response = \Illuminate\Support\Facades\Http::withToken($apiToken)
            ->post('http://localhost:8000/api/citas/sincronizar', [
                'google_token' => $googleToken
            ]);

        // Leemos lo que nos contestó el Admin (8000)
        if ($response->successful()) {
            $data = $response->json();
            
            // Ahora sí, usamos back()->with() porque estamos en el servidor web (8002)
            if ($data['status'] === 'success' || $data['status'] === 'info') {
                return back()->with('success', $data['message']);
            } else {
                return back()->with('warning', $data['message']);
            }
        }

        // Si la petición explotó por alguna razón
        return back()->withErrors(['error' => ' No se pudo procesar la sincronización.']);
    }
}