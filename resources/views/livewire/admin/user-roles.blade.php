<div>
    <div class="section-header">
        <h2>Gestión de Roles de Usuarios</h2>
        <div class="search-box">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="11" cy="11" r="8"></circle>
                <path d="m21 21-4.35-4.35"></path>
            </svg>
            <input type="text"
                   placeholder="Buscar por nombre, email o DNI..."
                   wire:model.debounce.300ms="searchTerm">
        </div>
    </div>

    <div wire:loading class="loading-spinner">
        Cargando usuarios...
    </div>

    @if(!$users || $users->isEmpty())
        <div class="empty-state">
            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                <circle cx="9" cy="7" r="4"></circle>
                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
            </svg>
            <p>No se encontraron usuarios</p>
        </div>
    @else
        <div class="users-table-container">
            @if($users && $users->count() > 0)
            <table class="users-table">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>DNI</th>
                        <th>Rol Actual</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>
                                <div class="user-cell">
                                    <div class="user-avatar-small">
                                        {{ substr($user->name, 0, 1) }}{{ substr($user->lastname, 0, 1) }}
                                    </div>
                                    <div>
                                        <strong>{{ $user->name }} {{ $user->lastname }}</strong>
                                        <p class="phone-text">{{ $user->phone ?? 'Sin teléfono' }}</p>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->dni ?? 'N/A' }}</td>
                            <td>
                                <span class="role-badge role-{{ $this->getUserRole($user->id) }}">
                                    @switch($this->getUserRole($user->id))
                                        @case('administrator')
                                            Administrador
                                            @break
                                        @case('trainer')
                                            Entrenador
                                            @break
                                        @case('client')
                                            Cliente
                                            @break
                                        @default
                                            Sin Rol
                                    @endswitch
                                </span>
                            </td>
                            <td>
                                <div class="role-dropdown">
                                    <select wire:change="confirmRoleChange({{ $user->id }}, $event.target.value)"
                                            class="role-select">
                                        <option value="">Cambiar a...</option>
                                        <option value="administrator">Administrador</option>
                                        <option value="trainer">Entrenador</option>
                                        <option value="client">Cliente</option>
                                    </select>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
        </div>
    @endif

    <!-- Modal de Selección de Especialidad (para Entrenadores) -->
    @if($showSpecialityModal)
        <div class="modal-overlay" wire:click.self="cancelRoleChange">
            <div class="modal-content modal-lg" @click.stop>
                <div class="modal-header">
                    <h3>Configurar Entrenador</h3>
                    <button class="modal-close" wire:click="cancelRoleChange">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="trainer-config-section">
                        <h4>Selecciona la Especialidad:</h4>
                        <p class="mb-4">Elige el tipo de entrenamiento que impartirá</p>
                        <div class="specialities-grid">
                            @forelse($specialities as $speciality)
                                <div class="speciality-card {{ $selectedSpeciality == $speciality->id ? 'selected' : '' }}" 
                                     wire:click.prevent="$set('selectedSpeciality', {{ $speciality->id }})"
                                     style="cursor: pointer;">
                                    <div class="speciality-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M6 9c0 1 1 2 2.5 2S11 10 11 9"></path>
                                            <path d="M11 9c0 1 1 2 2.5 2S16 10 16 9"></path>
                                            <path d="M8.5 14s1.5 1.5 3.5 1.5 3.5-1.5 3.5-1.5"></path>
                                            <circle cx="12" cy="12" r="10"></circle>
                                        </svg>
                                    </div>
                                    <h4>{{ $speciality->name }}</h4>
                                </div>
                            @empty
                                <p class="text-center">No hay especialidades disponibles</p>
                            @endforelse
                        </div>
                    </div>

                    <div class="trainer-config-section mt-6">
                        <h4>Años de Experiencia:</h4>
                        <p class="mb-4">Ingresa la experiencia del entrenador en años</p>
                        <div class="form-group">
                            <input type="number" 
                                   wire:model.lazy="selectedYearsExperience"
                                   min="0" 
                                   max="99"
                                   class="form-input"
                                   placeholder="Ej: 5">
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" wire:click="cancelRoleChange">
                        Cancelar
                    </button>
                    <button class="btn btn-primary" 
                            wire:click="confirmTrainerDetails" 
                            @if(!$selectedSpeciality) disabled @endif
                            wire:loading.attr="disabled">
                        <span wire:loading.remove>Continuar</span>
                        <span wire:loading>Procesando...</span>
                    </button>
                </div>
            </div>
        </div>
    @endif

    <!-- Modal de Confirmación -->
    @if($confirmingRoleChange)
        <div class="modal-overlay" wire:click.self="cancelRoleChange">
            <div class="modal-content" @click.stop>
                <div class="modal-header">
                    <h3>Confirmar Cambio de Rol</h3>
                    <button class="modal-close" wire:click="cancelRoleChange">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </button>
                </div>

                <div class="modal-body">
                    <p>¿Estás seguro de que deseas cambiar el rol de <strong>{{ $selectedUserId ? \App\Models\User::find($selectedUserId)?->name : '' }}</strong> a <strong>
                        @switch($newRole)
                            @case('administrator')
                                Administrador
                                @break
                            @case('trainer')
                                Entrenador
                                @break
                            @case('client')
                                Cliente
                                @break
                        @endswitch
                    </strong>?</p>

                    @if($newRole === 'trainer')
                        <div class="form-group mt-4">
                            <label for="yearsExperience">Años de Experiencia:</label>
                            <input type="number" 
                                   id="yearsExperience"
                                   wire:model.lazy="selectedYearsExperience"
                                   min="0" 
                                   max="99"
                                   class="form-input"
                                   placeholder="Ej: 5">
                        </div>
                    @endif
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" wire:click="cancelRoleChange">
                        Cancelar
                    </button>
                    <button class="btn btn-primary" wire:click="changeUserRole" wire:loading.attr="disabled">
                        <span wire:loading.remove wire:target="changeUserRole">Confirmar Cambio</span>
                        <span wire:loading wire:target="changeUserRole">Procesando...</span>
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>
