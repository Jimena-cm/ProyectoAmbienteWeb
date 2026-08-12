<?php
$activePage = 'admin';
$pageTitle = 'Facturas | Admin';
require_once '../app/views/layouts/header.php';

$adminSection = 'factura';
?>

<section class="cdp-catalogo">
    <div class="container py-5">
        <div class="cdp-admin-header">
            <h1>Facturas</h1>
            <button type="button" class="btn btn-primary" id="btnNuevaFactura">
                <i class="bi bi-plus-lg"></i>
                Nueva Factura
            </button>
        </div>
        <?php require_once '../app/views/partials/admin_nav.php'; ?>
        <div class="cdp-admin-card">
            <div id="tableLoader"
                 class="text-center py-5">
                <div class="spinner-border"
                     role="status">
                    <span class="visually-hidden">
                        Cargando...
                    </span>
                </div>
            </div>
            <table class="cdp-admin-table d-none"
                   id="facturasTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Fecha</th>
                        <th>Total</th>
                        <th>Estado</th>
                        <th>ID Usuario</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="facturasTBody">
                </tbody>
            </table>
        </div>
    </div>
</section>

<div class="cdp-admin-modal-overlay"
     id="facturaModal">
    <div class="cdp-admin-modal">
        <div class="cdp-admin-modal-header">
            <h3 id="modalTitle">
                Nueva Factura
            </h3>
            <button type="button" id="closeModal" class="cdp-admin-modal-close">
                X
            </button>
        </div>

        <form id="facturaForm">
            <input type="hidden" id="facturaId" name="id">

            <div class="cdp-admin-form-group">
                <label for="facturaFecha">
                    Fecha
                </label>
                <input type="date" id="facturaFecha" name="fecha" class="form-control" required>
            </div>

            <div class="cdp-admin-form-group">
                <label for="facturaTotal">
                    Total
                </label>
                <input type="number" id="facturaTotal" name="total" class="form-control" min="0" step="1" required placeholder="Ej: 45000">
            </div>

            <div class="cdp-admin-form-group">
                <label for="facturaEstado">
                    Estado
                </label>
                <input type="text" id="facturaEstado" name="estado" class="form-control" required placeholder="Ej: pagada">
            </div>

            <div class="cdp-admin-form-group">
                <label for="facturaUsuario">
                    ID Usuario
                </label>
                <input type="number" id="facturaUsuario" name="user_id" class="form-control" min="1" required placeholder="Ej: 2">
            </div>

            <div class="cdp-admin-modal-actions">
                <button type="button" class="btn btn-outline-secondary" onclick="document.getElementById('facturaModal').classList.remove('active')">
                    Cancelar
                </button>
                <button type="submit" class="btn btn-primary" id="btnSave">
                    Guardar
                </button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    const BASE_URL = "<?= BASE_URL ?>";
    const ROOT_URL = "<?= ROOT_URL ?>";
</script>

<script src="<?= ROOT_URL ?>js/factura.js"></script>

<?php require_once '../app/views/layouts/footer.php'; ?>