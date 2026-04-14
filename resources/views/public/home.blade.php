<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sanando Almas — Psicologa Maria Ines</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --azul:   #010e6b;
            --morado: #703b94;
            --claro:  #be74be;
            --rosado: #d481d2;
        }
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        * { font-family: 'Raleway', sans-serif; }
        html { scroll-behavior: smooth; }
        body { background: #f2f1f8; color: #0c0c2a; }

        /* ---- NAV ---- */
        nav {
            position: fixed; top: 0; left: 0; right: 0; z-index: 100;
            background: rgba(1,14,107,0.96);
            backdrop-filter: blur(12px);
            display: flex; align-items: center; justify-content: space-between;
            padding: 0 40px; height: 70px;
        }
        .nav-logo { display:flex; align-items:center; gap:12px; text-decoration:none; }
        .nav-logo img { height: 54px; width: auto; object-fit: contain; }
        .nav-links { display:flex; align-items:center; gap:6px; }
        .nav-link-item {
            color:rgba(255,255,255,0.65); font-size:13px; font-weight:600;
            text-decoration:none; padding:6px 12px; border-radius:8px;
            transition:color 0.15s, background 0.15s;
        }
        .nav-link-item:hover { color:white; background:rgba(255,255,255,0.08); }
        .btn-login {
            background: var(--rosado); color: white;
            font-size:13px; font-weight:700; padding:8px 18px;
            border-radius:20px; text-decoration:none;
            transition:background 0.15s, box-shadow 0.15s;
            margin-left:8px;
        }
        .btn-login:hover { background:#c46fc2; box-shadow:0 4px 16px rgba(212,129,210,0.4); }

        /* ---- HERO ---- */
        .hero {
            min-height: 100vh;
            background-image:
                radial-gradient(circle at 15% 85%, rgba(112,59,148,0.35) 0%, transparent 55%),
                radial-gradient(circle at 85% 15%, rgba(212,129,210,0.25) 0%, transparent 55%),
                linear-gradient(145deg, #010e6b 0%, #03197a 45%, #0d1252 100%);
            display: flex; align-items: center; justify-content: center;
            text-align: center; padding: 100px 24px 60px;
        }
        .hero-content { max-width: 720px; }
        .hero-logo {
            width: 220px; height: 220px; object-fit: contain;
            margin: 0 auto 28px; display: block;
        }
        .hero-tag {
            display:inline-flex; align-items:center; gap:8px;
            background:rgba(212,129,210,0.15); border:1px solid rgba(212,129,210,0.3);
            color: var(--rosado); font-size:12px; font-weight:700;
            padding:6px 14px; border-radius:20px; margin-bottom:28px;
            letter-spacing:0.06em; text-transform:uppercase;
        }
        .hero h1 {
            font-size:52px; font-weight:800; color:white;
            line-height:1.1; letter-spacing:-0.02em; margin-bottom:20px;
        }
        .hero h1 span { color: var(--rosado); }
        .hero p {
            font-size:17px; color:rgba(255,255,255,0.65);
            line-height:1.7; margin-bottom:36px; font-weight:400;
        }
        .hero-cta {
            display:inline-flex; align-items:center; gap:10px;
            background:white; color:var(--azul);
            font-size:14px; font-weight:700; padding:13px 28px;
            border-radius:30px; text-decoration:none;
            transition:box-shadow 0.2s, transform 0.2s;
        }
        .hero-cta:hover { box-shadow:0 8px 32px rgba(255,255,255,0.2); transform:translateY(-2px); }

        /* ---- SECCIONES ---- */
        .section-wrap { padding: 80px 40px; max-width: 1100px; margin: 0 auto; }
        .section-tag {
            display:inline-block; font-size:11px; font-weight:700;
            text-transform:uppercase; letter-spacing:0.1em;
            color:var(--morado); margin-bottom:12px;
        }
        .section-title {
            font-size:32px; font-weight:800; color:var(--azul);
            letter-spacing:-0.01em; margin-bottom:16px; line-height:1.2;
        }
        .section-subtitle {
            font-size:15px; color:#4b4b72; line-height:1.7; max-width:600px;
        }
        .divider {
            height:1px;
            background:linear-gradient(90deg, transparent, #e1ddf0, transparent);
            margin:0 40px;
        }

        /* ---- NOSOTROS ---- */
        .nosotros-grid {
            display:grid; grid-template-columns:1fr 1fr; gap:48px; align-items:center;
            margin-top:48px;
        }
        .nosotros-quote {
            font-size:26px; font-weight:800; color:var(--azul);
            line-height:1.3; letter-spacing:-0.01em;
            border-left:4px solid var(--rosado);
            padding-left:24px; margin-bottom:24px;
        }
        .nosotros-quote span { color:var(--morado); }
        .nosotros-texto { font-size:14px; color:#4b4b72; line-height:1.8; margin-bottom:16px; }
        .nosotros-card {
            background:white; border-radius:20px;
            border:1px solid #e1ddf0;
            box-shadow:0 8px 40px rgba(1,14,107,0.08);
            padding:32px; position:relative; overflow:hidden;
        }
        .nosotros-card::before {
            content:''; position:absolute; top:0; left:0; right:0; height:4px;
            background:linear-gradient(90deg, var(--azul), var(--morado), var(--rosado));
        }
        .nosotros-avatar {
            width:72px; height:72px; border-radius:50%;
            background:linear-gradient(135deg, var(--morado), var(--rosado));
            display:flex; align-items:center; justify-content:center;
            font-size:28px; font-weight:800; color:white;
            margin-bottom:16px;
        }
        .nosotros-nombre { font-size:18px; font-weight:800; color:var(--azul); margin-bottom:4px; }
        .nosotros-titulo { font-size:13px; color:var(--morado); font-weight:600; margin-bottom:16px; }
        .nosotros-badge {
            display:inline-flex; align-items:center;
            background:rgba(112,59,148,0.08); color:var(--morado);
            font-size:11px; font-weight:700; padding:4px 10px;
            border-radius:20px; margin:3px;
        }

        /* ---- VALORES ---- */
        .valores-grid {
            display:grid; grid-template-columns:repeat(3,1fr); gap:20px; margin-top:48px;
        }
        .valor-card {
            background:white; border-radius:16px;
            border:1px solid #e1ddf0; padding:28px 24px;
            transition:box-shadow 0.2s, transform 0.2s;
        }
        .valor-card:hover { box-shadow:0 8px 32px rgba(1,14,107,0.1); transform:translateY(-4px); }
        .valor-icon {
            width:44px; height:44px; border-radius:12px;
            background:rgba(112,59,148,0.1);
            display:flex; align-items:center; justify-content:center;
            margin-bottom:16px;
        }
        .valor-titulo { font-size:15px; font-weight:800; color:var(--azul); margin-bottom:8px; }
        .valor-texto { font-size:13px; color:#4b4b72; line-height:1.7; }

        /* ---- MAPA ---- */
        .mapa-container {
            margin-top:48px; border-radius:20px; overflow:hidden;
            border:1px solid #e1ddf0;
            box-shadow:0 4px 24px rgba(1,14,107,0.08);
        }
        .mapa-header {
            background:var(--azul); padding:20px 28px;
            display:flex; align-items:center; justify-content:space-between;
        }
        .mapa-header-info { display:flex; align-items:center; gap:12px; }
        .mapa-header-title { font-size:15px; font-weight:700; color:white; margin-bottom:2px; }
        .mapa-header-sub { font-size:12px; color:rgba(255,255,255,0.6); }
        .mapa-btn {
            display:inline-flex; align-items:center; gap:8px;
            background:var(--rosado); color:white;
            font-size:12px; font-weight:700; padding:8px 16px;
            border-radius:20px; text-decoration:none;
            transition:background 0.15s; white-space:nowrap;
            font-family:'Raleway',sans-serif;
        }
        .mapa-btn:hover { background:#c46fc2; }
        iframe { display:block; width:100%; border:0; }

        /* ---- CONTACTO ---- */
        .contacto-grid {
            display:grid; grid-template-columns:repeat(3,1fr); gap:16px; margin-top:48px;
        }
        .contacto-card {
            background:white; border-radius:16px;
            border:1px solid #e1ddf0; padding:28px 24px;
            text-align:center; text-decoration:none;
            transition:box-shadow 0.2s, transform 0.2s, border-color 0.2s;
            display:flex; flex-direction:column; align-items:center; gap:12px;
        }
        .contacto-card:hover { transform:translateY(-4px); box-shadow:0 8px 32px rgba(0,0,0,0.1); }
        .contacto-card.whatsapp:hover  { border-color:#25d366; }
        .contacto-card.facebook:hover  { border-color:#1877f2; }
        .contacto-card.instagram:hover { border-color:#e1306c; }
        .contacto-icon {
            width:56px; height:56px; border-radius:16px;
            display:flex; align-items:center; justify-content:center;
        }
        .contacto-nombre { font-size:14px; font-weight:700; color:var(--azul); }
        .contacto-desc { font-size:12px; color:#7a7a9a; }

        /* ---- FOOTER ---- */
        footer {
            background:var(--azul); padding:28px 40px;
            display:flex; align-items:center; justify-content:space-between;
            flex-wrap:wrap; gap:12px;
        }
        .footer-logo { display:flex; align-items:center; gap:12px; }
        .footer-logo img { height:44px; width:auto; object-fit:contain; }
        .footer-copy { color:rgba(255,255,255,0.4); font-size:12px; margin-top:2px; }
        .footer-right a {
            color:rgba(255,255,255,0.5); font-size:12px;
            text-decoration:none; transition:color 0.15s;
        }
        .footer-right a:hover { color:var(--rosado); }
    </style>
</head>
<body>

{{-- NAV --}}
<nav>
    <a href="{{ route('home') }}" class="nav-logo">
        <img src="{{ asset('images/logo.png') }}" alt="Sanando Almas">
    </a>
    <div class="nav-links">
        <a href="#nosotros"  class="nav-link-item">Nosotros</a>
        <a href="#ubicacion" class="nav-link-item">Ubicacion</a>
        <a href="#contacto"  class="nav-link-item">Contacto</a>
        <a href="{{ route('patient.login') }}" class="btn-login">Soy paciente</a>
    </div>
</nav>

{{-- HERO --}}
<div class="hero">
    <div class="hero-content">
        <img src="{{ asset('images/logo.png') }}" alt="Sanando Almas" class="hero-logo">
        <div class="hero-tag">Consultorio de Psicologia</div>
        <h1>Donde sanar<br>es <span>volver a ti</span></h1>
        <p>
            Cada persona carga con su propia historia. Aqui encontraras un espacio
            donde esa historia puede ser contada, escuchada y transformada
            con acompanamiento profesional y humano.
        </p>
        <a href="#nosotros" class="hero-cta">
            Conoce mas
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
            </svg>
        </a>
    </div>
</div>

{{-- NOSOTROS --}}
<section id="nosotros" class="section-wrap">
    <span class="section-tag">Nosotros</span>
    <h2 class="section-title">Un espacio construido<br>desde la empatia</h2>

    <div class="nosotros-grid">
        <div>
            <div class="nosotros-quote">
                Sanar no es olvidar lo que duele,<br>
                es aprender a <span>cargarlo diferente</span>.
            </div>
            <p class="nosotros-texto">
                Sanando Almas nace de la conviction de que cada persona merece un espacio
                donde pueda ser exactamente quien es, sin filtros ni juicios. Un lugar donde
                el silencio pesa menos y las palabras encuentran su camino.
            </p>
            <p class="nosotros-texto">
                La psicologia no se trata de arreglar lo que esta roto. Se trata de acompanar
                a las personas mientras descubren que nunca estuvieron rotas, solo cargando
                demasiado solas.
            </p>
            <p class="nosotros-texto">
                En este consultorio cada sesion es un acto de valentia. El tuyo al llegar,
                y el nuestro al sostener lo que traes contigo.
            </p>
        </div>

        <div class="nosotros-card">
            <div class="nosotros-avatar">M</div>
            <div class="nosotros-nombre">Psc. Maria Ines</div>
            <div class="nosotros-titulo">Psicologa Clinica — Sanando Almas</div>
            <p style="font-size:13px; color:#4b4b72; line-height:1.8; margin-bottom:20px;">
                Maria Ines dedica su practica a acompanar a quienes atraviesan momentos
                de quiebre, transicion o simplemente necesitan ser escuchados de verdad.
                Su enfoque combina calidez humana con herramientas clinicas solidas,
                creando un ambiente donde el cambio ocurre naturalmente.
            </p>
            <div>
                <span class="nosotros-badge">Ansiedad</span>
                <span class="nosotros-badge">Depresion</span>
                <span class="nosotros-badge">Duelo</span>
                <span class="nosotros-badge">Autoestima</span>
                <span class="nosotros-badge">Relaciones</span>
                <span class="nosotros-badge">Desarrollo personal</span>
            </div>
        </div>
    </div>
</section>

<div class="divider"></div>

{{-- VALORES --}}
<section class="section-wrap">
    <span class="section-tag">Como trabajamos</span>
    <h2 class="section-title">Lo que nos define</h2>
    <p class="section-subtitle">
        Cada consulta esta guiada por principios que ponen al paciente en el centro.
    </p>

    <div class="valores-grid">
        <div class="valor-card">
            <div class="valor-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="#703b94">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                          d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                </svg>
            </div>
            <div class="valor-titulo">Empatia real</div>
            <div class="valor-texto">No existe un guion ni respuestas ensayadas. Cada persona es unica y merece ser tratada como tal desde el primer momento.</div>
        </div>
        <div class="valor-card">
            <div class="valor-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="#703b94">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                          d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                </svg>
            </div>
            <div class="valor-titulo">Confidencialidad total</div>
            <div class="valor-texto">Lo que se comparte en consulta se queda en consulta. La confianza es el pilar sobre el que se construye cualquier proceso terapeutico.</div>
        </div>
        <div class="valor-card">
            <div class="valor-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="#703b94">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                          d="M13 10V3L4 14h7v7l9-11h-7z"/>
                </svg>
            </div>
            <div class="valor-titulo">Acompanamiento activo</div>
            <div class="valor-texto">El proceso no termina al salir de la sesion. Las herramientas y ejercicios asignados acompanan al paciente en su dia a dia.</div>
        </div>
    </div>
</section>

<div class="divider"></div>

{{-- UBICACION --}}
<section id="ubicacion" class="section-wrap">
    <span class="section-tag">Ubicacion</span>
    <h2 class="section-title">Encuentranos en Guadalajara</h2>
    <p class="section-subtitle">
        C. Crispiniano del Castillo 3258, Guadalajara, Jalisco.
    </p>

    <div class="mapa-container">
        <div class="mapa-header">
            <div class="mapa-header-info">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="rgba(255,255,255,0.7)">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                          d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                <div>
                    <div class="mapa-header-title">Consultorio Sanando Almas</div>
                    <div class="mapa-header-sub">C. Crispiniano del Castillo 3258, Guadalajara, Jalisco</div>
                </div>
            </div>
            <a href="https://maps.app.goo.gl/ie4YtezFJCAjn4WQ9" target="_blank" rel="noopener" class="mapa-btn">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                </svg>
                Abrir en Google Maps
            </a>
        </div>
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3732.9!2d-103.37!3d20.6434!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8428ae4b76a5b24d%3A0x0!2sC.%20Crispiniano%20del%20Castillo%203258%2C%20Guadalajara%2C%20Jal.!5e0!3m2!1ses!2smx!4v1234567890"
            height="420"
            allowfullscreen=""
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    </div>
</section>

<div class="divider"></div>

{{-- CONTACTO --}}
<section id="contacto" class="section-wrap">
    <span class="section-tag">Contacto</span>
    <h2 class="section-title">Conecta con nosotros</h2>
    <p class="section-subtitle">
        El primer paso siempre es el mas dificil. Escribenos y con gusto te orientamos.
    </p>

    <div class="contacto-grid">
        <a href="https://wa.me/523310617991" target="_blank" rel="noopener" class="contacto-card whatsapp">
            <div class="contacto-icon" style="background:#e8fdf0;">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="#25d366">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                </svg>
            </div>
            <div class="contacto-nombre">WhatsApp</div>
            <div class="contacto-desc">33 1061-7991</div>
        </a>

        <a href="https://www.facebook.com/share/1CHbxYCJZJ/" target="_blank" rel="noopener" class="contacto-card facebook">
            <div class="contacto-icon" style="background:#e8f0fe;">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="#1877f2">
                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                </svg>
            </div>
            <div class="contacto-nombre">Facebook</div>
            <div class="contacto-desc">Sanando Almas</div>
        </a>

        <a href="https://www.instagram.com/psicologamaines?igsh=bzhhcTl2aDB1cHBk" target="_blank" rel="noopener" class="contacto-card instagram">
            <div class="contacto-icon" style="background:#fce4ec;">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="#e1306c">
                    <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                </svg>
            </div>
            <div class="contacto-nombre">Instagram</div>
            <div class="contacto-desc">@psicologamaines</div>
        </a>
    </div>
</section>

{{-- FOOTER --}}
<footer>
    <div class="footer-logo">
        <img src="{{ asset('images/logo.png') }}" alt="Sanando Almas">
        <div class="footer-copy">
            &copy; {{ date('Y') }} Sanando Almas — Psc. Maria Ines. Todos los derechos reservados.
        </div>
    </div>
    <div class="footer-right">
        <a href="{{ route('patient.privacy') }}">Aviso de Privacidad</a>
    </div>
</footer>

</body>
</html>