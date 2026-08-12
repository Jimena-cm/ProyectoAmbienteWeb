<?php
$activePage = 'admin';
$pageTitle = 'Usuarios | Admin';
require_once '../app/views/layouts/header.php';

$adminSection = 'usuario';
?>

<section class="cdp-catalogo">
    <div class="container py-5">

        <div class="cdp-admin-header">
            <h1>Usuarios</h1>

            <button type="button"
                    class="btn btn-primary"
                    id="btnNuevoUsuario">

                <i class="bi bi-plus-lg"></i>
                Nuevo Usuario
            </button>
        </div>

        <?php require_once '../app/views/partials/admin_nav.php'; ?>

        <div class="cdp-admin-card">

            <div id="tableLoader" class="text-center py-5">
                <div class="spinner-border" role="status">
                    <span class="visually-hidden">
                        Cargando...
                    </span>
                </div>
            </div>

            <table class="cdp-admin-table d-none"
                   id="usuariosTable">

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Teléfono</th>
                        <th>Dirección</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody id="usuariosTBody">
                </tbody>

            </table>

        </div>

    </div>
</section>


<div class="cdp-admin-modal-overlay"
     id="usuarioModal">

    <div class="cdp-admin-modal">

        <div class="cdp-admin-modal-header">

            <h3 id="modalTitle">
                Nuevo Usuario
            </h3>

            <button type="button"
                    id="closeModal"
                    class="cdp-admin-modal-close">

                &times;

            </button>

        </div>


        <form id="usuarioForm">

            <input type="hidden"
                   id="usuarioId"
                   name="id">


            <div class="cdp-admin-form-group">

                <label for="usuarioNombre">
                    Nombre
                </label>

                <input type="text"
                       id="usuarioNombre"
                       name="name"
                       class="form-control"
                       required
                       placeholder="Ej: Juan Pérez">

            </div>


            <div class="cdp-admin-form-group">

                <label for="usuarioEmail">
                    Correo
                </label>

                <input type="email"
                       id="usuarioEmail"
                       name="email"
                       class="form-control"
                       required
                       placeholder="Ej: correo@ejemplo.com">

            </div>


            <div class="cdp-admin-form-group">

                <label for="usuarioPassword">
                    Contraseña
                </label>

                <input type="password"
                       id="usuarioPassword"
                       name="password"
                       class="form-control"
                       placeholder="Contraseña">

            </div>


            <div class="cdp-admin-form-group">

                <label for="usuarioPhone">
                    Teléfono
                </label>

                <input type="text"
                       id="usuarioPhone"
                       name="phone"
                       class="form-control"
                       placeholder="Ej: 8888-8888">

            </div>


            <div class="cdp-admin-form-group">

                <label for="usuarioAddress">
                    Dirección
                </label>

                <textarea id="usuarioAddress"
                          name="address"
                          class="form-control"
                          rows="3"
                          placeholder="Dirección del usuario"></textarea>

            </div>


            <div class="cdp-admin-modal-actions">

                <button type="button"
                        class="btn btn-outline-secondary"
                        id="btnCancelar"
                        onclick="document.getElementById('usuarioModal').classList.remove('active')">

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

<script src="<?= ROOT_URL ?>js/usuario.js"></script>

<?php require_once '../app/views/layouts/footer.php'; ?>