@extends('layouts.patient')

@section('content')

<header style="margin-bottom:28px; display:flex; align-items:flex-start; justify-content:space-between; flex-wrap:wrap; gap:12px;">
    <div>
        <h1 style="font-size:24px; font-weight:800; color:#010e6b; margin:0 0 4px; letter-spacing:-0.01em;">
            Mis Citas
        </h1>
        <p style="font-size:14px; color:#4b4b72; margin:0;">
            Consulta tus proximas citas y sincronizalas con Google Calendar.
        </p>
    </div>

    <form method="POST" action="{{ route('patient.sincronizar') }}">
        @csrf
        <button type="submit" style="display:flex; align-items:center; gap:8px; padding:10px 18px; border-radius:10px; background:#010e6b; color:white; border:none; font-family:'Raleway',sans-serif; font-size:13px; font-weight:700; cursor:pointer; transition:background 0.15s; letter-spacing:0.01em;">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            Sincronizar con Google Calendar
        </button>
    </form>
</header>

<div style="display:grid; grid-template-columns:1fr 360px; gap:20px; align-items:start;">

    <div class="card" style="padding:24px;">
        <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:20px;">
            <h2 id="mes-anio" style="font-size:15px; font-weight:800; color:#010e6b; margin:0; text-transform:capitalize;"></h2>
            <div style="display:flex; gap:6px;">
                <button onclick="cambiarMes(-1)" style="width:30px; height:30px; border-radius:8px; border:1.5px solid #e1ddf0; background:white; color:#4b4b72; cursor:pointer; font-size:14px; display:flex; align-items:center; justify-content:center;"> &#8249; </button>
                <button onclick="cambiarMes(1)" style="width:30px; height:30px; border-radius:8px; border:1.5px solid #e1ddf0; background:white; color:#4b4b72; cursor:pointer; font-size:14px; display:flex; align-items:center; justify-content:center;"> &#8250; </button>
            </div>
        </div>

        <div style="display:grid; grid-template-columns:repeat(7,1fr); gap:4px; margin-bottom:8px;">
            @foreach(['Dom','Lun','Mar','Mie','Jue','Vie','Sab'] as $dia)
            <div style="text-align:center; font-size:11px; font-weight:700; color:#7a7a9a; text-transform:uppercase; letter-spacing:0.06em; padding:4px 0;">
                {{ $dia }}
            </div>
            @endforeach
        </div>

        <div id="calendario-grid" style="display:grid; grid-template-columns:repeat(7,1fr); gap:4px;"></div>

        <div style="display:flex; align-items:center; gap:16px; margin-top:16px; padding-top:16px; border-top:1px solid #e1ddf0;">
            <div style="display:flex; align-items:center; gap:6px; font-size:11px; color:#4b4b72;">
                <div style="width:8px; height:8px; border-radius:50%; background:#010e6b;"></div>
                Hoy
            </div>
            <div style="display:flex; align-items:center; gap:6px; font-size:11px; color:#4b4b72;">
                <div style="width:8px; height:8px; border-radius:50%; background:#703b94;"></div>
                Cita programada
            </div>
        </div>
    </div>

    <div class="card" style="padding:24px;">
        <h2 style="font-size:15px; font-weight:800; color:#010e6b; margin:0 0 18px;">
            Proximas citas
        </h2>

        @forelse($citas as $citaData)
        @php
            $cita = (object) $citaData;
            $fechaCita = \Carbon\Carbon::parse($cita->fecha);
            $dias = (int) now()->startOfDay()->diffInDays($fechaCita->startOfDay(), false);
        @endphp
        <div style="border:1px solid #e1ddf0; border-radius:12px; padding:14px; margin-bottom:10px; background:#faf9fd; transition:border-color 0.15s;" onmouseover="this.style.borderColor='#be74be'" onmouseout="this.style.borderColor='#e1ddf0'">
            <div style="display:flex; align-items:flex-start; gap:12px;">
                <div style="min-width:50px; text-align:center; background:rgba(1,14,107,0.06); border-radius:10px; padding:8px 6px;">
                    <div style="font-size:10px; font-weight:700; text-transform:uppercase; letter-spacing:0.08em; color:#703b94;">
                        {{ $fechaCita->locale('es')->isoFormat('MMM') }}
                    </div>
                    <div style="font-size:22px; font-weight:800; color:#010e6b; line-height:1.1;">
                        {{ $fechaCita->format('d') }}
                    </div>
                </div>
                <div style="flex:1;">
                    <p style="font-size:13px; font-weight:700; color:#0c0c2a; margin:0 0 3px;">
                        Cita programada
                    </p>
                    <p style="font-size:12px; color:#4b4b72; margin:0;">
                        {{ \Carbon\Carbon::parse($cita->hora)->format('h:i a') }}
                        &mdash;
                        {{ date('h:i a', strtotime($cita->hora) + 3600) }}
                    </p>
                    <p style="font-size:11px; color:#9898b8; margin:4px 0 0; text-transform:capitalize;">
                        {{ $fechaCita->locale('es')->isoFormat('dddd D [de] MMMM [de] YYYY') }}
                    </p>
                </div>
                <div>
                    @if($dias === 0)
                        <span style="font-size:11px; font-weight:700; background:rgba(112,59,148,0.12); color:#5a2880; padding:3px 9px; border-radius:20px;">Hoy</span>
                    @elseif($dias === 1)
                        <span style="font-size:11px; font-weight:700; background:rgba(212,129,210,0.16); color:#5c1f5a; padding:3px 9px; border-radius:20px;">Manana</span>
                    @else
                        <span style="font-size:11px; color:#4b4b72;">En {{ $dias }} dias</span>
                    @endif
                </div>
            </div>
        </div>
        @empty
        <div style="text-align:center; padding:40px 0;">
            <div style="width:44px; height:44px; border-radius:50%; background:rgba(1,14,107,0.07); display:flex; align-items:center; justify-content:center; margin:0 auto 12px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="#703b94">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
            </div>
            <p style="font-size:14px; color:#4b4b72;">No tienes citas proximas.</p>
        </div>
        @endforelse
    </div>

</div>

<script>
    const fechasCitas = @json(collect($citas)->map(fn($f) => \Carbon\Carbon::parse($f['fecha'])->format('Y-m-d'))->values());
    const hoy = new Date();
    let mesActual = hoy.getMonth();
    let anioActual = hoy.getFullYear();

    const meses = ['enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre'];

    function renderCalendario() {
        const grid = document.getElementById('calendario-grid');
        const titulo = document.getElementById('mes-anio');
        titulo.textContent = meses[mesActual] + ' de ' + anioActual;
        grid.innerHTML = '';

        const primerDia = new Date(anioActual, mesActual, 1).getDay();
        const diasEnMes = new Date(anioActual, mesActual + 1, 0).getDate();

        for (let i = 0; i < primerDia; i++) {
            grid.innerHTML += `<div></div>`;
        }

        for (let dia = 1; dia <= diasEnMes; dia++) {
            const fecha = anioActual + '-' + String(mesActual + 1).padStart(2, '0') + '-' + String(dia).padStart(2, '0');
            const esHoy = dia === hoy.getDate() && mesActual === hoy.getMonth() && anioActual === hoy.getFullYear();
            const tieneCita = fechasCitas.includes(fecha);

            let estilo = `text-align:center; padding:6px 2px; border-radius:8px; font-size:13px; font-weight:600; cursor:default; position:relative;`;

            if (esHoy) {
                estilo += 'background:#010e6b; color:white;';
            } else if (tieneCita) {
                estilo += 'background:rgba(112,59,148,0.12); color:#010e6b;';
            } else {
                estilo += 'color:#4b4b72;';
            }

            let punto = tieneCita && !esHoy ? `<div style="width:5px;height:5px;border-radius:50%;background:#703b94;margin:2px auto 0;"></div>` : `<div style="height:7px;"></div>`;
            grid.innerHTML += `<div style="${estilo}">${dia}${punto}</div>`;
        }
    }

    function cambiarMes(direccion) {
        mesActual += direccion;
        if (mesActual > 11) { mesActual = 0; anioActual++; }
        if (mesActual < 0)  { mesActual = 11; anioActual--; }
        renderCalendario();
    }

    renderCalendario();
</script>

@endsection