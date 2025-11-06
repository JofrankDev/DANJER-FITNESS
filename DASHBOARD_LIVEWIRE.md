# Dashboard con Livewire - DANJER FITNESS

## Estructura del Proyecto

### Componentes Livewire Creados

1. **Sidebar** (`app/Http/Livewire/Dashboard/Sidebar.php`)
   - Maneja la navegación lateral
   - Controla el estado activo de cada sección
   - Emite eventos para cambiar entre secciones

2. **Stats** (`app/Http/Livewire/Dashboard/Stats.php`)
   - Muestra las estadísticas del usuario
   - Clases reservadas, completadas, del mes
   - Acciones rápidas para navegar a otras secciones

3. **ClassesList** (`app/Http/Livewire/Dashboard/ClassesList.php`)
   - Lista todas las clases disponibles
   - Filtros dinámicos por tipo de clase (Yoga, CrossFit, Spinning, etc.)
   - Función de reserva de clases
   - Loading states al reservar

4. **TrainersList** (`app/Http/Livewire/Dashboard/TrainersList.php`)
   - Muestra todos los entrenadores
   - Información de cada entrenador
   - Estadísticas de clases impartidas

5. **Plans** (`app/Http/Livewire/Dashboard/Plans.php`)
   - Muestra los planes de membresía disponibles
   - Permite cambiar de plan
   - Indica el plan actual del usuario

6. **Profile** (`app/Http/Livewire/Dashboard/Profile.php`)
   - Muestra información del perfil del usuario
   - Modo de edición con validación
   - Actualización de datos en tiempo real

### Layouts y Vistas

- **Dashboard Layout** (`resources/views/components/dashboard-layout.blade.php`)
  - Layout base que incluye sidebar y header
  - Integración con Livewire styles y scripts
  - Responsivo para móviles

- **Dashboard Index** (`resources/views/dashboard/index.blade.php`)
  - Vista principal que carga todos los componentes
  - Maneja la navegación entre secciones
  - Scripts para la comunicación con Livewire

### Assets

- **CSS**: 
  - `public/css/dashboard.css` - Estilos principales
  - `public/css/dashboard-livewire.css` - Estilos específicos para Livewire (loading states, alerts, etc.)

- **JavaScript**:
  - `public/js/dashboard-livewire.js` - Lógica de navegación y eventos de Livewire

## Características de Livewire Implementadas

1. **Navegación Reactiva**: Click en el sidebar actualiza dinámicamente el contenido sin recargar la página
2. **Filtros Dinámicos**: En la sección de clases, los filtros actualizan la lista instantáneamente
3. **Loading States**: Indicadores visuales cuando se ejecutan acciones (reservar clase, cambiar plan, etc.)
4. **Validación en Tiempo Real**: En el formulario de perfil
5. **Comunicación entre Componentes**: Eventos entre sidebar y secciones

## Uso

### Acceder al Dashboard
```
Route::get('/dashboard', function () {
    return view('dashboard.index');
})->name('dashboard')->middleware('auth');
```

### Crear Nuevo Componente Livewire
```bash
php artisan make:livewire dashboard/nombre-componente
```

### Usar un Componente en la Vista
```blade
<livewire:dashboard.nombre-componente />
```

## Próximos Pasos / Mejoras Pendientes

1. **Implementar Reservas Reales**:
   - Crear tabla `reservations` o `bookings`
   - Relacionar con `client_sessions`
   - Validar capacidad de la clase

2. **Mejorar Estadísticas**:
   - Conectar con datos reales de la BD
   - Mostrar gráficos de progreso
   - Historial de asistencia

3. **Sistema de Pagos**:
   - Integración con pasarela de pago
   - Cambio de plan con procesamiento de pago
   - Historial de pagos

4. **Notificaciones**:
   - Recordatorios de clases
   - Notificaciones de cambios de horario
   - Alertas de vencimiento de membresía

5. **Imágenes de Entrenadores**:
   - Sistema de upload de imágenes
   - Storage en el servidor
   - Avatares personalizados

## Comandos Útiles

```bash
# Limpiar caché de vistas
php artisan view:clear

# Limpiar caché de aplicación
php artisan cache:clear

# Publicar assets de Livewire
php artisan livewire:publish --assets

# Listar todos los componentes Livewire
php artisan livewire:list
```

## Debugging

Si los componentes no se actualizan:
1. Verificar que `@livewireStyles` y `@livewireScripts` estén en el layout
2. Limpiar caché: `php artisan view:clear`
3. Verificar la consola del navegador para errores JS
4. Verificar que los eventos se estén emitiendo correctamente

## Notas

- Todos los componentes están dentro del namespace `App\Http\Livewire\Dashboard`
- Las vistas están en `resources/views/livewire/dashboard/`
- El layout principal usa componentes de Blade (`<x-dashboard-layout>`)
- La comunicación entre componentes se hace mediante eventos (`$emit`, `$on`)
