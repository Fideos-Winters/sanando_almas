<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class EjerciciosController extends Controller
{
    public function index()
    {
        $token = session('api_token');

        $response = Http::withToken($token)
            ->get('http://admin.umbrellastella.com/api/ejercicios');

        if ($response->successful()) {
            $data = $response->json();
            
            return view('patient.ejercicios', [
                'paciente'   => $data['paciente'],
                'ejercicios' => $data['data']
            ]);
        }

        return redirect()->route('patient.dashboard')->with('error', 'No se pudieron cargar los ejercicios.');
    }
}