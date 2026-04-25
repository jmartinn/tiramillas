// Tira Millas — interactividad del cliente

document.addEventListener('DOMContentLoaded', () => {
    activarVistaPreviaImagen();
    activarContadorCaracteres();
    activarValoracionEstrellas();
    activarMapaPrincipal();
    activarMapaSelector();
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

/**
 * Permite fijar coordenadas haciendo clic en un mapa pequeño embebido en
 * los formularios de creación/edición de rutas, puntos y negocios.
 */
function activarMapaSelector() {
    const contenedores = document.querySelectorAll('[data-mapa-selector]');
    if (!contenedores.length || typeof L === 'undefined') return;

    contenedores.forEach((contenedor) => {
        const latInput = document.querySelector(contenedor.dataset.latField);
        const lngInput = document.querySelector(contenedor.dataset.lngField);
        if (!latInput || !lngInput) return;

        const latInicial = parseFloat(latInput.value) || 40.0;
        const lngInicial = parseFloat(lngInput.value) || -3.5;
        const zoomInicial = latInput.value && lngInput.value ? 11 : 6;

        const mapa = L.map(contenedor).setView([latInicial, lngInicial], zoomInicial);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap',
        }).addTo(mapa);

        let marker = null;
        if (latInput.value && lngInput.value) {
            marker = L.marker([latInicial, lngInicial]).addTo(mapa);
        }

        mapa.on('click', (event) => {
            const { lat, lng } = event.latlng;
            latInput.value = lat.toFixed(7);
            lngInput.value = lng.toFixed(7);

            if (marker) {
                marker.setLatLng([lat, lng]);
            } else {
                marker = L.marker([lat, lng]).addTo(mapa);
            }
        });
    });
}

/**
 * Inicializa el mapa principal en /mapa con los marcadores de rutas,
 * puntos y negocios obtenidos del endpoint JSON.
 */
function activarMapaPrincipal() {
    const contenedor = document.querySelector('#mapa-principal');
    if (!contenedor || typeof L === 'undefined') return;

    const endpoint = contenedor.dataset.endpoint;
    if (!endpoint) return;

    const mapa = L.map(contenedor).setView([40.0, -3.5], 6);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap',
        maxZoom: 18,
    }).addTo(mapa);

    const colores = {
        ruta: '#2d5016',
        punto: '#c97b3e',
        negocio: '#3d6b3a',
    };

    fetch(endpoint, { headers: { Accept: 'application/json' } })
        .then((res) => res.json())
        .then((datos) => {
            const grupo = L.featureGroup();

            datos.forEach((item) => {
                const marker = L.circleMarker([item.lat, item.lng], {
                    radius: 8,
                    fillColor: colores[item.tipo] ?? '#6b6b6b',
                    color: '#ffffff',
                    weight: 2,
                    opacity: 1,
                    fillOpacity: 0.95,
                });

                marker.bindPopup(
                    `<strong>${item.titulo}</strong><br>` +
                        `<span class="popup-meta">${item.tipo} · ${item.categoria}</span><br>` +
                        `<a href="${item.url}">Ver detalle</a>`,
                );

                marker.addTo(grupo);
            });

            grupo.addTo(mapa);

            if (datos.length > 0) {
                mapa.fitBounds(grupo.getBounds(), { padding: [40, 40], maxZoom: 10 });
            }
        })
        .catch((error) => {
            console.error('No se pudieron cargar los datos del mapa', error);
        });
}

