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
    <title>Catalogo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="/ProyectoAmbienteWeb/public/css/style.css">
</head>

<body class="home-body">
    <nav class="navbar navbar-expand-lg navbar-casa">

        <div class="container-fluid">

            <a class="navbar-brand d-flex align-items-center gap-2" href="dashboard.php">
                <img src="public/img/logo.jpg" alt="Logo de La Casa de la Placa" class="navbar-logo">
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
                        <a class="nav-link active" aria-current="page" href="catalogo.php">
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

                            <img src="public/img/usuario.jpg" alt="Foto del usuario" class="cuenta-imagen">

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
        <section class="cdp-catalogo">
            <div class="container py-5">

                <div class="input-group input-group-lg cdp-buscador mb-4">
                    <span class="input-group-text bg-white border-end-0">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="text" id="cdpBuscarPlaca" class="form-control border-start-0"
                        placeholder="Buscar placas premium...">
                </div>

                <div class="d-flex flex-wrap gap-2 mb-4 cdp-filtros" id="cdpFiltros">
                    <button type="button" class="btn btn-sm rounded-pill cdp-filtro active" data-filtro="todos">
                        <i class="bi bi-sliders me-1"></i> Todas las colecciones
                    </button>
                    <button type="button" class="btn btn-sm rounded-pill cdp-filtro" data-filtro="bronce">Bronce</button>
                    <button type="button" class="btn btn-sm rounded-pill cdp-filtro" data-filtro="madera">Nogal /
                        Madera</button>
                    <button type="button" class="btn btn-sm rounded-pill cdp-filtro" data-filtro="vidrio">Vidrio
                        Esmerilado</button>
                    <button type="button" class="btn btn-sm rounded-pill cdp-filtro" data-filtro="acero">Acero
                        Cepillado</button>
                </div>

                <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4 g-4" id="cdpGridProductos">


                    <div class="col cdp-producto" data-material="bronce" data-nombre="Placa de Bronce Clásica"
                        data-precio="₡92 500" data-imagen=""
                        data-descripcion="Placa conmemorativa en bronce fundido, acabado clásico envejecido. Ideal para reconocimientos institucionales y homenajes de larga duración. Grabado láser de alta precisión.">
                        <div class="card cdp-producto-card h-100">
                            <div class="cdp-producto-img-wrap">
                                <img src="" class="card-img-top" alt="Placa de Bronce Clásica">
                            </div>
                            <div class="card-body d-flex flex-column">
                                <p class="cdp-producto-nombre">Placa de Bronce Clásica</p>
                                <div class="d-flex justify-content-between align-items-center mt-auto">
                                    <span class="cdp-producto-precio">₡92 500</span>
                                    <button class="btn btn-sm rounded-circle cdp-btn-agregar" title="Ver detalle"
                                        data-bs-toggle="modal" data-bs-target="#cdpModalDetalle">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col cdp-producto" data-material="madera" data-nombre="Nogal Imperial Gold"
                        data-precio="₡120 000" data-imagen=""
                        data-descripcion="Placa en madera de nogal con detalles grabados en tono dorado. Un acabado cálido y elegante, perfecto para reconocimientos de trayectoria o logros destacados.">
                        <div class="card cdp-producto-card h-100">
                            <div class="cdp-producto-img-wrap">
                                <img src="" class="card-img-top" alt="Nogal Imperial Gold">
                            </div>
                            <div class="card-body d-flex flex-column">
                                <p class="cdp-producto-nombre">Nogal Imperial Gold</p>
                                <div class="d-flex justify-content-between align-items-center mt-auto">
                                    <span class="cdp-producto-precio">₡120 000</span>
                                    <button class="btn btn-sm rounded-circle cdp-btn-agregar" title="Ver detalle"
                                        data-bs-toggle="modal" data-bs-target="#cdpModalDetalle">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col cdp-producto" data-material="vidrio" data-nombre="Cristal Esmerilado Pro"
                        data-precio="₡105 000" data-imagen=""
                        data-descripcion="Placa en vidrio esmerilado con grabado interno de alta definición. Un estilo moderno y minimalista, ideal para espacios corporativos contemporáneos.">
                        <div class="card cdp-producto-card h-100">
                            <div class="cdp-producto-img-wrap">
                                <img src="" class="card-img-top" alt="Cristal Esmerilado Pro">
                            </div>
                            <div class="card-body d-flex flex-column">
                                <p class="cdp-producto-nombre">Cristal Esmerilado Pro</p>
                                <div class="d-flex justify-content-between align-items-center mt-auto">
                                    <span class="cdp-producto-precio">₡105 000</span>
                                    <button class="btn btn-sm rounded-circle cdp-btn-agregar" title="Ver detalle"
                                        data-bs-toggle="modal" data-bs-target="#cdpModalDetalle">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col cdp-producto" data-material="acero" data-nombre="Acero Cepillado Moderno"
                        data-precio="₡82 500" data-imagen=""
                        data-descripcion="Placa en acero inoxidable cepillado, resistente a la intemperie. Acabado industrial elegante, recomendado para exteriores y placas identificativas duraderas.">
                        <div class="card cdp-producto-card h-100">
                            <div class="cdp-producto-img-wrap">
                                <img src="" class="card-img-top" alt="Acero Cepillado Moderno">
                            </div>
                            <div class="card-body d-flex flex-column">
                                <p class="cdp-producto-nombre">Acero Cepillado Moderno</p>
                                <div class="d-flex justify-content-between align-items-center mt-auto">
                                    <span class="cdp-producto-precio">₡82 500</span>
                                    <button class="btn btn-sm rounded-circle cdp-btn-agregar" title="Ver detalle"
                                        data-bs-toggle="modal" data-bs-target="#cdpModalDetalle">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col cdp-producto" data-material="acero" data-nombre="Acero Cepillado Moderno"
                        data-precio="₡82 500" data-imagen=""
                        data-descripcion="Placa en acero inoxidable cepillado, resistente a la intemperie. Acabado industrial elegante, recomendado para exteriores y placas identificativas duraderas.">
                        <div class="card cdp-producto-card h-100">
                            <div class="cdp-producto-img-wrap">
                                <img src="" class="card-img-top" alt="Acero Cepillado Moderno">
                            </div>
                            <div class="card-body d-flex flex-column">
                                <p class="cdp-producto-nombre">Acero Cepillado Moderno</p>
                                <div class="d-flex justify-content-between align-items-center mt-auto">
                                    <span class="cdp-producto-precio">₡82 500</span>
                                    <button class="btn btn-sm rounded-circle cdp-btn-agregar" title="Ver detalle"
                                        data-bs-toggle="modal" data-bs-target="#cdpModalDetalle">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col cdp-producto" data-material="acero" data-nombre="Acero Cepillado Moderno"
                        data-precio="₡82 500" data-imagen=""
                        data-descripcion="Placa en acero inoxidable cepillado, resistente a la intemperie. Acabado industrial elegante, recomendado para exteriores y placas identificativas duraderas.">
                        <div class="card cdp-producto-card h-100">
                            <div class="cdp-producto-img-wrap">
                                <img src="" class="card-img-top" alt="Acero Cepillado Moderno">
                            </div>
                            <div class="card-body d-flex flex-column">
                                <p class="cdp-producto-nombre">Acero Cepillado Moderno</p>
                                <div class="d-flex justify-content-between align-items-center mt-auto">
                                    <span class="cdp-producto-precio">₡82 500</span>
                                    <button class="btn btn-sm rounded-circle cdp-btn-agregar" title="Ver detalle"
                                        data-bs-toggle="modal" data-bs-target="#cdpModalDetalle">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col cdp-producto" data-material="acero" data-nombre="Acero Cepillado Moderno"
                        data-precio="₡82 500" data-imagen=""
                        data-descripcion="Placa en acero inoxidable cepillado, resistente a la intemperie. Acabado industrial elegante, recomendado para exteriores y placas identificativas duraderas.">
                        <div class="card cdp-producto-card h-100">
                            <div class="cdp-producto-img-wrap">
                                <img src="" class="card-img-top" alt="Acero Cepillado Moderno">
                            </div>
                            <div class="card-body d-flex flex-column">
                                <p class="cdp-producto-nombre">Acero Cepillado Moderno</p>
                                <div class="d-flex justify-content-between align-items-center mt-auto">
                                    <span class="cdp-producto-precio">₡82 500</span>
                                    <button class="btn btn-sm rounded-circle cdp-btn-agregar" title="Ver detalle"
                                        data-bs-toggle="modal" data-bs-target="#cdpModalDetalle">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col cdp-producto" data-material="acero" data-nombre="Acero Cepillado Moderno"
                        data-precio="₡82 500" data-imagen=""
                        data-descripcion="Placa en acero inoxidable cepillado, resistente a la intemperie. Acabado industrial elegante, recomendado para exteriores y placas identificativas duraderas.">
                        <div class="card cdp-producto-card h-100">
                            <div class="cdp-producto-img-wrap">
                                <img src="" class="card-img-top" alt="Acero Cepillado Moderno">
                            </div>
                            <div class="card-body d-flex flex-column">
                                <p class="cdp-producto-nombre">Acero Cepillado Moderno</p>
                                <div class="d-flex justify-content-between align-items-center mt-auto">
                                    <span class="cdp-producto-precio">₡82 500</span>
                                    <button class="btn btn-sm rounded-circle cdp-btn-agregar" title="Ver detalle"
                                        data-bs-toggle="modal" data-bs-target="#cdpModalDetalle">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <p id="cdpSinResultados" class="text-center text-muted mt-5 d-none">
                    No encontramos placas que coincidan con tu búsqueda.
                </p>

            </div>
        </section>

        <div class="modal fade" id="cdpModalDetalle" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content cdp-modal-detalle">
                    <div class="modal-header border-0">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-4 align-items-center">
                            <div class="col-md-6">
                                <img id="cdpModalImagen" src="" alt="" class="img-fluid cdp-modal-imagen">
                            </div>
                            <div class="col-md-6">
                                <h3 id="cdpModalNombre" class="cdp-modal-nombre"></h3>
                                <p id="cdpModalPrecio" class="cdp-modal-precio"></p>
                                <p id="cdpModalDescripcion" class="cdp-modal-descripcion"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

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