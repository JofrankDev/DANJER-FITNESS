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
                    <h2>Crear Cuenta</h2>
                    <p>Únete a la comunidad DANJER FITNESS</p>
                </div>

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('register.post') }}" method="POST" class="auth-form">
                    @csrf

                    <div class="form-row">
                        <div class="form-group">
                            <label for="name">Nombre</label>
                            <input
                                type="text"
                                id="name"
                                name="name"
                                placeholder="Juan"
                                required
                                autofocus
                                value="{{ old('name') }}"
                            >
                            @error('name')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="lastname">Apellido</label>
                            <input
                                type="text"
                                id="lastname"
                                name="lastname"
                                placeholder="Pérez"
                                required
                                value="{{ old('lastname') }}"
                            >
                            @error('lastname')
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
                        <label for="phone">Teléfono (opcional)</label>
                        <input
                            type="tel"
                            id="phone"
                            name="phone"
                            placeholder="+1 234 567 890"
                            value="{{ old('phone') }}"
                        >
                        @error('phone')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="dni">DNI (opcional)</label>
                        <input
                            type="text"
                            id="dni"
                            name="dni"
                            placeholder="76543218"
                            value="{{ old('dni') }}"
                        >
                        @error('dni')
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
                            Acepto los <a href="#" class="auth-link" id="termsLink">términos y condiciones</a>
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

    <!-- Modal de Términos y Condiciones -->
    <div id="termsModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Términos y Condiciones de Uso</h3>
                <button class="modal-close" id="closeModal">&times;</button>
            </div>
            <div class="modal-body">
                <p class="modal-intro">Última actualización: 5 de noviembre de 2025</p>

                <h4>1. Aceptación de los Términos</h4>
                <p>Al registrarse y utilizar los servicios de DANJER FITNESS, usted acepta estar legalmente vinculado por estos términos y condiciones. Si no está de acuerdo con alguna parte de estos términos, no podrá acceder a nuestros servicios.</p>

                <h4>2. Uso de las Instalaciones</h4>
                <p>Los miembros se comprometen a utilizar las instalaciones de manera responsable, respetando el equipo, las áreas comunes y a los demás usuarios. Cualquier daño causado por uso indebido será responsabilidad del usuario.</p>

                <h4>3. Membresías y Pagos</h4>
                <p>Las membresías son personales e intransferibles. Los pagos deben realizarse en las fechas establecidas. La falta de pago puede resultar en la suspensión temporal del servicio. No se realizarán reembolsos por períodos no utilizados, excepto en casos excepcionales evaluados individualmente.</p>

                <h4>4. Salud y Seguridad</h4>
                <p>Es responsabilidad del usuario informar sobre cualquier condición médica que pueda afectar su capacidad para realizar ejercicio físico. Se recomienda consultar con un médico antes de iniciar cualquier programa de entrenamiento. DANJER FITNESS no se hace responsable por lesiones resultantes del uso inadecuado del equipo o negligencia del usuario.</p>

                <h4>5. Conducta y Comportamiento</h4>
                <p>Se espera que todos los miembros mantengan un comportamiento respetuoso hacia el personal y otros usuarios. Está prohibido el acoso, discriminación o cualquier conducta que perturbe el ambiente del gimnasio. El incumplimiento puede resultar en la cancelación inmediata de la membresía sin derecho a reembolso.</p>

                <h4>6. Privacidad y Protección de Datos</h4>
                <p>La información personal proporcionada será tratada de acuerdo con nuestra política de privacidad. Nos comprometemos a proteger sus datos y no compartirlos con terceros sin su consentimiento expreso, excepto cuando sea requerido por ley.</p>

                <h4>7. Cancelación y Suspensión</h4>
                <p>Los usuarios pueden cancelar su membresía con un aviso previo de 30 días. DANJER FITNESS se reserva el derecho de suspender o cancelar membresías en caso de incumplimiento de estos términos o comportamiento inapropiado.</p>

                <h4>8. Modificaciones</h4>
                <p>DANJER FITNESS se reserva el derecho de modificar estos términos y condiciones en cualquier momento. Los cambios serán comunicados a través de nuestros canales oficiales y entrarán en vigor inmediatamente después de su publicación.</p>

                <h4>9. Contacto</h4>
                <p>Para cualquier consulta sobre estos términos y condiciones, puede contactarnos a través de nuestros canales de atención al cliente o en nuestras instalaciones.</p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" id="acceptTerms">Aceptar y Cerrar</button>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/auth.js') }}"></script>
</body>
</html>
