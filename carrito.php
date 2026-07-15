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
    <title>Carrito</title>
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
                        <a class="nav-link active" aria-current="page" href="carrito.php">
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
    <main class="cdp-page">
        <section class="cdp-carrito">
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSIHWwyVSogX0PYkNxSFNOWEWXY5E4GiVmwXQySHbq_ciJbt6FrTJaAwrqK&s=10" class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">Acero Cepillado Moderno</h5>
                            <p class="card-text">Placa en acero inoxidable cepillado, resistente a la intemperie. Acabado industrial elegante, recomendado para exteriores y placas identificativas duraderas.</p>
                            <div class="cantidad-precio">
                                <div class="cantidad-carrito">
                                    <button class="btn-restar">-</button>
                                    <span id="cantidad">1</span>
                                    <button class="btn-aumentar">+</button>
                                </div>
                                <p class="precio">₡82 500</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-3" style="max-width: 540px;">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSIHWwyVSogX0PYkNxSFNOWEWXY5E4GiVmwXQySHbq_ciJbt6FrTJaAwrqK&s=10" class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">Cristal Esmerilado Pro</h5>
                            <p class="card-text">Placa en vidrio esmerilado con grabado interno de alta definición. Un estilo moderno y minimalista, ideal para espacios corporativos contemporáneos.</p>
                            <div class="cantidad-precio">
                                <div class="cantidad-carrito">
                                    <button class="btn-restar">-</button>
                                    <span id="cantidad">1</span>
                                    <button class="btn-aumentar">+</button>
                                </div>
                                <p class="precio">₡105 000</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>

        <section class="cpd-pago">
            <div class="cdp-total">
                <div class="card mb-3" id="card-total">
                    <div class="row g-0">
                        <div class="card-body">
                            <div class="precio-pagar">
                                <span>Subtotal:</span>
                                <span>₡187 500</span>
                            </div>
                            <div class="precio-pagar">
                                <span>Impuestos:</span>
                                <span>₡2 000</span>
                            </div>
                            <div class="total-precio">
                                <span class="total">Total:</span>
                                <span class="total">₡189 500</span>
                            </div>
                            <div class="container-btn">
                                <button class="btn-total">PAGAR</button>
                            </div>
                        </div>
                    </div>
                </div>
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

            <!-- NOTA: reemplaza estos enlaces por las redes reales del negocio -->
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

    <script src="./js/catalogo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>