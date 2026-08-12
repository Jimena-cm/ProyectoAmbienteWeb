document.addEventListener("DOMContentLoaded", () => {
    const carritoGuardado = JSON.parse(localStorage.getItem('carrito')) || [];
    articuloCarrito(carritoGuardado);

    function formatearPrecio(valor) {
        return '₡' + Math.round(valor).toLocaleString('es-CR');
    }

    function totalPago(lista) {
        if (lista.length === 0) {
            document.getElementById('spnSubtotal').textContent = formatearPrecio(0);
            document.getElementById('spnImpuestos').textContent = formatearPrecio(0);
            document.getElementById('spnTotal').textContent = formatearPrecio(0);
            return;
        }

        let subtotal = 0;
        lista.forEach(articulo => {
            subtotal += articulo.precio * articulo.cantidad;
        });
        const impuestos = subtotal * 0.13;
        const total = subtotal + impuestos;

        document.getElementById('spnSubtotal').textContent = formatearPrecio(subtotal);
        document.getElementById('spnImpuestos').textContent = formatearPrecio(impuestos);
        document.getElementById('spnTotal').textContent = formatearPrecio(total);
    }

    function articuloCarrito(lista) {
        const contenedorCarrito = document.querySelector('.cdp-carrito');
        contenedorCarrito.innerHTML = '';

        lista.forEach((articulo, index) => {
            const card = document.createElement('div');
            card.className = 'card mb-3';
            card.style.maxWidth = '540px';
            card.innerHTML = `
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="${articulo.imagenPreview}" class="img-fluid rounded-start" alt="Placa Personalizada">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">Placa Personalizada</h5>
                                <p class="card-text">${articulo.mensaje}</p>
                                <div class="cantidad-precio">
                                    <div class="cantidad-carrito">
                                        <button class="btn-restar">-</button>
                                        <span class="cantidad">${articulo.cantidad}</span>
                                        <button class="btn-aumentar">+</button>
                                    </div>
                                    <p class="precio">${formatearPrecio(articulo.precio * articulo.cantidad)}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;

            const btnAumentar = card.querySelector('.btn-aumentar');
            const btnRestar = card.querySelector('.btn-restar');
            const spnCantidad = card.querySelector('.cantidad');
            const precioArticulo = card.querySelector('.precio');

            btnAumentar.addEventListener('click', () => {
                let cantidad = parseInt(spnCantidad.textContent);
                cantidad++;

                lista[index].cantidad = cantidad;
                spnCantidad.textContent = cantidad;
                precioArticulo.textContent = formatearPrecio(articulo.precio * cantidad);

                localStorage.setItem('carrito', JSON.stringify(lista));
                totalPago(lista);
            });

            btnRestar.addEventListener('click', () => {
                let cantidad = parseInt(spnCantidad.textContent);

                if (cantidad > 1) {
                    cantidad--;
                    lista[index].cantidad = cantidad;
                    spnCantidad.textContent = cantidad;
                    precioArticulo.textContent = formatearPrecio(articulo.precio * cantidad);
                } else {
                    lista.splice(index, 1);
                    localStorage.setItem('carrito', JSON.stringify(lista));
                    articuloCarrito(lista);
                    return;
                }

                localStorage.setItem('carrito', JSON.stringify(lista));
                totalPago(lista);
            });

            contenedorCarrito.appendChild(card);
            totalPago(lista);
        });
        totalPago(lista);
    }
});

document.getElementById('finalizarPago').addEventListener('submit', function (e) {
    e.preventDefault();
    const numeroTarjeta = document.getElementById('numeroTarjeta').value;
    const fechaTarjeta = document.getElementById('fechaTarjeta').value;
    const anioTarjeta = document.getElementById('anioTarjeta').value;
    const cvvTarjeta = document.getElementById('cvvTarjeta').value;

    if (!numeroTarjeta || !fechaTarjeta || !anioTarjeta || !cvvTarjeta) {
        alert('Debe completar todos los campos');
        return;
    }

    const carrito = JSON.parse(localStorage.getItem('carrito')) || [];

    carrito.forEach(articulo => {
        const data = {
            cantidad: articulo.cantidad,
            precio: articulo.precio,
            material_id: articulo.material_id,
            tamano_id: articulo.tamano_id
        };
        console.log("Placa", data);

        fetch(`carrito/apiStore`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(data)
        })
            .then(res => res.json())
            .then(resp => {
                console.log(resp);
            })
            .catch(err => console.error(err));
    });
    console.log('FETCH');
    window.location.href = 'factura/index';

})
