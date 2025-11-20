<aside class="admin-sidebar" id="admin-sidebar">
    <div class="sidebar-header">
        <h2>DANJER FITNESS</h2>
        <span class="sidebar-subtitle">Panel Administrador</span>
    </div>

    <nav class="sidebar-nav">
        <a href="#"
           class="nav-item {{ $currentSection === 'dashboard' ? 'active' : '' }}"
           wire:click.prevent="changeSection('dashboard')"
           data-section="dashboard">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="3" y="3" width="7" height="7"></rect>
                <rect x="14" y="3" width="7" height="7"></rect>
                <rect x="14" y="14" width="7" height="7"></rect>
                <rect x="3" y="14" width="7" height="7"></rect>
            </svg>
            <span>Dashboard</span>
        </a>

        <a href="#"
           class="nav-item {{ $currentSection === 'user-roles' ? 'active' : '' }}"
           wire:click.prevent="changeSection('user-roles')"
           data-section="user-roles">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                <circle cx="9" cy="7" r="4"></circle>
                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
            </svg>
            <span>Gestión de Roles</span>
        </a>

        <a href="#"
           class="nav-item {{ $currentSection === 'reports' ? 'active' : '' }}"
           wire:click.prevent="changeSection('reports')"
           data-section="reports">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                <polyline points="9 22 9 12 15 12 15 22"></polyline>
            </svg>
            <span>Reportes</span>
        </a>

        <a href="#"
           class="nav-item {{ $currentSection === 'memberships' ? 'active' : '' }}"
           wire:click.prevent="changeSection('memberships')"
           data-section="memberships">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect>
                <line x1="1" y1="10" x2="23" y2="10"></line>
            </svg>
            <span>Gestión de Membresía</span>
        </a>

        <a href="#"
           class="nav-item {{ $currentSection === 'classes' ? 'active' : '' }}"
           wire:click.prevent="changeSection('classes')"
           data-section="classes">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                <line x1="16" y1="2" x2="16" y2="6"></line>
                <line x1="8" y1="2" x2="8" y2="6"></line>
                <line x1="3" y1="10" x2="21" y2="10"></line>
            </svg>
            <span>Gestión de Clases</span>
        </a>
    </nav>
</aside>
