<?php
$activePage = 'admin';
$pageTitle = 'Categorías | Admin';
require_once '../app/views/layouts/header.php';

$adminSection = 'categoria';
?>

<section class="cdp-catalogo">
    <div class="container py-5">

        <div class="cdp-admin-header">
            <h1>Categorías</h1>
            <button type="button" class="btn btn-primary" id="btnNuevaCategoria">
                <i class="bi bi-plus-lg"></i> Nueva Categoría
            </button>
        </div>

        <?php require_once '../app/views/partials/admin_nav.php'; ?>

        <div class="cdp-admin-card">

            <div id="tableLoader" class="text-center py-5">
                <div class="spinner-border" role="status">
                    <span class="visually-hidden">Cargando...</span>
                </div>
            </div>

            <table class="cdp-admin-table d-none" id="categoriasTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="categoriasTBody">
                </tbody>
            </table>

        </div>

    </div>
</section>


<div class="cdp-admin-modal-overlay" id="categoriaModal">
    <div class="cdp-admin-modal">
        <div class="cdp-admin-modal-header">
            <h3 id="modalTitle">Nueva Categoría</h3>
            <button type="button" id="closeModal" class="cdp-admin-modal-close">&times;</button>
        </div>

        <form id="categoriaForm">
            <input type="hidden" id="categoriaId" name="id">

            <div class="cdp-admin-form-group">
                <label for="categoriasNombre">Nombre</label>
                <input type="text" id="categoriasNombre" name="nombre" class="form-control" required placeholder="Ej: Placas conmemorativas">
            </div>

            <div class="cdp-admin-form-group">
                <label for="categoriasDescripcion">Descripción</label>
                <textarea id="categoriasDescripcion" name="descripcion" class="form-control" rows="3" placeholder="Descripción breve de la categoría"></textarea>
            </div>

            <div class="cdp-admin-modal-actions">
                <button type="button" class="btn btn-outline-secondary" id="btnCancelar" onclick="document.getElementById('categoriaModal').classList.remove('active')">Cancelar</button>
                <button type="submit" class="btn btn-primary" id="btnSave">Guardar</button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    const BASE_URL = "<?= BASE_URL ?>";
    const ROOT_URL = "<?= ROOT_URL ?>";
</script>
<script src="<?= ROOT_URL ?>js/categoria.js"></script>

<?php require_once '../app/views/layouts/footer.php'; ?>