<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - DANJER FITNESS</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;900&display=swap"
        rel="stylesheet">
</head>

<body>
    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <div class="logo">
                <img src="{{ asset('images/logoDanjer.png') }}" alt="DANJER FITNESS">
            </div>
            <button class="sidebar-toggle" id="sidebarToggle">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2">
                    <line x1="3" y1="12" x2="21" y2="12"></line>
                    <line x1="3" y1="6" x2="21" y2="6"></line>
                    <line x1="3" y1="18" x2="21" y2="18"></line>
                </svg>
            </button>
        </div>

        <nav class="sidebar-nav">
            <a href="#dashboard" class="nav-item active" data-section="dashboard">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2">
                    <rect x="3" y="3" width="7" height="7"></rect>
                    <rect x="14" y="3" width="7" height="7"></rect>
                    <rect x="14" y="14" width="7" height="7"></rect>
                    <rect x="3" y="14" width="7" height="7"></rect>
                </svg>
                <span>Dashboard</span>
            </a>
            <a href="#clases" class="nav-item" data-section="clases">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2">
                    <path d="M22 12h-4l-3 9L9 3l-3 9H2"></path>
                </svg>
                <span>Clases</span>
            </a>
            <a href="#profesores" class="nav-item" data-section="profesores">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                    <circle cx="9" cy="7" r="4"></circle>
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                </svg>
                <span>Profesores</span>
            </a>
            <a href="#planes" class="nav-item" data-section="planes">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2">
                    <path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                </svg>
                <span>Planes</span>
            </a>
            <a href="#perfil" class="nav-item" data-section="perfil">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                    <circle cx="12" cy="7" r="4"></circle>
                </svg>
                <span>Mi Perfil</span>
            </a>
        </nav>

        <div class="sidebar-footer">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="nav-item logout-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                        <polyline points="16 17 21 12 16 7"></polyline>
                        <line x1="21" y1="12" x2="9" y2="12"></line>
                    </svg>
                    <span>Cerrar Sesión</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Header -->
        <header class="header">
            <div class="header-left">
                <button class="mobile-toggle" id="mobileToggle">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2">
                        <line x1="3" y1="12" x2="21" y2="12"></line>
                        <line x1="3" y1="6" x2="21" y2="6"></line>
                        <line x1="3" y1="18" x2="21" y2="18"></line>
                    </svg>
                </button>
                <h1 class="page-title">Dashboard</h1>
            </div>
            <div class="header-right">
                <div class="user-info">
                    <div class="user-avatar">
                        <span>{{ substr(Auth::user()->name, 0, 1) }}{{ substr(Auth::user()->lastname, 0, 1) }}</span>
                    </div>
                    <div class="user-details">
                        <span class="user-name">{{ Auth::user()->name }} {{ Auth::user()->lastname }}</span>
                        <span class="user-role">Miembro</span>
                    </div>
                </div>
            </div>
        </header>

        <!-- Content Area -->
        <div class="content">
            <!-- Dashboard Section -->
            <section id="dashboard-section" class="content-section active">
                <div class="welcome-card">
                    <h2>¡Bienvenido, {{ Auth::user()->name }}!</h2>
                    <p>Estamos felices de tenerte aquí. Mantén tu rutina y alcanza tus objetivos.</p>
                </div>

                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                <line x1="16" y1="2" x2="16" y2="6"></line>
                                <line x1="8" y1="2" x2="8" y2="6"></line>
                                <line x1="3" y1="10" x2="21" y2="10"></line>
                            </svg>
                        </div>
                        <div class="stat-content">
                            <h3>0</h3>
                            <p>Clases Reservadas</p>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10"></circle>
                                <polyline points="12 6 12 12 16 14"></polyline>
                            </svg>
                        </div>
                        <div class="stat-content">
                            <h3>0</h3>
                            <p>Clases Completadas</p>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2">
                                <path d="M22 12h-4l-3 9L9 3l-3 9H2"></path>
                            </svg>
                        </div>
                        <div class="stat-content">
                            <h3>0</h3>
                            <p>Clases Este Mes</p>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2">
                                <polygon
                                    points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                </polygon>
                            </svg>
                        </div>
                        <div class="stat-content">
                            <h3>Plan Básico</h3>
                            <p>Membresía Actual</p>
                        </div>
                    </div>
                </div>

                <div class="quick-actions">
                    <h3>Acciones Rápidas</h3>
                    <div class="actions-grid">
                        <button class="action-btn" onclick="navigateToSection('clases')">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                <line x1="16" y1="2" x2="16" y2="6"></line>
                                <line x1="8" y1="2" x2="8" y2="6"></line>
                                <line x1="3" y1="10" x2="21" y2="10"></line>
                            </svg>
                            <span>Reservar Clase</span>
                        </button>
                        <button class="action-btn" onclick="navigateToSection('profesores')">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                            </svg>
                            <span>Ver Profesores</span>
                        </button>
                        <button class="action-btn" onclick="navigateToSection('planes')">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2">
                                <path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                            </svg>
                            <span>Cambiar Plan</span>
                        </button>
                        <button class="action-btn" onclick="navigateToSection('perfil')">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                            <span>Mi Perfil</span>
                        </button>
                    </div>
                </div>
            </section>

            <!-- Clases Section -->
            <section id="clases-section" class="content-section">
                <div class="section-header">
                    <h2>Clases Disponibles</h2>
                    <p>Reserva tu clase y empieza a entrenar</p>
                </div>

                <div class="filters">
                    <button class="filter-btn active" data-filter="todas">Todas</button>
                    <button class="filter-btn" data-filter="yoga">Yoga</button>
                    <button class="filter-btn" data-filter="crossfit">CrossFit</button>
                    <button class="filter-btn" data-filter="spinning">Spinning</button>
                    <button class="filter-btn" data-filter="pilates">Pilates</button>
                    <button class="filter-btn" data-filter="zumba">Zumba</button>
                </div>

                <div class="classes-grid">
                    <!-- Clase de ejemplo -->
                    <div class="class-card" data-type="yoga">
                        <div class="class-header">
                            <span class="class-badge yoga">Yoga</span>
                            <span class="class-status available">Disponible</span>
                        </div>
                        <h3>Yoga Matutino</h3>
                        <div class="class-details">
                            <div class="detail-item">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <polyline points="12 6 12 12 16 14"></polyline>
                                </svg>
                                <span>Lunes 07:00 - 08:00</span>
                            </div>
                            <div class="detail-item">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                                <span>María González</span>
                            </div>
                            <div class="detail-item">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                    <circle cx="12" cy="10" r="3"></circle>
                                </svg>
                                <span>Sala 1</span>
                            </div>
                        </div>
                        <button class="btn-reserve">Reservar Clase</button>
                    </div>

                    <!-- Más clases aquí... -->
                    <div class="class-card" data-type="crossfit">
                        <div class="class-header">
                            <span class="class-badge crossfit">CrossFit</span>
                            <span class="class-status available">Disponible</span>
                        </div>
                        <h3>CrossFit Intenso</h3>
                        <div class="class-details">
                            <div class="detail-item">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <polyline points="12 6 12 12 16 14"></polyline>
                                </svg>
                                <span>Lunes 09:00 - 09:45</span>
                            </div>
                            <div class="detail-item">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                                <span>Carlos Ruiz</span>
                            </div>
                            <div class="detail-item">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                    <circle cx="12" cy="10" r="3"></circle>
                                </svg>
                                <span>Sala 2</span>
                            </div>
                        </div>
                        <button class="btn-reserve">Reservar Clase</button>
                    </div>

                    <div class="class-card" data-type="spinning">
                        <div class="class-header">
                            <span class="class-badge spinning">Spinning</span>
                            <span class="class-status limited">Últimos cupos</span>
                        </div>
                        <h3>Spinning Power</h3>
                        <div class="class-details">
                            <div class="detail-item">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <polyline points="12 6 12 12 16 14"></polyline>
                                </svg>
                                <span>Lunes 18:00 - 18:50</span>
                            </div>
                            <div class="detail-item">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                                <span>Ana Martínez</span>
                            </div>
                            <div class="detail-item">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                    <circle cx="12" cy="10" r="3"></circle>
                                </svg>
                                <span>Sala 3</span>
                            </div>
                        </div>
                        <button class="btn-reserve">Reservar Clase</button>
                    </div>
                </div>
            </section>

            <!-- Profesores Section -->
            <section id="profesores-section" class="content-section">
                <div class="section-header">
                    <h2>Nuestros Profesores</h2>
                    <p>Conoce al equipo de expertos que te guiarán</p>
                </div>

                <div class="trainers-grid">
                    <div class="trainer-card">
                        <div class="trainer-image">
                            <div class="trainer-avatar">MG</div>
                        </div>
                        <div class="trainer-info">
                            <h3>María González</h3>
                            <span class="trainer-specialty">Instructora de Yoga</span>
                            <p>Certificada en Hatha y Vinyasa Yoga con más de 10 años de experiencia.</p>
                            <div class="trainer-stats">
                                <div class="stat">
                                    <strong>150+</strong>
                                    <span>Clases</span>
                                </div>
                                <div class="stat">
                                    <strong>4.9</strong>
                                    <span>Rating</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="trainer-card">
                        <div class="trainer-image">
                            <div class="trainer-avatar">CR</div>
                        </div>
                        <div class="trainer-info">
                            <h3>Carlos Ruiz</h3>
                            <span class="trainer-specialty">Instructor de CrossFit</span>
                            <p>Experto en entrenamiento funcional y preparación física de alto rendimiento.</p>
                            <div class="trainer-stats">
                                <div class="stat">
                                    <strong>200+</strong>
                                    <span>Clases</span>
                                </div>
                                <div class="stat">
                                    <strong>5.0</strong>
                                    <span>Rating</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="trainer-card">
                        <div class="trainer-image">
                            <div class="trainer-avatar">AM</div>
                        </div>
                        <div class="trainer-info">
                            <h3>Ana Martínez</h3>
                            <span class="trainer-specialty">Instructora de Spinning</span>
                            <p>Especialista en ciclismo indoor con certificación internacional.</p>
                            <div class="trainer-stats">
                                <div class="stat">
                                    <strong>180+</strong>
                                    <span>Clases</span>
                                </div>
                                <div class="stat">
                                    <strong>4.8</strong>
                                    <span>Rating</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="trainer-card">
                        <div class="trainer-image">
                            <div class="trainer-avatar">LP</div>
                        </div>
                        <div class="trainer-info">
                            <h3>Laura Pérez</h3>
                            <span class="trainer-specialty">Instructora de Zumba</span>
                            <p>Bailarina profesional y entrenadora de fitness con pasión por el ritmo.</p>
                            <div class="trainer-stats">
                                <div class="stat">
                                    <strong>120+</strong>
                                    <span>Clases</span>
                                </div>
                                <div class="stat">
                                    <strong>4.9</strong>
                                    <span>Rating</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Planes Section -->
            <section id="planes-section" class="content-section">
                <div class="section-header">
                    <h2>Planes de Membresía</h2>
                    <p>Elige el plan que mejor se adapte a tus necesidades</p>
                </div>

                <div class="plans-grid">
                    <div class="plan-card">
                        <div class="plan-header">
                            <h3>Básico</h3>
                            <div class="plan-price">
                                <span class="currency">$</span>
                                <span class="amount">29</span>
                                <span class="period">/mes</span>
                            </div>
                        </div>
                        <ul class="plan-features">
                            <li class="included">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                                <span>Acceso al gimnasio</span>
                            </li>
                            <li class="included">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                                <span>5 clases al mes</span>
                            </li>
                            <li class="included">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                                <span>Vestuarios y duchas</span>
                            </li>
                            <li class="excluded">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <line x1="18" y1="6" x2="6" y2="18"></line>
                                    <line x1="6" y1="6" x2="18" y2="18"></line>
                                </svg>
                                <span>Entrenador personal</span>
                            </li>
                            <li class="excluded">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <line x1="18" y1="6" x2="6" y2="18"></line>
                                    <line x1="6" y1="6" x2="18" y2="18"></line>
                                </svg>
                                <span>Nutricionista</span>
                            </li>
                        </ul>
                        <button class="btn-plan current">Plan Actual</button>
                    </div>

                    <div class="plan-card featured">
                        <div class="plan-badge">Más Popular</div>
                        <div class="plan-header">
                            <h3>Premium</h3>
                            <div class="plan-price">
                                <span class="currency">$</span>
                                <span class="amount">49</span>
                                <span class="period">/mes</span>
                            </div>
                        </div>
                        <ul class="plan-features">
                            <li class="included">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                                <span>Acceso ilimitado al gimnasio</span>
                            </li>
                            <li class="included">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                                <span>Clases ilimitadas</span>
                            </li>
                            <li class="included">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                                <span>Vestuarios y duchas</span>
                            </li>
                            <li class="included">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                                <span>2 sesiones de entrenador personal</span>
                            </li>
                            <li class="excluded">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <line x1="18" y1="6" x2="6" y2="18"></line>
                                    <line x1="6" y1="6" x2="18" y2="18"></line>
                                </svg>
                                <span>Nutricionista</span>
                            </li>
                        </ul>
                        <button class="btn-plan">Cambiar a Premium</button>
                    </div>

                    <div class="plan-card">
                        <div class="plan-header">
                            <h3>Elite</h3>
                            <div class="plan-price">
                                <span class="currency">$</span>
                                <span class="amount">79</span>
                                <span class="period">/mes</span>
                            </div>
                        </div>
                        <ul class="plan-features">
                            <li class="included">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                                <span>Acceso ilimitado al gimnasio</span>
                            </li>
                            <li class="included">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                                <span>Clases ilimitadas</span>
                            </li>
                            <li class="included">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                                <span>Vestuarios y duchas premium</span>
                            </li>
                            <li class="included">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                                <span>Entrenador personal ilimitado</span>
                            </li>
                            <li class="included">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                                <span>Plan nutricional personalizado</span>
                            </li>
                        </ul>
                        <button class="btn-plan">Cambiar a Elite</button>
                    </div>
                </div>
            </section>

            <!-- Perfil Section -->
            <section id="perfil-section" class="content-section">
                <div class="section-header">
                    <h2>Mi Perfil</h2>
                    <p>Gestiona tu información personal</p>
                </div>

                <div class="profile-content">
                    <div class="profile-card">
                        <div class="profile-avatar-large">
                            <span>{{ substr(Auth::user()->name, 0, 1) }}{{ substr(Auth::user()->lastname, 0, 1) }}</span>
                        </div>
                        <h3>{{ Auth::user()->name }} {{ Auth::user()->lastname }}</h3>
                        <span class="profile-email">{{ Auth::user()->email }}</span>
                        <span class="profile-member-since">Miembro desde {{ Auth::user()->created_at->format('F Y') }}</span>
                    </div>

                    <div class="profile-form">
                        <h3>Información Personal</h3>
                        <form>
                            <div class="form-row">
                                <div class="form-group">
                                    <label>Nombre</label>
                                    <input type="text" value="{{ Auth::user()->name }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Apellido</label>
                                    <input type="text" value="{{ Auth::user()->lastname }}" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" value="{{ Auth::user()->email }}" readonly>
                            </div>
                            @if(Auth::user()->phone)
                            <div class="form-group">
                                <label>Teléfono</label>
                                <input type="tel" value="{{ Auth::user()->phone }}" readonly>
                            </div>
                            @endif
                            @if(Auth::user()->dni)
                            <div class="form-group">
                                <label>DNI</label>
                                <input type="text" value="{{ Auth::user()->dni }}" readonly>
                            </div>
                            @endif
                            <button type="button" class="btn-edit">Editar Perfil</button>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <script src="{{ asset('js/dashboard.js') }}"></script>
</body>

</html>
