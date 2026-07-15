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
    <title>Diseñar</title>
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
                        <a class="nav-link active" aria-current="page" href="disenar.php">
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

    <main class="cdp-page">
        <section class="cdp-disenar">
            <div class="row">
                <div class="col-md-6">
                    <div class="card" id="disenar-card">
                        <h3 class="titulo-disenar">Diseñe su Placa</h3>
                    </div>
                    <div class="card" id="disenar-card">
                        <div class="form-disenar">
                            <form class="frm-disenar">
                                <label class="categorias">Categorías: </label>
                                <select id="categorias">
                                    <option value="seleccionar">---Seleccionar---</option>
                                    <option value="vidrio">Vidrio - ₡30 000</option>
                                    <option value="marmol">Mármol - ₡35 000</option>
                                    <option value="acrílico">Acrílico - ₡20 000</option>
                                    <option value="aluminio">Aluminio - ₡25 000</option>
                                </select>
                            </form>
                        </div>
                    </div>
                    <div class="card" id="disenar-card">
                        <div class="form-disenar">
                            <form class="frm-disenar">
                                <label class="tamano">Tamaños: </label>
                                <select id="tamano">
                                    <option value="seleccionar">---Seleccionar---</option>
                                    <option value="tamano1">20x20 - ₡20 000</option>
                                    <option value="tamano2">20x30 - ₡30 000</option>
                                    <option value="tamano3">30x30 - ₡35 000</option>
                                    <option value="tamano4">30x40 - ₡45 000</option>
                                </select>
                            </form>
                        </div>
                    </div>
                    <div class="card" id="disenar-card">
                        <div class="form-disenar">
                            <form class="frm-disenar">
                                <label class="mensaje">Mensaje: </label>
                                <textarea class="texto-placa" placeholder="Ingrese su mensaje."></textarea>
                            </form>
                        </div>
                    </div>
                    <div class="card" id="disenar-card">
                        <div class="form-disenar">
                            <form class="frm-disenar">
                                <label class="imagen">Imagen: </label>
                                <input class="file-disenar" type="file">
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-1"></div>

                <div class="col-md-5">
                    <div class="card">
                        <div class="imagen-placa">
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSIHWwyVSogX0PYkNxSFNOWEWXY5E4GiVmwXQySHbq_ciJbt6FrTJaAwrqK&s=10" class="card-img-top" alt="...">
                        </div>
                        <div class="card-body">
                            <h3>Resumen</h3>
                            <div class="precio-pagar">
                                <span>Categoría: </span>
                                <span>Vidrio - ₡30 000</span>
                            </div>

                            <div class="precio-pagar">
                                <span>Tamaño: </span>
                                <span>20x20 - ₡20 000</span>
                            </div>
                            <div class="precio-pagar">
                                <span>Impuestos:</span>
                                <span>₡189 500</span>
                            </div>
                            <div class="precio-pagar">
                                <span>Subtotal:</span>
                                <span>₡189 500</span>
                            </div>
                            <div class="total-precio">
                                <span class="total">Total:</span>
                                <span class="total">₡189 500</span>
                            </div>

                            <div class="container-btn">
                                <button class="btn-total">Añadir al Carrito</button>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>