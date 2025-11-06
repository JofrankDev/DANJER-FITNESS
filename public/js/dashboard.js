// ===================================
// NAVIGATION WITH LIVEWIRE
// ===================================
document.addEventListener('DOMContentLoaded', function() {
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
});

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

