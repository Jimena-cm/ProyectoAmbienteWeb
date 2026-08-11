<?php
$pageTitle = 'Cuentas | La Casa de la Placa';
$activePage = 'cuenta';

require_once '../app/views/layouts/header.php';
?>

<div class="soporte-page">

    <div class="soporte-container">

        <div class="soporte-header">
            <h2>Gestión de Cuentas</h2>

            <button
                class="btn soporte-btn-new"
                id="btnNuevaCuenta"
            >
                Nueva Cuenta
            </button>
        </div>


        <div class="soporte-card">

            <div id="tableLoader" class="loader-container">
                <div class="spinner"></div>
            </div>

            <table class="table soporte-table hidden" id="cuentaTable">

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Usuario</th>
                        <th>Correo</th>
                        <th>Ubicación</th>
                        <th>Género</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody id="cuentaTbody">
                </tbody>

            </table>

        </div>

    </div>

</div>


<div class="soporte-modal" id="cuentaModal">

    <div class="soporte-modal-content">

        <div class="soporte-modal-header">

            <h3 id="modalTitle">
                Nueva Cuenta
            </h3>

            <button
                class="soporte-modal-close"
                id="closeModal"
                type="button"
            >
                &times;
            </button>

        </div>


        <form id="cuentaForm">

            <input
                type="hidden"
                id="cuentaId"
                name="id"
            >


            <div class="mb-3">

                <label for="cuentaUserId" class="form-label">
                    ID Usuario
                </label>

                <input
                    type="number"
                    id="cuentaUserId"
                    name="user_id"
                    class="form-control"
                    required
                    placeholder="Ej: 2"
                >

            </div>


            <div class="mb-3">

                <label for="cuentaUbicacion" class="form-label">
                    Ubicación
                </label>

                <input
                    type="text"
                    id="cuentaUbicacion"
                    name="ubicacion"
                    class="form-control"
                    required
                    placeholder="Ej: San José, Costa Rica"
                >

            </div>


            <div class="mb-3">

                <label for="cuentaGenero" class="form-label">
                    Género
                </label>

                <select
                    id="cuentaGenero"
                    name="genero"
                    class="form-select"
                    required
                >
                    <option value="">Seleccione</option>
                    <option value="Femenino">Femenino</option>
                    <option value="Masculino">Masculino</option>
                    <option value="Otro">Otro</option>
                    <option value="Prefiero no indicar">Prefiero no indicar</option>
                </select>

            </div>


            <button
                type="submit"
                class="btn soporte-btn-save"
                id="btnSave"
            >
                Guardar Cuenta
            </button>

        </form>

    </div>

</div>


<script>
    const BASE_URL = "<?= BASE_URL ?>";
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="<?= ROOT_URL ?>js/cuenta.js"></script>

<?php require_once '../app/views/layouts/footer.php'; ?>