document.addEventListener('DOMContentLoaded', () => {
    console.log('tamano.js cargado');

    loadTamanos();

    const btnNuevoTamano = document.getElementById('btnNuevoTamano');
    const modal = document.getElementById('tamanoModal');
    const closeModal = document.getElementById('closeModal');
    const tamanoForm = document.getElementById('tamanoForm');
    const modalTitle = document.getElementById('modalTitle');

    btnNuevoTamano.addEventListener('click', () => {
        modalTitle.textContent = 'Nuevo Tamaño';
        tamanoForm.reset();
        document.getElementById('tamanoId').value = "";
        modal.classList.add('active');
    });

    closeModal.addEventListener('click', () => {
        modal.classList.remove('active');
    });

    tamanoForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        const id = document.getElementById('tamanoId').value;
        const dimensiones = document.getElementById('tamanosDimensiones').value;
        const precio_adicional = document.getElementById('tamanosPrecioAdicional').value;

        const data = { dimensiones, precio_adicional };

        const url = id ? `${BASE_URL}tamano/apiUpdate/${id}` : `${BASE_URL}tamano/apiStore`;
        const btnSave = document.getElementById('btnSave');
        const originalText = btnSave.textContent;
        btnSave.textContent = 'Guardando...';
        btnSave.disabled = true;

        try {
            const response = await fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            });

            const result = await response.json();

            if (result.success) {
                modal.classList.remove('active');
                Swal.fire('Éxito', result.message, 'success');
                loadTamanos();
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

async function loadTamanos() {
    const loader = document.getElementById('tableLoader');
    const table = document.getElementById('tamanosTable');
    const tbody = document.getElementById('tamanosTBody');

    loader.classList.remove('d-none');
    table.classList.add('d-none');
    tbody.innerHTML = '';

    try {

        const response = await fetch(`${BASE_URL}tamano/apiList`);
        const tamanos = await response.json();

        if (tamanos.length === 0) {
            tbody.innerHTML = '<tr><td colspan="4" class="text-center text-muted">No hay tamaños registrados</td></tr>';
        } else {
            tamanos.forEach(tamano => {

                const tr = document.createElement('tr');

                tr.innerHTML = `
                    <td>${tamano.id}</td>
                    <td>${tamano.dimensiones}</td>
                    <td>${formatearPrecio(tamano.precio_adicional)}</td>
                    <td class="cdp-admin-actions">
                        <button class="btn btn-sm btn-outline-secondary" onclick="editTamano(${tamano.id})">Editar</button>
                        <button class="btn btn-sm btn-outline-danger" onclick="deleteTamano(${tamano.id})">Eliminar</button>
                    </td>
                `;

                tbody.appendChild(tr);

            });
        }

    } catch (error) {
        Swal.fire('Error', 'No se lograron cargar los tamaños', 'error');

    } finally {
        loader.classList.add('d-none');
        table.classList.remove('d-none');
    }
}

async function editTamano(id) {
    try {
        const response = await fetch(`${BASE_URL}tamano/apiShow/${id}`);
        const result = await response.json();

        if (result.success) {
            const tamano = result.data;
            document.getElementById('tamanoId').value = tamano.id;
            document.getElementById('tamanosDimensiones').value = tamano.dimensiones;
            document.getElementById('tamanosPrecioAdicional').value = tamano.precio_adicional;

            document.getElementById('modalTitle').textContent = 'Editar Tamaño';
            document.getElementById('tamanoModal').classList.add('active');
        } else {
            Swal.fire('Error', result.message, 'error');
        }
    } catch (error) {
        Swal.fire('Error', 'No se pudo cargar el tamaño', 'error');
    }
}

function deleteTamano(id) {
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
                const response = await fetch(`${BASE_URL}tamano/apiDelete/${id}`, {
                    method: 'POST'
                });
                const resData = await response.json();

                if (resData.success) {
                    Swal.fire('¡Eliminado!', resData.message, 'success');
                    loadTamanos();
                } else {
                    Swal.fire('Error', resData.message, 'error');
                }
            } catch (error) {
                Swal.fire('Error', 'Ocurrió un error al eliminar el tamaño', 'error');
            }
        }
    });
}