<div>
    <div class="section-header">
        <h2>Mis Alumnos</h2>
        <div class="search-box">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="11" cy="11" r="8"></circle>
                <path d="m21 21-4.35-4.35"></path>
            </svg>
            <input type="text"
                   placeholder="Buscar por nombre o email..."
                   wire:model.debounce.300ms="searchTerm">
        </div>
    </div>

    <div wire:loading class="loading-spinner">
        Cargando alumnos...
    </div>

    @if(empty($students) || $students->isEmpty())
        <div class="empty-state">
            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                <circle cx="9" cy="7" r="4"></circle>
                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
            </svg>
            <p>No se encontraron alumnos</p>
        </div>
    @else
        <div class="students-grid">
            @foreach($students as $student)
                <div class="student-card">
                    <div class="student-avatar">
                        {{ substr($student->user->name ?? 'N', 0, 1) }}{{ substr($student->user->lastname ?? 'A', 0, 1) }}
                    </div>
                    <div class="student-info">
                        <h3>{{ $student->user->name ?? 'N/A' }} {{ $student->user->lastname ?? '' }}</h3>
                        <p class="student-email">{{ $student->user->email ?? 'N/A' }}</p>
                        <p class="student-phone">{{ $student->user->phone ?? 'Sin teléfono' }}</p>
                    </div>
                    <div class="student-stats">
                        <div class="stat-item">
                            <span class="stat-number">{{ $student->classes_taken ?? 0 }}</span>
                            <span class="stat-label">Clases Tomadas</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">{{ $student->classes_reserved ?? 0 }}</span>
                            <span class="stat-label">Clases Reservadas</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
