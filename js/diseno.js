document.addEventListener('DOMContentLoaded', () => {

    const IVA = 0.13;

    const selectMaterial = document.getElementById('categorias');
    const selectTamano = document.getElementById('tamano');
    const inputImagen = document.getElementById('inputImagenPlaca');
    const imgPreview = document.getElementById('imgPreviewPlaca');
    const btnAgregarCarrito = document.getElementById('btnAgregarCarrito');

    const resumenMaterial = document.getElementById('resumenMaterial');
    const resumenTamano = document.getElementById('resumenTamano');
    const resumenSubtotal = document.getElementById('resumenSubtotal');
    const resumenImpuestos = document.getElementById('resumenImpuestos');
    const resumenTotal = document.getElementById('resumenTotal');
    const inputMensaje = document.getElementById('mensajePlaca');
    const previewMensaje = document.getElementById('previewMensaje');

    let materialesPorId = {};
    let tamanosPorId = {};

    function formatearPrecio(valor) {
        return '₡' + Math.round(valor).toLocaleString('es-CR');
    }

    async function cargarOpciones() {
        try {
            const [resMateriales, resTamanos] = await Promise.all([
                fetch(`${BASE_URL}material/apiList`),
                fetch(`${BASE_URL}tamano/apiList`),
            ]);

            const materiales = await resMateriales.json();
            const tamanos = await resTamanos.json();

            materiales.forEach((material) => {
                materialesPorId[material.id] = material;
                const option = document.createElement('option');
                option.value = material.id;
                option.textContent = `${material.nombre} - ${formatearPrecio(material.precio)}`;
                selectMaterial.appendChild(option);
            });

            tamanos.forEach((tamano) => {
                tamanosPorId[tamano.id] = tamano;
                const option = document.createElement('option');
                option.value = tamano.id;
                option.textContent = `${tamano.dimensiones} - ${formatearPrecio(tamano.precio_adicional)}`;
                selectTamano.appendChild(option);
            });

        } catch (error) {
            console.error('Error cargando materiales/tamaños:', error);
        }
    }

    function actualizarResumen() {
        const material = materialesPorId[selectMaterial.value];
        const tamano = tamanosPorId[selectTamano.value];

        resumenMaterial.textContent = material
            ? `${material.nombre} - ${formatearPrecio(material.precio)}`
            : 'Sin seleccionar';

        resumenTamano.textContent = tamano
            ? `${tamano.dimensiones} - ${formatearPrecio(tamano.precio_adicional)}`
            : 'Sin seleccionar';

        const subtotal = (material ? Number(material.precio) : 0) + (tamano ? Number(tamano.precio_adicional) : 0);
        const impuestos = subtotal * IVA;
        const total = subtotal + impuestos;

        resumenSubtotal.textContent = formatearPrecio(subtotal);
        resumenImpuestos.textContent = formatearPrecio(impuestos);
        resumenTotal.textContent = formatearPrecio(total);

        btnAgregarCarrito.disabled = !(material && tamano);
    }

    selectMaterial.addEventListener('change', actualizarResumen);
    selectTamano.addEventListener('change', actualizarResumen);


    inputImagen.addEventListener('change', () => {
        const archivo = inputImagen.files[0];
        if (!archivo) return;

        if (!archivo.type.startsWith('image/')) {
            Swal.fire('Archivo inválido', 'El archivo seleccionado no es una imagen.', 'error');
            inputImagen.value = '';
            return;
        }

        const lector = new FileReader();
        lector.onload = (evento) => {
            imgPreview.src = evento.target.result;
        };
        lector.readAsDataURL(archivo);
    });


    inputMensaje.addEventListener('input', () => {
        const texto = inputMensaje.value.trim();

        if (texto === '') {
            previewMensaje.textContent = 'Su mensaje aparecerá aquí.';
            previewMensaje.classList.add('cdp-disenar-placeholder');
        } else {
            previewMensaje.textContent = texto;
            previewMensaje.classList.remove('cdp-disenar-placeholder');
        }
    });

    cargarOpciones().then(actualizarResumen);

    btnAgregarCarrito.addEventListener('click', () => {
        const materialDisenar = materialesPorId[selectMaterial.value];
        const tamanoDisenar = tamanosPorId[selectTamano.value];
        const mensajeDisenar = inputMensaje.value.trim();
        const fotoDisenar = imgPreview.src;

        if (!materialDisenar || !tamanoDisenar || !mensajeDisenar || !fotoDisenar) {
            Swal.fire('Campos incompletos', 'Debe completar todos los campos antes de continuar.', 'warning');
            return;
        }

        const subtotal = Number(materialDisenar.precio) + Number(tamanoDisenar.precio_adicional);
        const impuestos = subtotal * IVA;
        const total = subtotal + impuestos;

        const placaPersonalizada = {
            cantidad: 1,
            precio: total,
            material_id: selectMaterial.value,
            tamano_id: selectTamano.value,
            mensaje: mensajeDisenar,
            imagenPreview: fotoDisenar
        };


        let carrito = JSON.parse(localStorage.getItem('carrito')) || [];
        console.log(placaPersonalizada)
        carrito.push(placaPersonalizada);
        localStorage.setItem('carrito', JSON.stringify(carrito));

        Swal.fire('¡Listo!', 'Tu placa personalizada fue añadida al carrito.', 'success');
    });


});