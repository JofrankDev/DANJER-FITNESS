# Rutas de Autenticación - DANJER FITNESS

## 📋 Rutas Web (Formularios HTML)

### Rutas Públicas (Guest)

#### Mostrar Formulario de Login
- **Método:** GET
- **Ruta:** `/login`
- **Nombre:** `login`
- **Controlador:** `LoginController@showLoginForm`
- **Descripción:** Muestra el formulario de inicio de sesión

#### Procesar Login
- **Método:** POST
- **Ruta:** `/login`
- **Nombre:** `login.post`
- **Controlador:** `LoginController@login`
- **Parámetros:**
  - `email` (requerido, email)
  - `password` (requerido)
  - `remember` (opcional, boolean)
- **Redirección:** `/dashboard` (éxito) o back (error)

#### Mostrar Formulario de Registro
- **Método:** GET
- **Ruta:** `/register`
- **Nombre:** `register`
- **Controlador:** `RegisterController@showRegistrationForm`
- **Descripción:** Muestra el formulario de registro

#### Procesar Registro
- **Método:** POST
- **Ruta:** `/register`
- **Nombre:** `register.post`
- **Controlador:** `RegisterController@register`
- **Parámetros:**
  - `name` (requerido, string, max:255)
  - `email` (requerido, email, único)
  - `password` (requerido, min:8, confirmado)
  - `password_confirmation` (requerido)
- **Redirección:** `/dashboard` (éxito) o back (error)

### Rutas Protegidas (Auth)

#### Dashboard
- **Método:** GET
- **Ruta:** `/dashboard`
- **Nombre:** `dashboard`
- **Middleware:** `auth`
- **Descripción:** Panel de usuario autenticado

#### Cerrar Sesión
- **Método:** POST
- **Ruta:** `/logout`
- **Nombre:** `logout`
- **Controlador:** `LoginController@logout`
- **Middleware:** `auth`
- **Redirección:** `/` (home)

---

## 🔌 Rutas API (JSON)

### Rutas Públicas

#### API - Registro
- **Método:** POST
- **Ruta:** `/api/register`
- **Controlador:** `RegisterController@register`
- **Content-Type:** `application/json`
- **Body:**
```json
{
    "name": "Juan Pérez",
    "email": "juan@example.com",
    "password": "password123",
    "password_confirmation": "password123"
}
```
- **Respuesta Éxito (201):**
```json
{
    "success": true,
    "message": "Usuario registrado exitosamente.",
    "data": {
        "user": { ... }
    }
}
```

#### API - Login
- **Método:** POST
- **Ruta:** `/api/login`
- **Controlador:** `LoginController@login`
- **Content-Type:** `application/json`
- **Body:**
```json
{
    "email": "juan@example.com",
    "password": "password123",
    "remember": false
}
```
- **Respuesta Éxito (200):**
```json
{
    "success": true,
    "message": "Inicio de sesión exitoso.",
    "data": {
        "user": { ... }
    }
}
```

### Rutas Protegidas (Middleware: auth:web)

#### API - Obtener Usuario
- **Método:** GET
- **Ruta:** `/api/user`
- **Middleware:** `auth:web`
- **Respuesta Éxito (200):**
```json
{
    "success": true,
    "data": {
        "id": 1,
        "name": "Juan Pérez",
        "email": "juan@example.com",
        ...
    }
}
```

#### API - Logout
- **Método:** POST
- **Ruta:** `/api/logout`
- **Controlador:** `LoginController@logout`
- **Middleware:** `auth:web`
- **Respuesta Éxito (200):**
```json
{
    "success": true,
    "message": "Sesión cerrada exitosamente."
}
```

---

## 🎯 Ejemplos de Uso

### Desde un Formulario HTML (Blade)

```blade
<!-- Login Form -->
<form method="POST" action="{{ route('login.post') }}">
    @csrf
    <input type="email" name="email" required>
    <input type="password" name="password" required>
    <input type="checkbox" name="remember">
    <button type="submit">Iniciar Sesión</button>
</form>

<!-- Register Form -->
<form method="POST" action="{{ route('register.post') }}">
    @csrf
    <input type="text" name="name" required>
    <input type="email" name="email" required>
    <input type="password" name="password" required>
    <input type="password" name="password_confirmation" required>
    <button type="submit">Registrarse</button>
</form>

<!-- Logout Button -->
<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit">Cerrar Sesión</button>
</form>
```

### Desde JavaScript (API)

```javascript
// Registro
const registerResponse = await fetch('/api/register', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
    },
    credentials: 'include',
    body: JSON.stringify({
        name: 'Juan Pérez',
        email: 'juan@example.com',
        password: 'password123',
        password_confirmation: 'password123'
    })
});

// Login
const loginResponse = await fetch('/api/login', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
    },
    credentials: 'include',
    body: JSON.stringify({
        email: 'juan@example.com',
        password: 'password123',
        remember: false
    })
});

// Obtener Usuario
const userResponse = await fetch('/api/user', {
    credentials: 'include'
});

// Logout
const logoutResponse = await fetch('/api/logout', {
    method: 'POST',
    headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
    },
    credentials: 'include'
});
```

---

## 🛡️ Middleware

### Guest Middleware
Protege rutas para usuarios NO autenticados:
- `/login` (GET/POST)
- `/register` (GET/POST)

Si el usuario ya está autenticado, lo redirige al dashboard.

### Auth Middleware
Protege rutas para usuarios autenticados:
- `/dashboard` (GET)
- `/logout` (POST)

Si el usuario NO está autenticado, lo redirige al login.

---

## 📝 Validaciones

### Registro
- **name**: Requerido, string, máximo 255 caracteres
- **email**: Requerido, formato email válido, único en la tabla users
- **password**: Requerido, mínimo 8 caracteres, debe estar confirmado

### Login
- **email**: Requerido, formato email válido
- **password**: Requerido
- **remember**: Opcional, boolean

---

## ✅ Características

- ✅ **Dual Response**: Los controladores responden tanto a peticiones web (redirect) como API (JSON)
- ✅ **Validación en Español**: Todos los mensajes de error están en español
- ✅ **Session Management**: Regeneración de sesión automática por seguridad
- ✅ **Remember Me**: Soporte para mantener la sesión activa
- ✅ **CSRF Protection**: Protección contra ataques CSRF incluida
- ✅ **Auto Login**: El usuario se autentica automáticamente después del registro
- ✅ **Middleware**: Guest y Auth middleware para control de acceso

---

## 🔐 Seguridad

1. **Contraseñas Hasheadas**: Usando bcrypt
2. **CSRF Tokens**: Verificación en todas las peticiones POST
3. **Session Regeneration**: Al login/logout para prevenir session fixation
4. **Validación de Datos**: Todas las entradas son validadas
5. **Unique Email**: No permite duplicados en la base de datos

---

## 🚀 Comandos Útiles

```bash
# Ver todas las rutas
php artisan route:list

# Ver solo rutas de autenticación
php artisan route:list --name=login
php artisan route:list --name=register
php artisan route:list --name=logout

# Limpiar caché de rutas
php artisan route:clear

# Cachear rutas (producción)
php artisan route:cache
```
