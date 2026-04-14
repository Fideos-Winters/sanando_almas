<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('patient.login');
    }

public function handleApiCallback(Request $request) 
{
    $token = $request->query('token');
    if ($token) {
        session(['api_token' => $token]);
        $request->session()->save(); 
        
        // DEBUG: Mira el ID de sesión antes de irte
        // dd(session()->getId()); 

        return redirect()->route('patient.dashboard');
    }
}
    
    public function logout(Request $request)
    {
        session()->forget('api_token');
        return redirect()->route('patient.login');
    }
}