<?php
$pageTitle = 'Soporte | La Casa de la Placa';
$activePage = 'soporte';

require_once '../app/views/layouts/header.php';
?>

<div class="soporte-page">

    <div class="soporte-container">

        <div class="soporte-header">
            <h2>Gestión de Soporte</h2>

            <button
                class="btn soporte-btn-new"
                id="btnNuevoSoporte"
            >
                Nueva Solicitud
            </button>
        </div>


        <div class="soporte-card">

            <div id="tableLoader" class="loader-container">
                <div class="spinner"></div>
            </div>

            <table class="table soporte-table hidden" id="soporteTable">

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Teléfono</th>
                        <th>Correo</th>
                        <th>Mensaje</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody id="soporteTbody">
                </tbody>

            </table>

        </div>

    </div>

</div>


<div class="soporte-modal" id="soporteModal">

    <div class="soporte-modal-content">

        <div class="soporte-modal-header">

            <h3 id="modalTitle">
                Nueva Solicitud
            </h3>

            <button
                class="soporte-modal-close"
                id="closeModal"
                type="button"
            >
                &times;
            </button>

        </div>


        <form id="soporteForm">

            <input type="hidden" id="soporteId" name="id">


            <div class="mb-3">

                <label for="soporteNombre" class="form-label">
                    Nombre completo
                </label>

                <input
                    type="text"
                    id="soporteNombre"
                    name="nombre_completo"
                    class="form-control"
                    required
                    placeholder="Ej: Ana Jiménez"
                >

            </div>


            <div class="mb-3">

                <label for="soporteTelefono" class="form-label">
                    Teléfono
                </label>

                <input
                    type="text"
                    id="soporteTelefono"
                    name="telefono"
                    class="form-control"
                    placeholder="Ej: 8888-8888"
                >

            </div>


            <div class="mb-3">

                <label for="soporteCorreo" class="form-label">
                    Correo
                </label>

                <input
                    type="email"
                    id="soporteCorreo"
                    name="correo"
                    class="form-control"
                    required
                    placeholder="usuario@correo.com"
                >

            </div>


            <div class="mb-3">

                <label for="soporteMensaje" class="form-label">
                    Mensaje
                </label>

                <textarea
                    id="soporteMensaje"
                    name="mensaje_soporte"
                    class="form-control"
                    rows="5"
                    required
                    placeholder="Escriba el mensaje de soporte"
                ></textarea>

            </div>


            <button
                type="submit"
                class="btn soporte-btn-save"
                id="btnSave"
            >
                Guardar Solicitud
            </button>

        </form>

    </div>

</div>


<script>
    const BASE_URL = "<?= BASE_URL ?>";
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="<?= ROOT_URL ?>js/soporte.js"></script>

<?php require_once '../app/views/layouts/footer.php'; ?>