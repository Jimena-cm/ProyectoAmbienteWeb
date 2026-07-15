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
    <title>Preguntas Frecuentes</title>
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
                        <a class="nav-link" href="dashboard.php">
                            Inicio
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="catalogo.php">
                            Catalogo
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="disenar.php">
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
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="carrito.php">
                            Carrito
                        </a>
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

    <main class="faq-page">

        <section class="faq-container">


            <div class="faq-header">

                <img
                    src="./img/logo.jpg"
                    alt="Logo de La Casa de la Placa"
                    class="faq-logo">

                <span class="faq-label">
                    CENTRO DE AYUDA
                </span>

                <h1>Preguntas frecuentes</h1>

                <p>
                    Encuentra respuestas rápidas sobre nuestros productos,
                    pedidos y servicios.
                </p>

            </div>

            <!-- Preguntas -->
            <div class="accordion faq-accordion" id="faqAccordion">

                <!-- Pregunta 1 -->
                <div class="accordion-item">

                    <h2 class="accordion-header">

                        <button
                            class="accordion-button"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#pregunta1">
                            ¿Cuánto tarda la fabricación de una placa?
                        </button>

                    </h2>

                    <div
                        id="pregunta1"
                        class="accordion-collapse collapse show"
                        data-bs-parent="#faqAccordion">

                        <div class="accordion-body">
                            El tiempo de fabricación depende del tipo de placa
                            y del nivel de personalización solicitado. Te
                            informaremos el tiempo estimado al confirmar tu pedido.
                        </div>

                    </div>

                </div>


                <!-- Pregunta 2 -->
                <div class="accordion-item">

                    <h2 class="accordion-header">

                        <button
                            class="accordion-button collapsed"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#pregunta2">
                            ¿Puedo personalizar mi placa?
                        </button>

                    </h2>

                    <div
                        id="pregunta2"
                        class="accordion-collapse collapse"
                        data-bs-parent="#faqAccordion">

                        <div class="accordion-body">
                            Sí. Contamos con diferentes opciones de
                            personalización según el producto disponible.
                        </div>

                    </div>

                </div>


                <!-- Pregunta 3 -->
                <div class="accordion-item">

                    <h2 class="accordion-header">

                        <button
                            class="accordion-button collapsed"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#pregunta3">
                            ¿Cómo puedo consultar el estado de mi pedido?
                        </button>

                    </h2>

                    <div
                        id="pregunta3"
                        class="accordion-collapse collapse"
                        data-bs-parent="#faqAccordion">

                        <div class="accordion-body">
                            Puedes consultar tus pedidos desde la sección
                            <strong>Mi Historial</strong> dentro de tu cuenta.
                        </div>

                    </div>

                </div>


                <!-- Pregunta 4 -->
                <div class="accordion-item">

                    <h2 class="accordion-header">

                        <button
                            class="accordion-button collapsed"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#pregunta4">
                            ¿Realizan envíos?
                        </button>

                    </h2>

                    <div
                        id="pregunta4"
                        class="accordion-collapse collapse"
                        data-bs-parent="#faqAccordion">

                        <div class="accordion-body">
                            Sí. Las opciones de entrega pueden variar según
                            la ubicación del cliente.
                        </div>

                    </div>

                </div>


                <!-- Pregunta 5 -->
                <div class="accordion-item">

                    <h2 class="accordion-header">

                        <button
                            class="accordion-button collapsed"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#pregunta5">
                            ¿Qué hago si necesito ayuda con mi pedido?
                        </button>

                    </h2>

                    <div
                        id="pregunta5"
                        class="accordion-collapse collapse"
                        data-bs-parent="#faqAccordion">

                        <div class="accordion-body">
                            Puedes comunicarte con nosotros mediante nuestro
                            formulario de contacto y nuestro equipo te ayudará.
                        </div>

                    </div>

                </div>

            </div>


            <div class="faq-help">

                <div>
                    <h3>¿No encontraste tu respuesta?</h3>

                    <p>
                        Nuestro equipo de atención al cliente está para ayudarte.
                    </p>
                </div>

                <a
                    href="contacto.php"
                    class="btn btn-primary">
                    CONTACTARNOS
                </a>

            </div>


            <div class="text-center mt-4">

                <a
                    href="dashboard.php"
                    class="faq-back">
                    Volver al panel
                </a>

            </div>

        </section>

    </main>



    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>