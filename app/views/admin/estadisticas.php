<?php
$activePage = 'admin';
$pageTitle = 'Estadísticas | Admin';
require_once '../app/views/layouts/header.php';

$adminSection = 'estadistica';
?>

<section class="cdp-catalogo">
    <div class="container py-5">

        <div class="cdp-admin-header">

            <h1>Estadísticas</h1>

            <button type="button"
                    class="btn btn-primary"
                    id="btnNuevaEstadistica">

                <i class="bi bi-plus-lg"></i>
                Nueva Estadística

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
                   id="estadisticasTable">

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Descripción</th>
                        <th>Valor</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody id="estadisticasTBody">
                </tbody>

            </table>

        </div>

    </div>
</section>


<div class="cdp-admin-modal-overlay"
     id="estadisticaModal">

    <div class="cdp-admin-modal">

        <div class="cdp-admin-modal-header">

            <h3 id="modalTitle">
                Nueva Estadística
            </h3>

            <button type="button"
                    id="closeModal"
                    class="cdp-admin-modal-close">

                X

            </button>

        </div>


        <form id="estadisticaForm">

            <input type="hidden"
                   id="estadisticaId"
                   name="id">


            <div class="cdp-admin-form-group">

                <label for="estadisticaDescripcion">
                    Descripción
                </label>

                <input type="text"
                       id="estadisticaDescripcion"
                       name="description"
                       class="form-control"
                       required
                       placeholder="Ej: Pedidos realizados">

            </div>


            <div class="cdp-admin-form-group">

                <label for="estadisticaValor">
                    Valor
                </label>

                <input type="text"
                       id="estadisticaValor"
                       name="value"
                       class="form-control"
                       required
                       placeholder="Ej: 25">

            </div>


            <div class="cdp-admin-modal-actions">

                <button type="button"
                        class="btn btn-outline-secondary"
                        onclick="document.getElementById('estadisticaModal').classList.remove('active')">

                    Cancelar

                </button>

                <button type="submit"
                        class="btn btn-primary"
                        id="btnSave">

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

<script src="<?= ROOT_URL ?>js/estadistica.js"></script>

<?php require_once '../app/views/layouts/footer.php'; ?>