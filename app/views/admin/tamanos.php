<?php
$activePage = 'admin';
$pageTitle = 'Tamaños | Admin';
require_once '../app/views/layouts/header.php';

$adminSection = 'tamano';
?>

<section class="cdp-catalogo">
    <div class="container py-5">

        <div class="cdp-admin-header">
            <h1>Tamaños</h1>
            <button type="button" class="btn btn-primary" id="btnNuevoTamano">
                <i class="bi bi-plus-lg"></i> Nuevo Tamaño
            </button>
        </div>

        <?php require_once '../app/views/partials/admin_nav.php'; ?>

        <div class="cdp-admin-card">

            <div id="tableLoader" class="text-center py-5">
                <div class="spinner-border" role="status">
                    <span class="visually-hidden">Cargando...</span>
                </div>
            </div>

            <table class="cdp-admin-table d-none" id="tamanosTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Dimensiones</th>
                        <th>Precio adicional</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="tamanosTBody">
                </tbody>
            </table>

        </div>

    </div>
</section>

<div class="cdp-admin-modal-overlay" id="tamanoModal">
    <div class="cdp-admin-modal">
        <div class="cdp-admin-modal-header">
            <h3 id="modalTitle">Nuevo Tamaño</h3>
            <button type="button" id="closeModal" class="cdp-admin-modal-close">&times;</button>
        </div>

        <form id="tamanoForm">
            <input type="hidden" id="tamanoId" name="id">

            <div class="cdp-admin-form-group">
                <label for="tamanosDimensiones">Dimensiones</label>
                <input type="text" id="tamanosDimensiones" name="dimensiones" class="form-control" required placeholder="Ej: 20x30">
            </div>

            <div class="cdp-admin-form-group">
                <label for="tamanosPrecioAdicional">Precio adicional</label>
                <input type="number" id="tamanosPrecioAdicional" name="precio_adicional" class="form-control" min="0" step="1" required placeholder="Ej: 5000">
            </div>

            <div class="cdp-admin-modal-actions">
                <button type="button" class="btn btn-outline-secondary" onclick="document.getElementById('tamanoModal').classList.remove('active')">Cancelar</button>
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
<script src="<?= ROOT_URL ?>js/tamano.js"></script>

<?php require_once '../app/views/layouts/footer.php'; ?>