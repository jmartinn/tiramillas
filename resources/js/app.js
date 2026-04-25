// Tira Millas — interactividad del cliente

document.addEventListener('DOMContentLoaded', () => {
    activarVistaPreviaImagen();
    activarContadorCaracteres();
    activarValoracionEstrellas();
});

/**
 * Muestra una vista previa de la imagen al seleccionarla en cualquier
 * input de tipo file que acepte imágenes.
 */
function activarVistaPreviaImagen() {
    const inputs = document.querySelectorAll('input[type="file"][accept^="image"]');

    inputs.forEach((input) => {
        const preview = document.createElement('img');
        preview.className = 'image-preview';
        preview.style.display = 'none';
        input.insertAdjacentElement('afterend', preview);

        input.addEventListener('change', (event) => {
            const archivo = event.target.files?.[0];
            if (!archivo) {
                preview.style.display = 'none';
                preview.removeAttribute('src');
                return;
            }
            preview.src = URL.createObjectURL(archivo);
            preview.style.display = 'block';
        });
    });
}

/**
 * Añade un contador de caracteres bajo cada textarea con atributo maxlength.
 * Se actualiza en tiempo real al escribir.
 */
function activarContadorCaracteres() {
    const textareas = document.querySelectorAll('textarea[maxlength]');

    textareas.forEach((textarea) => {
        const max = parseInt(textarea.getAttribute('maxlength'), 10);
        const contador = document.createElement('p');
        contador.className = 'char-counter text-muted';
        textarea.insertAdjacentElement('afterend', contador);

        const actualizar = () => {
            const usados = textarea.value.length;
            contador.textContent = `${usados} / ${max} caracteres`;
        };

        textarea.addEventListener('input', actualizar);
        actualizar();
    });
}

/**
 * Sustituye el input numérico de puntuación por un widget de estrellas
 * en el formulario de reseña.
 */
function activarValoracionEstrellas() {
    const input = document.querySelector('#puntuacion');
    if (!input) return;

    const widget = document.createElement('div');
    widget.className = 'rating-widget';
    widget.setAttribute('role', 'radiogroup');
    widget.setAttribute('aria-label', 'Puntuación de 1 a 5 estrellas');

    const valorActual = parseInt(input.value, 10) || 0;

    const renderizar = (valor) => {
        widget.innerHTML = '';
        for (let i = 1; i <= 5; i++) {
            const boton = document.createElement('button');
            boton.type = 'button';
            boton.className = 'rating-star' + (i <= valor ? ' is-active' : '');
            boton.textContent = i <= valor ? '★' : '☆';
            boton.setAttribute('aria-label', `${i} ${i === 1 ? 'estrella' : 'estrellas'}`);
            boton.addEventListener('click', () => {
                input.value = i;
                renderizar(i);
            });
            widget.appendChild(boton);
        }
    };

    renderizar(valorActual);

    // Ocultar el input numérico, mantenerlo accesible para el envío del formulario.
    input.type = 'hidden';
    input.insertAdjacentElement('beforebegin', widget);
}

