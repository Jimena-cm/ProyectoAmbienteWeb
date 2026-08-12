<?php
$activePage = 'admin';
$pageTitle = 'Placas | Admin';
require_once '../app/views/layouts/header.php';

$adminSection = 'placa';
?>

<section class="cdp-catalogo">
    <div class="container py-5">

        <div class="cdp-admin-header">
            <h1>Placas</h1>
            <button type="button" class="btn btn-primary" id="btnNuevaPlaca">
                <i class="bi bi-plus-lg"></i> Nueva Placa
            </button>
        </div>

        <?php require_once '../app/views/partials/admin_nav.php'; ?>

        <div class="cdp-admin-card">

            <div id="tableLoader" class="text-center py-5">
                <div class="spinner-border" role="status">
                    <span class="visually-hidden">Cargando...</span>
                </div>
            </div>

            <table class="cdp-admin-table d-none" id="placasTable">
                <thead>
                    <tr>
                        <th>Imagen</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Disponible</th>
                        <th>Destacado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="placasTBody">
                </tbody>
            </table>

        </div>

    </div>
</section>


<div class="cdp-admin-modal-overlay" id="placaModal">
    <div class="cdp-admin-modal">
        <div class="cdp-admin-modal-header">
            <h3 id="modalTitle">Nueva Placa</h3>
            <button type="button" id="closeModal" class="cdp-admin-modal-close">&times;</button>
        </div>

        <form id="placaForm" enctype="multipart/form-data">
            <input type="hidden" id="placaId" name="id">

            <div class="cdp-admin-form-group">
                <label for="placasNombre">Nombre</label>
                <input type="text" id="placasNombre" name="nombre" class="form-control" required placeholder="Ej: Placa homenaje familiar">
            </div>

            <div class="cdp-admin-form-group">
                <label for="placasDescripcion">Descripción</label>
                <textarea id="placasDescripcion" name="descripcion" class="form-control" rows="2"></textarea>
            </div>

            <div class="cdp-admin-form-group">
                <label for="placasCategoria">Categoría</label>
                <select id="placasCategoria" name="categoria_id" class="form-control" required>
                    <option value="">---Seleccionar---</option>
                </select>
            </div>

            <div class="cdp-admin-form-group">
                <label for="placasMaterial">Material (texto libre para el catálogo)</label>
                <input type="text" id="placasMaterial" name="material" class="form-control" placeholder="Ej: bronce, madera, vidrio, acero">
            </div>

            <div class="cdp-admin-form-group">
                <label for="placasTamano">Tamaño (texto libre para el catálogo)</label>
                <input type="text" id="placasTamano" name="tamano" class="form-control" placeholder="Ej: 20cm x 30cm">
            </div>

            <div class="cdp-admin-form-group">
                <label for="placasPrecio">Precio</label>
                <input type="number" id="placasPrecio" name="precio" class="form-control" min="0" step="1" required>
            </div>

            <div class="cdp-admin-form-group">
                <label for="placasImagen">Imagen</label>
                <input type="file" id="placasImagen" name="imagen" class="file-disenar" accept="image/*">
                <img id="placasImagenPreview" class="cdp-admin-preview-imagen d-none" alt="Vista previa">
            </div>

            <div class="cdp-admin-form-group form-check">
                <input type="hidden" name="disponible" value="0">
                <input type="checkbox" id="placasDisponible" name="disponible" value="1" class="form-check-input" checked>
                <label for="placasDisponible" class="form-check-label">Disponible en el catálogo</label>
            </div>

            <div class="cdp-admin-form-group form-check">
                <input type="hidden" name="destacado" value="0">
                <input type="checkbox" id="placasDestacado" name="destacado" value="1" class="form-check-input">
                <label for="placasDestacado" class="form-check-label">Destacado en el home</label>
            </div>

            <div class="cdp-admin-modal-actions">
                <button type="button" class="btn btn-outline-secondary" onclick="document.getElementById('placaModal').classList.remove('active')">Cancelar</button>
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
<script src="<?= ROOT_URL ?>js/placa.js"></script>

<?php require_once '../app/views/layouts/footer.php'; ?>