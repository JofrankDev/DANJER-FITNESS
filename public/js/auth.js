/**
 * DANJER FITNESS - Auth JavaScript
 * Funcionalidad para páginas de autenticación
 */

// Toggle para mostrar/ocultar contraseña
function togglePassword(inputId = 'password') {
    const input = document.getElementById(inputId);
    const button = input.parentElement.querySelector('.toggle-password');
    
    if (input.type === 'password') {
        input.type = 'text';
        button.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path>
                <line x1="1" y1="1" x2="23" y2="23"></line>
            </svg>
        `;
    } else {
        input.type = 'password';
        button.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                <circle cx="12" cy="12" r="3"></circle>
            </svg>
        `;
    }
}

// Validación de formulario en tiempo real
document.addEventListener('DOMContentLoaded', function() {
    const forms = document.querySelectorAll('.auth-form');
    
    forms.forEach(form => {
        const inputs = form.querySelectorAll('input[required]');
        
        inputs.forEach(input => {
            // Validación al perder el foco
            input.addEventListener('blur', function() {
                validateInput(this);
            });
            
            // Limpiar error al escribir
            input.addEventListener('input', function() {
                if (this.classList.contains('error')) {
                    this.classList.remove('error');
                    const errorMsg = this.parentElement.querySelector('.error-message');
                    if (errorMsg) {
                        errorMsg.remove();
                    }
                }
            });
        });
        
        // Validación al enviar el formulario
        form.addEventListener('submit', function(e) {
            let isValid = true;
            
            inputs.forEach(input => {
                if (!validateInput(input)) {
                    isValid = false;
                }
            });
            
            // Validar que las contraseñas coincidan (si existe confirmación)
            const password = form.querySelector('#password');
            const passwordConfirmation = form.querySelector('#password_confirmation');
            
            if (password && passwordConfirmation) {
                if (password.value !== passwordConfirmation.value) {
                    showError(passwordConfirmation, 'Las contraseñas no coinciden');
                    isValid = false;
                }
            }
            
            if (!isValid) {
                e.preventDefault();
            }
        });
    });
});

// Función para validar un input individual
function validateInput(input) {
    const value = input.value.trim();
    const type = input.type;
    let isValid = true;
    let errorMessage = '';
    
    // Limpiar errores previos
    input.classList.remove('error');
    const existingError = input.parentElement.querySelector('.error-message');
    if (existingError) {
        existingError.remove();
    }
    
    // Validación según el tipo
    if (!value) {
        errorMessage = 'Este campo es requerido';
        isValid = false;
    } else if (type === 'email') {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(value)) {
            errorMessage = 'Ingresa un email válido';
            isValid = false;
        }
    } else if (type === 'password' && input.id === 'password') {
        if (value.length < 8) {
            errorMessage = 'La contraseña debe tener al menos 8 caracteres';
            isValid = false;
        }
    } else if (type === 'tel') {
        const phoneRegex = /^[+]?[\d\s-()]+$/;
        if (!phoneRegex.test(value)) {
            errorMessage = 'Ingresa un teléfono válido';
            isValid = false;
        }
    }
    
    if (!isValid) {
        showError(input, errorMessage);
    }
    
    return isValid;
}

// Función para mostrar errores
function showError(input, message) {
    input.classList.add('error');
    
    // Agregar border rojo al input
    input.style.borderColor = '#fc8181';
    
    // Crear mensaje de error si no existe
    const errorDiv = document.createElement('span');
    errorDiv.className = 'error-message';
    errorDiv.textContent = message;
    
    if (input.parentElement.classList.contains('password-input')) {
        input.parentElement.parentElement.appendChild(errorDiv);
    } else {
        input.parentElement.appendChild(errorDiv);
    }
}

// Animación de entrada para los formularios
window.addEventListener('load', function() {
    const authFormContainer = document.querySelector('.auth-form-container');
    const authBrand = document.querySelector('.auth-brand');
    
    if (authFormContainer) {
        authFormContainer.style.opacity = '0';
        authFormContainer.style.transform = 'translateY(20px)';
        
        setTimeout(() => {
            authFormContainer.style.transition = 'all 0.6s ease';
            authFormContainer.style.opacity = '1';
            authFormContainer.style.transform = 'translateY(0)';
        }, 100);
    }
    
    if (authBrand) {
        authBrand.style.opacity = '0';
        authBrand.style.transform = 'scale(0.95)';
        
        setTimeout(() => {
            authBrand.style.transition = 'all 0.6s ease';
            authBrand.style.opacity = '1';
            authBrand.style.transform = 'scale(1)';
        }, 200);
    }
});

// Prevenir el envío del formulario de Google (placeholder)
document.addEventListener('DOMContentLoaded', function() {
    const googleBtn = document.querySelector('.btn-google');
    
    if (googleBtn) {
        googleBtn.addEventListener('click', function(e) {
            e.preventDefault();
            alert('La autenticación con Google estará disponible próximamente.');
        });
    }
});
