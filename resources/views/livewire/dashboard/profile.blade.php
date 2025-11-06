<div>
    <div class="section-header">
        <h2>Mi Perfil</h2>
        <p>Gestiona tu información personal</p>
    </div>

    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <div class="profile-content">
        <div class="profile-card">
            <div class="profile-avatar-large">
                <span>{{ substr(Auth::user()->name, 0, 1) }}{{ substr(Auth::user()->lastname, 0, 1) }}</span>
            </div>
            <h3>{{ Auth::user()->name }} {{ Auth::user()->lastname }}</h3>
            <span class="profile-email">{{ Auth::user()->email }}</span>
            <span class="profile-member-since">Miembro desde {{ Auth::user()->created_at->format('F Y') }}</span>
        </div>

        <div class="profile-form">
            <h3>Información Personal</h3>
            <form wire:submit.prevent="updateProfile">
                <div class="form-row">
                    <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" wire:model.defer="name" {{ $editMode ? '' : 'readonly' }}>
                        @error('name') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label>Apellido</label>
                        <input type="text" wire:model.defer="lastname" {{ $editMode ? '' : 'readonly' }}>
                        @error('lastname') <span class="error">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" wire:model.defer="email" {{ $editMode ? '' : 'readonly' }}>
                    @error('email') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label>Teléfono</label>
                    <input type="tel" wire:model.defer="phone" {{ $editMode ? '' : 'readonly' }}>
                    @error('phone') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label>DNI</label>
                    <input type="text" wire:model.defer="dni" {{ $editMode ? '' : 'readonly' }}>
                    @error('dni') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div class="form-actions">
                    @if($editMode)
                        <button type="submit" class="btn-edit" wire:loading.attr="disabled">
                            <span wire:loading.remove>Guardar Cambios</span>
                            <span wire:loading>Guardando...</span>
                        </button>
                        <button type="button" wire:click="toggleEdit" class="btn-cancel">Cancelar</button>
                    @else
                        <button type="button" wire:click="toggleEdit" class="btn-edit">Editar Perfil</button>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>
