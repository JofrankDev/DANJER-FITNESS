<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard Administrador - DANJER FITNESS</title>
    <link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <div class="logo">
                <img src="{{ asset('images/logoDanjer.png') }}" alt="DANJER FITNESS">
                <span class="logo-text">DANJER FITNESS</span>
            </div>
            <button class="sidebar-toggle" id="sidebarToggle">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="3" y1="12" x2="21" y2="12"></line>
                    <line x1="3" y1="6" x2="21" y2="6"></line>
                    <line x1="3" y1="18" x2="21" y2="18"></line>
                </svg>
            </button>
        </div>
        
        <nav class="sidebar-nav">
            <ul class="nav-list">
                <li class="nav-item active">
                    <a href="#" class="nav-link">
                        <svg class="nav-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                            <polyline points="9 22 9 12 15 12 15 22"></polyline>
                        </svg>
                        <span class="nav-text">Dashboard</span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <svg class="nav-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                            <line x1="16" y1="2" x2="16" y2="6"></line>
                            <line x1="8" y1="2" x2="8" y2="6"></line>
                            <line x1="3" y1="10" x2="21" y2="10"></line>
                        </svg>
                        <span class="nav-text">Clases</span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <svg class="nav-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="8.5" cy="7" r="4"></circle>
                            <polyline points="17 11 19 13 23 9"></polyline>
                        </svg>
                        <span class="nav-text">Reservas</span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <svg class="nav-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                        <span class="nav-text">Clientes</span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <svg class="nav-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
                            <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                        </svg>
                        <span class="nav-text">Membresías</span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <svg class="nav-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                            <polyline points="14 2 14 8 20 8"></polyline>
                            <line x1="9" y1="15" x2="15" y2="15"></line>
                        </svg>
                        <span class="nav-text">Asistencias</span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <svg class="nav-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="12" y1="1" x2="12" y2="23"></line>
                            <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                        </svg>
                        <span class="nav-text">Pagos</span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <svg class="nav-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M21.21 15.89A10 10 0 1 1 8 2.83"></path>
                            <path d="M22 12A10 10 0 0 0 12 2v10z"></path>
                        </svg>
                        <span class="nav-text">Reportes</span>
                    </a>
                </li>
            </ul>
            
            <div class="nav-divider"></div>
            
            <ul class="nav-list">
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <svg class="nav-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="3"></circle>
                            <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path>
                        </svg>
                        <span class="nav-text">Configuración</span>
                    </a>
                </li>
            </ul>
        </nav>
    </aside>

    <!-- Main Content -->
    <div class="main-wrapper">
        <!-- Top Navigation -->
        <header class="topbar">
            <div class="topbar-left">
                <button class="menu-toggle" id="menuToggle">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="3" y1="12" x2="21" y2="12"></line>
                        <line x1="3" y1="6" x2="21" y2="6"></line>
                        <line x1="3" y1="18" x2="21" y2="18"></line>
                    </svg>
                </button>
                <div class="search-box">
                    <svg class="search-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="11" cy="11" r="8"></circle>
                        <path d="m21 21-4.35-4.35"></path>
                    </svg>
                    <input type="text" placeholder="Buscar clientes, clases, reservas...">
                </div>
            </div>
            
            <div class="topbar-right">
                <button class="topbar-btn" id="notificationBtn">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                        <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                    </svg>
                    <span class="badge">5</span>
                </button>
                
                <div class="user-menu">
                    <button class="user-btn" id="userMenuBtn">
                        <img src="{{ asset('images/default-avatar.png') }}" alt="Admin" class="user-avatar">
                        <div class="user-info">
                            <span class="user-name">Administradora</span>
                            <span class="user-role">Entrenadora</span>
                        </div>
                        <svg class="dropdown-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </button>
                    
                    <div class="user-dropdown" id="userDropdown">
                        <a href="#" class="dropdown-item">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                            Mi Perfil
                        </a>
                        <a href="#" class="dropdown-item">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="3"></circle>
                                <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path>
                            </svg>
                            Configuración
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="{{ route('home') }}" class="dropdown-item">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                            </svg>
                            Ver Sitio Web
                        </a>
                        <a href="#" class="dropdown-item text-danger">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                <polyline points="16 17 21 12 16 7"></polyline>
                                <line x1="21" y1="12" x2="9" y2="12"></line>
                            </svg>
                            Cerrar Sesión
                        </a>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Content Area -->
        <main class="content">
            <div class="content-header">
                <div>
                    <h1 class="page-title">Dashboard</h1>
                    <p class="page-subtitle">Bienvenida al panel de administración de DANJER FITNESS</p>
                </div>
                <div class="header-actions">
                    <button class="btn btn-outline">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                            <polyline points="7 10 12 15 17 10"></polyline>
                            <line x1="12" y1="15" x2="12" y2="3"></line>
                        </svg>
                        Exportar Reporte
                    </button>
                    <button class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                        Nueva Clase
                    </button>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon bg-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                    </div>
                    <div class="stat-content">
                        <p class="stat-label">Clientes Activos</p>
                        <h3 class="stat-value">248</h3>
                        <div class="stat-trend up">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>
                                <polyline points="17 6 23 6 23 12"></polyline>
                            </svg>
                            <span>12% vs mes anterior</span>
                        </div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon bg-success">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="8.5" cy="7" r="4"></circle>
                            <polyline points="17 11 19 13 23 9"></polyline>
                        </svg>
                    </div>
                    <div class="stat-content">
                        <p class="stat-label">Reservas Hoy</p>
                        <h3 class="stat-value">42</h3>
                        <div class="stat-trend up">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>
                                <polyline points="17 6 23 6 23 12"></polyline>
                            </svg>
                            <span>8% más que ayer</span>
                        </div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon bg-warning">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
                            <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                        </svg>
                    </div>
                    <div class="stat-content">
                        <p class="stat-label">Membresías Activas</p>
                        <h3 class="stat-value">186</h3>
                        <div class="stat-trend down">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="23 18 13.5 8.5 8.5 13.5 1 6"></polyline>
                                <polyline points="17 18 23 18 23 12"></polyline>
                            </svg>
                            <span>3% menos</span>
                        </div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon bg-info">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="12" y1="1" x2="12" y2="23"></line>
                            <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                        </svg>
                    </div>
                    <div class="stat-content">
                        <p class="stat-label">Ingresos del Mes</p>
                        <h3 class="stat-value">$12,450</h3>
                        <div class="stat-trend up">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>
                                <polyline points="17 6 23 6 23 12"></polyline>
                            </svg>
                            <span>18% vs mes anterior</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts and Tables Row -->
            <div class="dashboard-grid">
                <!-- Upcoming Classes -->
                <div class="dashboard-card">
                    <div class="card-header">
                        <h2 class="card-title">Próximas Clases</h2>
                        <a href="#" class="btn btn-sm btn-outline">Ver todas</a>
                    </div>
                    <div class="card-body">
                        <div class="class-list">
                            <div class="class-item">
                                <div class="class-time">
                                    <span class="time">09:00</span>
                                    <span class="duration">60 min</span>
                                </div>
                                <div class="class-info">
                                    <h4>Yoga Matutino</h4>
                                    <p>Sala 1 • 15/20 reservas</p>
                                </div>
                                <div class="class-status">
                                    <div class="progress-ring">
                                        <svg width="50" height="50">
                                            <circle cx="25" cy="25" r="20" fill="none" stroke="#e0e0e0" stroke-width="4"></circle>
                                            <circle cx="25" cy="25" r="20" fill="none" stroke="#667eea" stroke-width="4" stroke-dasharray="125.6" stroke-dashoffset="31.4" transform="rotate(-90 25 25)"></circle>
                                        </svg>
                                        <span class="progress-text">75%</span>
                                    </div>
                                </div>
                            </div>

                            <div class="class-item">
                                <div class="class-time">
                                    <span class="time">10:30</span>
                                    <span class="duration">45 min</span>
                                </div>
                                <div class="class-info">
                                    <h4>CrossFit Intenso</h4>
                                    <p>Sala 2 • 12/15 reservas</p>
                                </div>
                                <div class="class-status">
                                    <div class="progress-ring">
                                        <svg width="50" height="50">
                                            <circle cx="25" cy="25" r="20" fill="none" stroke="#e0e0e0" stroke-width="4"></circle>
                                            <circle cx="25" cy="25" r="20" fill="none" stroke="#f093fb" stroke-width="4" stroke-dasharray="125.6" stroke-dashoffset="25.12" transform="rotate(-90 25 25)"></circle>
                                        </svg>
                                        <span class="progress-text">80%</span>
                                    </div>
                                </div>
                            </div>

                            <div class="class-item">
                                <div class="class-time">
                                    <span class="time">18:00</span>
                                    <span class="duration">50 min</span>
                                </div>
                                <div class="class-info">
                                    <h4>Spinning</h4>
                                    <p>Sala 3 • 20/20 reservas</p>
                                </div>
                                <div class="class-status">
                                    <div class="progress-ring full">
                                        <svg width="50" height="50">
                                            <circle cx="25" cy="25" r="20" fill="none" stroke="#e0e0e0" stroke-width="4"></circle>
                                            <circle cx="25" cy="25" r="20" fill="none" stroke="#10b981" stroke-width="4" stroke-dasharray="125.6" stroke-dashoffset="0" transform="rotate(-90 25 25)"></circle>
                                        </svg>
                                        <span class="progress-text">Full</span>
                                    </div>
                                </div>
                            </div>

                            <div class="class-item">
                                <div class="class-time">
                                    <span class="time">19:00</span>
                                    <span class="duration">60 min</span>
                                </div>
                                <div class="class-info">
                                    <h4>Zumba</h4>
                                    <p>Sala 1 • 8/25 reservas</p>
                                </div>
                                <div class="class-status">
                                    <div class="progress-ring">
                                        <svg width="50" height="50">
                                            <circle cx="25" cy="25" r="20" fill="none" stroke="#e0e0e0" stroke-width="4"></circle>
                                            <circle cx="25" cy="25" r="20" fill="none" stroke="#fbbf24" stroke-width="4" stroke-dasharray="125.6" stroke-dashoffset="85.28" transform="rotate(-90 25 25)"></circle>
                                        </svg>
                                        <span class="progress-text">32%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Bookings -->
                <div class="dashboard-card">
                    <div class="card-header">
                        <h2 class="card-title">Reservas Recientes</h2>
                        <a href="#" class="btn btn-sm btn-outline">Ver todas</a>
                    </div>
                    <div class="card-body">
                        <div class="booking-list">
                            <div class="booking-item">
                                <img src="{{ asset('images/default-avatar.png') }}" alt="Cliente" class="booking-avatar">
                                <div class="booking-info">
                                    <h4>María García</h4>
                                    <p>Yoga Matutino • 09:00 AM</p>
                                </div>
                                <span class="booking-badge confirmed">Confirmada</span>
                            </div>

                            <div class="booking-item">
                                <img src="{{ asset('images/default-avatar.png') }}" alt="Cliente" class="booking-avatar">
                                <div class="booking-info">
                                    <h4>Carlos López</h4>
                                    <p>CrossFit Intenso • 10:30 AM</p>
                                </div>
                                <span class="booking-badge confirmed">Confirmada</span>
                            </div>

                            <div class="booking-item">
                                <img src="{{ asset('images/default-avatar.png') }}" alt="Cliente" class="booking-avatar">
                                <div class="booking-info">
                                    <h4>Ana Martínez</h4>
                                    <p>Spinning • 06:00 PM</p>
                                </div>
                                <span class="booking-badge pending">Pendiente</span>
                            </div>

                            <div class="booking-item">
                                <img src="{{ asset('images/default-avatar.png') }}" alt="Cliente" class="booking-avatar">
                                <div class="booking-info">
                                    <h4>Juan Pérez</h4>
                                    <p>Pilates • 05:00 PM</p>
                                </div>
                                <span class="booking-badge confirmed">Confirmada</span>
                            </div>

                            <div class="booking-item">
                                <img src="{{ asset('images/default-avatar.png') }}" alt="Cliente" class="booking-avatar">
                                <div class="booking-info">
                                    <h4>Laura Rodríguez</h4>
                                    <p>Zumba • 07:00 PM</p>
                                </div>
                                <span class="booking-badge confirmed">Confirmada</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bottom Row -->
            <div class="dashboard-grid-3">
                <!-- Attendance Chart -->
                <div class="dashboard-card col-span-2">
                    <div class="card-header">
                        <h2 class="card-title">Asistencia Semanal</h2>
                        <div class="card-actions">
                            <button class="btn btn-sm btn-ghost active">Semana</button>
                            <button class="btn btn-sm btn-ghost">Mes</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas id="attendanceChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Membership Status -->
                <div class="dashboard-card">
                    <div class="card-header">
                        <h2 class="card-title">Estado de Membresías</h2>
                    </div>
                    <div class="card-body">
                        <div class="membership-stats">
                            <div class="membership-item">
                                <div class="membership-header">
                                    <span class="membership-name">Plan Básico</span>
                                    <span class="membership-count">82</span>
                                </div>
                                <div class="progress-bar">
                                    <div class="progress-fill" style="width: 44%;"></div>
                                </div>
                            </div>

                            <div class="membership-item">
                                <div class="membership-header">
                                    <span class="membership-name">Plan Premium</span>
                                    <span class="membership-count">68</span>
                                </div>
                                <div class="progress-bar">
                                    <div class="progress-fill" style="width: 37%;"></div>
                                </div>
                            </div>

                            <div class="membership-item">
                                <div class="membership-header">
                                    <span class="membership-name">Plan Elite</span>
                                    <span class="membership-count">36</span>
                                </div>
                                <div class="progress-bar">
                                    <div class="progress-fill" style="width: 19%;"></div>
                                </div>
                            </div>

                            <div class="membership-donut">
                                <canvas id="membershipChart"></canvas>
                            </div>

                            <div class="membership-alerts">
                                <div class="alert alert-warning">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
                                        <line x1="12" y1="9" x2="12" y2="13"></line>
                                        <line x1="12" y1="17" x2="12.01" y2="17"></line>
                                    </svg>
                                    <div>
                                        <strong>12 membresías</strong>
                                        <span>vencen en 7 días</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="quick-actions">
                <h2 class="section-title">Acciones Rápidas</h2>
                <div class="quick-actions-grid">
                    <button class="quick-action-card">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                        <span>Crear Nueva Clase</span>
                    </button>

                    <button class="quick-action-card">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="8.5" cy="7" r="4"></circle>
                            <line x1="20" y1="8" x2="20" y2="14"></line>
                            <line x1="23" y1="11" x2="17" y2="11"></line>
                        </svg>
                        <span>Registrar Cliente</span>
                    </button>

                    <button class="quick-action-card">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                            <polyline points="14 2 14 8 20 8"></polyline>
                            <line x1="9" y1="15" x2="15" y2="15"></line>
                        </svg>
                        <span>Marcar Asistencia</span>
                    </button>

                    <button class="quick-action-card">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="12" y1="1" x2="12" y2="23"></line>
                            <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                        </svg>
                        <span>Registrar Pago</span>
                    </button>

                    <button class="quick-action-card">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                            <polyline points="7 10 12 15 17 10"></polyline>
                            <line x1="12" y1="15" x2="12" y2="3"></line>
                        </svg>
                        <span>Generar Reporte</span>
                    </button>

                    <button class="quick-action-card">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                            <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                        </svg>
                        <span>Enviar Notificación</span>
                    </button>
                </div>
            </div>
        </main>
    </div>

    <!-- Notification Panel -->
    <div class="notification-panel" id="notificationPanel">
        <div class="notification-header">
            <h3>Notificaciones</h3>
            <button class="close-btn" id="closeNotifications">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
        </div>
        <div class="notification-list">
            <div class="notification-item unread">
                <div class="notification-icon bg-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="8.5" cy="7" r="4"></circle>
                        <polyline points="17 11 19 13 23 9"></polyline>
                    </svg>
                </div>
                <div class="notification-content">
                    <p><strong>Nueva reserva</strong> de María García para Yoga Matutino</p>
                    <span class="notification-time">Hace 5 minutos</span>
                </div>
            </div>

            <div class="notification-item unread">
                <div class="notification-icon bg-warning">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
                        <line x1="12" y1="9" x2="12" y2="13"></line>
                        <line x1="12" y1="17" x2="12.01" y2="17"></line>
                    </svg>
                </div>
                <div class="notification-content">
                    <p><strong>Membresía próxima a vencer</strong> de Carlos López (3 días)</p>
                    <span class="notification-time">Hace 15 minutos</span>
                </div>
            </div>

            <div class="notification-item">
                <div class="notification-icon bg-success">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="20 6 9 17 4 12"></polyline>
                    </svg>
                </div>
                <div class="notification-content">
                    <p><strong>Pago recibido</strong> de Ana Martínez - Plan Premium</p>
                    <span class="notification-time">Hace 1 hora</span>
                </div>
            </div>

            <div class="notification-item">
                <div class="notification-icon bg-info">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="12" y1="16" x2="12" y2="12"></line>
                        <line x1="12" y1="8" x2="12.01" y2="8"></line>
                    </svg>
                </div>
                <div class="notification-content">
                    <p><strong>Cupo liberado</strong> en Spinning 6:00 PM</p>
                    <span class="notification-time">Hace 2 horas</span>
                </div>
            </div>

            <div class="notification-item">
                <div class="notification-icon bg-danger">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="15" y1="9" x2="9" y2="15"></line>
                        <line x1="9" y1="9" x2="15" y2="15"></line>
                    </svg>
                </div>
                <div class="notification-content">
                    <p><strong>Cancelación</strong> de Juan Pérez para CrossFit</p>
                    <span class="notification-time">Hace 3 horas</span>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <script src="{{ asset('js/admin/dashboard.js') }}"></script>
</body>
</html>
