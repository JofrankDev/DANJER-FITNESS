<div>
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-error">
            {{ session('error') }}
        </div>
    @endif

    @if($view === 'types')
        {{-- Vista de Tipos de Clases --}}
        <div class="section-header">
            <h2>Tipos de Clases</h2>
            <p>Selecciona el tipo de clase que te interesa</p>
        </div>

        <div class="class-types-grid">
            @forelse($classTypes as $classType)
                <div class="class-type-card" wire:click="selectClassType({{ $classType->id }})">
                    <div class="class-type-icon">
                        @if($classType->name === 'Aeróbicos')
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M22 12h-4l-3 9L9 3l-3 9H2"></path>
                            </svg>
                        @elseif($classType->name === 'Fitness de Combate')
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M12 2L2 7l10 5 10-5-10-5z"></path>
                                <path d="M2 17l10 5 10-5"></path>
                                <path d="M2 12l10 5 10-5"></path>
                            </svg>
                        @elseif($classType->name === 'HIIT')
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline>
                            </svg>
                        @elseif($classType->name === 'Funcional')
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10"></circle>
                                <line x1="12" y1="8" x2="12" y2="12"></line>
                                <line x1="12" y1="16" x2="12.01" y2="16"></line>
                            </svg>
                        @elseif($classType->name === 'Musculación')
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M6.5 6.5h11"></path>
                                <path d="M6.5 17.5h11"></path>
                                <path d="M6.5 12h11"></path>
                                <path d="M3 6.5h1"></path>
                                <path d="M3 17.5h1"></path>
                                <path d="M20 6.5h1"></path>
                                <path d="M20 17.5h1"></path>
                            </svg>
                        @endif
                    </div>
                    <h3>{{ $classType->name }}</h3>
                    <p>{{ Str::limit($classType->description, 100) }}</p>
                    <div class="class-type-stats">
                        <span class="sessions-count">{{ $classType->sessions_count }} sesiones disponibles</span>
                    </div>
                    <button class="btn-select-type">Ver Horarios →</button>
                </div>
            @empty
                <div class="empty-state">
                    <p>No hay tipos de clases disponibles</p>
                </div>
            @endforelse
        </div>

    @elseif($view === 'sessions')
        {{-- Vista de Sesiones del Tipo Seleccionado --}}
        <div class="section-header">
            <button class="btn-back" wire:click="backToTypes">
                ← Volver a Tipos de Clases
            </button>
            <div>
                <h2>{{ $selectedClassType->name }}</h2>
                <p>{{ $selectedClassType->description }}</p>
            </div>
        </div>

        <div class="classes-grid">
            @forelse($sessions as $session)
                <div class="class-card">
                    <div class="class-header">
                        <span class="class-badge {{ strtolower($selectedClassType->name) }}">
                            {{ $selectedClassType->name }}
                        </span>
                        <span class="class-date">{{ $session->date->format('d/m/Y') }}</span>
                    </div>
                    <h3>{{ $session->name }}</h3>
                    <p style="color: #666; font-size: 0.9rem; margin-top: 0.5rem;">{{ Str::limit($session->description, 80) }}</p>
                    <div class="class-details">
                        <div class="detail-item">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10"></circle>
                                <polyline points="12 6 12 12 16 14"></polyline>
                            </svg>
                            <span>{{ $session->day_name }} {{ $session->start_datetime->format('H:i') }} - {{ $session->end_time }}</span>
                        </div>
                        <div class="detail-item">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                            <span>{{ $session->trainer->user->name ?? 'N/A' }} {{ $session->trainer->user->lastname ?? '' }}</span>
                        </div>
                        <div class="detail-item">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                <circle cx="12" cy="10" r="3"></circle>
                            </svg>
                            <span>{{ $session->room->name ?? 'N/A' }}</span>
                        </div>
                        <div class="detail-item">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                            </svg>
                            <span>{{ $session->clients->where('pivot.status', '!=', 'cancelled')->count() }} / {{ $session->capacity }}</span>
                        </div>
                    </div>

                    @if(in_array($session->id, $userReservations))
                        <button class="btn-cancel-reservation" wire:click="cancelReservation({{ $session->id }})"
                            wire:loading.attr="disabled">
                            <span wire:loading.remove wire:target="cancelReservation({{ $session->id }})">
                                ✓ Reservado - Cancelar
                            </span>
                            <span wire:loading wire:target="cancelReservation({{ $session->id }})">
                                Cancelando...
                            </span>
                        </button>
                    @else
                        <button class="btn-reserve" wire:click="reserveClass({{ $session->id }})"
                            wire:loading.attr="disabled">
                            <span wire:loading.remove wire:target="reserveClass({{ $session->id }})">
                                Reservar Clase
                            </span>
                            <span wire:loading wire:target="reserveClass({{ $session->id }})">
                                Reservando...
                            </span>
                        </button>
                    @endif
                </div>
            @empty
                <div class="empty-state">
                    <p>No hay sesiones disponibles para este tipo de clase</p>
                </div>
            @endforelse
        </div>
    @endif
</div>
