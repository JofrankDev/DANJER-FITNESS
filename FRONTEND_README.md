# DANJER FITNESS - Página Principal

## 📋 Descripción

Página principal moderna y responsive para el gimnasio DANJER FITNESS, desarrollada con Laravel y Blade. Permite a los usuarios ver información sobre clases, horarios, planes de membresía y realizar reservas.

## ✨ Características

### 🎨 Diseño
- **Diseño moderno y atractivo** con gradientes y animaciones
- **100% responsive** - se adapta a móviles, tablets y desktop
- **Animaciones suaves** al hacer scroll y en las interacciones
- **Paleta de colores vibrante** inspirada en fitness y energía

### 🏋️ Funcionalidades

#### Navegación
- Menú fijo con efecto al hacer scroll
- Menú hamburguesa en móviles
- Navegación suave entre secciones
- Resaltado automático de sección activa

#### Secciones Principales
1. **Hero Section** - Presentación impactante con call-to-action
2. **Características** - Destacados del gimnasio (4 características principales)
3. **Clases** - Galería de 6 tipos de clases disponibles
4. **Horarios** - Sistema de tabs para ver horarios por día
5. **Planes** - 3 opciones de membresía (Básico, Premium, Elite)
6. **Contacto** - Formulario de contacto e información

#### Sistema de Reservas
- Botones de reserva en cada clase
- Validación de usuario autenticado
- Notificaciones visuales
- Integración lista para API backend

#### Interactividad
- Notificaciones toast personalizadas
- Formulario de contacto funcional
- Suscripción a newsletter
- Botón "volver arriba"
- Efecto parallax en hero

## 📁 Estructura de Archivos

```
resources/
└── views/
    └── home.blade.php          # Vista principal

public/
├── css/
│   └── home.css                # Estilos personalizados
└── js/
    └── home.js                 # JavaScript interactivo
```

## 🎨 Secciones Detalladas

### Hero Section
- Imagen de fondo con overlay oscuro
- Título principal animado
- Subtítulo descriptivo
- 2 botones de call-to-action
- Indicador de scroll animado

### Características (Features)
- 4 tarjetas con íconos SVG
- Animación hover con elevación
- Íconos con gradientes de color
- Diseño en grid responsive

### Clases
- 6 tarjetas de clases diferentes:
  - Yoga
  - CrossFit
  - Spinning
  - Pilates
  - Zumba
  - Funcional
- Cada una con gradiente único
- Información de duración y nivel
- Botón de reserva

### Horarios
- Sistema de tabs para 6 días de la semana
- Tabla de horarios con:
  - Hora
  - Nombre de clase
  - Entrenador
  - Sala
  - Botón de reserva
- Datos dinámicos desde JavaScript

### Planes de Membresía
- 3 opciones de planes:
  - **Básico**: $29/mes
  - **Premium**: $49/mes (destacado)
  - **Elite**: $79/mes
- Lista de características incluidas
- Badge especial en plan más popular
- Efecto hover con elevación

### Contacto
- Formulario de contacto con validación
- Información de ubicación, teléfono y email
- Íconos SVG personalizados
- Diseño en 2 columnas (desktop)

### Footer
- 4 columnas de información:
  - Sobre DANJER FITNESS
  - Enlaces rápidos
  - Horarios de atención
  - Newsletter
- Redes sociales con íconos
- Copyright

## 🚀 Funcionalidades JavaScript

### Sistema de Reservas
```javascript
bookClass(className, time, day)
```
- Verifica autenticación
- Muestra notificaciones
- Preparado para integración con API

### Notificaciones
```javascript
showNotification(message, type)
```
- 4 tipos: success, error, warning, info
- Animaciones de entrada/salida
- Auto-cierre después de 3 segundos

### Navegación
- Scroll suave entre secciones
- Menú móvil con animación
- Resaltado de sección activa
- Navbar con efecto al hacer scroll

### Horarios Dinámicos
- Datos organizados por día
- Actualización automática al cambiar de tab
- Preparado para recibir datos del backend

## 🎨 Paleta de Colores

```css
--primary-color: #ff6b35      /* Naranja energético */
--secondary-color: #004e89    /* Azul profundo */
--dark-color: #1a1a2e         /* Negro azulado */
--light-color: #f5f5f5        /* Gris muy claro */
```

## 📱 Responsive Breakpoints

- **Desktop**: > 968px
- **Tablet**: 640px - 968px
- **Mobile**: < 640px

## 🔧 Integración con Laravel

### Vista Blade
La vista utiliza directivas Blade para:
- `{{ asset() }}` - Cargar recursos CSS/JS
- `@guest / @endguest` - Mostrar/ocultar según autenticación
- Preparado para variables dinámicas del controlador

### Próximos Pasos de Integración

1. **Autenticación**
```php
// En el controlador
public function index()
{
    return view('home', [
        'user' => auth()->user()
    ]);
}
```

2. **Datos de Clases**
```php
// Pasar clases desde el controlador
'classes' => ClassType::all()
```

3. **Horarios**
```php
// Pasar sesiones agrupadas por día
'schedule' => Session::getWeekSchedule()
```

4. **Planes**
```php
// Pasar planes de membresía
'plans' => Plan::all()
```

## 🌟 Características Técnicas

### CSS
- Variables CSS personalizadas
- Flexbox y CSS Grid
- Animaciones y transiciones suaves
- Box shadows y gradientes
- Media queries para responsive

### JavaScript
- Vanilla JavaScript (sin dependencias)
- Event listeners optimizados
- Intersection Observer para animaciones
- LocalStorage ready
- Preparado para fetch API

## 🔐 Seguridad

- Formularios preparados para CSRF token
- Validación de autenticación en reservas
- Inputs con validación HTML5
- XSS protection en notificaciones

## 🚀 Mejoras Futuras Sugeridas

1. **Backend Integration**
   - Conectar sistema de reservas a base de datos
   - Implementar autenticación completa
   - API REST para clases y horarios

2. **Características Adicionales**
   - Sistema de calificaciones para clases
   - Perfil de usuario con historial
   - Calendario personal de reservas
   - Notificaciones push

3. **Optimizaciones**
   - Lazy loading de imágenes
   - Service Worker para PWA
   - Optimización de recursos
   - Caché de datos

4. **UX Improvements**
   - Filtros para clases
   - Búsqueda de entrenadores
   - Chat en vivo
   - Testimonios de clientes

## 📝 Notas de Desarrollo

- Los archivos CSS y JS están separados en `public/`
- Las imágenes de fondo usan gradientes (reemplazar con imágenes reales)
- Los datos de horarios están mockeados en JavaScript
- Sistema de notificaciones listo para usar

## 🎯 Uso

1. Acceder a la ruta principal: `http://localhost/`
2. Navegar por las diferentes secciones
3. Probar las reservas (requiere autenticación)
4. Enviar formulario de contacto
5. Suscribirse al newsletter

---

**Desarrollado para DANJER FITNESS** 🏋️‍♀️
