document.addEventListener('DOMContentLoaded', () => {
    console.log('historialAdmin.js cargado');

    loadHistorial();

    const btnNuevoHistorial = document.getElementById('btnNuevoHistorial');
    const modal = document.getElementById('historialModal');
    const closeModal = document.getElementById('closeModal');
    const historialForm = document.getElementById('historialForm');
    const modalTitle = document.getElementById('modalTitle');

    btnNuevoHistorial.addEventListener('click', () => {
        modalTitle.textContent = 'Nuevo Historial';
        historialForm.reset();
        document.getElementById('historialId').value = "";
        modal.classList.add('active');
    });

    closeModal.addEventListener('click', () => {
        modal.classList.remove('active');
    });

    historialForm.addEventListener('submit', async (e) => {
        e.preventDefault();

        const id = document.getElementById('historialId').value;
        const user_id = document.getElementById('historialUsuario').value;
        const producto = document.getElementById('historialProducto').value;
        const fecha = document.getElementById('historialFecha').value;
        const estado = document.getElementById('historialEstado').value;

        const data = {
            user_id,
            producto,
            fecha,
            estado
        };

        const url = id
            ? `${BASE_URL}historial/apiUpdate/${id}`
            : `${BASE_URL}historial/apiStore`;

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

                Swal.fire(
                    'Éxito',
                    result.message,
                    'success'
                );

                loadHistorial();

            } else {

                Swal.fire(
                    'Error',
                    result.message,
                    'error'
                );
            }

        } catch (error) {

            Swal.fire(
                'Error',
                'Ocurrió un error en la solicitud',
                'error'
            );

        } finally {

            btnSave.textContent = originalText;
            btnSave.disabled = false;
        }

    });
});


async function loadHistorial() {

    const loader = document.getElementById('tableLoader');
    const table = document.getElementById('historialTable');
    const tbody = document.getElementById('historialTBody');

    loader.classList.remove('d-none');
    table.classList.add('d-none');
    tbody.innerHTML = '';

    try {

        const response = await fetch(
            `${BASE_URL}historial/apiList`
        );

        const historial = await response.json();

        if (historial.length === 0) {

            tbody.innerHTML =
                '<tr><td colspan="6" class="text-center text-muted">No hay registros en el historial</td></tr>';

        } else {

            historial.forEach(registro => {

                const tr = document.createElement('tr');

                tr.innerHTML = `
                    <td>${registro.id}</td>
                    <td>${registro.user_id}</td>
                    <td>${registro.producto}</td>
                    <td>${registro.fecha}</td>
                    <td>${registro.estado}</td>

                    <td class="cdp-admin-actions">

                        <button
                            class="btn btn-sm btn-outline-secondary"
                            onclick="editHistorial(${registro.id})">

                            Editar

                        </button>

                        <button
                            class="btn btn-sm btn-outline-danger"
                            onclick="deleteHistorial(${registro.id})">

                            Eliminar

                        </button>

                    </td>
                `;

                tbody.appendChild(tr);
            });
        }

    } catch (error) {

        Swal.fire(
            'Error',
            'No se logró cargar el historial',
            'error'
        );

    } finally {

        loader.classList.add('d-none');
        table.classList.remove('d-none');
    }
}


async function editHistorial(id) {

    try {

        const response = await fetch(
            `${BASE_URL}historial/apiShow/${id}`
        );

        const result = await response.json();

        if (result.success) {

            const historial = result.data;

            document.getElementById('historialId').value =
                historial.id;

            document.getElementById('historialUsuario').value =
                historial.user_id;

            document.getElementById('historialProducto').value =
                historial.producto;

            document.getElementById('historialFecha').value =
                historial.fecha;

            document.getElementById('historialEstado').value =
                historial.estado;

            document.getElementById('modalTitle').textContent =
                'Editar Historial';

            document.getElementById('historialModal')
                .classList.add('active');

        } else {

            Swal.fire(
                'Error',
                result.message,
                'error'
            );
        }

    } catch (error) {

        Swal.fire(
            'Error',
            'No se pudo cargar el historial',
            'error'
        );
    }
}


function deleteHistorial(id) {

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

                const response = await fetch(
                    `${BASE_URL}historial/apiDelete/${id}`,
                    {
                        method: 'POST'
                    }
                );

                const resData = await response.json();

                if (resData.success) {

                    Swal.fire(
                        '¡Eliminado!',
                        resData.message,
                        'success'
                    );

                    loadHistorial();

                } else {

                    Swal.fire(
                        'Error',
                        resData.message,
                        'error'
                    );
                }

            } catch (error) {

                Swal.fire(
                    'Error',
                    'Ocurrió un error al eliminar el historial',
                    'error'
                );
            }
        }
    });
}