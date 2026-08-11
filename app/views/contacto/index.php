<?php
$pageTitle = 'Contacto | La Casa de la Placa';
$activePage = 'contacto';

require_once '../app/views/layouts/header.php';
?>

<div class="soporte-page">

    <div class="soporte-container">

        <div class="soporte-header">

            <h2>Gestión de Contacto</h2>

            <button
                class="btn soporte-btn-new"
                id="btnNuevoContacto"
            >
                Nuevo Mensaje
            </button>

        </div>


        <div class="soporte-card">

            <div id="tableLoader" class="loader-container">
                <div class="spinner"></div>
            </div>

            <table class="table soporte-table hidden" id="contactoTable">

                <thead>

                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Mensaje</th>
                        <th>Fecha</th>
                        <th>Acciones</th>
                    </tr>

                </thead>

                <tbody id="contactoTbody">
                </tbody>

            </table>

        </div>

    </div>

</div>


<div class="soporte-modal" id="contactoModal">

    <div class="soporte-modal-content">

        <div class="soporte-modal-header">

            <h3 id="modalTitle">
                Nuevo Mensaje
            </h3>

            <button
                class="soporte-modal-close"
                id="closeModal"
                type="button"
            >
                &times;
            </button>

        </div>


        <form id="contactoForm">

            <input
                type="hidden"
                id="contactoId"
                name="id"
            >


            <div class="mb-3">

                <label
                    for="contactoNombre"
                    class="form-label"
                >
                    Nombre
                </label>

                <input
                    type="text"
                    id="contactoNombre"
                    name="nombre"
                    class="form-control"
                    required
                    placeholder="Ej: Ana Jiménez"
                >

            </div>


            <div class="mb-3">

                <label
                    for="contactoEmail"
                    class="form-label"
                >
                    Correo electrónico
                </label>

                <input
                    type="email"
                    id="contactoEmail"
                    name="email"
                    class="form-control"
                    required
                    placeholder="usuario@correo.com"
                >

            </div>


            <div class="mb-3">

                <label
                    for="contactoMensaje"
                    class="form-label"
                >
                    Mensaje
                </label>

                <textarea
                    id="contactoMensaje"
                    name="mensaje"
                    class="form-control"
                    rows="5"
                    required
                    placeholder="Escriba su mensaje"
                ></textarea>

            </div>


            <button
                type="submit"
                class="btn soporte-btn-save"
                id="btnSave"
            >
                Guardar Mensaje
            </button>

        </form>

    </div>

</div>


<script>
    const BASE_URL = "<?= BASE_URL ?>";
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="<?= ROOT_URL ?>js/contacto.js"></script>

<?php require_once '../app/views/layouts/footer.php'; ?>