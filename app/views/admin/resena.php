<?php
$activePage = 'admin';
$pageTitle = 'Reseñas | Admin';
require_once '../app/views/layouts/header.php';

$adminSection = 'resena';
?>

<section class="cdp-catalogo">
    <div class="container py-5">

        <div class="cdp-admin-header">

            <h1>Reseñas</h1>

            <button type="button"
                    class="btn btn-primary"
                    id="btnNuevaResena">

                <i class="bi bi-plus-lg"></i>
                Nueva Reseña

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
                   id="resenasTable">

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>ID Usuario</th>
                        <th>Nombre</th>
                        <th>Comentario</th>
                        <th>Calificación</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody id="resenasTBody">
                </tbody>

            </table>

        </div>

    </div>
</section>


<div class="cdp-admin-modal-overlay"
     id="resenaModal">

    <div class="cdp-admin-modal">

        <div class="cdp-admin-modal-header">

            <h3 id="modalTitle">
                Nueva Reseña
            </h3>

            <button type="button"
                    id="closeModal"
                    class="cdp-admin-modal-close">

                X

            </button>

        </div>


        <form id="resenaForm">

            <input type="hidden"
                   id="resenaId"
                   name="id">


            <div class="cdp-admin-form-group">

                <label for="resenaUsuario">
                    ID Usuario
                </label>

                <input type="number"
                       id="resenaUsuario"
                       name="user_id"
                       class="form-control"
                       min="1"
                       required
                       placeholder="Ej: 2">

            </div>


            <div class="cdp-admin-form-group">

                <label for="resenaNombre">
                    Nombre
                </label>

                <input type="text"
                       id="resenaNombre"
                       name="nombre"
                       class="form-control"
                       required
                       placeholder="Ej: Jimena Rojas">

            </div>


            <div class="cdp-admin-form-group">

                <label for="resenaComentario">
                    Comentario
                </label>

                <textarea id="resenaComentario"
                          name="comentario"
                          class="form-control"
                          rows="3"
                          required
                          placeholder="Comentario de la reseña"></textarea>

            </div>


            <div class="cdp-admin-form-group">

                <label for="resenaCalificacion">
                    Calificación
                </label>

                <input type="number"
                       id="resenaCalificacion"
                       name="calificacion"
                       class="form-control"
                       min="1"
                       max="5"
                       required
                       placeholder="Ej: 5">

            </div>


            <div class="cdp-admin-modal-actions">

                <button type="button"
                        class="btn btn-outline-secondary"
                        onclick="document.getElementById('resenaModal').classList.remove('active')">

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

<script src="<?= ROOT_URL ?>js/resena.js"></script>

<?php require_once '../app/views/layouts/footer.php'; ?>