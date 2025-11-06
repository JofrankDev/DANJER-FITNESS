<div>
    <div class="section-header">
        <h2>Clases Disponibles</h2>
        <p>Reserva tu clase y empieza a entrenar</p>
    </div>

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

    <div class="filters">
        <button wire:click="setFilter('todas')"
                class="filter-btn {{ $filter === 'todas' ? 'active' : '' }}">
            Todas
        </button>
        <button wire:click="setFilter('yoga')"
                class="filter-btn {{ $filter === 'yoga' ? 'active' : '' }}">
            Yoga
        </button>
        <button wire:click="setFilter('crossfit')"
                class="filter-btn {{ $filter === 'crossfit' ? 'active' : '' }}">
            CrossFit
        </button>
        <button wire:click="setFilter('spinning')"
                class="filter-btn {{ $filter === 'spinning' ? 'active' : '' }}">
            Spinning
        </button>
        <button wire:click="setFilter('pilates')"
                class="filter-btn {{ $filter === 'pilates' ? 'active' : '' }}">
            Pilates
        </button>
        <button wire:click="setFilter('zumba')"
                class="filter-btn {{ $filter === 'zumba' ? 'active' : '' }}">
            Zumba
        </button>
    </div>

    <div class="classes-grid">
        @forelse($classes as $class)
            <div class="class-card" data-type="{{ strtolower($class->classType->name) }}">
                <div class="class-header">
                    <span class="class-badge {{ strtolower($class->classType->name) }}">
                        {{ $class->classType->name }}
                    </span>
                    <span class="class-status available">Disponible</span>
                </div>
                <h3>{{ $class->name }}</h3>
                <p style="color: #666; font-size: 0.9rem; margin-top: 0.5rem;">{{ Str::limit($class->description, 80) }}</p>
                <div class="class-details">
                    <div class="detail-item">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10"></circle>
                            <polyline points="12 6 12 12 16 14"></polyline>
                        </svg>
                        <span>{{ $class->day_name }} {{ $class->start_datetime }} - {{ $class->end_time }}</span>
                    </div>
                    <div class="detail-item">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                        <span>{{ $class->trainer->user->name ?? 'N/A' }} {{ $class->trainer->user->lastname ?? '' }}</span>
                    </div>
                    <div class="detail-item">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                            <circle cx="12" cy="10" r="3"></circle>
                        </svg>
                        <span>{{ $class->room->name ?? 'N/A' }}</span>
                    </div>
                </div>
                @if(in_array($class->id, $userReservations))
                    <button wire:click="cancelReservation({{ $class->id }})"
                            class="btn-reserve btn-cancel-reservation"
                            wire:loading.attr="disabled"
                            wire:target="cancelReservation({{ $class->id }})">
                        <span wire:loading.remove wire:target="cancelReservation({{ $class->id }})">✓ Reservado - Cancelar</span>
                        <span wire:loading wire:target="cancelReservation({{ $class->id }})">Cancelando...</span>
                    </button>
                @else
                    <button wire:click="reserveClass({{ $class->id }})"
                            class="btn-reserve"
                            wire:loading.attr="disabled"
                            wire:target="reserveClass({{ $class->id }})">
                        <span wire:loading.remove wire:target="reserveClass({{ $class->id }})">Reservar Clase</span>
                        <span wire:loading wire:target="reserveClass({{ $class->id }})">Reservando...</span>
                    </button>
                @endif
            </div>
        @empty
            <div class="empty-state">
                <p>No hay clases disponibles con el filtro seleccionado.</p>
            </div>
        @endforelse
    </div>
</div>
