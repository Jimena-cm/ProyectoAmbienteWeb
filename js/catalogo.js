// ==========================================================
// LA CASA DE LA PLACA — Catálogo: búsqueda y filtros
// ==========================================================

document.addEventListener('DOMContentLoaded', function () {

  const buscador = document.getElementById('cdpBuscarPlaca');
  const filtros = document.querySelectorAll('.cdp-filtro');
  const productos = document.querySelectorAll('.cdp-producto');
  const sinResultados = document.getElementById('cdpSinResultados');

  let filtroActivo = 'todos';

  function aplicarFiltro() {
    const texto = buscador.value.trim().toLowerCase();
    let visibles = 0;

    productos.forEach((producto) => {
      const nombre = producto.querySelector('.cdp-producto-nombre').textContent.toLowerCase();
      const material = producto.dataset.material;

      const coincideMaterial = (filtroActivo === 'todos' || material === filtroActivo);
      const coincideTexto = nombre.includes(texto);

      const visible = coincideMaterial && coincideTexto;
      producto.classList.toggle('d-none', !visible);
      if (visible) visibles++;
    });

    sinResultados.classList.toggle('d-none', visibles > 0);
  }

  if (buscador) {
    buscador.addEventListener('input', aplicarFiltro);
  }

  filtros.forEach((btn) => {
    btn.addEventListener('click', () => {
      filtros.forEach((b) => b.classList.remove('active'));
      btn.classList.add('active');
      filtroActivo = btn.dataset.filtro;
      aplicarFiltro();
    });
  });

  // ---- Modal de detalle del producto ----
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

});