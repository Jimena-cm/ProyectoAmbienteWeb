document.addEventListener('DOMContentLoaded', function () {

  const revealTargets = document.querySelectorAll(
    '.cdp-servicio-card, .cdp-historia-texto'
  );

  if ('IntersectionObserver' in window && revealTargets.length) {
    const observer = new IntersectionObserver((entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add('cdp-visible');
          observer.unobserve(entry.target);
        }
      });
    }, { threshold: 0.2 });

    revealTargets.forEach((el, index) => {
      if (el.classList.contains('cdp-servicio-card')) {
        el.style.setProperty('--reveal-delay', (index * 0.12) + 's');
      }
      observer.observe(el);
    });
  } else {
    revealTargets.forEach((el) => el.classList.add('cdp-visible'));
  }

  const carouselEl = document.getElementById('cdpCarruselPlacas');
  if (carouselEl && window.bootstrap) {
    const carousel = window.bootstrap.Carousel.getOrCreateInstance(carouselEl, {
      interval: 5500,
      pause: false,
      touch: true
    });

    carouselEl.addEventListener('mouseenter', () => carousel.pause());
    carouselEl.addEventListener('mouseleave', () => carousel.cycle());
  }

  const gridDestacados = document.getElementById('cdpGridDestacados');
  const destacadosVacio = document.getElementById('cdpDestacadosVacio');

  if (gridDestacados) {
    cargarDestacados();
  }

  function formatearPrecio(precio) {
    return '₡' + Number(precio).toLocaleString('es-CR');
  }

  function rutaImagen(nombreImagen) {
    return nombreImagen ? BASE_URL + 'uploads/' + nombreImagen : '';
  }

  function cargarDestacados() {
    fetch(`${BASE_URL}dashboard/apiDestacados`)
      .then((res) => res.json())
      .then((productos) => {
        if (!productos.length) {
          destacadosVacio.classList.remove('d-none');
          return;
        }
        renderizarDestacados(productos);
      })
      .catch((error) => {
        console.error('Error cargando destacados:', error);
        destacadosVacio.textContent = 'Ocurrió un error cargando los destacados.';
        destacadosVacio.classList.remove('d-none');
      });
  }

  function renderizarDestacados(productos) {
    gridDestacados.innerHTML = '';

    productos.forEach((producto) => {
      const precio = formatearPrecio(producto.precio);
      const imagen = rutaImagen(producto.imagen_nombre);

      const col = document.createElement('div');
      col.className = 'col cdp-producto';

      col.innerHTML = `
        <div class="card cdp-producto-card h-100">
            <div class="cdp-producto-img-wrap">
                <img src="${imagen}" class="card-img-top" alt="${producto.nombre}">
            </div>
            <div class="card-body d-flex flex-column">
                <p class="cdp-producto-nombre">${producto.nombre}</p>
                <div class="d-flex justify-content-between align-items-center mt-auto">
                    <span class="cdp-producto-precio">${precio}</span>
                    <a href="${BASE_URL}catalogo" class="btn btn-sm rounded-circle cdp-btn-agregar" title="Ver en catálogo">
                        <i class="bi bi-eye"></i>
                    </a>
                </div>
            </div>
        </div>
      `;

      gridDestacados.appendChild(col);
    });
  }

});