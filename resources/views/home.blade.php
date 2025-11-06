<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DANJER FITNESS - Tu Gimnasio de Confianza</title>
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;900&display=swap"
        rel="stylesheet">
</head>

<body>
    <!-- Navegación -->
    <nav class="navbar" id="navbar">
        <div class="container">
            <div class="nav-wrapper">
                <div class="logo">
                    <img src="{{ asset('images/logoDanjer.png') }}" alt="DANJER FITNESS">
                </div>
                <ul class="nav-menu" id="navMenu">
                    <li><a href="#inicio" class="nav-link active">Inicio</a></li>
                    <li><a href="#clases" class="nav-link">Clases</a></li>
                    <li><a href="#horarios" class="nav-link">Horarios</a></li>
                    <li><a href="#planes" class="nav-link">Planes</a></li>
                    <li><a href="#contacto" class="nav-link">Contacto</a></li>
                </ul>
                <div class="nav-buttons">
                    @guest
                        <a href="{{ route('login') }}" class="btn btn-outline">Iniciar Sesión</a>
                        <a href="{{ route('register') }}" class="btn btn-primary">Registrarse</a>
                    @else
                        <a href="#" class="btn btn-primary">Mi Cuenta</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary">
                                Cerrar Sesión
                            </button>
                        </form>

                    @endguest
                </div>
                <div class="hamburger" id="hamburger">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero" id="inicio">
        <div class="hero-overlay"></div>
        <div class="container">
            <div class="hero-content">
                <h1 class="hero-title animate-fade-in">Transforma Tu Cuerpo<br><span>Transforma Tu Vida</span></h1>
                <p class="hero-subtitle animate-fade-in-delay">Únete a la mejor comunidad fitness y alcanza tus
                    objetivos con entrenadores certificados</p>
                <div class="hero-buttons animate-fade-in-delay-2">
                    <a href="#planes" class="btn btn-hero">Comienza Ahora</a>
                    <a href="#clases" class="btn btn-outline-white">Ver Clases</a>
                </div>
            </div>
        </div>
        <div class="scroll-indicator">
            <div class="mouse"></div>
        </div>
    </section>

    <!-- Características -->
    <section class="features">
        <div class="container">
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                    </div>
                    <h3>Entrenadores Certificados</h3>
                    <p>Profesionales especializados para guiarte en tu progreso</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                            <line x1="16" y1="2" x2="16" y2="6"></line>
                            <line x1="8" y1="2" x2="8" y2="6"></line>
                            <line x1="3" y1="10" x2="21" y2="10"></line>
                        </svg>
                    </div>
                    <h3>Reserva Online</h3>
                    <p>Sistema fácil e intuitivo para reservar tus clases favoritas</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <circle cx="12" cy="12" r="10"></circle>
                            <polyline points="12 6 12 12 16 14"></polyline>
                        </svg>
                    </div>
                    <h3>Horarios Flexibles</h3>
                    <p>Clases disponibles todo el día para adaptarse a tu ritmo</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2">
                            <path d="M22 12h-4l-3 9L9 3l-3 9H2"></path>
                        </svg>
                    </div>
                    <h3>Variedad de Clases</h3>
                    <p>Yoga, CrossFit, Spinning, Pilates y mucho más</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Clases Destacadas -->
    <section class="classes" id="clases">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Nuestras Clases</h2>
                <p class="section-subtitle">Descubre la variedad de clases que ofrecemos para todos los niveles</p>
            </div>
            <div class="classes-grid">
                <div class="class-card">
                    <div class="class-image"
                        style="background-image: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                        <div class="class-overlay">
                            <h3>Yoga</h3>
                            <p>Equilibra cuerpo y mente</p>
                        </div>
                    </div>
                    <div class="class-info">
                        <div class="class-details">
                            <span class="class-duration">⏱ 60 min</span>
                            <span class="class-level">📊 Todos los niveles</span>
                        </div>
                        <button class="btn btn-small">Reservar Clase</button>
                    </div>
                </div>
                <div class="class-card">
                    <div class="class-image"
                        style="background-image: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                        <div class="class-overlay">
                            <h3>CrossFit</h3>
                            <p>Entrena como un atleta</p>
                        </div>
                    </div>
                    <div class="class-info">
                        <div class="class-details">
                            <span class="class-duration">⏱ 45 min</span>
                            <span class="class-level">📊 Intermedio</span>
                        </div>
                        <button class="btn btn-small">Reservar Clase</button>
                    </div>
                </div>
                <div class="class-card">
                    <div class="class-image"
                        style="background-image: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                        <div class="class-overlay">
                            <h3>Spinning</h3>
                            <p>Pedalea hacia tus metas</p>
                        </div>
                    </div>
                    <div class="class-info">
                        <div class="class-details">
                            <span class="class-duration">⏱ 50 min</span>
                            <span class="class-level">📊 Todos los niveles</span>
                        </div>
                        <button class="btn btn-small">Reservar Clase</button>
                    </div>
                </div>
            </div>
            <div class="text-center mt-4">
                @auth
                    <a href="#clases-completas" class="btn btn-primary btn-ver-mas">
                        Ver Todas Las Clases
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-left: 8px; vertical-align: middle;">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary btn-ver-mas">
                        Ver Todas Las Clases
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-left: 8px; vertical-align: middle;">
                            <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"></path>
                            <polyline points="10 17 15 12 10 7"></polyline>
                            <line x1="15" y1="12" x2="3" y2="12"></line>
                        </svg>
                    </a>
                @endauth
            </div>
        </div>
    </section>

    <!-- Horarios -->
    <section class="schedule" id="horarios">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Horarios de Clases</h2>
                <p class="section-subtitle">Encuentra el horario perfecto para ti</p>
            </div>
            <div class="schedule-tabs">
                <button class="tab-button active" data-day="lunes">Lunes</button>
                <button class="tab-button" data-day="martes">Martes</button>
                <button class="tab-button" data-day="miercoles">Miércoles</button>
                <button class="tab-button" data-day="jueves">Jueves</button>
                <button class="tab-button" data-day="viernes">Viernes</button>
                <button class="tab-button" data-day="sabado">Sábado</button>
            </div>
            <div class="schedule-content">
                <div class="schedule-list active" id="lunes">
                    <div class="schedule-item">
                        <span class="schedule-time">07:00 - 08:00</span>
                        <span class="schedule-class">Yoga</span>
                        <span class="schedule-trainer">María González</span>
                        <span class="schedule-room">Sala 1</span>
                        <button class="btn btn-small">Reservar</button>
                    </div>
                    <div class="schedule-item">
                        <span class="schedule-time">09:00 - 09:45</span>
                        <span class="schedule-class">CrossFit</span>
                        <span class="schedule-trainer">Carlos Ruiz</span>
                        <span class="schedule-room">Sala 2</span>
                        <button class="btn btn-small">Reservar</button>
                    </div>
                    <div class="schedule-item">
                        <span class="schedule-time">18:00 - 18:50</span>
                        <span class="schedule-class">Spinning</span>
                        <span class="schedule-trainer">Ana Martínez</span>
                        <span class="schedule-room">Sala 3</span>
                        <button class="btn btn-small">Reservar</button>
                    </div>
                    <div class="schedule-item">
                        <span class="schedule-time">19:00 - 20:00</span>
                        <span class="schedule-class">Zumba</span>
                        <span class="schedule-trainer">Laura Pérez</span>
                        <span class="schedule-room">Sala 1</span>
                        <button class="btn btn-small">Reservar</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Planes -->
    <section class="pricing" id="planes">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Nuestros Planes</h2>
                <p class="section-subtitle">Elige el plan que mejor se adapte a tus necesidades</p>
            </div>
            <div class="pricing-grid">
                <div class="pricing-card">
                    <div class="pricing-header">
                        <h3>Básico</h3>
                        <div class="pricing-price">
                            <span class="currency">$</span>
                            <span class="amount">29</span>
                            <span class="period">/mes</span>
                        </div>
                    </div>
                    <ul class="pricing-features">
                        <li>✓ Acceso al gimnasio</li>
                        <li>✓ 5 clases al mes</li>
                        <li>✓ Vestuarios y duchas</li>
                        <li>✗ Entrenador personal</li>
                        <li>✗ Nutricionista</li>
                    </ul>
                    <button class="btn btn-outline-full">Seleccionar Plan</button>
                </div>
                <div class="pricing-card featured">
                    <div class="featured-badge">Más Popular</div>
                    <div class="pricing-header">
                        <h3>Premium</h3>
                        <div class="pricing-price">
                            <span class="currency">$</span>
                            <span class="amount">49</span>
                            <span class="period">/mes</span>
                        </div>
                    </div>
                    <ul class="pricing-features">
                        <li>✓ Acceso ilimitado al gimnasio</li>
                        <li>✓ Clases ilimitadas</li>
                        <li>✓ Vestuarios y duchas</li>
                        <li>✓ 2 sesiones de entrenador personal</li>
                        <li>✗ Nutricionista</li>
                    </ul>
                    <button class="btn btn-primary-full">Seleccionar Plan</button>
                </div>
                <div class="pricing-card">
                    <div class="pricing-header">
                        <h3>Elite</h3>
                        <div class="pricing-price">
                            <span class="currency">$</span>
                            <span class="amount">79</span>
                            <span class="period">/mes</span>
                        </div>
                    </div>
                    <ul class="pricing-features">
                        <li>✓ Acceso ilimitado al gimnasio</li>
                        <li>✓ Clases ilimitadas</li>
                        <li>✓ Vestuarios y duchas premium</li>
                        <li>✓ Entrenador personal ilimitado</li>
                        <li>✓ Plan nutricional personalizado</li>
                    </ul>
                    <button class="btn btn-outline-full">Seleccionar Plan</button>
                </div>
            </div>
        </div>
    </section>

    <!-- Contacto -->
    <section class="contact" id="contacto">
        <div class="container">
            <div class="contact-wrapper">
                <div class="contact-info">
                    <h2>Contáctanos</h2>
                    <p>¿Tienes alguna pregunta? Estamos aquí para ayudarte</p>
                    <div class="contact-details">
                        <div class="contact-item">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                <circle cx="12" cy="10" r="3"></circle>
                            </svg>
                            <div>
                                <h4>Dirección</h4>
                                <p>Av. Principal 123, Ciudad, País</p>
                            </div>
                        </div>
                        <div class="contact-item">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2">
                                <path
                                    d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z">
                                </path>
                            </svg>
                            <div>
                                <h4>Teléfono</h4>
                                <p>+1 234 567 890</p>
                            </div>
                        </div>
                        <div class="contact-item">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z">
                                </path>
                                <polyline points="22,6 12,13 2,6"></polyline>
                            </svg>
                            <div>
                                <h4>Email</h4>
                                <p>info@danjerfitness.com</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="contact-form">
                    <form id="contactForm">
                        <div class="form-group">
                            <input type="text" placeholder="Nombre completo" required>
                        </div>
                        <div class="form-group">
                            <input type="email" placeholder="Email" required>
                        </div>
                        <div class="form-group">
                            <input type="tel" placeholder="Teléfono" required>
                        </div>
                        <div class="form-group">
                            <textarea placeholder="Mensaje" rows="4" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary-full">Enviar Mensaje</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3>DANJER <span>FITNESS</span></h3>
                    <p>Transformando vidas a través del fitness desde 2020</p>
                    <div class="social-links">
                        <a href="#" aria-label="Facebook">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                            </svg>
                        </a>
                        <a href="#" aria-label="Instagram">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                <rect x="2" y="2" width="20" height="20" rx="5" ry="5">
                                </rect>
                                <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                            </svg>
                        </a>
                        <a href="#" aria-label="Twitter">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                <path
                                    d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z">
                                </path>
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="footer-section">
                    <h4>Enlaces Rápidos</h4>
                    <ul>
                        <li><a href="#inicio">Inicio</a></li>
                        <li><a href="#clases">Clases</a></li>
                        <li><a href="#horarios">Horarios</a></li>
                        <li><a href="#planes">Planes</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h4>Horarios</h4>
                    <ul>
                        <li>Lunes - Viernes: 6:00 - 22:00</li>
                        <li>Sábado: 8:00 - 20:00</li>
                        <li>Domingo: 9:00 - 14:00</li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h4>Newsletter</h4>
                    <p>Suscríbete para recibir noticias y promociones</p>
                    <form class="newsletter-form">
                        <input type="email" placeholder="Tu email">
                        <button type="submit" class="btn btn-primary">Suscribirse</button>
                    </form>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2025 DANJER FITNESS. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>

    <!-- Botón volver arriba -->
    <button class="back-to-top" id="backToTop" aria-label="Volver arriba">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
            stroke-width="2">
            <polyline points="18 15 12 9 6 15"></polyline>
        </svg>
    </button>

    <script src="{{ asset('js/home.js') }}"></script>
</body>

</html>
