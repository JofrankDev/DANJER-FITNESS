// ===================================
// DASHBOARD CON LIVEWIRE
// ===================================
document.addEventListener('DOMContentLoaded', function() {
    // Mobile sidebar toggle
    const sidebar = document.getElementById('sidebar');
    const mobileToggle = document.getElementById('mobileToggle');
    const sidebarToggle = document.getElementById('sidebarToggle');

    if (mobileToggle) {
        mobileToggle.addEventListener('click', function() {
            sidebar.classList.toggle('active');
        });
    }

    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', function() {
            sidebar.classList.toggle('collapsed');
        });
    }

    // Close sidebar when clicking outside on mobile
    document.addEventListener('click', function(e) {
        if (window.innerWidth <= 768) {
            if (!sidebar.contains(e.target) && !mobileToggle.contains(e.target)) {
                sidebar.classList.remove('active');
            }
        }
    });
});

// Global function for navigation (called from Livewire components)
function navigateToSection(section) {
    // Ocultar todas las secciones
    document.querySelectorAll('.content-section').forEach(sec => {
        sec.style.display = 'none';
        sec.classList.remove('active');
    });

    // Mostrar la sección seleccionada
    const targetSection = document.getElementById(section + '-section');
    if (targetSection) {
        targetSection.style.display = 'block';
        targetSection.classList.add('active');
    }

    // Actualizar el título
    const pageTitle = document.querySelector('.page-title');
    if (pageTitle) {
        const titles = {
            'dashboard': 'Dashboard',
            'clases': 'Clases',
            'profesores': 'Profesores',
            'planes': 'Planes',
            'perfil': 'Mi Perfil'
        };
        pageTitle.textContent = titles[section] || section;
    }

    // Close sidebar on mobile after selection
    const sidebar = document.getElementById('sidebar');
    if (window.innerWidth <= 768 && sidebar) {
        sidebar.classList.remove('active');
    }

    // Emitir evento para actualizar el sidebar
    if (window.Livewire) {
        window.Livewire.emit('sectionChanged', section);
    }
}

// Listen for Livewire navigation events
document.addEventListener('livewire:load', function () {
    window.livewire.on('navigateTo', section => {
        navigateToSection(section);
    });
});
