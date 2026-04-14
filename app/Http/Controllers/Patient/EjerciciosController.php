<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class EjerciciosController extends Controller
{
    /**
     * Recupera la lista de ejercicios asignados al paciente desde la API Admin.
     */
    public function index()
    {
        // Recuperamos el token de la sesión
        $token = session('api_token');

        if (!$token) {
            return redirect()->route('login')->with('error', 'Sesión no válida.');
        }

        /**
         * Petición al Servidor Admin (8000)
         * - withToken: Autenticación Sanctum.
         * - acceptJson: Clave para evitar redirecciones fallidas y errores 500.
         */
        $response = Http::withToken($token)
            ->acceptJson()
            ->get('https://admin.umbrellastella.com/api/ejercicios');

        // Si la llama se extingue (Petición fallida)
        if ($response->failed()) {
            Log::error("Error al consultar ejercicios: " . $response->status(), [
                'id_paciente' => session('id_paciente'),
                'error' => $response->body()
            ]);

            return redirect()->route('patient.dashboard')
                ->with('error', 'No se pudo conectar con el santuario de ejercicios.');
        }

        $data = $response->json();

        /**
         * Retornamos la vista con los datos procesados.
         * Nota: Asegúrate de que la API Admin devuelva exactamente estas claves.
         */
        return view('patient.ejercicios', [
            'paciente'   => $data['paciente'] ?? null,
            'ejercicios' => $data['data'] ?? []
        ]);
    }
}