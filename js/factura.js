document.addEventListener('DOMContentLoaded', () => {
    loadFacturas();
});

async function loadFacturas() {

    const loader = document.getElementById('tableLoader');
    const table = document.getElementById('facturasTable');
    const tbody = document.getElementById('facturasTBody');

    try {

        const response = await fetch(
            `${BASE_URL}factura/apiList`
        );

        const facturas = await response.json();

        tbody.innerHTML = '';

        if (facturas.length === 0) {

            tbody.innerHTML = `
                <tr>
                    <td colspan="6" class="text-center">
                        No hay facturas registradas
                    </td>
                </tr>
            `;

        } else {

            facturas.forEach(factura => {

                const fila = document.createElement('tr');

                fila.innerHTML = `
                    <td>${factura.id}</td>
                    <td>${factura.fecha}</td>
                    <td>${factura.total}</td>
                    <td>${factura.estado}</td>
                    <td>${factura.user_id}</td>
                    <td>
                        <button class="btn btn-sm btn-outline-secondary">
                            Editar
                        </button>

                        <button class="btn btn-sm btn-outline-danger">
                            Eliminar
                        </button>
                    </td>
                `;

                tbody.appendChild(fila);
            });
        }

    } catch (error) {

        console.log(error);

    } finally {

        loader.classList.add('d-none');
        table.classList.remove('d-none');
    }
}