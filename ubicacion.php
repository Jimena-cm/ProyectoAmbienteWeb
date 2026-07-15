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
    <title>Ubicación</title>
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


    <main class="location-page">

        <section class="location-container">

          
            <div class="location-header">

                <img
                    src="./img/logo.jpg"
                    alt="Logo de La Casa de la Placa"
                    class="location-logo"
                >

                <span>NUESTRA UBICACIÓN</span>

                <h1>Visítanos</h1>

                <p>
                    Encuentra fácilmente nuestras instalaciones y conoce
                    nuestro horario de atención.
                </p>

            </div>


            
            <div class="location-grid">

              
                <div class="location-info">

                    <h2>La Casa de la Placa</h2>

                    <p class="location-description">
                        Estamos para atenderte y ayudarte con tus consultas,
                        pedidos y productos personalizados.
                    </p>


                    <div class="location-detail">

                        <strong>Ubicación</strong>

                        <span>
                            Costa Rica
                        </span>

                    </div>


                    <div class="location-detail">

                        <strong>Horario de atención</strong>

                        <span>
                            Lunes a sábado
                        </span>

                        <span>
                            8:00 a.m. - 6:00 p.m.
                        </span>

                    </div>


                    <div class="location-detail">

                        <strong>Teléfono</strong>

                        <span>
                            +506 8888-8888
                        </span>

                    </div>


                    <div class="location-detail">

                        <strong>Correo electrónico</strong>

                        <span>
                            lacasadelaplaca@correo.com
                        </span>

                    </div>


                    <a
                        href="contacto.php"
                        class="btn btn-primary location-contact-button"
                    >
                        CONTACTARNOS
                    </a>

                </div>


                <!-- Mapa  de google-->
                <div class="location-map">

                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3930.5370296247293!2d-84.0859919!3d9.889153099999998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8fa0e39d5ec6795d%3A0x28e8a1dffcc8764e!2sLa%20Casa%20de%20las%20placas%2F%20Fundici%C3%B3n%20Jim%C3%A9nez!5e0!3m2!1ses-419!2scr!4v1784010692876!5m2!1ses-419!2scr"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="strict-origin-when-cross-origin">
                    </iframe>

                </div>

            </div>


            
            <div class="text-center mt-4">

                <a
                    href="dashboard.php"
                    class="location-back">
                     Volver al panel
                </a>

            </div>

        </section>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>