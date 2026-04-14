<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aviso de Privacidad — Sanando Almas</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; }
        * { font-family: 'Raleway', sans-serif; }
        body {
            margin: 0;
            min-height: 100vh;
            background-image:
                radial-gradient(circle at 20% 80%, rgba(112,59,148,0.3) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(212,129,210,0.2) 0%, transparent 50%),
                linear-gradient(145deg, #010e6b 0%, #03197a 40%, #0d1252 100%);
            padding: 40px 20px;
            display: flex;
            justify-content: center;
        }
        .card {
            background: #fff;
            border-radius: 22px;
            box-shadow: 0 32px 80px rgba(0,0,0,0.3);
            padding: 44px 48px;
            width: 100%;
            max-width: 700px;
            height: fit-content;
        }
        .logo { display:flex; align-items:center; gap:10px; margin-bottom:32px; }
        .logo-icon {
            width:32px; height:32px; border-radius:50%;
            background: #d481d2;
            display:flex; align-items:center; justify-content:center;
        }
        .logo-text { font-size:16px; font-weight:700; color:#010e6b; }
        h1 { font-size:24px; font-weight:800; color:#010e6b; margin:0 0 4px; }
        .fecha { font-size:12px; color:#7a7a9a; margin:0 0 28px; }
        h2 { font-size:14px; font-weight:700; color:#010e6b; margin:24px 0 6px; text-transform:uppercase; letter-spacing:0.06em; }
        p { font-size:13px; color:#4b4b72; line-height:1.7; margin:0 0 8px; }
        .divider { height:1px; background:#e1ddf0; margin:20px 0; }
        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-top: 32px;
            padding: 10px 20px;
            background: #010e6b;
            color: white;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 700;
            text-decoration: none;
            transition: background 0.15s;
        }
        .btn-back:hover { background: #020f78; }
        .accent-bar {
            height:3px; border-radius:0 0 22px 22px; margin:32px -48px -44px;
            background:linear-gradient(90deg, #010e6b, #703b94, #d481d2);
        }
    </style>
</head>
<body>
<div class="card">
    <div class="logo">
        <div class="logo-icon" aria-hidden="true">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" viewBox="0 0 24 24">
                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5
                         2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09
                         C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42
                         22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
            </svg>
        </div>
        <span class="logo-text">Sanando Almas</span>
    </div>

    <h1>Aviso de Privacidad</h1>
    <p class="fecha">Ultima actualizacion: marzo de 2026</p>

    <p>En Sanando Almas nos comprometemos a proteger la privacidad y confidencialidad de la informacion personal de nuestros pacientes. El presente aviso describe como recopilamos, usamos y protegemos sus datos personales de conformidad con la Ley Federal de Proteccion de Datos Personales en Posesion de los Particulares (LFPDPPP).</p>

    <div class="divider"></div>

    <h2>Responsable del tratamiento</h2>
    <p>Los datos personales que usted proporciona son tratados bajo la responsabilidad del consultorio Sanando Almas y su titular, quien funge como psicologa responsable del servicio.</p>

    <h2>Datos personales que recopilamos</h2>
    <p>Para el funcionamiento del portal del paciente recopilamos los siguientes datos: nombre completo, correo electronico, numero de telefono y fecha de nacimiento. Estos datos son proporcionados directamente por la psicologa al momento de dar de alta al paciente en el sistema.</p>
    <p>Adicionalmente, al iniciar sesion mediante Google, obtenemos unicamente su correo electronico para verificar su identidad. No almacenamos contrasenas ni informacion adicional de su cuenta de Google.</p>

    <h2>Finalidad del tratamiento</h2>
    <p>Sus datos personales son utilizados exclusivamente para las siguientes finalidades: identificarlo como paciente registrado, mostrarle sus citas programadas y los ejercicios asignados por su psicologa, y garantizar que solo usted tenga acceso a su informacion.</p>

    <h2>Confidencialidad de la informacion clinica</h2>
    <p>Toda la informacion relacionada con sus sesiones, notas clinicas y ejercicios terapeuticos es estrictamente confidencial. Dicha informacion solo es accesible por usted y por la psicologa responsable de su atencion. No se comparte con terceros bajo ninguna circunstancia.</p>

    <h2>Uso de servicios de terceros</h2>
    <p>Este portal utiliza Google OAuth unicamente como metodo de autenticacion. Al iniciar sesion con Google usted acepta tambien los terminos y politicas de privacidad de Google. Sanando Almas no tiene acceso a su contrasena de Google ni a informacion adicional de su cuenta mas alla del correo electronico.</p>

    <h2>Derechos ARCO</h2>
    <p>Usted tiene derecho a Acceder, Rectificar, Cancelar u Oponerse al tratamiento de sus datos personales. Para ejercer cualquiera de estos derechos puede comunicarse directamente con su psicologa a traves de los medios de contacto disponibles en el portal.</p>

    <h2>Cambios al aviso de privacidad</h2>
    <p>Sanando Almas se reserva el derecho de modificar el presente aviso en cualquier momento. Cualquier cambio sera notificado a traves del portal.</p>

    <div class="divider"></div>

    <a href="{{ route('patient.login') }}" class="btn-back">
        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
        Regresar al inicio
    </a>

    <div class="accent-bar" aria-hidden="true"></div>
</div>
</body>
</html>