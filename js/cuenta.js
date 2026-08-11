document.addEventListener('DOMContentLoaded', () => {
    console.log('cuenta.js loaded');

    loadCuentas();

    const btnNuevaCuenta = document.getElementById('btnNuevaCuenta');
    const modal = document.getElementById('cuentaModal');
    const closeModal = document.getElementById('closeModal');
    const cuentaForm = document.getElementById('cuentaForm');
    const modalTitle = document.getElementById('modalTitle');

    btnNuevaCuenta.addEventListener('click', () => {
        modalTitle.textContent = 'Nueva Cuenta';

        cuentaForm.reset();

        document.getElementById('cuentaId').value = '';

        modal.classList.add('active');
    });

    closeModal.addEventListener('click', () => {
        modal.classList.remove('active');
    });


    cuentaForm.addEventListener('submit', async (e) => {
        e.preventDefault();

        const id = document.getElementById('cuentaId').value;
        const user_id = document.getElementById('cuentaUserId').value;
        const ubicacion = document.getElementById('cuentaUbicacion').value;
        const genero = document.getElementById('cuentaGenero').value;

        const data = {
            user_id,
            ubicacion,
            genero
        };

        const url = id
            ? `${BASE_URL}cuenta/apiUpdate/${id}`
            : `${BASE_URL}cuenta/apiStore`;

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

                loadCuentas();

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


async function loadCuentas() {

    const loader = document.getElementById('tableLoader');
    const table = document.getElementById('cuentaTable');
    const tbody = document.getElementById('cuentaTbody');

    loader.classList.remove('hidden');
    table.classList.add('hidden');
    tbody.innerHTML = '';

    try {

        const response = await fetch(`${BASE_URL}cuenta/apiList`);
        const cuentas = await response.json();

        if(cuentas.length === 0){

            tbody.innerHTML = `
                <tr>
                    <td colspan="6" class="text-center text-muted">
                        No hay cuentas registradas
                    </td>
                </tr>
            `;

        }else{

            cuentas.forEach(cuenta => {

                const tr = document.createElement('tr');

                tr.innerHTML = `
                    <td>${cuenta.id}</td>
                    <td>${cuenta.usuario}</td>
                    <td>${cuenta.email}</td>
                    <td>${cuenta.ubicacion ?? ''}</td>
                    <td>${cuenta.genero ?? ''}</td>

                    <td class="actions">

                        <button
                            class="btn btn-info btn-sm"
                            onclick="editCuenta(${cuenta.id})"
                        >
                            Editar
                        </button>

                        <button
                            class="btn btn-danger btn-sm"
                            onclick="deleteCuenta(${cuenta.id})"
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
            'No se lograron cargar las cuentas',
            'error'
        );

    }finally{

        loader.classList.add('hidden');
        table.classList.remove('hidden');

    }
}


async function editCuenta(id) {

    try {

        const response = await fetch(`${BASE_URL}cuenta/apiShow/${id}`);
        const result = await response.json();

        if(result.success){

            const cuenta = result.data;

            document.getElementById('cuentaId').value = cuenta.id;
            document.getElementById('cuentaUserId').value = cuenta.user_id;
            document.getElementById('cuentaUbicacion').value = cuenta.ubicacion ?? '';
            document.getElementById('cuentaGenero').value = cuenta.genero ?? '';

            document.getElementById('modalTitle').textContent = 'Editar Cuenta';

            document.getElementById('cuentaModal').classList.add('active');

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
            'No se pudo cargar la cuenta',
            'error'
        );

    }
}


function deleteCuenta(id) {

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

                const response = await fetch(`${BASE_URL}cuenta/apiDelete/${id}`, {
                    method: 'POST'
                });

                const resData = await response.json();

                if(resData.success){

                    Swal.fire(
                        '¡Eliminado!',
                        resData.message,
                        'success'
                    );

                    loadCuentas();

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