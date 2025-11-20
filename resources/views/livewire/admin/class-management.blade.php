<div>
    <div class="class-management-container">
        <!-- Panel Principal -->
        <div class="class-management-main">
            <div class="class-management-header">
                <h2>Gestión de Clases</h2>
            </div>

            <div class="class-management-controls">
                <div class="search-box" style="max-width: 400px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="11" cy="11" r="8"></circle>
                        <path d="m21 21-4.35-4.35"></path>
                    </svg>
                    <input type="text"
                           placeholder="Buscar clases..."
                           wire:model.debounce.300ms="searchTerm">
                </div>

                <button class="btn btn-primary" wire:click="openCreateModal">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                    Nueva Clase
                </button>
            </div>

            <div wire:loading class="loading-spinner">
                Cargando clases...
            </div>

            @if(!$sessions || count($sessions) == 0)
                <div class="empty-state">
                    <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                        <line x1="16" y1="2" x2="16" y2="6"></line>
                        <line x1="8" y1="2" x2="8" y2="6"></line>
                        <line x1="3" y1="10" x2="21" y2="10"></line>
                    </svg>
                    <p>No se encontraron clases</p>
                </div>
            @else
                <div class="sessions-table-container">
                    <table class="sessions-table">
                        <thead>
                            <tr>
                                <th>Clase</th>
                                <th>Entrenador</th>
                                <th>Lugar</th>
                                <th>Capacidad</th>
                                <th>Fecha y Hora</th>
                                <th>Duración</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sessions as $session)
                                <tr>
                                    <td>
                                        <div class="session-info">
                                            <strong>{{ $session->name }}</strong>
                                            <p class="session-type">{{ $session->classType->name ?? 'N/A' }}</p>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="trainer-info">
                                            <span class="trainer-avatar">{{ substr($session->trainer->user->name, 0, 1) }}{{ substr($session->trainer->user->lastname, 0, 1) }}</span>
                                            <div>
                                                <strong>{{ $session->trainer->user->name }} {{ $session->trainer->user->lastname }}</strong>
                                                <p class="trainer-specialty">{{ $session->trainer->speciality ? \App\Models\ClassType::find($session->trainer->speciality)?->name : 'N/A' }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="room-info">
                                            <strong>{{ $session->room->name }}</strong>
                                            <p class="room-capacity">Cap: {{ $session->room->capacity }} personas</p>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="capacity-badge">{{ $session->capacity }}/{{ $session->room->capacity }}</span>
                                    </td>
                                    <td>
                                        <div class="datetime-info">
                                            <span class="date">{{ \Carbon\Carbon::parse($session->date)->format('d/m/Y') }}</span>
                                            <span class="time">{{ $session->start_datetime }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="duration-badge">{{ $session->duration_minutes }}min</span>
                                    </td>
                                    <td>
                                        <span class="status-badge status-{{ $session->status }}">
                                            {{ ucfirst($session->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="action-buttons">
                                            <button class="btn btn-sm btn-primary" 
                                                    wire:click="editSession({{ $session->id }})">
                                                Editar
                                            </button>
                                            <button class="btn btn-sm btn-danger" 
                                                    wire:click="confirmDelete({{ $session->id }})">
                                                Eliminar
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

    <!-- Modal de Crear/Editar Clase -->
    @if($showCreateModal)
        <div class="modal-overlay" wire:click.self="closeCreateModal">
            <div class="modal-content modal-lg" @click.stop>
                <div class="modal-header">
                    <h3>{{ $selectedSessionId ? 'Editar Clase' : 'Crear Nueva Clase' }}</h3>
                    <button class="modal-close" wire:click="closeCreateModal">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="sessionName">Nombre de la Clase</label>
                            <input type="text" 
                                   id="sessionName"
                                   wire:model.lazy="sessionName"
                                   class="form-input"
                                   placeholder="Ej: Yoga Mañana">
                        </div>

                        <div class="form-group">
                            <label for="classTypeId">Tipo de Clase</label>
                            <select id="classTypeId" 
                                    wire:model.lazy="classTypeId"
                                    class="form-input">
                                <option value="">-- Selecciona un tipo --</option>
                                @foreach($classTypes as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="trainerId">Entrenador</label>
                            <select id="trainerId" 
                                    wire:model.lazy="trainerId"
                                    class="form-input">
                                <option value="">-- Selecciona un entrenador --</option>
                                @foreach($trainers as $trainer)
                                    <option value="{{ $trainer->id }}">{{ $trainer->user->name }} {{ $trainer->user->lastname }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="roomId">Lugar</label>
                            <select id="roomId" 
                                    wire:model.lazy="roomId"
                                    class="form-input">
                                <option value="">-- Selecciona una sala --</option>
                                @foreach($rooms as $room)
                                    <option value="{{ $room->id }}">{{ $room->name }} (Cap: {{ $room->capacity }})</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="capacity">Capacidad</label>
                            <input type="number" 
                                   id="capacity"
                                   wire:model.lazy="capacity"
                                   min="1"
                                   class="form-input"
                                   placeholder="Ej: 20">
                        </div>

                        <div class="form-group">
                            <label for="startDatetime">Fecha y Hora</label>
                            <input type="datetime-local" 
                                   id="startDatetime"
                                   wire:model.lazy="startDatetime"
                                   class="form-input">
                        </div>

                        <div class="form-group">
                            <label for="durationMinutes">Duración (minutos)</label>
                            <input type="number" 
                                   id="durationMinutes"
                                   wire:model.lazy="durationMinutes"
                                   min="1"
                                   class="form-input"
                                   placeholder="Ej: 60">
                        </div>

                        <div class="form-group">
                            <label for="status">Estado</label>
                            <select id="status" 
                                    wire:model.lazy="status"
                                    class="form-input">
                                <option value="scheduled">Programada</option>
                                <option value="in_progress">En Progreso</option>
                                <option value="completed">Completada</option>
                                <option value="cancelled">Cancelada</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="sessionDescription">Descripción</label>
                        <textarea id="sessionDescription"
                                  wire:model.lazy="sessionDescription"
                                  class="form-input"
                                  rows="3"
                                  placeholder="Descripción de la clase..."></textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" wire:click="closeCreateModal">
                        Cancelar
                    </button>
                    <button class="btn btn-primary" 
                            wire:click="{{ $selectedSessionId ? 'updateSession' : 'createSession' }}" 
                            wire:loading.attr="disabled">
                        <span wire:loading.remove>{{ $selectedSessionId ? 'Actualizar' : 'Crear' }} Clase</span>
                        <span wire:loading>Procesando...</span>
                    </button>
                </div>
            </div>
        </div>
    @endif

    <!-- Modal de Confirmar Eliminación -->
    @if($confirmingDelete)
        <div class="modal-overlay" wire:click.self="cancelDelete">
            <div class="modal-content" @click.stop>
                <div class="modal-header">
                    <h3>Confirmar Eliminación</h3>
                    <button class="modal-close" wire:click="cancelDelete">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </button>
                </div>

                <div class="modal-body">
                    <p>¿Estás seguro de que deseas eliminar esta clase? Esta acción no se puede deshacer.</p>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" wire:click="cancelDelete">
                        Cancelar
                    </button>
                    <button class="btn btn-danger" wire:click="deleteSession" wire:loading.attr="disabled">
                        <span wire:loading.remove>Eliminar</span>
                        <span wire:loading>Eliminando...</span>
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>
