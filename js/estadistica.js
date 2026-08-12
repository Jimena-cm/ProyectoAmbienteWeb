document.addEventListener('DOMContentLoaded', () => {
    console.log('estadistica.js cargado');

    loadEstadisticas();

    const btnNuevaEstadistica = document.getElementById('btnNuevaEstadistica');
    const modal = document.getElementById('estadisticaModal');
    const closeModal = document.getElementById('closeModal');
    const estadisticaForm = document.getElementById('estadisticaForm');
    const modalTitle = document.getElementById('modalTitle');

    btnNuevaEstadistica.addEventListener('click', () => {
        modalTitle.textContent = 'Nueva Estadística';
        estadisticaForm.reset();
        document.getElementById('estadisticaId').value = "";
        modal.classList.add('active');
    });

    closeModal.addEventListener('click', () => {
        modal.classList.remove('active');
    });

    estadisticaForm.addEventListener('submit', async (e) => {
        e.preventDefault();

        const id = document.getElementById('estadisticaId').value;
        const description = document.getElementById('estadisticaDescripcion').value;
        const value = document.getElementById('estadisticaValor').value;

        const data = {
            description,
            value
        };

        const url = id
            ? `${BASE_URL}estadistica/apiUpdate/${id}`
            : `${BASE_URL}estadistica/apiStore`;

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

                loadEstadisticas();

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


async function loadEstadisticas() {

    const loader = document.getElementById('tableLoader');
    const table = document.getElementById('estadisticasTable');
    const tbody = document.getElementById('estadisticasTBody');

    loader.classList.remove('d-none');
    table.classList.add('d-none');
    tbody.innerHTML = '';

    try {

        const response = await fetch(
            `${BASE_URL}estadistica/apiList`
        );

        const estadisticas = await response.json();

        if (estadisticas.length === 0) {

            tbody.innerHTML =
                '<tr><td colspan="4" class="text-center text-muted">No hay estadísticas registradas</td></tr>';

        } else {

            estadisticas.forEach(estadistica => {

                const tr = document.createElement('tr');

                tr.innerHTML = `
                    <td>${estadistica.id}</td>
                    <td>${estadistica.description}</td>
                    <td>${estadistica.value}</td>

                    <td class="cdp-admin-actions">

                        <button
                            class="btn btn-sm btn-outline-secondary"
                            onclick="editEstadistica(${estadistica.id})">

                            Editar

                        </button>

                        <button
                            class="btn btn-sm btn-outline-danger"
                            onclick="deleteEstadistica(${estadistica.id})">

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
            'No se lograron cargar las estadísticas',
            'error'
        );

    } finally {

        loader.classList.add('d-none');
        table.classList.remove('d-none');
    }
}


async function editEstadistica(id) {

    try {

        const response = await fetch(
            `${BASE_URL}estadistica/apiShow/${id}`
        );

        const result = await response.json();

        if (result.success) {

            const estadistica = result.data;

            document.getElementById('estadisticaId').value =
                estadistica.id;

            document.getElementById('estadisticaDescripcion').value =
                estadistica.description;

            document.getElementById('estadisticaValor').value =
                estadistica.value;

            document.getElementById('modalTitle').textContent =
                'Editar Estadística';

            document.getElementById('estadisticaModal')
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
            'No se pudo cargar la estadística',
            'error'
        );
    }
}


function deleteEstadistica(id) {

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
                    `${BASE_URL}estadistica/apiDelete/${id}`,
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

                    loadEstadisticas();

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
                    'Ocurrió un error al eliminar la estadística',
                    'error'
                );
            }
        }
    });
}