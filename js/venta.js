document.addEventListener('DOMContentLoaded', () => {
    console.log('venta.js cargado');

    loadVentas();

    const btnNuevaVenta = document.getElementById('btnNuevaVenta');
    const modal = document.getElementById('ventaModal');
    const closeModal = document.getElementById('closeModal');
    const ventaForm = document.getElementById('ventaForm');
    const modalTitle = document.getElementById('modalTitle');

    btnNuevaVenta.addEventListener('click', () => {
        modalTitle.textContent = 'Nueva Venta';
        ventaForm.reset();
        document.getElementById('ventaId').value = "";
        modal.classList.add('active');
    });

    closeModal.addEventListener('click', () => {
        modal.classList.remove('active');
    });

    ventaForm.addEventListener('submit', async (e) => {
        e.preventDefault();

        const id = document.getElementById('ventaId').value;
        const cantidad = document.getElementById('ventaCantidad').value;
        const precio = document.getElementById('ventaPrecio').value;
        const factura_id = document.getElementById('ventaFactura').value;
        const placa_id = document.getElementById('ventaPlaca').value;
        const material_id = document.getElementById('ventaMaterial').value;
        const tamano_id = document.getElementById('ventaTamano').value;

        const data = {
            cantidad,
            precio,
            factura_id,
            placa_id,
            material_id,
            tamano_id
        };

        const url = id
            ? `${BASE_URL}venta/apiUpdate/${id}`
            : `${BASE_URL}venta/apiStore`;

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
                loadVentas();
            } else {
                Swal.fire('Error', result.message, 'error');
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


function formatearPrecio(valor) {
    return '₡' + Number(valor).toLocaleString('es-CR');
}


async function loadVentas() {
    const loader = document.getElementById('tableLoader');
    const table = document.getElementById('ventasTable');
    const tbody = document.getElementById('ventasTBody');

    loader.classList.remove('d-none');
    table.classList.add('d-none');
    tbody.innerHTML = '';

    try {

        const response = await fetch(
            `${BASE_URL}venta/apiList`
        );

        const ventas = await response.json();

        if (ventas.length === 0) {

            tbody.innerHTML =
                '<tr><td colspan="8" class="text-center text-muted">No hay ventas registradas</td></tr>';

        } else {

            ventas.forEach(venta => {

                const tr = document.createElement('tr');

                tr.innerHTML = `
                    <td>${venta.id}</td>
                    <td>${venta.cantidad}</td>
                    <td>${formatearPrecio(venta.precio)}</td>
                    <td>${venta.factura_id}</td>
                    <td>${venta.placa_id}</td>
                    <td>${venta.material_id}</td>
                    <td>${venta.tamano_id}</td>

                    <td class="cdp-admin-actions">
                        <button
                            class="btn btn-sm btn-outline-secondary"
                            onclick="editVenta(${venta.id})">
                            Editar
                        </button>

                        <button
                            class="btn btn-sm btn-outline-danger"
                            onclick="deleteVenta(${venta.id})">
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
            'No se lograron cargar las ventas',
            'error'
        );

    } finally {

        loader.classList.add('d-none');
        table.classList.remove('d-none');
    }
}


async function editVenta(id) {
    try {

        const response = await fetch(
            `${BASE_URL}venta/apiShow/${id}`
        );

        const result = await response.json();

        if (result.success) {

            const venta = result.data;

            document.getElementById('ventaId').value =
                venta.id;

            document.getElementById('ventaCantidad').value =
                venta.cantidad;

            document.getElementById('ventaPrecio').value =
                venta.precio;

            document.getElementById('ventaFactura').value =
                venta.factura_id;

            document.getElementById('ventaPlaca').value =
                venta.placa_id;

            document.getElementById('ventaMaterial').value =
                venta.material_id;

            document.getElementById('ventaTamano').value =
                venta.tamano_id;

            document.getElementById('modalTitle').textContent =
                'Editar Venta';

            document.getElementById('ventaModal')
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
            'No se pudo cargar la venta',
            'error'
        );
    }
}


function deleteVenta(id) {

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
                    `${BASE_URL}venta/apiDelete/${id}`,
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

                    loadVentas();

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
                    'Ocurrió un error al eliminar la venta',
                    'error'
                );
            }
        }
    });
}