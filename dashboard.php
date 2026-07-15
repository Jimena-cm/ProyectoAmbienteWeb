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
    <title>Dashboard</title>
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
                        <a class="nav-link active" aria-current="page" href="dashboard.php">
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


    <main class="cdp-inicio">

        <section class="cdp-hero">
            <div class="container">
                <p class="cdp-hero-eyebrow">Fundición Jiménez · Desde 1990</p>
                <h1 class="cdp-hero-title">Placas que <span>conservan la memoria</span></h1>

                <div id="cdpCarruselPlacas" class="carousel slide cdp-carousel" data-bs-ride="carousel">
                    <div class="carousel-inner">


                        <div class="carousel-item active">
                            <div class="cdp-plaque">
                                <span class="cdp-plaque-tag">Reconocimiento</span>
                                <div class="cdp-plaque-photo-placeholder"><i class="bi bi-person-fill"></i></div>
                                <p class="cdp-plaque-name">Ejemplo de Placa Conmemorativa</p>
                                <p class="cdp-plaque-dates">1950 - 2024</p>
                                <p class="cdp-plaque-epitaph">"Un espacio para honrar la memoria de quienes marcaron
                                    nuestras vidas."</p>
                            </div>
                        </div>

                        <div class="carousel-item">
                            <div class="cdp-plaque">
                                <span class="cdp-plaque-tag">Empresarial</span>
                                <div class="cdp-plaque-photo-placeholder"><i class="bi bi-award-fill"></i></div>
                                <p class="cdp-plaque-name">Reconocimiento a Trayectoria</p>
                                <p class="cdp-plaque-dates">Entregado en el 2026</p>
                                <p class="cdp-plaque-epitaph">"Placas grabadas para logros, aniversarios y hitos
                                    importantes."</p>
                            </div>
                        </div>

                        <div class="carousel-item">
                            <div class="cdp-plaque">
                                <span class="cdp-plaque-tag">Mascotas</span>
                                <div class="cdp-plaque-photo-placeholder"><i class="bi bi-heart-fill"></i></div>
                                <p class="cdp-plaque-name">Placa para Mascota</p>
                                <p class="cdp-plaque-dates">Siempre en casa</p>
                                <p class="cdp-plaque-epitaph">"Detalles personalizados para recordar a tu compañero
                                    fiel."</p>
                            </div>
                        </div>

                    </div>

                    <button class="carousel-control-prev" type="button" data-bs-target="#cdpCarruselPlacas"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Anterior</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#cdpCarruselPlacas"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Siguiente</span>
                    </button>

                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#cdpCarruselPlacas" data-bs-slide-to="0" class="active"
                            aria-current="true" aria-label="Placa 1"></button>
                        <button type="button" data-bs-target="#cdpCarruselPlacas" data-bs-slide-to="1"
                            aria-label="Placa 2"></button>
                        <button type="button" data-bs-target="#cdpCarruselPlacas" data-bs-slide-to="2"
                            aria-label="Placa 3"></button>
                    </div>
                </div>
            </div>
        </section>

        <section class="cdp-servicios">
            <div class="container">
                <p class="cdp-section-eyebrow">Qué puedes hacer aquí</p>
                <h2 class="cdp-section-title">Tres formas de crear tu placa</h2>

                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="cdp-servicio-card">
                            <div class="cdp-servicio-icono"><i class="bi bi-brush"></i></div>
                            <h3>Arma tu placa</h3>
                            <p>Personaliza completamente tu placa conmemorativa o de reconocimiento. Elige material,
                                tamaño, forma, tipografía, íconos y mensaje, visualizando cada cambio en tiempo real.
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="cdp-servicio-card">
                            <div class="cdp-servicio-icono"><i class="bi bi-award"></i></div>
                            <h3>Reconocimientos</h3>
                            <p>Crea placas destinadas a celebrar logros, méritos o agradecimientos. Selecciona modelos
                                predefinidos, personaliza mensajes y añade elementos decorativos.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="cdp-servicio-card">
                            <div class="cdp-servicio-icono"><i class="bi bi-heart"></i></div>
                            <h3>Placas para mascotas</h3>
                            <p>Diseña placas identificativas o conmemorativas para tus animales. Elige forma, tamaño,
                                material y grabado, además de íconos relacionados con mascotas.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="cdp-historia">
            <div class="cdp-historia-inner">
                <div class="cdp-historia-marca">
                    <span class="cdp-historia-quote"></span>
                    <h2>Nuestra historia</h2>
                    <p class="cdp-tagline">Concepción Arriba de Alajuelita, desde 1990</p>
                </div>
                <div class="cdp-historia-texto">
                    <p>
                        "Fundición Jiménez" y "La Casa de la Placa" son empresas familiares fundadas
                        en los años 90 en Concepción Arriba de Alajuelita, por el señor Jorge Jiménez
                        Jiménez, como necesidad para sobrevivir y solventar la necesidad de placas
                        conmemorativas de la zona y reconocimientos empresariales y estudiantiles.
                        "La Casa de la Placa" fue creada como solución a la alta demanda de placas
                        conmemorativas en pandemia, ya que los dueños actuales se dieron cuenta de que
                        no daban abasto recibiendo solicitudes y produciendo. Separando las ventas de
                        la producción lograron establecer una línea de negocio continua y sin problemas
                        para recibir solicitudes.
                    </p>
                </div>
            </div>
        </section>

    </main>

    <footer class="cdp-footer">
        <div class="container py-5">

            <div class="cdp-footer-brand text-center">
                <p class="cdp-footer-copy">COPYRIGHT © 2026 LA CASA DE LA PLACA</p>
                <p class="cdp-footer-tagline">Placas que conservan la memoria.</p>
            </div>

            <div class="cdp-footer-social mb-2 text-center">
                <a href="https://www.facebook.com/share/1L1eFBMFed/" class="cdp-social-btn text-decoration-none" aria-label="Facebook">
                    <i class="bi bi-facebook"></i>
                </a>
                <a href="https://www.instagram.com/lacasadelaplaca?igsh=MTg2ZHVrM3FrZ2Z4cg==" class="cdp-social-btn text-decoration-none" aria-label="Instagram">
                    <i class="bi bi-instagram"></i>
                </a>
                <a href="https://api.whatsapp.com/send?phone=50664160187" class="cdp-social-btn text-decoration-none" aria-label="Whatsapp">
                    <i class="bi bi-whatsapp"></i>
                </a>
            </div>

        </div>
    </footer>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


    <script src="./js/inicio.js">
    </script>


</body>

</html>