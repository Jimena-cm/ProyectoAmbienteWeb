document.addEventListener("DOMContentLoaded", () => {
  const cardTitulo = document.querySelector(".card-title");
  const cardTexto = document.querySelector(".card-text");
  const cardPrecio = document.querySelector(".precio");

  const btnAumentar = document.querySelector(".btn-aumentar");
  const btnRestar = document.querySelector(".btn-restar");
  const cantidadSpan = document.getElementById("cantidad");

  function renderizarCarrito(lista) {
  const contenedor = document.getElementById('cdpCarrito');
  contenedor.innerHTML = '';

  lista.forEach(producto => {
    const precio = '₡' + Number(producto.precio).toLocaleString('es-CR');
    const imagen = producto.imagen_nombre ? ROOT_URL + 'uploads/' + producto.imagen_nombre : '';

    const card = document.createElement('div');
    card.className = 'card mb-3';
    card.style.maxWidth = '540px';
    card.innerHTML = `
      <div class="row g-0">
        <div class="col-md-4">
          <img src="${imagen}" class="img-fluid rounded-start" alt="${producto.nombre}">
        </div>
        <div class="col-md-8">
          <div class="card-body">
            <h5 class="card-title">${producto.nombre}</h5>
            <p class="card-text">${producto.descripcion}</p>
            <div class="cantidad-precio">
              <div class="cantidad-carrito">
                <button class="btn-restar">-</button>
                <span class="cantidad">${producto.cantidad}</span>
                <button class="btn-aumentar">+</button>
              </div>
              <p class="precio">${precio}</p>
            </div>
          </div>
        </div>
      </div>
    `;
    contenedor.appendChild(card);
  });
}

  btnAumentar.addEventListener("click", () => {
    let cantidad = parseInt(cantidadSpan.textContent);
    cantidad++;
    cantidadSpan.textContent = cantidad;
  });

  btnRestar.addEventListener("click", () => {
    let cantidad = parseInt(cantidadSpan.textContent);
    if (cantidad > 1) {
      cantidad--;
      cantidadSpan.textContent = cantidad;
    }
  });

});
