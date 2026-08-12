document.addEventListener('DOMContentLoaded', function () {

    const grid = document.getElementById('cdpGridProductos');
    const filtrosContenedor = document.getElementById('cdpFiltros');
    const buscador = document.getElementById('cdpBuscarPlaca');
    const sinResultados = document.getElementById('cdpSinResultados');
    const cargando = document.getElementById('cdpCargando');

    let productos = [];
    let filtroActivo = 'todos';

    function formatearPrecio(precio) {
        return '₡' + Number(precio).toLocaleString('es-CR');
    }

    function rutaImagen(nombreImagen) {
        return nombreImagen ? ROOT_URL + 'uploads/' + nombreImagen : '';
    }

    function renderizarFiltros() {
        const materiales = [...new Set(productos.map((p) => p.material))];

      col.innerHTML = `
        <div class="card cdp-producto-card h-100">
            <div class="cdp-producto-img-wrap">
                <img src="${imagen}" class="card-img-top" alt="${producto.nombre}">
            </div>
            <div class="card-body d-flex flex-column">
                <p class="cdp-producto-nombre">${producto.nombre}</p>
                <div class="d-flex justify-content-between align-items-center mt-auto">
                    <span class="cdp-producto-precio">${precio}</span>
                    <div class="d-flex gap-2">
                        <button class="btn btn-sm rounded-circle cdp-btn-agregar"
                            title="Ver detalle"
                            data-bs-toggle="modal"
                            data-bs-target="#cdpModalDetalle">
                            <i class="bi bi-eye"></i>     
                  </button>
                  <form action="${BASE_URL}carrito/agregar/${producto.id}"
                      method="POST">
                      <button type="submit"
                          class="btn btn-sm rounded-circle cdp-btn-agregar"
                          title="Agregar al carrito">
                          <i class="bi bi-cart-plus"></i>
                      </button>
                  </form>
                    </div>
                </div>
            </div>
        </div>
      `;
        materiales.forEach((material) => {
            const btn = document.createElement('button');
            btn.type = 'button';
            btn.className = 'btn btn-sm rounded-pill cdp-filtro';
            btn.dataset.filtro = material;
            btn.textContent = material.charAt(0).toUpperCase() + material.slice(1);
            btn.addEventListener('click', () => activarFiltro(btn, material));
            filtrosContenedor.appendChild(btn);
        });

        const btnTodos = filtrosContenedor.querySelector('[data-filtro="todos"]');
        btnTodos.addEventListener('click', () => activarFiltro(btnTodos, 'todos'));
    }

    function activarFiltro(boton, material) {
        document.querySelectorAll('.cdp-filtro').forEach((b) => b.classList.remove('active'));
        boton.classList.add('active');
        filtroActivo = material;
        aplicarFiltro();
    }

    function renderizarProductos(lista) {
        grid.innerHTML = '';

        lista.forEach((producto) => {
            const precio = formatearPrecio(producto.precio);
            const imagen = rutaImagen(producto.imagen_nombre);

            const col = document.createElement('div');
            col.className = 'col cdp-producto';
            col.dataset.material = producto.material;
            col.dataset.nombre = producto.nombre;
            col.dataset.precio = precio;
            col.dataset.imagen = imagen;
            col.dataset.descripcion = producto.descripcion;

            col.innerHTML = `
                <div class="card cdp-producto-card h-100">
                    <div class="cdp-producto-img-wrap">
                        <img src="${imagen}" class="card-img-top" alt="${producto.nombre}">
                    </div>
                    <div class="card-body d-flex flex-column">
                        <p class="cdp-producto-nombre">${producto.nombre}</p>
                        <div class="d-flex justify-content-between align-items-center mt-auto">
                            <span class="cdp-producto-precio">${precio}</span>
                            <button class="btn btn-sm rounded-circle cdp-btn-agregar" title="Ver detalle"
                                data-bs-toggle="modal" data-bs-target="#cdpModalDetalle">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                    </div>
                </div>
            `;

            grid.appendChild(col);
        });
    }

    function aplicarFiltro() {
        const texto = buscador.value.trim().toLowerCase();

        const filtrados = productos.filter((producto) => {
            const coincideMaterial = (filtroActivo === 'todos' || producto.material === filtroActivo);
            const coincideTexto = producto.nombre.toLowerCase().includes(texto);
            return coincideMaterial && coincideTexto;
        });

        renderizarProductos(filtrados);
        sinResultados.classList.toggle('d-none', filtrados.length > 0);
    }

    function inicializarModal() {
        const modalDetalle = document.getElementById('cdpModalDetalle');

        modalDetalle.addEventListener('show.bs.modal', (event) => {
            const boton = event.relatedTarget;
            const tarjeta = boton.closest('.cdp-producto');

            document.getElementById('cdpModalImagen').src = tarjeta.dataset.imagen;
            document.getElementById('cdpModalImagen').alt = tarjeta.dataset.nombre;
            document.getElementById('cdpModalNombre').textContent = tarjeta.dataset.nombre;
            document.getElementById('cdpModalPrecio').textContent = tarjeta.dataset.precio;
            document.getElementById('cdpModalDescripcion').textContent = tarjeta.dataset.descripcion;
        });
    }

    fetch(`${BASE_URL}catalogo/apiList`)
        .then((res) => res.json())
        .then((data) => {
            productos = data;
            cargando.classList.add('d-none');
            renderizarFiltros();
            renderizarProductos(productos);
            inicializarModal();
        })
        .catch((error) => {
            cargando.textContent = 'Ocurrió un error cargando el catálogo.';
            console.error(error);
        });

    buscador.addEventListener('input', aplicarFiltro);
});