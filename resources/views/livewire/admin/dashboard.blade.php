<x-admin-dashboard-layout>
    <!-- Dashboard Section -->
    <div id="dashboard-section" class="admin-dashboard-section active">
        <div class="section-header">
            <h2>Dashboard Administrativo</h2>
            <p>Bienvenido al panel de control principal</p>
        </div>
        <!-- Contenido del dashboard irá aquí -->
    </div>

    <!-- User Roles Section -->
    <div id="user-roles-section" class="admin-dashboard-section" style="display: none;">
        <livewire:admin.user-roles />
    </div>

    <!-- Reports Section -->
    <div id="reports-section" class="admin-dashboard-section" style="display: none;">
        <livewire:admin.reports />
    </div>

    <!-- Membership Management Section -->
    <div id="memberships-section" class="admin-dashboard-section" style="display: none;">
        <livewire:admin.membership-management />
    </div>

    <!-- Class Management Section -->
    <div id="classes-section" class="admin-dashboard-section" style="display: none;">
        <livewire:admin.class-management />
    </div>
</x-admin-dashboard-layout>
