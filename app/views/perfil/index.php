<?php
$pageTitle = 'Mi Perfil | La Casa de la Placa';
$activePage = 'perfil';

require_once '../app/views/layouts/header.php';
?>

<div class="account-page">

    <div class="account-container">

        <section class="account-header">

            <img
                src="<?= BASE_URL ?>img/usuario.jpg"
                alt="Foto de perfil"
                id="profileMainImage"
                class="account-profile-image"
            >

            <div class="account-header-info">

                <span>MI CUENTA</span>

                <h1 id="accountName">
                    Cargando...
                </h1>

                <p id="accountEmail">
                    Cargando información...
                </p>

            </div>

        </section>


        <section class="account-summary">

            <div class="summary-card">

                <span class="summary-number" id="totalPedidos">
                    0
                </span>

                <p>Pedidos realizados</p>

            </div>


            <div class="summary-card">

                <span class="summary-title">
                    Cliente desde
                </span>

                <p id="fechaRegistro">
                    --
                </p>

            </div>


            <div class="summary-card">

                <span class="summary-title">
                    Estado
                </span>

                <p class="account-active">
                    Cuenta activa
                </p>

            </div>

        </section>


        <section class="account-info-section">

            <div class="account-section-title">

                <div>

                    <span>DATOS PERSONALES</span>

                    <h2>Información de mi cuenta</h2>

                </div>

            </div>


            <div class="account-info-grid">

                <div class="account-info-item">

                    <span>Nombre completo</span>

                    <strong id="infoName">
                        --
                    </strong>

                </div>


                <div class="account-info-item">

                    <span>Correo electrónico</span>

                    <strong id="infoEmail">
                        --
                    </strong>

                </div>


                <div class="account-info-item">

                    <span>Teléfono</span>

                    <strong id="infoPhone">
                        --
                    </strong>

                </div>


                <div class="account-info-item">

                    <span>Dirección</span>

                    <strong id="infoAddress">
                        --
                    </strong>

                </div>

            </div>

        </section>


        <section class="account-actions">

            <a
                href="<?= BASE_URL ?>pedido/historial"
                class="account-action-card"
            >

                <strong>Mis pedidos</strong>

                <span>
                    Consulta el historial de tu cuenta →
                </span>

            </a>


            <a
                href="<?= BASE_URL ?>contacto"
                class="account-action-card"
            >

                <strong>Atención al cliente</strong>

                <span>
                    Comunícate con nuestro equipo →
                </span>

            </a>

        </section>


        <section class="account-edit-section">

            <div class="account-section-title">

                <div>

                    <span>CONFIGURACIÓN</span>

                    <h2>Editar información</h2>

                    <p>
                        Actualiza tus datos personales.
                    </p>

                </div>

            </div>


            <div id="perfilLoader" class="loader-container">
                <div class="spinner"></div>
            </div>


            <form id="perfilForm" class="hidden">

                <div class="account-form-grid">

                    <div>

                        <label
                            for="perfilName"
                            class="form-label"
                        >
                            Nombre completo
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            id="perfilName"
                            name="name"
                            required
                        >

                    </div>


                    <div>

                        <label
                            for="perfilEmail"
                            class="form-label"
                        >
                            Correo electrónico
                        </label>

                        <input
                            type="email"
                            class="form-control"
                            id="perfilEmail"
                            name="email"
                            required
                        >

                    </div>


                    <div>

                        <label
                            for="perfilPhone"
                            class="form-label"
                        >
                            Teléfono
                        </label>

                        <input
                            type="tel"
                            class="form-control"
                            id="perfilPhone"
                            name="phone"
                        >

                    </div>


                    <div>

                        <label
                            for="perfilAddress"
                            class="form-label"
                        >
                            Dirección
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            id="perfilAddress"
                            name="address"
                        >

                    </div>


                    <div>

                        <label
                            for="perfilPassword"
                            class="form-label"
                        >
                            Contraseña
                        </label>

                        <input
                            type="password"
                            class="form-control"
                            id="perfilPassword"
                            name="password"
                            placeholder="Dejar en blanco para no cambiar"
                        >

                        <small class="text-muted">
                            Dejar en blanco para mantener la contraseña actual.
                        </small>

                    </div>

                </div>


                <div
                    id="perfilMessage"
                    class="mt-3"
                ></div>


                <button
                    type="submit"
                    class="btn btn-primary account-save-button"
                >
                    GUARDAR CAMBIOS
                </button>

            </form>

        </section>


        <div class="text-center mt-4">

            <a
                href="<?= BASE_URL ?>dashboard"
                class="account-back"
            >
                Volver al inicio
            </a>

        </div>

    </div>

</div>


<script>
    const BASE_URL = "<?= BASE_URL ?>";
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="<?= ROOT_URL ?>js/perfil.js"></script>

<?php require_once '../app/views/layouts/footer.php'; ?>