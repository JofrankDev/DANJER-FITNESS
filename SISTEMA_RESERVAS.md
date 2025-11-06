# Sistema de Reservas - DANJER FITNESS

## 📊 Estructura de Base de Datos

### Tabla: `client_sessions` (Tabla Pivot de Reservas)

```sql
- id (bigint)
- client_id (bigint) - FK a clients
- session_id (bigint) - FK a sessions
- status (enum) - Estado de la reserva
- attendance (boolean) - Asistencia real
- reserved_at (timestamp) - Cuándo se hizo la reserva
- cancelled_at (timestamp) - Cuándo se canceló
- created_at (timestamp)
- updated_at (timestamp)
```

### Estados de Reserva (`status`)

| Estado | Descripción |
|--------|-------------|
| `reserved` | **Reservado** - Cliente acabade reservar |
| `confirmed` | **Confirmado** - Cliente confirmó asistencia |
| `cancelled` | **Cancelado** - Cliente canceló la reserva |
| `completed` | **Completado** - Clase finalizada |

## 🔄 Flujo de Reserva

```
1. Usuario ve clase disponible
   ↓
2. Click en "Reservar Clase"
   ↓
3. Sistema valida:
   ✓ Usuario tiene perfil de cliente
   ✓ No tiene reserva activa
   ✓ Hay cupos disponibles
   ↓
4. Se crea registro en client_sessions:
   - status = 'reserved'
   - attendance = false
   - reserved_at = now()
   ↓
5. Botón cambia a "✓ Reservado - Cancelar"
```

## 🎯 Funcionalidades Implementadas

### 1. Reservar Clase

**Método:** `reserveClass($sessionId)`

**Validaciones:**
- ✅ Verifica que el usuario tenga perfil de cliente
- ✅ Verifica que no tenga una reserva activa
- ✅ Verifica capacidad disponible de la clase
- ✅ Permite reactivar reservas canceladas

**Resultado:**
- Crea registro en `client_sessions` con status `reserved`
- Actualiza la vista mostrando "Reservado"
- Muestra mensaje de éxito

### 2. Cancelar Reserva

**Método:** `cancelReservation($sessionId)`

**Validaciones:**
- ✅ Verifica que el usuario tenga una reserva
- ✅ No permite cancelar clases ya completadas

**Resultado:**
- Actualiza status a `cancelled`
- Registra `cancelled_at`
- Libera el cupo para otros usuarios
- Botón vuelve a "Reservar Clase"

### 3. Verificación de Capacidad

```php
$currentReservations = $session->clients()
    ->wherePivotIn('status', ['reserved', 'confirmed'])
    ->count();

if ($currentReservations >= $session->capacity) {
    // Clase llena
}
```

Solo cuenta reservas activas (`reserved` o `confirmed`), no las canceladas.

### 4. Indicador Visual

- **Sin reserva:** Botón morado "Reservar Clase"
- **Con reserva:** Botón verde "✓ Reservado - Cancelar"
  - Hover: Se pone rojo para cancelar

## 🔧 Componentes y Archivos Modificados

### 1. Migración
```
database/migrations/2025_11_06_101547_add_status_to_client_sessions_table.php
```
- Agrega campos: `status`, `reserved_at`, `cancelled_at`

### 2. Modelos

**`app/Models/Client.php`**
```php
public function sessions() : BelongsToMany
{
    return $this->belongsToMany(Session::class, 'client_sessions')
        ->withPivot('status', 'attendance', 'reserved_at', 'cancelled_at')
        ->withTimestamps();
}
```

**`app/Models/Session.php`**
```php
public function clients() : BelongsToMany
{
    return $this->belongsToMany(Client::class, 'client_sessions')
        ->withPivot('status', 'attendance', 'reserved_at', 'cancelled_at')
        ->withTimestamps();
}
```

### 3. Componente Livewire

**`app/Http/Livewire/Dashboard/ClassesList.php`**

Propiedades:
```php
public $filter = 'todas';
public $classes = [];
public $userReservations = []; // IDs de sesiones reservadas
```

Métodos principales:
- `loadClasses()` - Carga clases disponibles
- `loadUserReservations()` - Carga reservas del usuario
- `reserveClass($sessionId)` - Crea reserva
- `cancelReservation($sessionId)` - Cancela reserva

### 4. Vista

**`resources/views/livewire/dashboard/classes-list.blade.php`**
- Muestra alertas de éxito/error
- Botones dinámicos según estado de reserva
- Loading states con Livewire

### 5. Estilos

**`public/css/dashboard-livewire.css`**
```css
.btn-cancel-reservation {
    background: #10b981 !important; /* Verde */
}

.btn-cancel-reservation:hover {
    background: #dc2626 !important; /* Rojo al hover */
}
```

## 📝 Uso

### Reservar una Clase

```blade
@if(in_array($class->id, $userReservations))
    <button wire:click="cancelReservation({{ $class->id }})">
        ✓ Reservado - Cancelar
    </button>
@else
    <button wire:click="reserveClass({{ $class->id }})">
        Reservar Clase
    </button>
@endif
```

### Verificar si Usuario Tiene Reserva

```php
$client = auth()->user()->client;

if ($client) {
    $hasReservation = $client->sessions()
        ->where('session_id', $sessionId)
        ->wherePivotIn('status', ['reserved', 'confirmed'])
        ->exists();
}
```

### Obtener Todas las Reservas Activas de un Usuario

```php
$reservations = auth()->user()->client->sessions()
    ->wherePivotIn('status', ['reserved', 'confirmed'])
    ->with(['classType', 'trainer.user', 'room'])
    ->get();
```

## 🚀 Próximas Mejoras

1. **Notificaciones:**
   - Email cuando se hace una reserva
   - Recordatorio 24h antes de la clase
   - Notificación si la clase se cancela

2. **Lista de Espera:**
   - Si la clase está llena, permitir unirse a lista de espera
   - Notificar automáticamente si se libera un cupo

3. **Políticas de Cancelación:**
   - No permitir cancelar X horas antes de la clase
   - Penalización por cancelaciones frecuentes

4. **Confirmación Automática:**
   - Enviar recordatorio para confirmar 48h antes
   - Si no confirma, liberar el cupo

5. **Dashboard de Mis Reservas:**
   - Sección separada para ver todas las reservas
   - Historial de clases asistidas
   - Estadísticas personales

6. **Validación de Membresía:**
   - Verificar que el plan del usuario permita reservar
   - Limite de clases según el plan

## 🐛 Resolución de Problemas

### Error: "No tienes un perfil de cliente asociado"
**Solución:** Asegúrate de que el usuario autenticado tenga un registro en la tabla `clients`:
```php
$user = User::find(1);
$user->client()->create([
    'address' => 'Dirección ejemplo',
    'emergency_phone' => '123456789',
]);
```

### Error: "Ya tienes una reserva para esta clase"
**Solución:** El usuario ya tiene una reserva activa. Debe cancelarla primero o verificar el estado en la BD.

### No se ven los campos nuevos en la BD
**Solución:** 
1. Verificar que la migración se haya ejecutado: `php artisan migrate:status`
2. Si no, ejecutar: `php artisan migrate`
3. Refrescar tu cliente de BD (phpMyAdmin, TablePlus, etc.)

## 📊 Consultas Útiles

### Ver todas las reservas activas
```sql
SELECT cs.*, u.name, u.lastname, s.name as session_name
FROM client_sessions cs
JOIN clients c ON cs.client_id = c.id
JOIN users u ON c.user_id = u.id
JOIN sessions s ON cs.session_id = s.id
WHERE cs.status IN ('reserved', 'confirmed')
ORDER BY cs.created_at DESC;
```

### Ver capacidad de clases
```sql
SELECT 
    s.id,
    s.name,
    s.capacity,
    COUNT(cs.id) as reservas,
    (s.capacity - COUNT(cs.id)) as disponibles
FROM sessions s
LEFT JOIN client_sessions cs ON s.id = cs.session_id 
    AND cs.status IN ('reserved', 'confirmed')
WHERE s.status = 'scheduled'
GROUP BY s.id
ORDER BY s.date, s.start_datetime;
```

---

✅ **Sistema de reservas completamente funcional y listo para usar!**
