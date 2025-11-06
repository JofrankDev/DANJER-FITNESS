// ===================================
// NAVIGATION
// ===================================
document.addEventListener('DOMContentLoaded', function() {
    // Sidebar navigation
    const navItems = document.querySelectorAll('.nav-item[data-section]');
    const sections = document.querySelectorAll('.content-section');
    const pageTitle = document.querySelector('.page-title');

    navItems.forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();
            const targetSection = this.getAttribute('data-section');

            // Remove active class from all nav items and sections
            navItems.forEach(nav => nav.classList.remove('active'));
            sections.forEach(section => section.classList.remove('active'));

            // Add active class to clicked item and corresponding section
            this.classList.add('active');
            const activeSection = document.getElementById(`${targetSection}-section`);
            if (activeSection) {
                activeSection.classList.add('active');
                // Update page title
                const sectionTitle = this.querySelector('span').textContent;
                pageTitle.textContent = sectionTitle;
            }

            // Close sidebar on mobile after selection
            if (window.innerWidth <= 768) {
                sidebar.classList.remove('active');
            }
        });
    });

    // Mobile sidebar toggle
    const sidebar = document.getElementById('sidebar');
    const mobileToggle = document.getElementById('mobileToggle');

    if (mobileToggle) {
        mobileToggle.addEventListener('click', function() {
            sidebar.classList.toggle('active');
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

    // ===================================
    // FILTERS (CLASES)
    // ===================================
    const filterButtons = document.querySelectorAll('.filter-btn');
    const classCards = document.querySelectorAll('.class-card');

    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            const filter = this.getAttribute('data-filter');

            // Update active button
            filterButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');

            // Filter classes
            classCards.forEach(card => {
                const cardType = card.getAttribute('data-type');

                if (filter === 'todas' || cardType === filter) {
                    card.style.display = 'block';
                    card.style.animation = 'fadeIn 0.3s ease';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });

    // ===================================
    // RESERVE BUTTONS
    // ===================================
    const reserveButtons = document.querySelectorAll('.btn-reserve');

    reserveButtons.forEach(button => {
        button.addEventListener('click', function() {
            const className = this.closest('.class-card').querySelector('h3').textContent;

            // Simple alert for now - can be replaced with modal
            alert(`¡Clase "${className}" reservada con éxito!`);

            // Change button state
            this.textContent = 'Reservado';
            this.style.background = '#10b981';
            this.disabled = true;
        });
    });

    // ===================================
    // PLAN BUTTONS
    // ===================================
    const planButtons = document.querySelectorAll('.btn-plan:not(.current)');

    planButtons.forEach(button => {
        button.addEventListener('click', function() {
            const planName = this.closest('.plan-card').querySelector('h3').textContent;

            if (confirm(`¿Estás seguro de que quieres cambiar al plan ${planName}?`)) {
                alert(`¡Cambiado al plan ${planName} exitosamente!`);

                // Update UI
                document.querySelectorAll('.btn-plan').forEach(btn => {
                    btn.classList.remove('current');
                    btn.textContent = btn.textContent.replace('Plan Actual', 'Cambiar a ' + btn.closest('.plan-card').querySelector('h3').textContent);
                });

                this.classList.add('current');
                this.textContent = 'Plan Actual';
            }
        });
    });

    // ===================================
    // EDIT PROFILE
    // ===================================
    const editButton = document.querySelector('.btn-edit');
    const profileInputs = document.querySelectorAll('.profile-form input');

    if (editButton) {
        editButton.addEventListener('click', function() {
            const isEditing = this.textContent === 'Editar Perfil';

            if (isEditing) {
                // Enable editing
                profileInputs.forEach(input => {
                    if (input.type !== 'email') { // Keep email readonly
                        input.removeAttribute('readonly');
                        input.style.background = '#fff';
                        input.style.cursor = 'text';
                    }
                });
                this.textContent = 'Guardar Cambios';
                this.style.background = '#10b981';
            } else {
                // Save changes
                profileInputs.forEach(input => {
                    input.setAttribute('readonly', true);
                    input.style.background = '#f5f5f5';
                    input.style.cursor = 'not-allowed';
                });
                this.textContent = 'Editar Perfil';
                this.style.background = '#C71585';
                alert('¡Cambios guardados exitosamente!');
            }
        });
    }
});

// ===================================
// NAVIGATION HELPER FUNCTION
// ===================================
function navigateToSection(sectionName) {
    const targetNav = document.querySelector(`[data-section="${sectionName}"]`);
    if (targetNav) {
        targetNav.click();
    }
}

// ===================================
// SCROLL TO TOP ON SECTION CHANGE
// ===================================
document.querySelectorAll('.nav-item').forEach(item => {
    item.addEventListener('click', function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
});
