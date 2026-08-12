<?php
$activePage = 'admin';
$pageTitle = 'Ventas | Admin';
require_once '../app/views/layouts/header.php';

$adminSection = 'venta';
?>

<section class="cdp-catalogo">
    <div class="container py-5">
        <div class="cdp-admin-header">
            <h1>Ventas</h1>
            <button type="button" class="btn btn-primary" id="btnNuevaVenta">
                <i class="bi bi-plus-lg"></i>
                Nueva Venta
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
                   id="ventasTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Factura</th>
                        <th>Placa</th>
                        <th>Material</th>
                        <th>Tamaño</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="ventasTBody">
                </tbody>
            </table>
        </div>
    </div>
</section>

<div class="cdp-admin-modal-overlay"
     id="ventaModal">
    <div class="cdp-admin-modal">
        <div class="cdp-admin-modal-header">
            <h3 id="modalTitle">
                Nueva Venta
            </h3>
            <button type="button" id="closeModal" class="cdp-admin-modal-close">
                X
            </button>
        </div>

        <form id="ventaForm">
            <input type="hidden" id="ventaId" name="id">
            <div class="cdp-admin-form-group">
                <label for="ventaCantidad">
                    Cantidad
                </label>
                <input type="number" id="ventaCantidad" name="cantidad" class="form-control" min="1" required placeholder="Ej: 1">
            </div>

            <div class="cdp-admin-form-group">
                <label for="ventaPrecio">
                    Precio
                </label>
                <input type="number" id="ventaPrecio" name="precio" class="form-control" min="0" step="1" required placeholder="Ej: 45000">
            </div>

            <div class="cdp-admin-form-group">
                <label for="ventaFactura">
                    ID Factura
                </label>
                <input type="number" id="ventaFactura" name="factura_id" class="form-control" min="1" required placeholder="Ej: 1">
            </div>

            <div class="cdp-admin-form-group">
                <label for="ventaPlaca">
                    ID Placa
                </label>
                <input type="number" id="ventaPlaca" name="placa_id" class="form-control" min="1" required placeholder="Ej: 1">
            </div>

            <div class="cdp-admin-form-group">
                <label for="ventaMaterial">
                    ID Material
                </label>
                <input type="number" id="ventaMaterial" name="material_id" class="form-control" min="1" required placeholder="Ej: 1">
            </div>

            <div class="cdp-admin-form-group">
                <label for="ventaTamano">
                    ID Tamaño
                </label>
                <input type="number" id="ventaTamano" name="tamano_id" class="form-control" min="1" required placeholder="Ej: 2">
            </div>

            <div class="cdp-admin-modal-actions">
                <button type="button" class="btn btn-outline-secondary" onclick="document.getElementById('ventaModal').classList.remove('active')">
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

<script src="<?= ROOT_URL ?>js/venta.js"></script>

<?php require_once '../app/views/layouts/footer.php'; ?>