// ===================================
// NAVEGACIÓN
// ===================================
document.addEventListener('DOMContentLoaded', function() {
    const navbar = document.getElementById('navbar');
    const hamburger = document.getElementById('hamburger');
    const navMenu = document.getElementById('navMenu');
    const navLinks = document.querySelectorAll('.nav-link');
    const backToTop = document.getElementById('backToTop');

    // Navbar scroll effect
    window.addEventListener('scroll', function() {
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }

        // Mostrar/ocultar botón volver arriba
        if (window.scrollY > 300) {
            backToTop.classList.add('show');
        } else {
            backToTop.classList.remove('show');
        }
    });

    // Toggle menú móvil
    hamburger.addEventListener('click', function() {
        navMenu.classList.toggle('active');
        
        // Animación del hamburger
        const spans = hamburger.querySelectorAll('span');
        if (navMenu.classList.contains('active')) {
            spans[0].style.transform = 'rotate(45deg) translateY(8px)';
            spans[1].style.opacity = '0';
            spans[2].style.transform = 'rotate(-45deg) translateY(-8px)';
        } else {
            spans[0].style.transform = 'none';
            spans[1].style.opacity = '1';
            spans[2].style.transform = 'none';
        }
    });

    // Cerrar menú al hacer click en un enlace
    navLinks.forEach(link => {
        link.addEventListener('click', function() {
            navMenu.classList.remove('active');
            const spans = hamburger.querySelectorAll('span');
            spans[0].style.transform = 'none';
            spans[1].style.opacity = '1';
            spans[2].style.transform = 'none';
        });
    });

    // Resaltar enlace activo según scroll
    window.addEventListener('scroll', function() {
        let current = '';
        const sections = document.querySelectorAll('section');
        
        sections.forEach(section => {
            const sectionTop = section.offsetTop;
            const sectionHeight = section.clientHeight;
            if (pageYOffset >= sectionTop - 100) {
                current = section.getAttribute('id');
            }
        });

        navLinks.forEach(link => {
            link.classList.remove('active');
            if (link.getAttribute('href') === '#' + current) {
                link.classList.add('active');
            }
        });
    });

    // Botón volver arriba
    backToTop.addEventListener('click', function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
});

// ===================================
// TABS DE HORARIOS
// ===================================
const tabButtons = document.querySelectorAll('.tab-button');
const scheduleLists = document.querySelectorAll('.schedule-list');

// Datos de ejemplo para horarios (en una aplicación real, esto vendría del servidor)
const scheduleData = {
    lunes: [
        { time: '07:00 - 08:00', class: 'Yoga', trainer: 'María González', room: 'Sala 1' },
        { time: '09:00 - 09:45', class: 'CrossFit', trainer: 'Carlos Ruiz', room: 'Sala 2' },
        { time: '18:00 - 18:50', class: 'Spinning', trainer: 'Ana Martínez', room: 'Sala 3' },
        { time: '19:00 - 20:00', class: 'Zumba', trainer: 'Laura Pérez', room: 'Sala 1' }
    ],
    martes: [
        { time: '07:00 - 08:00', class: 'Pilates', trainer: 'Sofia Torres', room: 'Sala 1' },
        { time: '10:00 - 10:50', class: 'Funcional', trainer: 'Diego López', room: 'Sala 2' },
        { time: '17:00 - 17:45', class: 'CrossFit', trainer: 'Carlos Ruiz', room: 'Sala 2' },
        { time: '19:00 - 20:00', class: 'Spinning', trainer: 'Ana Martínez', room: 'Sala 3' }
    ],
    miercoles: [
        { time: '07:00 - 08:00', class: 'Yoga', trainer: 'María González', room: 'Sala 1' },
        { time: '09:00 - 09:45', class: 'Zumba', trainer: 'Laura Pérez', room: 'Sala 1' },
        { time: '18:00 - 18:50', class: 'Funcional', trainer: 'Diego López', room: 'Sala 2' },
        { time: '19:00 - 20:00', class: 'Pilates', trainer: 'Sofia Torres', room: 'Sala 1' }
    ],
    jueves: [
        { time: '07:00 - 08:00', class: 'CrossFit', trainer: 'Carlos Ruiz', room: 'Sala 2' },
        { time: '10:00 - 10:50', class: 'Yoga', trainer: 'María González', room: 'Sala 1' },
        { time: '17:00 - 17:45', class: 'Spinning', trainer: 'Ana Martínez', room: 'Sala 3' },
        { time: '19:00 - 20:00', class: 'Zumba', trainer: 'Laura Pérez', room: 'Sala 1' }
    ],
    viernes: [
        { time: '07:00 - 08:00', class: 'Funcional', trainer: 'Diego López', room: 'Sala 2' },
        { time: '09:00 - 09:45', class: 'Pilates', trainer: 'Sofia Torres', room: 'Sala 1' },
        { time: '18:00 - 18:50', class: 'CrossFit', trainer: 'Carlos Ruiz', room: 'Sala 2' },
        { time: '19:00 - 20:00', class: 'Yoga', trainer: 'María González', room: 'Sala 1' }
    ],
    sabado: [
        { time: '09:00 - 10:00', class: 'Yoga', trainer: 'María González', room: 'Sala 1' },
        { time: '10:00 - 10:50', class: 'Spinning', trainer: 'Ana Martínez', room: 'Sala 3' },
        { time: '11:00 - 11:45', class: 'Zumba', trainer: 'Laura Pérez', room: 'Sala 1' },
        { time: '12:00 - 13:00', class: 'Funcional', trainer: 'Diego López', room: 'Sala 2' }
    ]
};

tabButtons.forEach(button => {
    button.addEventListener('click', function() {
        const day = this.getAttribute('data-day');
        
        // Actualizar botones activos
        tabButtons.forEach(btn => btn.classList.remove('active'));
        this.classList.add('active');
        
        // Actualizar contenido
        updateSchedule(day);
    });
});

function updateSchedule(day) {
    const scheduleContent = document.querySelector('.schedule-content');
    const scheduleList = document.getElementById('lunes');
    
    if (scheduleData[day]) {
        let html = '';
        scheduleData[day].forEach(item => {
            html += `
                <div class="schedule-item">
                    <span class="schedule-time">${item.time}</span>
                    <span class="schedule-class">${item.class}</span>
                    <span class="schedule-trainer">${item.trainer}</span>
                    <span class="schedule-room">${item.room}</span>
                    <button class="btn btn-small" onclick="bookClass('${item.class}', '${item.time}', '${day}')">Reservar</button>
                </div>
            `;
        });
        scheduleList.innerHTML = html;
    }
}

// ===================================
// SISTEMA DE RESERVAS
// ===================================
function bookClass(className, time, day) {
    // Verificar si el usuario está autenticado
    const isAuthenticated = false; // Esto debería venir de Laravel/Blade
    
    if (!isAuthenticated) {
        showNotification('Por favor, inicia sesión para reservar una clase', 'warning');
        // Redirigir al login después de 2 segundos
        setTimeout(() => {
            // window.location.href = '/login';
        }, 2000);
        return;
    }
    
    // Aquí iría la lógica de reserva (POST a la API)
    showNotification(`Reservando ${className} para ${translateDay(day)} a las ${time}...`, 'info');
    
    // Simular llamada a API
    setTimeout(() => {
        const success = Math.random() > 0.2; // 80% de éxito
        
        if (success) {
            showNotification(`¡Clase reservada exitosamente! ${className} - ${translateDay(day)} ${time}`, 'success');
        } else {
            showNotification('Lo sentimos, esta clase está llena. Intenta con otro horario.', 'error');
        }
    }, 1500);
}

function translateDay(day) {
    const days = {
        lunes: 'Lunes',
        martes: 'Martes',
        miercoles: 'Miércoles',
        jueves: 'Jueves',
        viernes: 'Viernes',
        sabado: 'Sábado'
    };
    return days[day] || day;
}

// ===================================
// NOTIFICACIONES
// ===================================
function showNotification(message, type = 'info') {
    // Crear elemento de notificación
    const notification = document.createElement('div');
    notification.className = `notification notification-${type}`;
    notification.textContent = message;
    
    // Estilos inline para la notificación
    notification.style.cssText = `
        position: fixed;
        top: 100px;
        right: 20px;
        background: ${type === 'success' ? '#10b981' : type === 'error' ? '#ef4444' : type === 'warning' ? '#f59e0b' : '#3b82f6'};
        color: white;
        padding: 1rem 1.5rem;
        border-radius: 10px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
        z-index: 9999;
        animation: slideIn 0.3s ease-out;
        max-width: 400px;
    `;
    
    document.body.appendChild(notification);
    
    // Remover después de 3 segundos
    setTimeout(() => {
        notification.style.animation = 'slideOut 0.3s ease-in';
        setTimeout(() => {
            notification.remove();
        }, 300);
    }, 3000);
}

// Añadir animaciones de notificación
const style = document.createElement('style');
style.textContent = `
    @keyframes slideIn {
        from {
            transform: translateX(400px);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }
    
    @keyframes slideOut {
        from {
            transform: translateX(0);
            opacity: 1;
        }
        to {
            transform: translateX(400px);
            opacity: 0;
        }
    }
`;
document.head.appendChild(style);

// ===================================
// FORMULARIO DE CONTACTO
// ===================================
const contactForm = document.getElementById('contactForm');
if (contactForm) {
    contactForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        
        showNotification('Enviando mensaje...', 'info');
        
        // Simular envío de formulario
        setTimeout(() => {
            showNotification('¡Mensaje enviado exitosamente! Nos pondremos en contacto contigo pronto.', 'success');
            contactForm.reset();
        }, 1500);
        
        // En una aplicación real, aquí iría el fetch para enviar los datos
        /*
        fetch('/api/contact', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            showNotification('¡Mensaje enviado exitosamente!', 'success');
            contactForm.reset();
        })
        .catch(error => {
            showNotification('Error al enviar el mensaje. Intenta nuevamente.', 'error');
        });
        */
    });
}

// ===================================
// ANIMACIONES DE SCROLL
// ===================================
const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -100px 0px'
};

const observer = new IntersectionObserver(function(entries) {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.style.animation = 'fadeIn 0.6s ease-out forwards';
            observer.unobserve(entry.target);
        }
    });
}, observerOptions);

// Observar elementos que queremos animar
document.querySelectorAll('.feature-card, .class-card, .pricing-card').forEach(el => {
    el.style.opacity = '0';
    observer.observe(el);
});

// ===================================
// BOTONES DE RESERVA EN CLASES
// ===================================
document.querySelectorAll('.class-card .btn').forEach(button => {
    button.addEventListener('click', function() {
        const classCard = this.closest('.class-card');
        const className = classCard.querySelector('.class-overlay h3').textContent;
        const duration = classCard.querySelector('.class-duration').textContent;
        
        showNotification(`Mostrando horarios disponibles para ${className}`, 'info');
        
        // Scroll suave a la sección de horarios
        setTimeout(() => {
            document.getElementById('horarios').scrollIntoView({ behavior: 'smooth' });
        }, 1000);
    });
});

// ===================================
// SELECCIÓN DE PLANES
// ===================================
document.querySelectorAll('.pricing-card .btn').forEach(button => {
    button.addEventListener('click', function() {
        const pricingCard = this.closest('.pricing-card');
        const planName = pricingCard.querySelector('h3').textContent;
        const planPrice = pricingCard.querySelector('.amount').textContent;
        
        showNotification(`Has seleccionado el plan ${planName} - $${planPrice}/mes`, 'success');
        
        // Aquí iría la lógica para redirigir a la página de pago o registro
        setTimeout(() => {
            // window.location.href = '/register?plan=' + planName.toLowerCase();
        }, 1500);
    });
});

// ===================================
// NEWSLETTER
// ===================================
const newsletterForm = document.querySelector('.newsletter-form');
if (newsletterForm) {
    newsletterForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const email = this.querySelector('input[type="email"]').value;
        
        showNotification('Suscribiéndote al newsletter...', 'info');
        
        setTimeout(() => {
            showNotification('¡Te has suscrito exitosamente! Revisa tu email.', 'success');
            this.reset();
        }, 1500);
    });
}

// ===================================
// SMOOTH SCROLL PARA TODOS LOS ENLACES
// ===================================
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        const href = this.getAttribute('href');
        if (href !== '#' && href.length > 1) {
            e.preventDefault();
            const target = document.querySelector(href);
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        }
    });
});

// ===================================
// EFECTO PARALLAX EN HERO
// ===================================
window.addEventListener('scroll', function() {
    const hero = document.querySelector('.hero');
    if (hero) {
        const scrolled = window.pageYOffset;
        hero.style.transform = `translateY(${scrolled * 0.5}px)`;
    }
});

console.log('🏋️ DANJER FITNESS - Sistema cargado correctamente');
