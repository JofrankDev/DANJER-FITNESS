<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse - DANJER FITNESS</title>
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;900&display=swap" rel="stylesheet">
</head>
<body>
    <div class="auth-container">
        <div class="auth-left">
            <div class="auth-brand">
                <img src="{{ asset('images/logoDanjer.png') }}" alt="DANJER FITNESS">
                <h1>DANJER <span>FITNESS</span></h1>
                <p>Transforma tu cuerpo, transforma tu vida</p>
            </div>
        </div>
        
        <div class="auth-right">
            <div class="auth-form-container">
                <a href="{{ route('home') }}" class="back-link">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="15 18 9 12 15 6"></polyline>
                    </svg>
                    Volver al inicio
                </a>
                
                <div class="auth-header">
                    <h2>Crear Cuenta</h2>
                    <p>Únete a la comunidad DANJER FITNESS</p>
                </div>

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="#" method="POST" class="auth-form">
                    @csrf
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="first_name">Nombre</label>
                            <input 
                                type="text" 
                                id="first_name" 
                                name="first_name" 
                                placeholder="Juan" 
                                required 
                                autofocus
                                value="{{ old('first_name') }}"
                            >
                            @error('first_name')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="last_name">Apellido</label>
                            <input 
                                type="text" 
                                id="last_name" 
                                name="last_name" 
                                placeholder="Pérez" 
                                required
                                value="{{ old('last_name') }}"
                            >
                            @error('last_name')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email">Correo electrónico</label>
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            placeholder="tu@email.com" 
                            required
                            value="{{ old('email') }}"
                        >
                        @error('email')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="phone">Teléfono</label>
                        <input 
                            type="tel" 
                            id="phone" 
                            name="phone" 
                            placeholder="+1 234 567 890" 
                            required
                            value="{{ old('phone') }}"
                        >
                        @error('phone')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <div class="password-input">
                            <input 
                                type="password" 
                                id="password" 
                                name="password" 
                                placeholder="••••••••" 
                                required
                            >
                            <button type="button" class="toggle-password" onclick="togglePassword('password')">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                            </button>
                        </div>
                        <small class="form-hint">Mínimo 8 caracteres</small>
                        @error('password')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Confirmar contraseña</label>
                        <div class="password-input">
                            <input 
                                type="password" 
                                id="password_confirmation" 
                                name="password_confirmation" 
                                placeholder="••••••••" 
                                required
                            >
                            <button type="button" class="toggle-password" onclick="togglePassword('password_confirmation')">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                            </button>
                        </div>
                        @error('password_confirmation')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="checkbox-container">
                            <input type="checkbox" name="terms" id="terms" required>
                            <span class="checkmark"></span>
                            Acepto los <a href="#" class="auth-link">términos y condiciones</a>
                        </label>
                    </div>

                    <button type="submit" class="btn btn-primary btn-full">
                        Crear Cuenta
                    </button>

                    <p class="auth-footer">
                        ¿Ya tienes una cuenta? 
                        <a href="{{ route('login') }}" class="auth-link">Inicia sesión aquí</a>
                    </p>
                </form>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/auth.js') }}"></script>
</body>
</html>
