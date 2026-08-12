document.addEventListener('DOMContentLoaded', () => {
    console.log('pedido.js cargado');

    loadPedidos();
});


function formatearPrecio(valor) {
    return '₡' + Number(valor).toLocaleString('es-CR');
}


async function loadPedidos() {

    const loader = document.getElementById('pedidosLoader');
    const lista = document.getElementById('pedidosLista');

    lista.innerHTML = '';

    try {

        const response = await fetch(
            `${BASE_URL}pedido/apiList`
        );

        const pedidos = await response.json();

        if (pedidos.length === 0) {

            lista.innerHTML = `
                <div class="cdp-admin-card text-center">
                    No hay pedidos registrados
                </div>
            `;

        } else {

            pedidos.forEach(pedido => {

                let productos = '';

                pedido.detalles.forEach(detalle => {

                    productos += `
                        <div class="d-flex justify-content-between border-bottom py-3">

                            <div>
                                <strong>
                                    ${detalle.nombre}
                                </strong>

                                <div>
                                    Cantidad: ${detalle.cantidad}
                                </div>
                            </div>

                            <div>
                                ${formatearPrecio(detalle.precio)}
                            </div>

                        </div>
                    `;

                });


                const card = document.createElement('div');

                card.className = 'cdp-admin-card mb-4';

                card.innerHTML = `

                    <div class="d-flex justify-content-between align-items-center mb-3">

                        <div>
                            <h4>
                                Pedido #${pedido.id}
                            </h4>

                            <div>
                                Fecha: ${pedido.fecha}
                            </div>

                            <div>
                                Usuario: ${pedido.user_id}
                            </div>

                            <div>
                                Estado: ${pedido.estado}
                            </div>
                        </div>


                        <button
                            class="btn btn-sm btn-outline-danger"
                            onclick="deletePedido(${pedido.id})">

                            Eliminar

                        </button>

                    </div>


                    ${productos}


                    <div class="text-end mt-3">

                        <strong>
                            Total:
                            ${formatearPrecio(pedido.total)}
                        </strong>

                    </div>
                `;


                lista.appendChild(card);

            });
        }

    } catch (error) {

        Swal.fire(
            'Error',
            'No se lograron cargar los pedidos',
            'error'
        );

    } finally {

        loader.classList.add('d-none');
    }
}


function deletePedido(id) {

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
                    `${BASE_URL}pedido/apiDelete/${id}`,
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

                    loadPedidos();

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
                    'Ocurrió un error al eliminar el pedido',
                    'error'
                );
            }
        }
    });
}