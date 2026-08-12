<?php
$activePage = 'catalogo';
$pageTitle = 'Catálogo | La Casa de la Placa';
require_once '../app/views/layouts/header.php';
?>

<section class="cdp-catalogo">
    <div class="container py-5">

        <div class="input-group input-group-lg cdp-buscador mb-4">
            <span class="input-group-text bg-white border-end-0">
                <i class="bi bi-search"></i>
            </span>
            <input type="text" id="cdpBuscarPlaca" class="form-control border-start-0"
                placeholder="Buscar placas premium...">
        </div>

        <div class="d-flex flex-wrap gap-2 mb-4 cdp-filtros" id="cdpFiltros">
            <button type="button" class="btn btn-sm rounded-pill cdp-filtro active" data-filtro="todos">
                <i class="bi bi-sliders me-1"></i> Todas las colecciones
            </button>
        </div>

        <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4 g-4" id="cdpGridProductos">
        </div>

        <p id="cdpCargando" class="text-center text-muted mt-5">
            Cargando catálogo...
        </p>

        <p id="cdpSinResultados" class="text-center text-muted mt-5 d-none">
            No encontramos placas que coincidan con tu búsqueda.
        </p>

    </div>
</section>

<div class="modal fade" id="cdpModalDetalle" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content cdp-modal-detalle">
            <div class="modal-header border-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <div class="row g-4 align-items-center">
                    <div class="col-md-6">
                        <img id="cdpModalImagen" src="" alt="" class="img-fluid cdp-modal-imagen">
                    </div>
                    <div class="col-md-6">
                        <h3 id="cdpModalNombre" class="cdp-modal-nombre"></h3>
                        <p id="cdpModalPrecio" class="cdp-modal-precio"></p>
                        <p id="cdpModalDescripcion" class="cdp-modal-descripcion"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const BASE_URL = "<?= BASE_URL ?>";
</script>
<script src="<?= BASE_URL ?>js/catalogo.js"></script>

<?php require_once '../app/views/layouts/footer.php'; ?>