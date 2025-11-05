<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - DANJER FITNESS</title>
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
<<<<<<< HEAD
=======

>>>>>>> 739cf40 (Modificiacion del login y register(funcionando))
        <div class="auth-right">
            <div class="auth-form-container">
                <a href="{{ route('home') }}" class="back-link">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="15 18 9 12 15 6"></polyline>
                    </svg>
                    Volver al inicio
                </a>
<<<<<<< HEAD
=======

>>>>>>> 739cf40 (Modificiacion del login y register(funcionando))
                <div class="auth-header">
                    <h2>Iniciar Sesión</h2>
                    <p>Bienvenido de nuevo a DANJER FITNESS</p>
                </div>

                @if(session('error'))
                    <div class="alert alert-error">
                        {{ session('error') }}
                    </div>
                @endif

                <form action="{{ route('login.post') }}" method="POST" class="auth-form">
                    @csrf

                    <div class="form-group">
                        <label for="email">Correo electrónico</label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            placeholder="tu@email.com"
                            required
                            autofocus
                            value="{{ old('email') }}"
                        >
                        @error('email')
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
                            <button type="button" class="toggle-password" onclick="togglePassword()">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                            </button>
                        </div>
                        @error('password')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-options">
                        <label class="checkbox-container">
                            <input type="checkbox" name="remember" id="remember" value="1">
                            <span class="checkmark"></span>
                            Recuérdame
                        </label>
                        <a href="#" class="forgot-password">¿Olvidaste tu contraseña?</a>
                    </div>

                    <button type="submit" class="btn btn-primary btn-full">
                        Iniciar Sesión
                    </button>

                    <p class="auth-footer">
                        ¿No tienes una cuenta?
                        <a href="{{ route('register') }}" class="auth-link">Regístrate aquí</a>
                    </p>
                </form>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/auth.js') }}"></script>
</body>
</html>
