document.addEventListener('DOMContentLoaded', () => {
    console.log('material.js cargado');

    loadMateriales();

    const btnNuevoMaterial = document.getElementById('btnNuevoMaterial');
    const modal = document.getElementById('materialModal');
    const closeModal = document.getElementById('closeModal');
    const materialForm = document.getElementById('materialForm');
    const modalTitle = document.getElementById('modalTitle');

    btnNuevoMaterial.addEventListener('click', () => {
        modalTitle.textContent = 'Nuevo Material';
        materialForm.reset();
        document.getElementById('materialId').value = "";
        modal.classList.add('active');
    });

    closeModal.addEventListener('click', () => {
        modal.classList.remove('active');
    });

    materialForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        const id = document.getElementById('materialId').value;
        const nombre = document.getElementById('materialesNombre').value;
        const precio = document.getElementById('materialesPrecio').value;

        const data = { nombre, precio };

        const url = id ? `${BASE_URL}material/apiUpdate/${id}` : `${BASE_URL}material/apiStore`;
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
                loadMateriales();
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

async function loadMateriales() {
    const loader = document.getElementById('tableLoader');
    const table = document.getElementById('materialesTable');
    const tbody = document.getElementById('materialesTBody');

    loader.classList.remove('d-none');
    table.classList.add('d-none');
    tbody.innerHTML = '';

    try {

        const response = await fetch(`${BASE_URL}material/apiList`);
        const materiales = await response.json();

        if (materiales.length === 0) {
            tbody.innerHTML = '<tr><td colspan="4" class="text-center text-muted">No hay materiales registrados</td></tr>';
        } else {
            materiales.forEach(material => {

                const tr = document.createElement('tr');

                tr.innerHTML = `
                    <td>${material.id}</td>
                    <td>${material.nombre}</td>
                    <td>${formatearPrecio(material.precio)}</td>
                    <td class="cdp-admin-actions">
                        <button class="btn btn-sm btn-outline-secondary" onclick="editMaterial(${material.id})">Editar</button>
                        <button class="btn btn-sm btn-outline-danger" onclick="deleteMaterial(${material.id})">Eliminar</button>
                    </td>
                `;

                tbody.appendChild(tr);

            });
        }

    } catch (error) {
        Swal.fire('Error', 'No se lograron cargar los materiales', 'error');

    } finally {
        loader.classList.add('d-none');
        table.classList.remove('d-none');
    }
}

async function editMaterial(id) {
    try {
        const response = await fetch(`${BASE_URL}material/apiShow/${id}`);
        const result = await response.json();

        if (result.success) {
            const material = result.data;
            document.getElementById('materialId').value = material.id;
            document.getElementById('materialesNombre').value = material.nombre;
            document.getElementById('materialesPrecio').value = material.precio;

            document.getElementById('modalTitle').textContent = 'Editar Material';
            document.getElementById('materialModal').classList.add('active');
        } else {
            Swal.fire('Error', result.message, 'error');
        }
    } catch (error) {
        Swal.fire('Error', 'No se pudo cargar el material', 'error');
    }
}

function deleteMaterial(id) {
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
                const response = await fetch(`${BASE_URL}material/apiDelete/${id}`, {
                    method: 'POST'
                });
                const resData = await response.json();

                if (resData.success) {
                    Swal.fire('¡Eliminado!', resData.message, 'success');
                    loadMateriales();
                } else {
                    Swal.fire('Error', resData.message, 'error');
                }
            } catch (error) {
                Swal.fire('Error', 'Ocurrió un error al eliminar el material', 'error');
            }
        }
    });
}