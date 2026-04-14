<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sanando Almas — Portal Paciente</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --azul-oscuro:    #010e6b;
            --morado-medio:   #703b94;
            --morado-claro:   #be74be;
            --morado-rosado:  #d481d2;
            --bg-page:        #f2f1f8;
            --surface:        #ffffff;
            --border:         #e1ddf0;
            --text-primary:   #0c0c2a;
            --text-secondary: #4b4b72;
        }

        *, *::before, *::after { box-sizing: border-box; }
        * { font-family: 'Raleway', sans-serif; }

        body { 
            background: var(--bg-page); 
            color: var(--text-primary); 
            margin: 0;
            display: flex;
            min-height: 100vh;
        }

        /* ----- SIDEBAR FIXED ----- */
        .sidebar {
            background: var(--azul-oscuro);
            width: 240px; /* Un poco más ancho para que respire el texto */
            min-height: 100vh;
            position: fixed; 
            top: 0; left: 0;
            display: flex; 
            flex-direction: column;
            padding: 24px 16px; 
            z-index: 20;
            box-shadow: 4px 0 15px rgba(0,0,0,0.1);
        }

        .sidebar-logo {
            display: flex; align-items: center; gap: 12px;
            padding: 0 8px 24px;
            border-bottom: 1px solid rgba(255,255,255,0.08);
            margin-bottom: 12px;
        }

        .sidebar-logo-icon {
            width: 32px; height: 32px; border-radius: 50%;
            background: var(--morado-rosado);
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
            box-shadow: 0 4px 10px rgba(212,129,210,0.3);
        }

        .sidebar-logo-text { color: #fff; font-weight: 800; font-size: 15px; letter-spacing: 0.02em; }

        .sidebar-section-label {
            font-size: 10px; font-weight: 800; letter-spacing: 0.15em;
            text-transform: uppercase; color: rgba(255,255,255,0.3);
            padding: 20px 10px 8px; display: block;
        }

        /* ----- NAVEGACIÓN ----- */
        .nav-link {
            display: flex; align-items: center; gap: 12px;
            padding: 10px 12px; border-radius: 10px;
            font-size: 14px; font-weight: 600;
            color: rgba(255,255,255,0.6);
            text-decoration: none; 
            transition: all 0.2s ease;
            cursor: pointer; border: none; background: none;
            width: 100%; text-align: left;
        }

        .nav-link:hover {
            background: rgba(255,255,255,0.08); 
            color: #fff;
            transform: translateX(4px);
        }

        .nav-link.active { 
            background: rgba(212,129,210,0.15); 
            color: var(--morado-rosado); 
            font-weight: 700;
        }

        /* ----- USUARIO ----- */
        .sidebar-user {
            margin-top: auto; 
            padding: 20px 8px 0;
            border-top: 1px solid rgba(255,255,255,0.08);
            display: flex; align-items: center; gap: 12px;
        }

        .user-avatar {
            width: 38px; height: 38px; border-radius: 12px;
            background: linear-gradient(135deg, var(--morado-medio), var(--morado-rosado));
            color: #fff; font-size: 15px; font-weight: 700;
            display: flex; align-items: center; justify-content: center; 
            flex-shrink: 0;
        }

        .user-name { font-size: 13px; font-weight: 700; color: #fff; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .user-role { font-size: 11px; color: rgba(255,255,255,0.45); font-weight: 500; }

        /* ----- CONTENIDO PRINCIPAL ----- */
        .main-content {
            margin-left: 240px; 
            flex: 1; 
            padding: 40px 48px; 
            min-height: 100vh;
            background-image: 
                radial-gradient(at 0% 0%, rgba(112,59,148,0.04) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(1,14,107,0.03) 0px, transparent 50%);
        }

        .card { 
            background: var(--surface); 
            border-radius: 20px; 
            border: 1px solid var(--border); 
            box-shadow: 0 4px 20px rgba(1,14,107,0.03);
            padding: 24px;
        }

        /* ALERTAS */
        .alert {
            border-radius: 12px; padding: 14px 20px; font-size: 14px; font-weight: 600; margin-bottom: 24px;
            display: flex; align-items: center; gap: 10px;
        }
        .alert-success { background: #f0fdf4; border: 1px solid #bbf7d0; color: #15803d; }
        .alert-error { background: #fef2f2; border: 1px solid #fecaca; color: #991b1b; }
    </style>
</head>
<body>

<aside class="sidebar">
    <div class="sidebar-logo">
        <div class="sidebar-logo-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="white" viewBox="0 0 24 24">
                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09 C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
            </svg>
        </div>
        <span class="sidebar-logo-text">Sanando Almas</span>
    </div>

    <span class="sidebar-section-label">Menu Principal</span>
    <nav style="display:flex; flex-direction:column; gap:4px;">
        <a href="{{ route('patient.dashboard') }}"
           class="nav-link {{ request()->routeIs('patient.dashboard') ? 'active' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
            </svg>
            Inicio
        </a>
        <a href="{{ route('patient.citas') }}"
           class="nav-link {{ request()->routeIs('patient.citas') ? 'active' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            Mis Citas
        </a>
        <a href="{{ route('patient.ejercicios') }}"
           class="nav-link {{ request()->routeIs('patient.ejercicios') ? 'active' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
            </svg>
            Mis Ejercicios
        </a>
    </nav>

    <span class="sidebar-section-label">Configuración</span>
    <nav style="display:flex; flex-direction:column; gap:4px;">
        <form method="POST" action="{{ route('patient.logout') }}">
            @csrf
            <button type="submit" class="nav-link text-red-400 hover:text-red-300">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                </svg>
                Cerrar Sesión
            </button>
        </form>
    </nav>

    <div class="sidebar-user">
        <div class="user-avatar">
            {{ strtoupper(substr(auth('patient')->user()->paciente->nombre ?? 'P', 0, 1)) }}
        </div>
        <div style="overflow:hidden;">
            <div class="user-name">
                {{ auth('patient')->user()->paciente->nombre ?? 'Paciente' }}
            </div>
            <div class="user-role">Portal del Paciente</div>
        </div>
    </div>
</aside>

<main class="main-content">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    
    @if($errors->any())
        <div class="alert alert-error">{{ $errors->first() }}</div>
    @endif

    @yield('content')
</main>

</body>
</html>