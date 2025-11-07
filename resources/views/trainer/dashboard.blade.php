<x-trainer-dashboard-layout>
    <!-- Dashboard Stats (Default) -->
    <div id="dashboard-section" class="dashboard-section active">
        <livewire:trainer.stats />
    </div>

    <!-- Mis Clases -->
    <div id="mis-clases-section" class="dashboard-section" style="display: none;">
        <livewire:trainer.my-classes />
    </div>

    <!-- Alumnos -->
    <div id="alumnos-section" class="dashboard-section" style="display: none;">
        <livewire:trainer.students />
    </div>
</x-trainer-dashboard-layout>
