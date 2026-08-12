document.addEventListener("DOMContentLoaded", () => {

    const pedidos =
        JSON.parse(localStorage.getItem('pedidos')) || [];

    mostrarPedidos(pedidos);


    function formatearPrecio(valor) {
        return '₡' + Math.round(valor).toLocaleString('es-CR');
    }


    function mostrarPedidos(lista) {

        const contenedorPedidos =
            document.querySelector('.cdp-carrito');

        contenedorPedidos.innerHTML = '';


        if (lista.length === 0) {

            const card = document.createElement('div');

            card.className = 'card mb-3';

            card.style.maxWidth = '540px';

            card.innerHTML = `
                <div class="card-body text-center">

                    <h5 class="card-title">
                        No tienes pedidos
                    </h5>

                    <p class="card-text">
                        Cuando realices un pedido aparecerá aquí.
                    </p>

                </div>
            `;

            contenedorPedidos.appendChild(card);

            return;
        }


        lista.forEach((articulo, index) => {

            const card = document.createElement('div');

            card.className = 'card mb-3';

            card.style.maxWidth = '540px';


            card.innerHTML = `
                <div class="row g-0">

                    <div class="col-md-4">

                        <img
                            src="${articulo.imagenPreview}"
                            class="img-fluid rounded-start"
                            alt="Placa Personalizada">

                    </div>


                    <div class="col-md-8">

                        <div class="card-body">

                            <h5 class="card-title">
                                Placa Personalizada
                            </h5>

                            <p class="card-text">
                                ${articulo.mensaje}
                            </p>

                            <p class="card-text">
                                Cliente: ${NOMBRE_USUARIO}
                            </p>


                            <div class="cantidad-precio">

                                <span>
                                    Cantidad:
                                    ${articulo.cantidad}
                                </span>


                                <p class="precio">

                                    ${formatearPrecio(
                                        articulo.precio *
                                        articulo.cantidad
                                    )}

                                </p>

                            </div>


                            <button
                                class="btn btn-outline-danger btn-eliminar">

                                Eliminar

                            </button>

                        </div>

                    </div>

                </div>
            `;


            const btnEliminar =
                card.querySelector('.btn-eliminar');


            btnEliminar.addEventListener('click', () => {

                lista.splice(index, 1);

                localStorage.setItem(
                    'pedidos',
                    JSON.stringify(lista)
                );

                mostrarPedidos(lista);
            });


            contenedorPedidos.appendChild(card);
        });
    }

});