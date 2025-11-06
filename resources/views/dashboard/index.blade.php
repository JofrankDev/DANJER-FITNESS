<x-dashboard-layout>
    <x-slot name="title">Dashboard</x-slot>
    <x-slot name="pageTitle">Dashboard</x-slot>

    <div id="dashboard-content">
        <!-- Dashboard Stats Section -->
        <section id="dashboard-section" class="content-section active" wire:ignore.self>
            <livewire:dashboard.stats />
        </section>

        <!-- Clases Section -->
        <section id="clases-section" class="content-section" style="display: none;" wire:ignore.self>
            <livewire:dashboard.classes-list />
        </section>

        <!-- Profesores Section -->
        <section id="profesores-section" class="content-section" style="display: none;" wire:ignore.self>
            <livewire:dashboard.trainers-list />
        </section>

        <!-- Planes Section -->
        <section id="planes-section" class="content-section" style="display: none;" wire:ignore.self>
            <livewire:dashboard.plans />
        </section>

        <!-- Perfil Section -->
        <section id="perfil-section" class="content-section" style="display: none;" wire:ignore.self>
            <livewire:dashboard.profile />
        </section>
    </div>

    @push('scripts')
    <script>
        // Escuchar el evento de navegación
        window.livewire.on('navigateTo', section => {
            navigateToSection(section);
        });

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
                pageTitle.textContent = section.charAt(0).toUpperCase() + section.slice(1);
            }

            // Emitir evento para actualizar el sidebar
            window.livewire.emit('sectionChanged', section);
        }
    </script>
    @endpush
</x-dashboard-layout>
