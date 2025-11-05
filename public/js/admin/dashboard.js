/**
 * ===================================
 * DASHBOARD ADMIN - DANJER FITNESS
 * ===================================
 */

// ===================================
// INICIALIZACIÓN
// ===================================
document.addEventListener('DOMContentLoaded', function() {
    initializeSidebar();
    initializeUserMenu();
    initializeNotifications();
    initializeCharts();
    initializeAnimations();
});

// ===================================
// SIDEBAR
// ===================================
function initializeSidebar() {
    const sidebar = document.getElementById('sidebar');
    const menuToggle = document.getElementById('menuToggle');
    const sidebarToggle = document.getElementById('sidebarToggle');

    // Toggle sidebar en móviles
    if (menuToggle) {
        menuToggle.addEventListener('click', function() {
            sidebar.classList.toggle('active');
            
            // Añadir overlay
            if (sidebar.classList.contains('active')) {
                createOverlay();
            } else {
                removeOverlay();
            }
        });
    }

    // Toggle colapso de sidebar (funcionalidad futura)
    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', function() {
            // Funcionalidad para colapsar/expandir sidebar
            console.log('Sidebar toggle clicked');
        });
    }

    // Cerrar sidebar al hacer click fuera (móviles)
    document.addEventListener('click', function(event) {
        if (window.innerWidth <= 1024) {
            const isClickInsideSidebar = sidebar.contains(event.target);
            const isClickOnMenuToggle = menuToggle && menuToggle.contains(event.target);
            
            if (!isClickInsideSidebar && !isClickOnMenuToggle && sidebar.classList.contains('active')) {
                sidebar.classList.remove('active');
                removeOverlay();
            }
        }
    });
}

// ===================================
// MENÚ DE USUARIO
// ===================================
function initializeUserMenu() {
    const userMenuBtn = document.getElementById('userMenuBtn');
    const userDropdown = document.getElementById('userDropdown');

    if (userMenuBtn && userDropdown) {
        userMenuBtn.addEventListener('click', function(event) {
            event.stopPropagation();
            userDropdown.classList.toggle('active');
        });

        // Cerrar dropdown al hacer click fuera
        document.addEventListener('click', function(event) {
            if (!userMenuBtn.contains(event.target) && !userDropdown.contains(event.target)) {
                userDropdown.classList.remove('active');
            }
        });

        // Cerrar dropdown al hacer click en un item
        const dropdownItems = userDropdown.querySelectorAll('.dropdown-item');
        dropdownItems.forEach(item => {
            item.addEventListener('click', function() {
                userDropdown.classList.remove('active');
            });
        });
    }
}

// ===================================
// NOTIFICACIONES
// ===================================
function initializeNotifications() {
    const notificationBtn = document.getElementById('notificationBtn');
    const notificationPanel = document.getElementById('notificationPanel');
    const closeNotifications = document.getElementById('closeNotifications');

    if (notificationBtn && notificationPanel) {
        notificationBtn.addEventListener('click', function(event) {
            event.stopPropagation();
            notificationPanel.classList.toggle('active');
            
            if (notificationPanel.classList.contains('active')) {
                createOverlay();
            } else {
                removeOverlay();
            }
        });

        if (closeNotifications) {
            closeNotifications.addEventListener('click', function() {
                notificationPanel.classList.remove('active');
                removeOverlay();
            });
        }

        // Cerrar panel al hacer click fuera
        document.addEventListener('click', function(event) {
            if (!notificationPanel.contains(event.target) && !notificationBtn.contains(event.target)) {
                notificationPanel.classList.remove('active');
                removeOverlay();
            }
        });

        // Marcar notificación como leída al hacer click
        const notificationItems = notificationPanel.querySelectorAll('.notification-item');
        notificationItems.forEach(item => {
            item.addEventListener('click', function() {
                this.classList.remove('unread');
            });
        });
    }
}

// ===================================
// GRÁFICOS CON CHART.JS
// ===================================
function initializeCharts() {
    // Gráfico de Asistencia Semanal
    const attendanceCtx = document.getElementById('attendanceChart');
    if (attendanceCtx) {
        new Chart(attendanceCtx, {
            type: 'line',
            data: {
                labels: ['Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb', 'Dom'],
                datasets: [{
                    label: 'Asistencias',
                    data: [65, 78, 82, 75, 88, 92, 45],
                    borderColor: '#667eea',
                    backgroundColor: 'rgba(102, 126, 234, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4,
                    pointRadius: 5,
                    pointHoverRadius: 7,
                    pointBackgroundColor: '#667eea',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointHoverBackgroundColor: '#667eea',
                    pointHoverBorderColor: '#fff',
                }, {
                    label: 'Reservas',
                    data: [72, 85, 90, 82, 95, 98, 52],
                    borderColor: '#764ba2',
                    backgroundColor: 'rgba(118, 75, 162, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4,
                    pointRadius: 5,
                    pointHoverRadius: 7,
                    pointBackgroundColor: '#764ba2',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointHoverBackgroundColor: '#764ba2',
                    pointHoverBorderColor: '#fff',
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                        labels: {
                            usePointStyle: true,
                            padding: 20,
                            font: {
                                size: 13,
                                weight: '600'
                            }
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(15, 23, 42, 0.9)',
                        titleColor: '#fff',
                        bodyColor: '#fff',
                        padding: 12,
                        borderColor: 'rgba(255, 255, 255, 0.1)',
                        borderWidth: 1,
                        displayColors: true,
                        callbacks: {
                            label: function(context) {
                                return context.dataset.label + ': ' + context.parsed.y + ' personas';
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            font: {
                                size: 12
                            },
                            color: '#64748b'
                        },
                        grid: {
                            color: '#e2e8f0',
                            drawBorder: false
                        }
                    },
                    x: {
                        ticks: {
                            font: {
                                size: 12,
                                weight: '600'
                            },
                            color: '#64748b'
                        },
                        grid: {
                            display: false
                        }
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index'
                }
            }
        });
    }

    // Gráfico de Membresías (Donut)
    const membershipCtx = document.getElementById('membershipChart');
    if (membershipCtx) {
        new Chart(membershipCtx, {
            type: 'doughnut',
            data: {
                labels: ['Básico', 'Premium', 'Elite'],
                datasets: [{
                    data: [82, 68, 36],
                    backgroundColor: [
                        '#667eea',
                        '#764ba2',
                        '#f093fb'
                    ],
                    borderWidth: 0,
                    hoverOffset: 10
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                cutout: '70%',
                plugins: {
                    legend: {
                        display: true,
                        position: 'bottom',
                        labels: {
                            usePointStyle: true,
                            padding: 15,
                            font: {
                                size: 12,
                                weight: '600'
                            }
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(15, 23, 42, 0.9)',
                        titleColor: '#fff',
                        bodyColor: '#fff',
                        padding: 12,
                        borderColor: 'rgba(255, 255, 255, 0.1)',
                        borderWidth: 1,
                        callbacks: {
                            label: function(context) {
                                const label = context.label || '';
                                const value = context.parsed || 0;
                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                const percentage = ((value / total) * 100).toFixed(1);
                                return label + ': ' + value + ' (' + percentage + '%)';
                            }
                        }
                    }
                }
            }
        });
    }
}

// ===================================
// ANIMACIONES
// ===================================
function initializeAnimations() {
    // Animación de números (contador)
    animateNumbers();
    
    // Intersection Observer para animaciones al scroll
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-in');
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    // Observar elementos con animación
    const animatedElements = document.querySelectorAll('.stat-card, .dashboard-card, .quick-action-card');
    animatedElements.forEach(element => {
        observer.observe(element);
    });
}

// Animación de números contadores
function animateNumbers() {
    const statValues = document.querySelectorAll('.stat-value');
    
    statValues.forEach(stat => {
        const text = stat.textContent;
        const hasPrefix = text.includes('$');
        const numberString = text.replace(/[^0-9]/g, '');
        const finalNumber = parseInt(numberString);
        
        if (isNaN(finalNumber)) return;
        
        const duration = 2000; // 2 segundos
        const steps = 60;
        const increment = finalNumber / steps;
        let current = 0;
        let step = 0;
        
        const timer = setInterval(() => {
            step++;
            current += increment;
            
            if (step >= steps) {
                current = finalNumber;
                clearInterval(timer);
            }
            
            const displayValue = Math.floor(current);
            stat.textContent = hasPrefix ? '$' + displayValue.toLocaleString() : displayValue.toLocaleString();
        }, duration / steps);
    });
}

// ===================================
// OVERLAY
// ===================================
function createOverlay() {
    // Remover overlay existente si hay
    removeOverlay();
    
    const overlay = document.createElement('div');
    overlay.id = 'overlay';
    overlay.style.cssText = `
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 999;
        transition: opacity 0.3s ease;
        opacity: 0;
    `;
    
    document.body.appendChild(overlay);
    
    // Forzar reflow para activar transición
    overlay.offsetHeight;
    overlay.style.opacity = '1';
    
    // Cerrar al hacer click en overlay
    overlay.addEventListener('click', function() {
        const sidebar = document.getElementById('sidebar');
        const notificationPanel = document.getElementById('notificationPanel');
        
        if (sidebar) sidebar.classList.remove('active');
        if (notificationPanel) notificationPanel.classList.remove('active');
        removeOverlay();
    });
}

function removeOverlay() {
    const overlay = document.getElementById('overlay');
    if (overlay) {
        overlay.style.opacity = '0';
        setTimeout(() => {
            overlay.remove();
        }, 300);
    }
}

// ===================================
// BÚSQUEDA
// ===================================
const searchInput = document.querySelector('.search-box input');
if (searchInput) {
    let searchTimeout;
    
    searchInput.addEventListener('input', function(e) {
        clearTimeout(searchTimeout);
        
        searchTimeout = setTimeout(() => {
            const searchTerm = e.target.value.toLowerCase();
            
            if (searchTerm.length >= 3) {
                // Aquí se implementaría la lógica de búsqueda real
                console.log('Buscando:', searchTerm);
                // Simulación de búsqueda
                performSearch(searchTerm);
            }
        }, 500);
    });
}

function performSearch(term) {
    // Simulación de búsqueda
    // En producción, esto haría una petición AJAX al servidor
    console.log('Realizando búsqueda de:', term);
    
    // Ejemplo: mostrar resultados en consola
    const mockResults = [
        { type: 'cliente', name: 'María García' },
        { type: 'clase', name: 'Yoga Matutino' },
        { type: 'reserva', name: 'Reserva #1234' }
    ];
    
    console.log('Resultados encontrados:', mockResults.filter(item => 
        item.name.toLowerCase().includes(term)
    ));
}

// ===================================
// TABS (para horarios y filtros)
// ===================================
function initializeTabs() {
    const tabButtons = document.querySelectorAll('.tab-button');
    
    tabButtons.forEach(button => {
        button.addEventListener('click', function() {
            const targetDay = this.getAttribute('data-day');
            
            // Remover clase active de todos los botones y contenido
            tabButtons.forEach(btn => btn.classList.remove('active'));
            document.querySelectorAll('.schedule-list').forEach(list => list.classList.remove('active'));
            
            // Añadir clase active al botón clickeado
            this.classList.add('active');
            
            // Mostrar contenido correspondiente
            const targetContent = document.getElementById(targetDay);
            if (targetContent) {
                targetContent.classList.add('active');
            }
        });
    });
}

// ===================================
// BOTONES DE ACCIÓN RÁPIDA
// ===================================
const quickActionCards = document.querySelectorAll('.quick-action-card');
quickActionCards.forEach(card => {
    card.addEventListener('click', function() {
        const actionText = this.querySelector('span').textContent;
        console.log('Acción rápida:', actionText);
        
        // Aquí se implementaría la lógica para cada acción
        // Por ejemplo, abrir un modal, redirigir, etc.
        showNotification(`Abriendo: ${actionText}`, 'info');
    });
});

// ===================================
// NOTIFICACIONES TOAST
// ===================================
function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `toast toast-${type}`;
    notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        padding: 1rem 1.5rem;
        background-color: white;
        border-radius: 0.75rem;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        z-index: 9999;
        animation: slideInRight 0.3s ease;
        border-left: 4px solid ${getNotificationColor(type)};
    `;
    
    notification.innerHTML = `
        <div style="display: flex; align-items: center; gap: 0.75rem;">
            <svg style="width: 20px; height: 20px; color: ${getNotificationColor(type)};" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                ${getNotificationIcon(type)}
            </svg>
            <span style="font-size: 0.9375rem; font-weight: 500; color: #1e293b;">${message}</span>
        </div>
    `;
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.style.animation = 'slideOutRight 0.3s ease';
        setTimeout(() => {
            notification.remove();
        }, 300);
    }, 3000);
}

function getNotificationColor(type) {
    const colors = {
        success: '#10b981',
        warning: '#fbbf24',
        danger: '#ef4444',
        info: '#3b82f6'
    };
    return colors[type] || colors.info;
}

function getNotificationIcon(type) {
    const icons = {
        success: '<polyline points="20 6 9 17 4 12"></polyline>',
        warning: '<path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12.01" y2="17"></line>',
        danger: '<circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line>',
        info: '<circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line>'
    };
    return icons[type] || icons.info;
}

// ===================================
// ANIMACIONES CSS
// ===================================
const style = document.createElement('style');
style.textContent = `
    @keyframes slideInRight {
        from {
            transform: translateX(400px);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }
    
    @keyframes slideOutRight {
        from {
            transform: translateX(0);
            opacity: 1;
        }
        to {
            transform: translateX(400px);
            opacity: 0;
        }
    }
    
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .animate-in {
        animation: fadeIn 0.5s ease forwards;
    }
`;
document.head.appendChild(style);

// ===================================
// MANEJO DE RESIZE
// ===================================
let resizeTimeout;
window.addEventListener('resize', function() {
    clearTimeout(resizeTimeout);
    
    resizeTimeout = setTimeout(() => {
        const sidebar = document.getElementById('sidebar');
        
        // Remover clase active del sidebar si la pantalla es grande
        if (window.innerWidth > 1024 && sidebar) {
            sidebar.classList.remove('active');
            removeOverlay();
        }
    }, 250);
});

// ===================================
// ACTUALIZACIÓN EN TIEMPO REAL (SIMULADO)
// ===================================
// Simulación de actualización de datos en tiempo real
function startRealtimeUpdates() {
    // Actualizar badge de notificaciones cada 30 segundos (simulado)
    setInterval(() => {
        const badge = document.querySelector('.topbar-btn .badge');
        if (badge) {
            const currentCount = parseInt(badge.textContent);
            const newCount = currentCount + Math.floor(Math.random() * 2);
            
            if (newCount !== currentCount) {
                badge.textContent = newCount;
                badge.style.animation = 'pulse 0.5s ease';
                setTimeout(() => {
                    badge.style.animation = '';
                }, 500);
            }
        }
    }, 30000);
}

// Iniciar actualizaciones en tiempo real
startRealtimeUpdates();

// ===================================
// UTILIDADES
// ===================================
// Función para formatear fechas
function formatDate(date) {
    const options = { year: 'numeric', month: 'long', day: 'numeric' };
    return new Date(date).toLocaleDateString('es-ES', options);
}

// Función para formatear moneda
function formatCurrency(amount) {
    return new Intl.NumberFormat('es-ES', {
        style: 'currency',
        currency: 'USD'
    }).format(amount);
}

// ===================================
// EXPORT (para usar en otros scripts)
// ===================================
window.DashboardApp = {
    showNotification,
    formatDate,
    formatCurrency
};

console.log('Dashboard cargado correctamente ✓');
