document.addEventListener('DOMContentLoaded', () => {
    console.log('resena.js cargado');

    loadResenas();

    const btnNuevaResena = document.getElementById('btnNuevaResena');
    const modal = document.getElementById('resenaModal');
    const closeModal = document.getElementById('closeModal');
    const resenaForm = document.getElementById('resenaForm');
    const modalTitle = document.getElementById('modalTitle');

    btnNuevaResena.addEventListener('click', () => {
        modalTitle.textContent = 'Nueva Reseña';
        resenaForm.reset();
        document.getElementById('resenaId').value = "";
        modal.classList.add('active');
    });

    closeModal.addEventListener('click', () => {
        modal.classList.remove('active');
    });

    resenaForm.addEventListener('submit', async (e) => {
        e.preventDefault();

        const id = document.getElementById('resenaId').value;
        const user_id = document.getElementById('resenaUsuario').value;
        const nombre = document.getElementById('resenaNombre').value;
        const comentario = document.getElementById('resenaComentario').value;
        const calificacion = document.getElementById('resenaCalificacion').value;

        const data = {
            user_id,
            nombre,
            comentario,
            calificacion
        };

        const url = id
            ? `${BASE_URL}resena/apiUpdate/${id}`
            : `${BASE_URL}resena/apiStore`;

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

                loadResenas();

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


async function loadResenas() {

    const loader = document.getElementById('tableLoader');
    const table = document.getElementById('resenasTable');
    const tbody = document.getElementById('resenasTBody');

    loader.classList.remove('d-none');
    table.classList.add('d-none');
    tbody.innerHTML = '';

    try {

        const response = await fetch(
            `${BASE_URL}resena/apiList`
        );

        const resenas = await response.json();

        if (resenas.length === 0) {

            tbody.innerHTML =
                '<tr><td colspan="6" class="text-center text-muted">No hay reseñas registradas</td></tr>';

        } else {

            resenas.forEach(resena => {

                const tr = document.createElement('tr');

                tr.innerHTML = `
                    <td>${resena.id}</td>
                    <td>${resena.user_id}</td>
                    <td>${resena.nombre}</td>
                    <td>${resena.comentario}</td>
                    <td>${resena.calificacion}</td>

                    <td class="cdp-admin-actions">

                        <button
                            class="btn btn-sm btn-outline-secondary"
                            onclick="editResena(${resena.id})">

                            Editar

                        </button>

                        <button
                            class="btn btn-sm btn-outline-danger"
                            onclick="deleteResena(${resena.id})">

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
            'No se lograron cargar las reseñas',
            'error'
        );

    } finally {

        loader.classList.add('d-none');
        table.classList.remove('d-none');
    }
}


async function editResena(id) {

    try {

        const response = await fetch(
            `${BASE_URL}resena/apiShow/${id}`
        );

        const result = await response.json();

        if (result.success) {

            const resena = result.data;

            document.getElementById('resenaId').value =
                resena.id;

            document.getElementById('resenaUsuario').value =
                resena.user_id;

            document.getElementById('resenaNombre').value =
                resena.nombre;

            document.getElementById('resenaComentario').value =
                resena.comentario;

            document.getElementById('resenaCalificacion').value =
                resena.calificacion;

            document.getElementById('modalTitle').textContent =
                'Editar Reseña';

            document.getElementById('resenaModal')
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
            'No se pudo cargar la reseña',
            'error'
        );
    }
}


function deleteResena(id) {

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
                    `${BASE_URL}resena/apiDelete/${id}`,
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

                    loadResenas();

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
                    'Ocurrió un error al eliminar la reseña',
                    'error'
                );
            }
        }
    });
}