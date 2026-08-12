<?php
$activePage = 'admin';
$pageTitle = 'Materiales | Admin';
require_once '../app/views/layouts/header.php';

$adminSection = 'material';
?>

<section class="cdp-catalogo">
    <div class="container py-5">

        <div class="cdp-admin-header">
            <h1>Materiales</h1>
            <button type="button" class="btn btn-primary" id="btnNuevoMaterial">
                <i class="bi bi-plus-lg"></i> Nuevo Material
            </button>
        </div>

        <?php require_once '../app/views/partials/admin_nav.php'; ?>

        <div class="cdp-admin-card">

            <div id="tableLoader" class="text-center py-5">
                <div class="spinner-border" role="status">
                    <span class="visually-hidden">Cargando...</span>
                </div>
            </div>

            <table class="cdp-admin-table d-none" id="materialesTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="materialesTBody">
                </tbody>
            </table>

        </div>

    </div>
</section>


<div class="cdp-admin-modal-overlay" id="materialModal">
    <div class="cdp-admin-modal">
        <div class="cdp-admin-modal-header">
            <h3 id="modalTitle">Nuevo Material</h3>
            <button type="button" id="closeModal" class="cdp-admin-modal-close">&times;</button>
        </div>

        <form id="materialForm">
            <input type="hidden" id="materialId" name="id">

            <div class="cdp-admin-form-group">
                <label for="materialesNombre">Nombre</label>
                <input type="text" id="materialesNombre" name="nombre" class="form-control" required placeholder="Ej: Mármol blanco">
            </div>

            <div class="cdp-admin-form-group">
                <label for="materialesPrecio">Precio</label>
                <input type="number" id="materialesPrecio" name="precio" class="form-control" min="0" step="1" required placeholder="Ej: 45000">
            </div>

            <div class="cdp-admin-modal-actions">
                <button type="button" class="btn btn-outline-secondary" onclick="document.getElementById('materialModal').classList.remove('active')">Cancelar</button>
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
<script src="<?= ROOT_URL ?>js/material.js"></script>

<?php require_once '../app/views/layouts/footer.php'; ?>