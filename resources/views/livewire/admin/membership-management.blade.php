<div>
    <div class="membership-container">
        <!-- Panel Izquierdo: Lista de Clientes y Membresías -->
        <div class="membership-main">
            <div class="membership-header">
                <h2>Gestión de Membresías</h2>
            </div>

            <div class="membership-search">
                <div class="search-box">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="11" cy="11" r="8"></circle>
                        <path d="m21 21-4.35-4.35"></path>
                    </svg>
                    <input type="text"
                           placeholder="Buscar clientes..."
                           wire:model.debounce.300ms="searchTerm">
                </div>
            </div>

            <div wire:loading class="loading-spinner">
                Cargando clientes...
            </div>

            @if(!$clients || count($clients) == 0)
                <div class="empty-state">
                    <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                    <p>No se encontraron clientes</p>
                </div>
            @else
                <div class="clients-table-container">
                    <table class="clients-table">
                        <thead>
                            <tr>
                                <th>Cliente</th>
                                <th>Email</th>
                                <th>Plan Actual</th>
                                <th>Estado</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($clients as $user)
                                @php
                                    $client = $user->client;
                                    $membership = $this->getUserMembership($user->id);
                                @endphp
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
                                    <td>
                                        @if($membership)
                                            <span class="plan-badge">{{ $membership->plan->type }}</span>
                                            <p class="plan-price">$ {{ number_format($membership->plan->price, 2) }}</p>
                                        @else
                                            <span class="plan-badge plan-none">Sin Plan</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($membership)
                                            <span class="status-badge status-{{ $membership->status ? 'active' : 'inactive' }}">
                                                {{ $membership->status ? 'Activo' : 'Inactivo' }}
                                            </span>
                                        @else
                                            <span class="status-badge status-none">Sin Membresía</span>
                                        @endif
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-primary" 
                                                wire:click="confirmMembershipChange({{ $client->id }})">
                                            Editar
                                        </button>
                                        @if($membership)
                                            <button class="btn btn-sm btn-danger" 
                                                    wire:click="removeMembership({{ $client->id }})">
                                                Quitar
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

        <!-- Panel Derecho: Crear Nuevo Plan -->
        <div class="membership-sidebar">
            <div class="sidebar-card">
                <h3>Crear Nuevo Plan</h3>
                <p class="sidebar-subtitle">Agrega un nuevo plan de membresía</p>

                <button class="btn btn-primary btn-block mt-3" wire:click="openCreatePlanModal">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                    Nuevo Plan
                </button>

                <div class="plans-list mt-5">
                    <h4>Planes Disponibles</h4>
                    @if(count($plans) > 0)
                        <div class="plans-scroll">
                            @foreach($plans as $plan)
                                <div class="plan-item">
                                    <div class="plan-header">
                                        <h5>{{ $plan->type }}</h5>
                                        <span class="plan-price-badge">${{ number_format($plan->price, 2) }}</span>
                                    </div>
                                    <p class="plan-description">{{ $plan->description ?? 'Sin descripción' }}</p>
                                    <button class="btn btn-xs btn-danger mt-2" 
                                            wire:click="deletePlan({{ $plan->id }})"
                                            wire:confirm="¿Estás seguro de que deseas eliminar este plan?">
                                        Eliminar
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted">No hay planes disponibles</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Crear Plan -->
    @if($showCreatePlanModal)
        <div class="modal-overlay" wire:click.self="closeCreatePlanModal">
            <div class="modal-content" @click.stop>
                <div class="modal-header">
                    <h3>Crear Nuevo Plan</h3>
                    <button class="modal-close" wire:click="closeCreatePlanModal">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label for="planType">Nombre del Plan</label>
                        <input type="text" 
                               id="planType"
                               wire:model.lazy="newPlanType"
                               class="form-input"
                               placeholder="Ej: Plan Básico">
                    </div>

                    <div class="form-group">
                        <label for="planPrice">Precio</label>
                        <input type="number" 
                               id="planPrice"
                               wire:model.lazy="newPlanPrice"
                               step="0.01"
                               min="0"
                               class="form-input"
                               placeholder="Ej: 49.99">
                    </div>

                    <div class="form-group">
                        <label for="planDescription">Descripción</label>
                        <textarea id="planDescription"
                                  wire:model.lazy="newPlanDescription"
                                  class="form-input"
                                  rows="3"
                                  placeholder="Descripción del plan..."></textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" wire:click="closeCreatePlanModal">
                        Cancelar
                    </button>
                    <button class="btn btn-primary" wire:click="createPlan" wire:loading.attr="disabled">
                        <span wire:loading.remove>Crear Plan</span>
                        <span wire:loading>Creando...</span>
                    </button>
                </div>
            </div>
        </div>
    @endif

    <!-- Modal de Editar Membresía -->
    @if($confirmingMembershipChange)
        <div class="modal-overlay" wire:click.self="cancelMembershipChange">
            <div class="modal-content" @click.stop>
                <div class="modal-header">
                    <h3>Editar Membresía</h3>
                    <button class="modal-close" wire:click="cancelMembershipChange">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label for="membershipPlan">Selecciona un Plan</label>
                        <select id="membershipPlan" 
                                wire:model.lazy="selectedPlanId"
                                class="form-input">
                            <option value="">-- Sin Membresía --</option>
                            @foreach($plans as $plan)
                                <option value="{{ $plan->id }}">
                                    {{ $plan->type }} - $ {{ number_format($plan->price, 2) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    @if($selectedPlanId)
                        <div class="form-group">
                            <label for="membershipStatus">Estado</label>
                            <select id="membershipStatus" 
                                    wire:model.lazy="membershipStatus"
                                    class="form-input">
                                <option value="active">Activo</option>
                                <option value="inactive">Inactivo</option>
                            </select>
                        </div>
                    @endif
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" wire:click="cancelMembershipChange">
                        Cancelar
                    </button>
                    <button class="btn btn-primary" wire:click="saveMembership" wire:loading.attr="disabled">
                        <span wire:loading.remove>Guardar Cambios</span>
                        <span wire:loading>Guardando...</span>
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>
