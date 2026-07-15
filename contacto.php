<?php
session_start();

require_once "./backend/conexion.php";


$stmt = $pdo->prepare(
    "SELECT profile_image
     FROM users
     WHERE id = ?"
);

$stmt->execute([
    $_SESSION["user_id"]
]);

$usuarioActual = $stmt->fetch(PDO::FETCH_ASSOC);


$fotoPerfil = $usuarioActual["profile_image"] ?? "";


if ($fotoPerfil === "" || $fotoPerfil === "usuario.jpg") {

    $rutaFoto = "./img/usuario.jpg";

} else {

    $rutaFoto = "./uploads/" . $fotoPerfil;

}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">
</head>

<body class="home-body">
    <nav class="navbar navbar-expand-lg navbar-casa">

        <div class="container-fluid">

            <a class="navbar-brand d-flex align-items-center gap-2" href="dashboard.php">
                <img src="./img/logo.jpg" alt="Logo de La Casa de la Placa" class="navbar-logo">
                <span>
                    LA CASA DE LA PLACA
                </span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Abrir menú">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNavDropdown">

                <ul class="navbar-nav ms-auto align-items-lg-center">

                    <li class="nav-item">
                        <a class="nav-link"  href="dashboard.php">
                            Inicio
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link"  href="catalogo.php">
                            Catalogo
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link"  href="disenar.php">
                            Diseñar
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="historial.php">
                            Mi historial
                        </a>
                    </li>

                    <li class="nav-item dropdown">

                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Atención al cliente
                        </a>

                        <ul class="dropdown-menu">

                            <li>
                                <a class="dropdown-item" href="faq.php">
                                    Preguntas frecuentes
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item" href="contacto.php">
                                    Contacto
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item" href="ubicacion.php">
                                    Ubicación
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item" href="resenas.php">
                                    Reseñas
                                </a>
                            </li>
                        </ul>

                        <li class="nav-item">
                        <a class="nav-link"  href="carrito.php">
                            Carrito
                        </a>
                    </li>

                    </li>

                    <!-- Mi cuenta -->
                    <li class="nav-item dropdown ms-lg-3">

                        <a class="nav-link dropdown-toggle cuenta-menu" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">

                            <img src="<?= htmlspecialchars($rutaFoto) ?>" alt="Foto del usuario" class="cuenta-imagen">

                            <span class="cuenta-info">
                                <small>
                                    Mi cuenta
                                </small>
                                <strong>
                                    <?= htmlspecialchars($_SESSION["user_name"]) ?>
                                </strong>
                            </span>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="perfil.php">
                                    Información de mi cuenta
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item" href="historial.php">
                                    Mis pedidos
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item" href="contacto.php">
                                    Atención al cliente
                                </a>
                            </li>

                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <li>
                                <a class="dropdown-item text-danger" href="backend/logout.php">
                                    Cerrar sesión
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>

        </div>
    </nav>

    <main class="contact-page">

        <section class="contact-container">

            
            <div class="contact-header">
                <img
                    src="./img/logo.jpg"
                    alt="Logo de La Casa de la Placa"
                    class="contact-logo"
                >

                <span>ATENCIÓN AL CLIENTE</span>

                <h1>Estamos para ayudarte</h1>

                <p>
                    Envíanos tu consulta y nuestro equipo se pondrá
                    en contacto contigo.
                </p>
            </div>


            <div class="contact-grid">

                
                <div class="contact-info">

                    <h2>Información de contacto</h2>

                    <p class="contact-description">
                        ¿Tienes alguna consulta sobre nuestros productos
                        o pedidos? Comunícate con nosotros.
                    </p>

                    <div class="contact-detail">
                        <strong>Correo electrónico</strong>
                        <span>lacasadelaplaca@correo.com</span>
                    </div>

                    <div class="contact-detail">
                        <strong>Teléfono</strong>
                        <span>+506 8888-8888</span>
                    </div>

                    <div class="contact-detail">
                        <strong>Horario de atención</strong>
                        <span>Lunes a sábado</span>
                        <span>8:00 a.m. - 6:00 p.m.</span>
                    </div>

                    <div class="contact-detail">
                        <strong>Ubicación</strong>

                        <a href="ubicacion.php">
                            Ver nuestra ubicación →
                        </a>
                    </div>


                    <!-- Redes sociales PENDIENTE-->
                    <div class="social-section">

                        <h3>Síguenos</h3>

                        <div class="social-links">

                            <a href="#" class="social-link">
                                Facebook
                            </a>

                            <a href="#" class="social-link">
                                Instagram
                            </a>

                            <a href="#" class="social-link">
                                WhatsApp
                            </a>

                        </div>

                    </div>

                </div>


               
                <div class="contact-form-card">

                    <h2>Envíanos un mensaje</h2>

                    <p>
                        Completa el formulario y atenderemos tu consulta.
                    </p>

                    <form id="frmContacto">

                        <div class="mb-3">

                            <label
                                for="nombre"
                                class="form-label"
                            >
                                Nombre completo
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                id="nombre"
                                name="nombre"
                                placeholder="Tu nombre"
                                required
                            >

                        </div>


                        <div class="mb-3">

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
                                placeholder="correo@ejemplo.com"
                                required
                            >

                        </div>


                        <div class="mb-3">

                            <label
                                for="mensaje"
                                class="form-label"
                            >
                                Mensaje
                            </label>

                            <textarea
                                class="form-control"
                                id="mensaje"
                                name="mensaje"
                                rows="6"
                                placeholder="¿Cómo podemos ayudarte?"
                                required
                            ></textarea>

                        </div>


                        <div
                            id="msgContacto"
                            class="mb-3"
                        ></div>


                        <button
                            type="submit"
                            class="btn btn-primary w-100 p-2"
                        >
                            ENVIAR MENSAJE
                        </button>

                    </form>

                </div>

            </div>


            <div class="text-center mt-4">

                <a
                    href="dashboard.php"
                    class="contact-back"
                >
                     Volver al panel
                </a>

            </div>

        </section>

    </main>


    <script src="./js/contacto.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>