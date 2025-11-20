<div>
    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    @if(session()->has('error'))
        <div class="alert alert-error">
            {{ session('error') }}
        </div>
    @endif

    <div class="section-header">
        <h2>Mis Clases</h2>
        <div class="filter-tabs">
            <button class="filter-tab {{ $filter === 'upcoming' ? 'active' : '' }}"
                    wire:click="setFilter('upcoming')">
                Próximas
            </button>
            <button class="filter-tab {{ $filter === 'today' ? 'active' : '' }}"
                    wire:click="setFilter('today')">
                Hoy
            </button>
            <button class="filter-tab {{ $filter === 'past' ? 'active' : '' }}"
                    wire:click="setFilter('past')">
                Pasadas
            </button>
            <button class="filter-tab {{ $filter === 'all' ? 'active' : '' }}"
                    wire:click="setFilter('all')">
                Todas
            </button>
        </div>
    </div>

    <div wire:loading class="loading-spinner">
        Cargando clases...
    </div>

    @if(empty($classes) || $classes->isEmpty())
        <div class="empty-state">
            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                <line x1="16" y1="2" x2="16" y2="6"></line>
                <line x1="8" y1="2" x2="8" y2="6"></line>
                <line x1="3" y1="10" x2="21" y2="10"></line>
            </svg>
            <p>No tienes clases en esta categoría</p>
        </div>
    @else
        <div class="classes-list">
            @foreach($classes as $class)
                <div class="class-card">
                    <div class="class-header">
                        <div class="class-type">
                            <h3>{{ $class->classType->name ?? 'Clase' }}</h3>
                            <span class="class-status status-{{ $class->status }}">{{ ucfirst($class->status) }}</span>
                        </div>
                        <div class="class-date">
                            <span class="date">{{ $class->date->format('d/m/Y') }}</span>
                            <span class="time">{{ $class->start_datetime->format('H:i') }} - {{ $class->end_time }}</span>
                        </div>
                    </div>

                    <div class="class-details">
                        <div class="detail-item">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                <circle cx="12" cy="10" r="3"></circle>
                            </svg>
                            <span>{{ $class->room->name ?? 'N/A' }}</span>
                        </div>
                        <div class="detail-item">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                            </svg>
                            <span>{{ $class->clients->where('pivot.status', '!=', 'cancelled')->count() }} / {{ $class->capacity }} inscritos</span>
                        </div>
                    </div>

                    <button class="btn-view-students" wire:click="viewStudents({{ $class->id }})">
                        Ver Alumnos Inscritos
                    </button>
                </div>
            @endforeach
        </div>
    @endif

    <!-- Modal para ver alumnos -->
    @if($showStudentsModal && $selectedClass)
        <div class="modal-overlay" wire:click="closeModal">
            <div class="modal-content" wire:click.stop>
                <div class="modal-header">
                    <h3>{{ $selectedClass->classType->name ?? 'Clase' }}</h3>
                    <button class="modal-close" wire:click="closeModal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="class-info-modal">
                        <p><strong>Fecha:</strong> {{ $selectedClass->date->format('d/m/Y') }}</p>
                        <p><strong>Hora:</strong> {{ $selectedClass->start_datetime->format('H:i') }} - {{ $selectedClass->end_time }}</p>
                        <p><strong>Sala:</strong> {{ $selectedClass->room->name ?? 'N/A' }}</p>
                        <p><strong>Capacidad:</strong> {{ $selectedClass->clients->where('pivot.status', '!=', 'cancelled')->count() }} / {{ $selectedClass->capacity }}</p>
                    </div>

                    <h4>Lista de Alumnos</h4>
                    @if($selectedClass->clients->where('pivot.status', '!=', 'cancelled')->isEmpty())
                        <p class="no-students">No hay alumnos inscritos aún</p>
                    @else
                        <table class="students-table">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Estado</th>
                                    <th>Asistencia</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($selectedClass->clients->where('pivot.status', '!=', 'cancelled') as $client)
                                    <tr>
                                        <td>{{ $client->user->name ?? 'N/A' }} {{ $client->user->lastname ?? '' }}</td>
                                        <td>
                                            <span class="badge-{{ $client->pivot->status }}">
                                                {{ ucfirst($client->pivot->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            <button
                                                class="attendance-btn {{ $client->pivot->attendance ? 'present' : 'absent' }}"
                                                wire:click="toggleAttendance({{ $selectedClass->id }}, {{ $client->id }})"
                                                wire:loading.attr="disabled">
                                                {{ $client->pivot->attendance ? '✓ Presente' : '✗ Ausente' }}
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    @endif
</div>
