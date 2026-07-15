<?php

session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: index.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Mi Cuenta | La Casa de la Placa</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link
        rel="stylesheet"
        href="./css/style.css"
    >

</head>

<body>

    <main class="account-page">

        <div class="account-container">


           

            <section class="account-header">

                <img
                    src="./img/usuario.jpg"
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
                    href="historial.php"
                    class="account-action-card"
                >

                    <strong>Mis pedidos</strong>

                    <span>
                        Consulta el historial de tu cuenta →
                    </span>

                </a>


                <a
                    href="contacto.php"
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
                            Actualiza tus datos personales y tu foto.
                        </p>

                    </div>

                </div>


                <form id="frmPerfil">


                    <!-- Foto -->

                    <div class="profile-image-section">

                        <img
                            src="./img/usuario.jpg"
                            alt="Foto de perfil"
                            id="profilePreview"
                            class="profile-user-image"
                        >


                        <div class="profile-image-info">

                            <label
                                for="profile_image"
                                class="form-label"
                            >
                                Foto de perfil
                            </label>


                            <input
                                type="file"
                                class="form-control"
                                id="profile_image"
                                name="profile_image"
                                accept="image/jpeg, image/png, image/webp"
                            >


                            <small class="text-muted">
                                JPG, PNG o WEBP. Máximo 2 MB.
                            </small>

                        </div>

                    </div>


                    <div class="account-form-grid">


                        <div>

                            <label
                                for="name"
                                class="form-label"
                            >
                                Nombre completo
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                id="name"
                                name="name"
                                required
                            >

                        </div>


                        <div>

                            <label
                                for="email"
                                class="form-label"
                            >
                                Correo electrónico
                            </label>

                            <input
                                type="email"
                                class="form-control"
                                id="email"
                                name="email"
                                required
                            >

                        </div>


                        <div>

                            <label
                                for="phone"
                                class="form-label"
                            >
                                Teléfono
                            </label>

                            <input
                                type="tel"
                                class="form-control"
                                id="phone"
                                name="phone"
                            >

                        </div>


                        <div>

                            <label
                                for="address"
                                class="form-label"
                            >
                                Dirección
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                id="address"
                                name="address"
                            >

                        </div>


                    </div>


                    <div
                        id="msgPerfil"
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
                    href="dashboard.php"
                    class="account-back"
                >
                     Volver al inicio
                </a>

            </div>


        </div>

    </main>


    <script src="./js/perfil.js"></script>

</body>

</html>