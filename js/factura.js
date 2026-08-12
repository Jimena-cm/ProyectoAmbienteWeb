document.addEventListener("DOMContentLoaded", () => {
    console.log("FACTURA");

    fetch(`factura/apiList`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ carrito: JSON.parse(localStorage.getItem('carrito')) || [] })
    })
    then(res => res.json())
        .then(resp => {
            if (resp.success) {
                const detalleDiv = document.getElementById('facturaDetalle');
                detalleDiv.innerHTML = "";

                resp.detalle.forEach(item => {
                    detalleDiv.innerHTML += `
                    <div class="col-12 mb-3">
                        <div class="card-body">
                            <p>Tamaño: ${item.tamano}</p>
                            <p>Material: ${item.material}</p>
                            <p>Cantidad: ${item.cantidad}</p>
                        </div>
                    </div>
                `;
                });

                document.getElementById('subtotal').textContent = '₡' + resp.subtotal;
                document.getElementById('impuestos').textContent = '₡' + resp.impuestos;
                document.getElementById('total').textContent = '₡' + resp.total;
            } else {
                alert("Error al generar factura");
            }
        })
});
