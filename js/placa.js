document.addEventListener('DOMContentLoaded', () => {
    console.log('placa.js cargado');

    loadPlacas();
    cargarCategorias();

    const btnNuevaPlaca = document.getElementById('btnNuevaPlaca');
    const modal = document.getElementById('placaModal');
    const closeModal = document.getElementById('closeModal');
    const placaForm = document.getElementById('placaForm');
    const modalTitle = document.getElementById('modalTitle');
    const inputImagen = document.getElementById('placasImagen');
    const previewImagen = document.getElementById('placasImagenPreview');

    btnNuevaPlaca.addEventListener('click', () => {
        modalTitle.textContent = 'Nueva Placa';
        placaForm.reset();
        document.getElementById('placaId').value = "";
        previewImagen.src = '';
        previewImagen.classList.add('d-none');
        document.getElementById('placasDisponible').checked = true;
        modal.classList.add('active');
    });

    closeModal.addEventListener('click', () => {
        modal.classList.remove('active');
    });

    inputImagen.addEventListener('change', () => {
        const archivo = inputImagen.files[0];
        if (!archivo) return;

        const lector = new FileReader();
        lector.onload = (e) => {
            previewImagen.src = e.target.result;
            previewImagen.classList.remove('d-none');
        };
        lector.readAsDataURL(archivo);
    });

    placaForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        const id = document.getElementById('placaId').value;
        const formData = new FormData(placaForm);

        const url = id ? `${BASE_URL}placa/apiUpdate/${id}` : `${BASE_URL}placa/apiStore`;
        const btnSave = document.getElementById('btnSave');
        const originalText = btnSave.textContent;
        btnSave.textContent = 'Guardando...';
        btnSave.disabled = true;

        try {
            const response = await fetch(url, {
                method: 'POST',
                body: formData,
            });

            const result = await response.json();

            if (result.success) {
                modal.classList.remove('active');
                Swal.fire('Éxito', result.message, 'success');
                loadPlacas();
            } else {
                Swal.fire('Error', result.message, 'error');
            }

        } catch (error) {
            Swal.fire('Error', 'Ocurrió un error en la solicitud', 'error');
        } finally {
            btnSave.textContent = originalText;
            btnSave.disabled = false;
        }

    });

});

function formatearPrecio(valor) {
    return '₡' + Number(valor).toLocaleString('es-CR');
}

function rutaImagen(nombreImagen) {
    return nombreImagen ? ROOT_URL + 'uploads/' + nombreImagen : '';
}

async function cargarCategorias() {
    try {
        const response = await fetch(`${BASE_URL}categoria/apiList`);
        const categorias = await response.json();
        const select = document.getElementById('placasCategoria');

        categorias.forEach((categoria) => {
            const option = document.createElement('option');
            option.value = categoria.id;
            option.textContent = categoria.nombre;
            select.appendChild(option);
        });
    } catch (error) {
        console.error('Error cargando categorías:', error);
    }
}

async function loadPlacas() {
    const loader = document.getElementById('tableLoader');
    const table = document.getElementById('placasTable');
    const tbody = document.getElementById('placasTBody');

    loader.classList.remove('d-none');
    table.classList.add('d-none');
    tbody.innerHTML = '';

    try {

        const response = await fetch(`${BASE_URL}placa/apiList`);
        const placas = await response.json();

        if (placas.length === 0) {
            tbody.innerHTML = '<tr><td colspan="6" class="text-center text-muted">No hay placas registradas</td></tr>';
        } else {
            placas.forEach(placa => {

                const tr = document.createElement('tr');
                const imagen = rutaImagen(placa.imagen_nombre);

                tr.innerHTML = `
                    <td>${imagen ? `<img src="${imagen}" class="cdp-admin-thumb" alt="${placa.nombre}">` : '<span class="text-muted">Sin imagen</span>'}</td>
                    <td>${placa.nombre}</td>
                    <td>${formatearPrecio(placa.precio)}</td>
                    <td>${placa.disponible == 1 ? 'Sí' : 'No'}</td>
                    <td>${placa.destacado == 1 ? 'Sí' : 'No'}</td>
                    <td class="cdp-admin-actions">
                        <button class="btn btn-sm btn-outline-secondary" onclick="editPlaca(${placa.id})">Editar</button>
                        <button class="btn btn-sm btn-outline-danger" onclick="deletePlaca(${placa.id})">Eliminar</button>
                    </td>
                `;

                tbody.appendChild(tr);

            });
        }

    } catch (error) {
        Swal.fire('Error', 'No se lograron cargar las placas', 'error');

    } finally {
        loader.classList.add('d-none');
        table.classList.remove('d-none');
    }
}

async function editPlaca(id) {
    try {
        const response = await fetch(`${BASE_URL}placa/apiShow/${id}`);
        const result = await response.json();

        if (result.success) {
            const placa = result.data;
            document.getElementById('placaId').value = placa.id;
            document.getElementById('placasNombre').value = placa.nombre;
            document.getElementById('placasDescripcion').value = placa.descripcion ?? '';
            document.getElementById('placasMaterial').value = placa.material ?? '';
            document.getElementById('placasTamano').value = placa.tamano ?? '';
            document.getElementById('placasPrecio').value = placa.precio;
            document.getElementById('placasCategoria').value = placa.categoria_id;
            document.getElementById('placasDisponible').checked = (placa.disponible == 1);
            document.getElementById('placasDestacado').checked = (placa.destacado == 1);

            const previewImagen = document.getElementById('placasImagenPreview');
            const imagen = rutaImagen(placa.imagen_nombre);

            if (imagen) {
                previewImagen.src = imagen;
                previewImagen.classList.remove('d-none');
            } else {
                previewImagen.classList.add('d-none');
            }

            document.getElementById('modalTitle').textContent = 'Editar Placa';
            document.getElementById('placaModal').classList.add('active');
        } else {
            Swal.fire('Error', result.message, 'error');
        }
    } catch (error) {
        Swal.fire('Error', 'No se pudo cargar la placa', 'error');
    }
}

function deletePlaca(id) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: "¡No podrás revertir esto!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#64748b',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then(async (result) => {
        if (result.isConfirmed) {
            try {
                const response = await fetch(`${BASE_URL}placa/apiDelete/${id}`, {
                    method: 'POST'
                });
                const resData = await response.json();

                if (resData.success) {
                    Swal.fire('¡Eliminado!', resData.message, 'success');
                    loadPlacas();
                } else {
                    Swal.fire('Error', resData.message, 'error');
                }
            } catch (error) {
                Swal.fire('Error', 'Ocurrió un error al eliminar la placa', 'error');
            }
        }
    });
}