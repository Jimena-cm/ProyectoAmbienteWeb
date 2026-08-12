document.addEventListener("DOMContentLoaded", () => {
    function formatearPrecio(valor) {
        return '₡' + Math.round(valor).toLocaleString('es-CR');
    }

    function articuloCarrito(lista) {
        const btnAumentar = card.querySelector('.btn-aumentar');
        const btnRestar = card.querySelector('.btn-restar');
        const cantidadSpan = card.querySelector('.cantidad');
        const contenedor = document.getElementById('cdpCarrito');
        contenedor.innerHTML = '';

        lista.forEach(articulo => {
            const precioArticulo = formatearPrecio(articulo.precio);

            const imagenArticulo = articulo.tipo === 'Diseño'
                ? articulo.imagenPreview
                : (articulo.imagen_nombre ? ROOT_URL + 'uploads/' + articulo.imagen_nombre : '');

            const textoArticulo = articulo.tipo === 'Diseño'
                ? articulo.mensaje
                : articulo.descripcion;

            const nombreArticulo = articulo.tipo === 'Diseño'
                ? 'Placa Personalizada'
                : articulo.nombre;

            const card = document.createElement('div');
            card.className = 'card mb-3';
            card.style.maxWidth = '540px';
            card.innerHTML = `
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="${imagenArticulo}" class="img-fluid rounded-start" alt="${nombreArticulo}">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">${nombreArticulo}</h5>
                                <p class="card-text">${textoArticulo}</p>
                                <div class="cantidad-precio">
                                    <div class="cantidad-carrito">
                                        <button class="btn-restar">-</button>
                                        <span class="cantidad">${articulo.cantidad}</span>
                                        <button class="btn-aumentar">+</button>
                                    </div>
                                    <p class="precio">${precioArticulo}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            btnAumentar.addEventListener('click', () => {
                let cantidad = parseInt(cantidadSpan.textContent);
                cantidad++;
                cantidadSpan.textContent = cantidad;
                lista[index].cantidad = cantidad;
                localStorage.setItem('carrito', JSON.stringify(lista));
            });

            btnRestar.addEventListener('click', () => {
                let cantidad = parseInt(cantidadSpan.textContent);
                if (cantidad > 1) {
                    cantidad--;
                    cantidadSpan.textContent = cantidad;
                    lista[index].cantidad = cantidad;
                } else {
                    lista.splice(index, 1);
                    articuloCarrito(lista);
                }

                localStorage.setItem('carrito', JSON.stringify(lista));
            });
            contenedor.appendChild(card);
        });
    }
})