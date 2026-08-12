document.addEventListener('DOMContentLoaded', function () {

  const buscador = document.getElementById('cdpBuscarPlaca');
  const filtrosContenedor = document.getElementById('cdpFiltros');
  const grid = document.getElementById('cdpGridProductos');
  const sinResultados = document.getElementById('cdpSinResultados');
  const cargando = document.getElementById('cdpCargando');

  let productosData = [];
  let filtroActivo = 'todos';

  function renderizarProductos(lista) {
    grid.innerHTML = '';

    lista.forEach((producto) => {
      const precio = '₡' + Number(producto.precio).toLocaleString('es-CR');
      const imagen = producto.imagen_nombre ? ROOT_URL + 'uploads/' + producto.imagen_nombre : '';

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
  function renderizarFiltros() {
    const materiales = [...new Set(productosData.map((p) => p.material))];

    materiales.forEach((material) => {
      const btn = document.createElement('button');
      btn.type = 'button';
      btn.className = 'btn btn-sm rounded-pill cdp-filtro';
      btn.dataset.filtro = material;
      btn.textContent = material.charAt(0).toUpperCase() + material.slice(1);
      filtrosContenedor.appendChild(btn);
    });

    inicializarFiltros();
  }

  function aplicarFiltro() {
    const texto = buscador.value.trim().toLowerCase();

    const filtrados = productosData.filter((producto) => {
      const coincideMaterial = (filtroActivo === 'todos' || producto.material === filtroActivo);
      const coincideTexto = producto.nombre.toLowerCase().includes(texto);
      return coincideMaterial && coincideTexto;
    });

    renderizarProductos(filtrados);
    sinResultados.classList.toggle('d-none', filtrados.length > 0);
  }

  function inicializarFiltros() {
    const filtros = document.querySelectorAll('.cdp-filtro');

    filtros.forEach((btn) => {
      btn.addEventListener('click', () => {
        filtros.forEach((b) => b.classList.remove('active'));
        btn.classList.add('active');
        filtroActivo = btn.dataset.filtro;
        aplicarFiltro();
      });
    });
  }

  if (buscador) {
    buscador.addEventListener('input', aplicarFiltro);
  }

  const modalDetalle = document.getElementById('cdpModalDetalle');

  if (modalDetalle) {
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
      productosData = data;
      if (cargando) cargando.classList.add('d-none');
      renderizarProductos(productosData);
      renderizarFiltros();
    })
    .catch((error) => {
      console.error('Error cargando el catálogo:', error);
      if (cargando) cargando.textContent = 'Ocurrió un error cargando el catálogo.';
    });

});