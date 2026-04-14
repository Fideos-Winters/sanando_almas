<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingresar — Sanando Almas</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --azul-oscuro:   #010e6b;
            --morado-medio:  #703b94;
            --morado-rosado: #d481d2;
            --focus-ring:    0 0 0 3px rgba(112,59,148,0.4);
        }
        *, *::before, *::after { box-sizing: border-box; }
        * { font-family: 'Raleway', sans-serif; }
        
        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px;
            background-image:
                radial-gradient(circle at 20% 80%, rgba(112,59,148,0.3) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(212,129,210,0.2) 0%, transparent 50%),
                linear-gradient(145deg, #010e6b 0%, #03197a 40%, #0d1252 100%);
        }

        /* ----- LOGO GRANDE Y INTEGRADO ----- */
        .logo-flotante {
            width: 200px; /* Tamaño mucho más grande */
            height: 200px;
            object-fit: contain;
            position: relative;
            z-index: 20; /* Asegura que esté sobre la card */
            
            /* Esta es la clave: subimos la card para que muerda el logo */
            margin-bottom: -110px; /* Un poco más de la mitad para integrarlo */
            
            /* Sombra suave para dar profundidad */
            filter: drop-shadow(0 15px 25px rgba(0,0,0,0.25));
        }

        /* ----- CARD AJUSTADA ----- */
        .card {
            background: #fff;
            border-radius: 24px; /* Bordes ligeramente más suaves */
            box-shadow: 0 32px 80px rgba(0,0,0,0.3);
            
            /* Reducimos el padding superior para acercar el texto al logo */
            padding: 120px 40px 40px; /* Estaba en 90px, lo subimos por el tamaño del logo */
            
            width: 100%;
            max-width: 420px; /* Un pelín más ancha para equilibrar el logo grande */
            position: relative;
            z-index: 10;
        }

        h1 {
            font-size: 28px; /* Título un poco más grande para equilibrar */
            font-weight: 800;
            color: var(--azul-oscuro);
            margin: 0 0 8px; /* Un poco más de aire abajo */
            letter-spacing: -0.02em;
            text-align: center;
            line-height: 1.2;
        }
        
        .subtitle {
            font-size: 15px; /* Texto ligeramente más grande */
            color: #4b4b72;
            margin: 0 0 36px;
            line-height: 1.6;
            font-weight: 400;
            text-align: center;
        }

        /* --- Resto de estilos (iguales o con micro-ajustes) --- */
        .btn-google {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            padding: 14px 20px; /* Botón un pelín más alto */
            border-radius: 12px;
            border: 1.5px solid #e1ddf0;
            background: #ffffff;
            color: #0c0c2a;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.2s ease-in-out;
        }
        .btn-google:hover {
            border-color: var(--morado-medio);
            box-shadow: 0 6px 20px rgba(112,59,148,0.15);
            background: #faf9fd;
            transform: translateY(-1px);
        }
        
        .divider {
            display: flex; align-items: center; gap: 12px;
            margin: 28px 0; color: #9898b8; font-size: 11px;
            font-weight: 700; letter-spacing: 0.1em; text-transform: uppercase;
        }
        .divider::before, .divider::after {
            content: ''; flex: 1; height: 1px; background: #e1ddf0;
        }
        
        .info-box {
            background: rgba(1,14,107,0.03);
            border: 1px solid rgba(1,14,107,0.08);
            border-radius: 12px;
            padding: 16px;
            font-size: 13px;
            color: #5a5a85;
            line-height: 1.6;
            text-align: center;
            font-weight: 500;
        }
        
        .privacy-link {
            text-align: center;
            margin-top: 24px;
            font-size: 12px;
            color: #9898b8;
        }
        .privacy-link a {
            color: var(--morado-medio);
            font-weight: 600;
            text-decoration: none;
        }
        
        .accent-bar {
            height: 6px; /* Barra un poco más gruesa */
            border-radius: 0 0 24px 24px;
            margin: 30px -40px -40px;
            background: linear-gradient(90deg, var(--azul-oscuro), var(--morado-medio), var(--morado-rosado));
        }
    </style>
</head>
<body>

    <img src="{{ asset('images/logo.png') }}" 
         alt="Sanando Almas" 
         class="logo-flotante">

    <div class="card">
        <h1>Portal del Paciente</h1>
        <p class="subtitle">
            Inicia sesión con tu cuenta de Google para acceder a tus citas y ejercicios.
        </p>

        @if($errors->any())
            <div style="background:#fff0f0; border:1px solid #f0c0c0; color:#9b1c1c; font-size:13px; font-weight:600; border-radius:10px; padding:12px; margin-bottom:20px; text-align:center;" role="alert">
                {{ $errors->first() }}
            </div>
        @endif

<a href="http://admin.umbrellastella.com/api/auth/google/redirect" class="btn-google">
    <svg width="20" height="20" viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg">
        <path d="M17.64 9.2c0-.637-.057-1.251-.164-1.84H9v3.481h4.844c-.209 1.125-.843 2.078-1.796 2.717v2.258h2.908c1.702-1.567 2.684-3.875 2.684-6.615z" fill="#4285F4"/>
        <path d="M9 18c2.43 0 4.467-.806 5.956-2.184l-2.908-2.258c-.806.54-1.837.86-3.048.86-2.344 0-4.328-1.584-5.036-3.711H.957v2.332A8.997 8.997 0 009 18z" fill="#34A853"/>
        <path d="M3.964 10.707A5.41 5.41 0 013.682 9c0-.593.102-1.17.282-1.707V4.961H.957A8.996 8.996 0 000 9c0 1.452.348 2.827.957 4.039l3.007-2.332z" fill="#FBBC05"/>
        <path d="M9 3.58c1.321 0 2.508.454 3.44 1.345l2.582-2.58C13.463.891 11.426 0 9 0A8.997 8.997 0 00.957 4.961L3.964 7.293C4.672 5.163 6.656 3.58 9 3.58z" fill="#EA4335"/>
    </svg>
    Continuar con Google
</a>

        <div class="divider">acceso restringido</div>

        <div class="info-box">
            Solo pueden ingresar pacientes registrados por la psicóloga.
            Si no puedes acceder, contacta a tu psicóloga.
        </div>

        <p class="privacy-link">
            Al continuar aceptas nuestro 
            <a href="{{ route('patient.privacy') }}" target="_blank">Aviso de Privacidad</a>
        </p>

        <div class="accent-bar" aria-hidden="true"></div>
    </div>

</body>
</html>