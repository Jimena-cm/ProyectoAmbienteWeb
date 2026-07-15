document.addEventListener("DOMContentLoaded", function () {

    const contenedor =
        document.querySelector("#historialContenido");


    fetch("./backend/historial.php")

        .then(response => {

            if (!response.ok) {
                throw new Error("No autorizado");
            }

            return response.json();
        })

        .then(resultado => {

            if (!resultado.success) {

                contenedor.innerHTML = `
                    <div class="alert alert-danger">
                        ${resultado.message}
                    </div>
                `;

                return;
            }


            const historial = resultado.historial;


            // Si no hay pedidos
            if (historial.length === 0) {

                contenedor.innerHTML = `
                    <div class="history-empty">

                        <h3>
                            Aún no tienes pedidos
                        </h3>

                        <p>
                            Cuando realices una compra,
                            aparecerá en esta sección.
                        </p>

                    </div>
                `;

                return;
            }


            let html = `
                <div class="table-responsive">

                    <table class="table history-table">

                        <thead>

                            <tr>
                                <th>Pedido</th>
                                <th>Producto</th>
                                <th>Fecha</th>
                                <th>Estado</th>
                            </tr>

                        </thead>

                        <tbody>
            `;


            historial.forEach(pedido => {

                let estadoClase = "";


                switch (pedido.estado.toLowerCase()) {

                    case "entregado":
                        estadoClase = "estado-entregado";
                        break;

                    case "en proceso":
                        estadoClase = "estado-proceso";
                        break;

                    case "pendiente":
                        estadoClase = "estado-pendiente";
                        break;

                    case "cancelado":
                        estadoClase = "estado-cancelado";
                        break;

                    default:
                        estadoClase = "estado-default";
                }


                html += `

                    <tr>

                        <td>
                            #${pedido.id}
                        </td>

                        <td>
                            ${pedido.producto}
                        </td>

                        <td>
                            ${pedido.fecha}
                        </td>

                        <td>

                            <span class="estado ${estadoClase}">

                                ${pedido.estado}

                            </span>

                        </td>

                    </tr>
                `;

            });


            html += `

                        </tbody>

                    </table>

                </div>
            `;


            contenedor.innerHTML = html;

        })

        .catch(error => {

            console.log("Error:", error);

            window.location.href = "index.php";

        });

});