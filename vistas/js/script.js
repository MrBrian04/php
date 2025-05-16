// ===================== VALIDACIONES =====================

// Expresiones regulares
const nombreRegex = /^[A-Za-zÁÉÍÓÚáéíóúÑñ]+(?: [A-Za-zÁÉÍÓÚáéíóúÑñ]+)*$/;
const telefonoRegex = /^\+?\d{7,15}$/; // más realista y estricta
const correoRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

// Inputs
const nombrePersona = document.getElementById('nombrePersona');
const telefonoPersona = document.getElementById('telefonoPersona');
const emailPersona = document.getElementById('emailPersona');

// Flags de reentrada
let reentrandoNombre = false;
let reentrandoTelefono = false;
let reentrandoCorreo = false;

// ====== Validación de NOMBRE ======
nombrePersona.addEventListener('blur', () => {
    if (reentrandoNombre) {
        reentrandoNombre = false;
        return;
    }

    const valor = nombrePersona.value.trim();
    if (valor === '') return; // 👈 Si está vacío, no validar

    if (!nombreRegex.test(valor)) {
        alert('Por favor, ingresa un nombre válido (solo letras y espacios).');
        reentrandoNombre = true;
        setTimeout(() => nombrePersona.focus(), 0);
    }
});

// ====== Validación de TELÉFONO ======
telefonoPersona.addEventListener('blur', () => {
    if (reentrandoTelefono) {
        reentrandoTelefono = false;
        return;
    }

    const valor = telefonoPersona.value.trim();
    if (valor === '') return;

    if (!telefonoRegex.test(valor)) {
        alert('Por favor, ingresa un número de teléfono válido (solo dígitos y opcional "+").');
        reentrandoTelefono = true;
        setTimeout(() => telefonoPersona.focus(), 0);
    }
});

// ====== Validación de CORREO ======
emailPersona.addEventListener('blur', () => {
    if (reentrandoCorreo) {
        reentrandoCorreo = false;
        return;
    }

    const valor = emailPersona.value.trim();
    if (valor === '') return;

    if (!correoRegex.test(valor)) {
        alert('Por favor, ingresa un correo electrónico válido.');
        reentrandoCorreo = true;
        setTimeout(() => emailPersona.focus(), 0);
    }
});
