document.addEventListener('DOMContentLoaded', () => {
    console.log('soporte.js loaded');

    loadSoporte();

    const btnNuevoSoporte = document.getElementById('btnNuevoSoporte');
    const modal = document.getElementById('soporteModal');
    const closeModal = document.getElementById('closeModal');
    const soporteForm = document.getElementById('soporteForm');
    const modalTitle = document.getElementById('modalTitle');

    btnNuevoSoporte.addEventListener('click', () => {
        modalTitle.textContent = 'Nueva Solicitud';

        soporteForm.reset();

        document.getElementById('soporteId').value = '';

        modal.classList.add('active');
    });

    closeModal.addEventListener('click', () => {
        modal.classList.remove('active');
    });


    soporteForm.addEventListener('submit', async (e) => {
        e.preventDefault();

        const id = document.getElementById('soporteId').value;
        const nombre_completo = document.getElementById('soporteNombre').value;
        const telefono = document.getElementById('soporteTelefono').value;
        const correo = document.getElementById('soporteCorreo').value;
        const mensaje_soporte = document.getElementById('soporteMensaje').value;

        const data = {
            nombre_completo,
            telefono,
            correo,
            mensaje_soporte
        };

        const url = id
            ? `${BASE_URL}soporte/apiUpdate/${id}`
            : `${BASE_URL}soporte/apiStore`;

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

            if(result.success){

                modal.classList.remove('active');

                Swal.fire(
                    'Éxito',
                    result.message,
                    'success'
                );

                loadSoporte();

            }else{

                Swal.fire(
                    'Error',
                    result.message,
                    'error'
                );

            }

        }catch(error){

            Swal.fire(
                'Error',
                'Ocurrió un error en la solicitud',
                'error'
            );

        }finally{

            btnSave.textContent = originalText;
            btnSave.disabled = false;

        }
    });
});


async function loadSoporte() {

    const loader = document.getElementById('tableLoader');
    const table = document.getElementById('soporteTable');
    const tbody = document.getElementById('soporteTbody');

    loader.classList.remove('hidden');
    table.classList.add('hidden');

    tbody.innerHTML = '';

    try {

        const response = await fetch(`${BASE_URL}soporte/apiList`);
        const soportes = await response.json();

        if(soportes.length === 0){

            tbody.innerHTML = `
                <tr>
                    <td colspan="6" class="text-center text-muted">
                        No hay solicitudes de soporte registradas
                    </td>
                </tr>
            `;

        }else{

            soportes.forEach(soporte => {

                const tr = document.createElement('tr');

                tr.innerHTML = `
                    <td>${soporte.id}</td>
                    <td>${soporte.nombre_completo}</td>
                    <td>${soporte.telefono ?? ''}</td>
                    <td>${soporte.correo}</td>
                    <td>${soporte.mensaje_soporte ?? ''}</td>

                    <td class="actions">

                        <button
                            class="btn btn-info btn-sm"
                            onclick="editSoporte(${soporte.id})"
                        >
                            Editar
                        </button>

                        <button
                            class="btn btn-danger btn-sm"
                            onclick="deleteSoporte(${soporte.id})"
                        >
                            Eliminar
                        </button>

                    </td>
                `;

                tbody.appendChild(tr);

            });

        }

    }catch(error){

        Swal.fire(
            'Error',
            'No se lograron cargar las solicitudes de soporte',
            'error'
        );

    }finally{

        loader.classList.add('hidden');
        table.classList.remove('hidden');

    }
}


async function editSoporte(id) {

    try {

        const response = await fetch(`${BASE_URL}soporte/apiShow/${id}`);
        const result = await response.json();

        if(result.success){

            const soporte = result.data;

            document.getElementById('soporteId').value = soporte.id;
            document.getElementById('soporteNombre').value = soporte.nombre_completo;
            document.getElementById('soporteTelefono').value = soporte.telefono ?? '';
            document.getElementById('soporteCorreo').value = soporte.correo;
            document.getElementById('soporteMensaje').value = soporte.mensaje_soporte ?? '';

            document.getElementById('modalTitle').textContent = 'Editar Solicitud';

            document.getElementById('soporteModal').classList.add('active');

        }else{

            Swal.fire(
                'Error',
                result.message,
                'error'
            );

        }

    }catch(error){

        Swal.fire(
            'Error',
            'No se pudo cargar la solicitud de soporte',
            'error'
        );

    }
}


function deleteSoporte(id) {

    Swal.fire({
        title: '¿Estás seguro?',
        text: '¡No podrás revertir esto!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#64748b',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'

    }).then(async (result) => {

        if(result.isConfirmed){

            try {

                const response = await fetch(`${BASE_URL}soporte/apiDelete/${id}`, {
                    method: 'POST'
                });

                const resData = await response.json();

                if(resData.success){

                    Swal.fire(
                        '¡Eliminado!',
                        resData.message,
                        'success'
                    );

                    loadSoporte();

                }else{

                    Swal.fire(
                        'Error',
                        resData.message,
                        'error'
                    );

                }

            }catch(error){

                Swal.fire(
                    'Error',
                    'Ocurrió un error al eliminar',
                    'error'
                );

            }

        }

    });
}