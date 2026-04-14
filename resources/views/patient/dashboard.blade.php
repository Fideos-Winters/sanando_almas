@extends('layouts.patient')

@section('content')

@php
    $pacienteObj = (object) $paciente;
    $citasColl = collect($citas)->map(fn($item) => (object) $item);
    $ejerciciosColl = collect($ejercicios)->map(fn($item) => (object) $item);
@endphp

<header style="margin-bottom:28px;">
    <h1 style="font-family:'DM Serif Display',serif; font-size:26px; color:#010e6b; margin:0 0 4px;">
        Bienvenido, {{ $pacienteObj->nombre }} {{ $pacienteObj->apellido }}
    </h1>
    <p style="font-size:14px; color:#4b4b72; margin:0;">
        Aqui puedes consultar tus proximas citas y los ejercicios asignados.
    </p>
</header>

<div style="display:grid; grid-template-columns:repeat(2,1fr); gap:16px; margin-bottom:24px;">
    <div class="card" style="padding:18px 20px;">
        <div class="stat-label" style="font-size:12px; color:#703b94; font-weight:700; text-transform:uppercase; letter-spacing:0.05em;">Proximas citas</div>
        <div class="stat-value" style="font-size:28px; font-weight:800; color:#010e6b;">{{ $citasColl->count() }}</div>
    </div>
    <div class="card" style="padding:18px 20px;">
        <div class="stat-label" style="font-size:12px; color:#703b94; font-weight:700; text-transform:uppercase; letter-spacing:0.05em;">Ejercicios asignados</div>
        <div class="stat-value" style="font-size:28px; font-weight:800; color:#010e6b;">{{ $ejerciciosColl->count() }}</div>
    </div>
</div>

<div style="display:grid; grid-template-columns:1fr 340px; gap:20px; align-items:start;">

    <section class="card" style="padding:24px;" aria-labelledby="citas-heading">
        <h2 id="citas-heading" style="font-size:15px; font-weight:700; color:#010e6b; margin:0 0 20px;">
            Proximas citas
        </h2>

        @forelse($citasColl as $cita)
        <article style="display:flex; align-items:flex-start; gap:14px; padding:16px 0; border-bottom:1px solid #e1ddf0;">

            <div class="date-block" aria-hidden="true" style="min-width:50px; text-align:center; background:rgba(1,14,107,0.06); border-radius:10px; padding:8px 6px;">
                <div style="font-size:10px; font-weight:700; text-transform:uppercase; color:#703b94;">
                    {{ \Carbon\Carbon::parse($cita->fecha)->locale('es')->isoFormat('MMM') }}
                </div>
                <div style="font-size:22px; font-weight:800; color:#010e6b; line-height:1.1;">
                    {{ \Carbon\Carbon::parse($cita->fecha)->format('d') }}
                </div>
            </div>

            <div style="flex:1; min-width:0;">
                <span style="font-size:10px; font-weight:700; color:#703b94; text-transform:uppercase; margin-bottom:4px; display:inline-flex;">
                    Cita programada
                </span>
                <p style="font-size:14px; font-weight:600; color:#0c0c2a; margin:4px 0 3px;">
                    {{ \Carbon\Carbon::parse($cita->fecha)->locale('es')->isoFormat('dddd D [de] MMMM [de] YYYY') }}
                </p>
                <p style="font-size:12px; color:#4b4b72; margin:0;">
                    <time datetime="{{ $cita->fecha }} {{ $cita->hora }}">
                        {{ \Carbon\Carbon::parse($cita->hora)->format('h:i a') }}
                    </time>
                </p>
            </div>

            <div style="flex-shrink:0;">
                @php $dias = (int) now()->startOfDay()->diffInDays(\Carbon\Carbon::parse($cita->fecha)->startOfDay(), false); @endphp
                @if($dias === 0)
                    <span style="font-size:11px; font-weight:700; background:rgba(112,59,148,0.12); color:#5a2880; padding:3px 9px; border-radius:20px;">Hoy</span>
                @elseif($dias === 1)
                    <span style="font-size:11px; font-weight:700; background:rgba(212,129,210,0.16); color:#5c1f5a; padding:3px 9px; border-radius:20px;">Manana</span>
                @else
                    <span style="font-size:11px; color:#4b4b72;">En {{ $dias }} dias</span>
                @endif
            </div>

        </article>
        @empty
        <div style="text-align:center; padding:40px 0;">
            <div style="width:44px; height:44px; border-radius:50%; background:rgba(1,14,107,0.07); display:flex; align-items:center; justify-content:center; margin:0 auto 12px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="#703b94">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
            </div>
            <p style="font-size:14px; color:#4b4b72;">No tienes citas proximas agendadas.</p>
        </div>
        @endforelse
    </section>

    <section class="card" style="padding:24px;" aria-labelledby="ejercicios-heading">
        <h2 id="ejercicios-heading" style="font-size:15px; font-weight:700; color:#010e6b; margin:0 0 18px;">
            Ejercicios asignados
        </h2>

        @forelse($ejerciciosColl as $ejercicio)
        <div class="exercise-item" style="margin-bottom:16px; padding-bottom:12px; border-bottom:1px solid #f0f0f7;">
            <h3 style="font-size:13px; font-weight:700; color:#0c0c2a; margin:0 0 6px;">
                {{ $ejercicio->nombre_ejercicio ?? $ejercicio->titulo }}
            </h3>
            <p style="font-size:12px; color:#4b4b72; margin:0; line-height:1.5;">
                {{ $ejercicio->descripcion }}
            </p>
        </div>
        @empty
        <p style="font-size:14px; color:#4b4b72; text-align:center; padding:20px 0;">
            No tienes ejercicios asignados aun.
        </p>
        @endforelse
    </section>

</div>

@endsection