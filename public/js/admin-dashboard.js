// Navigation between sections
function navigateToSection(section) {
    // Hide all sections
    const sections = document.querySelectorAll('.admin-dashboard-section');
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

    // Update active state in sidebar
    const navItems = document.querySelectorAll('.sidebar-nav .nav-item');
    navItems.forEach(item => {
        if (item.getAttribute('data-section') === section) {
            item.classList.add('active');
        } else {
            item.classList.remove('active');
        }
    });
}

// Listen to Livewire events
document.addEventListener('DOMContentLoaded', function() {
    // Mobile menu toggle
    const mobileMenuToggle = document.getElementById('mobileMenuToggle');
    const adminSidebar = document.querySelector('.admin-sidebar');

    if (mobileMenuToggle && adminSidebar) {
        mobileMenuToggle.addEventListener('click', function() {
            adminSidebar.classList.toggle('active');
        });

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(e) {
            if (window.innerWidth <= 768) {
                if (!adminSidebar.contains(e.target) && !mobileMenuToggle.contains(e.target)) {
                    adminSidebar.classList.remove('active');
                }
            }
        });
    }

    // Sidebar navigation
    const navItems = document.querySelectorAll('.sidebar-nav .nav-item');
    navItems.forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();
            const section = this.getAttribute('data-section');
            navigateToSection(section);

            // Close mobile menu after navigation
            if (adminSidebar && window.innerWidth <= 768) {
                adminSidebar.classList.remove('active');
            }
        });
    });

    // Set initial active state
    const initialSection = document.querySelector('.sidebar-nav .nav-item.active');
    if (initialSection) {
        const section = initialSection.getAttribute('data-section');
        navigateToSection(section);
    }
});
