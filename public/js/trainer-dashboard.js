// Navigation between sections
function navigateToSection(section) {
    // Hide all sections
    const sections = document.querySelectorAll('.dashboard-section');
    sections.forEach(s => {
        s.style.display = 'none';
        s.classList.remove('active');
    });

    // Show selected section
    const selectedSection = document.getElementById(`${section}-section`);
    if (selectedSection) {
        selectedSection.style.display = 'block';
        selectedSection.classList.add('active');
    }

    // Emit event to Livewire components
    window.dispatchEvent(new CustomEvent('section-changed', { detail: section }));
}

// Listen to Livewire events
document.addEventListener('DOMContentLoaded', function() {
    // Mobile menu toggle
    const mobileMenuToggle = document.getElementById('mobileMenuToggle');
    const sidebar = document.getElementById('sidebar');

    if (mobileMenuToggle && sidebar) {
        mobileMenuToggle.addEventListener('click', function() {
            sidebar.classList.toggle('active');
        });

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(e) {
            if (window.innerWidth <= 768) {
                if (!sidebar.contains(e.target) && !mobileMenuToggle.contains(e.target)) {
                    sidebar.classList.remove('active');
                }
            }
        });
    }

    // Livewire navigation event listener
    if (typeof window.livewire !== 'undefined') {
        window.livewire.on('navigateTo', section => {
            navigateToSection(section);

            // Close mobile menu after navigation
            if (sidebar && window.innerWidth <= 768) {
                sidebar.classList.remove('active');
            }
        });
    }

    // Listen to Livewire load event (in case Livewire loads after this script)
    document.addEventListener('livewire:load', function() {
        window.livewire.on('navigateTo', section => {
            navigateToSection(section);

            // Close mobile menu after navigation
            if (sidebar && window.innerWidth <= 768) {
                sidebar.classList.remove('active');
            }
        });
    });
});
