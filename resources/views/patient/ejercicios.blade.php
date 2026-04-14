@extends('layouts.patient')

@section('content')

@php
    // Convertimos el array del API en una colección de objetos para mantener la sintaxis ->
    $ejerciciosColl = collect($ejercicios)->map(fn($item) => (object) $item);
@endphp

<header style="margin-bottom:28px;">
    <h1 style="font-size:24px; font-weight:800; color:#010e6b; margin:0 0 4px; letter-spacing:-0.01em;">
        Mis Ejercicios
    </h1>
    <p style="font-size:14px; color:#4b4b72; margin:0;">
        Ejercicios asignados por tu psicologa durante tus sesiones.
    </p>
</header>

@if($ejerciciosColl->isEmpty())
<div class="card" style="padding:60px; text-align:center;">
    <div style="width:52px; height:52px; border-radius:50%; background:rgba(1,14,107,0.07); display:flex; align-items:center; justify-content:center; margin:0 auto 16px;">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="#703b94">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
        </svg>
    </div>
    <p style="font-size:15px; font-weight:600; color:#4b4b72;">No tienes ejercicios asignados aun.</p>
    <p style="font-size:13px; color:#9898b8; margin-top:4px;">Tu psicologa los asignara durante tus sesiones.</p>
</div>
@else
<div style="display:grid; grid-template-columns:repeat(auto-fill, minmax(300px, 1fr)); gap:16px;">
    @foreach($ejerciciosColl as $index => $ejercicio)
    <div class="card" style="padding:22px; border-left:4px solid #703b94;">
        <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:12px;">
            <span style="font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:0.08em; color:#703b94;">
                Ejercicio {{ $index + 1 }}
            </span>
        </div>
        <h3 style="font-size:15px; font-weight:800; color:#010e6b; margin:0 0 10px; line-height:1.3;">
            {{ $ejercicio->nombre_ejercicio ?? $ejercicio->titulo }}
        </h3>
        <p style="font-size:13px; color:#4b4b72; margin:0; line-height:1.7;">
            {{ $ejercicio->descripcion }}
        </p>
    </div>
    @endforeach
</div>
@endif

@endsection