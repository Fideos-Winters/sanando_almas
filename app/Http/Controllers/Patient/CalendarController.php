<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CalendarController extends Controller
{
    /**
     * Muestra la vista de citas del paciente consumiendo datos del Admin.
     */
    public function index()
    {
        $token = session('api_token');

        if (!$token) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión.');
        }

        /**
         * Petición al API Admin
         * Usamos el endpoint del dashboard que ya contiene las citas próximas.
         */
        $response = Http::withToken($token)
            ->acceptJson()
            ->get('https://admin.umbrellastella.com/api/dashboard');

        if ($response->successful()) {
            $data = $response->json()['data'] ?? null;
            
            return view('patient.citas', [
                'paciente' => $data['perfil'] ?? null,
                'citas'    => $data['proximas_citas'] ?? []
            ]);
        }

        // Si el token es inválido o el servidor falla, regresamos al origen
        Log::error("Error al cargar citas (8002): " . $response->status());
        return redirect()->route('login');
    }

    /**
     * Sincroniza las citas del paciente con su Google Calendar personal.
     */
    public function sincronizar()
    {
        // Rescatamos ambos tokens de la sesión del Cliente (8002)
        $apiToken    = session('api_token');
        $googleToken = session('google_token'); 
        
        // Si el cliente perdió el token de Google, detenemos el ritual aquí
        if (!$googleToken) {
            return back()->withErrors(['error' => 'La llama de Google se ha extinguido. Por favor, re-inicia sesión.']);
        }

        /**
         * Enviamos la petición POST al Admin para procesar la sincronización.
         * Es vital usar acceptJson() para manejar errores de autenticación correctamente.
         */
        $response = Http::withToken($apiToken)
            ->acceptJson()
            ->post('https://admin.umbrellastella.com/api/citas/sincronizar', [
                'google_token' => $googleToken
            ]);

        if ($response->successful()) {
            $data = $response->json();
            
            // Evaluamos el estado de la respuesta del Admin
            $status = $data['status'] ?? 'info';
            $message = $data['message'] ?? 'Ritual de sincronización completado.';

            // Mapeamos los estados del Admin a las alertas del Cliente
            $flashType = match($status) {
                'success' => 'success',
                'warning' => 'warning',
                default   => 'info',
            };

            return back()->with($flashType, $message);
        }

        // Si la petición al Admin falló (Ej: Error 500 o 401)
        Log::error("Falla en sincronización (8002 -> 8000): " . $response->status(), [
            'body' => $response->body()
        ]);

        return back()->withErrors(['error' => 'El santuario Admin no respondió a la sincronización.']);
    }
}